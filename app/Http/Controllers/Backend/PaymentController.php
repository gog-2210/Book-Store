<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\BookService;
use App\Services\CartService;
use App\Services\OrderDetailService;
use App\Services\OrderService;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentService;
    protected $cartService;
    protected $orderService;
    protected $orderDetailService;
    protected $bookService;

    public function __construct(PaymentService $paymentService, CartService $cartService, OrderService $orderService, OrderDetailService $orderDetailService, BookService $bookService)
    {
        $this->paymentService = $paymentService;
        $this->cartService = $cartService;
        $this->orderService = $orderService;
        $this->orderDetailService = $orderDetailService;
        $this->bookService = $bookService;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cartItems = session()->get('cart', []);

        $request['total_price'] = $cartItems->sum(function ($item) {
            return $item->quantity * $item->book->price ?? 0;
        });

        $request['orderInfo'] = auth()->id() . '-' . time();

        $request = $request->all();

        session()->put('data', $request);

        $paymentUrl = $this->paymentService->createPaymentUrl($request);

        return redirect($paymentUrl);
    }

    public function return(Request $request)
    {
        $vnp_SecureHash = $request->input('vnp_SecureHash');
        $inputData = $request->except('vnp_SecureHashType', 'vnp_SecureHash');

        ksort($inputData);
        $hashData = urldecode(http_build_query($inputData));
        $secureHash = hash_hmac('sha512', $hashData, config('services.vnpay.vnp_HashSecret'));
        $data = session()->get('data');
        if ($vnp_SecureHash === $secureHash) {
            if ($request->input('vnp_ResponseCode') == '00') {
                // Lưu thông tin đơn hàng
                $order = $this->orderService->create([
                    'user_id' => auth()->id(),
                    'payment_id' => $data['payment_id'],
                    'shipping_address' => $data['shipping_address'],
                    'phoneReceiver' => $data['phoneReceiver'],
                    'nameReceiver' => $data['nameReceiver'],
                ]);

                // Lưu thông tin chi tiết đơn hàng
                foreach ($data['cart_items'] as $item) {
                    $cartItem = $this->cartService->getCartById($item);
                    $this->orderDetailService->create([
                        'order_id' => $order->id,
                        'book_id' => $cartItem->book_id,
                        'quantity' => $cartItem->quantity,
                        'price' => $cartItem->book->price,
                    ]);
                    $this->bookService->updateQuantityAndSold($cartItem->book_id, $cartItem->quantity);
                }

                $this->paymentService->update($data['payment_id'], ['payment_status' => 'Đã thanh toán']);

                $this->cartService->deleteByUserId(auth()->id());

                session()->forget('cart');
                session()->forget('data');

                return redirect()->route('order')->with('success', 'Thanh toán thành công!');
            } else {
                $this->paymentService->delete($data['payment_id']);

                return redirect()->route('cart')->with('error', 'Thanh toán thất bại!');
            }
        } else {
            return redirect()->route('cart')->with('error', 'Chữ ký không hợp lệ!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function create(Request $request)
    {
        $selectedItems = $request->input('cart_items', []);
        if (empty($selectedItems)) {
            return redirect()->route('cart')->with('error', 'Vui lòng chọn ít nhất một sản phẩm.');
        }

        $cartItems = $this->cartService->getCartByIds($selectedItems);
        session()->put('cart', $cartItems);
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->quantity * $item->book->price ?? 0;
        });

        return view('client.payment', compact('cartItems', 'totalPrice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
