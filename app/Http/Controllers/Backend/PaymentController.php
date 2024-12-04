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
                return $this->paymentService->handleReturn($data);
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
        $selectedItems = json_decode($request->input('cart_items', '[]'), true);

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
