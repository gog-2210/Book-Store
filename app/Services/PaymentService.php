<?php

namespace App\Services;

use App\Models\Payment;
use Illuminate\Support\Facades\Http;

class PaymentService
{
    protected $vnp_TmnCode;
    protected $vnp_HashSecret;
    protected $vnp_Url;
    protected $vnp_ReturnUrl;
    protected $model;
    protected $orderService;
    protected $orderDetailService;
    protected $paymentService;
    protected $cartService;
    protected $bookService;

    public function __construct(
        Payment $payment,
        OrderService $orderService,
        OrderDetailService $orderDetailService,
        CartService $cartService,
        BookService $bookService
    ) {
        $this->vnp_TmnCode = config('services.vnpay.vnp_TmnCode');
        $this->vnp_HashSecret = config('services.vnpay.vnp_HashSecret');
        $this->vnp_Url = config('services.vnpay.vnp_Url');
        $this->vnp_ReturnUrl = config('services.vnpay.vnp_Returnurl');
        $this->model = $payment;
        $this->orderService = $orderService;
        $this->orderDetailService = $orderDetailService;
        $this->cartService = $cartService;
        $this->bookService = $bookService;
    }

    public function createPaymentUrl($data)
    {
        $vnp_TxnRef = time();
        $vnp_IpAddr = request()->ip();
        $bankCode = "NCB";

        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $this->vnp_TmnCode,
            "vnp_Amount" => $data['total_price'] * 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => now()->format('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => "vn",
            "vnp_OrderInfo" => $data['orderInfo'],
            "vnp_OrderType" => "other",
            "vnp_ReturnUrl" => $this->vnp_ReturnUrl,
            "vnp_TxnRef" => $vnp_TxnRef,
        ];

        if ($bankCode) {
            $inputData['vnp_BankCode'] = $bankCode;
        }

        // Sắp xếp key theo thứ tự bảng chữ cái
        ksort($inputData);

        $query = "";
        $hashData = "";
        foreach ($inputData as $key => $value) {
            $hashData .= urlencode($key) . "=" . urlencode($value) . "&";
            $query .= urlencode($key) . "=" . urlencode($value) . "&";
        }

        // Xóa ký tự `&` cuối cùng
        $hashData = rtrim($hashData, "&");
        $query = rtrim($query, "&");

        // Tạo Secure Hash
        if (!empty($this->vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashData, $this->vnp_HashSecret);
            $query .= '&vnp_SecureHash=' . $vnpSecureHash;
        }

        // Tạo URL thanh toán
        $paymentUrl = $this->vnp_Url . "?" . $query;

        $paymentCreate = $this->create([
            'payment_status' => 'Đang xử lý',
            'payment_type' => 'vnpay',
            'amount' => $data['total_price'],
        ]);

        $data['payment_id'] = $paymentCreate->id;
        session()->put('data', $data);

        return $paymentUrl;
    }

    public function handleReturn($data)
    {
        // Lưu thông tin order
        $order = $this->orderService->create([
            'user_id' => auth()->id(),
            'payment_id' => $data['payment_id'],
            'shipping_address' => $data['shipping_address'],
            'phoneReceiver' => $data['phoneReceiver'],
            'nameReceiver' => $data['nameReceiver'],
        ]);

        // Lưu thông tin order detail
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

        // Cập nhật trạng thái thanh toán
        $this->update($data['payment_id'], ['payment_status' => 'Đã thanh toán']);

        // Xóa cart theo ids
        $this->cartService->deleteByIds($data['cart_items']);

        session()->forget('cart');
        session()->forget('data');

        return redirect()->route('order')->with('success', 'Thanh toán thành công!');
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($id, $data)
    {
        return $this->model->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }
}
