<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(Request $request)
    {
        $orders = $this->orderService->getAllOrdersWithSearchAndPagination($request->search);
        return view('admin.orders.index', compact('orders'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // // Validate dữ liệu thanh toán
        // $request->validate([
        //     'payment_method' => 'required|string',
        //     'address' => 'required|string|max:255',
        //     'phone' => 'required|string|max:15',
        // ]);

        // // Lấy giỏ hàng hiện tại
        // $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();

        // if ($cartItems->isEmpty()) {
        //     return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống. Không thể đặt hàng.');
        // }

        // // Tính tổng giá trị đơn hàng
        // $totalPrice = $cartItems->sum(function ($item) {
        //     return $item->quantity * $item->product->price;
        // });

        // // Tạo đơn hàng
        // $order = Order::create([
        //     'user_id' => auth()->id(),
        //     'total_price' => $totalPrice,
        //     'payment_method' => $request->payment_method,
        //     'address' => $request->address,
        //     'phone' => $request->phone,
        //     'status' => 'pending', // trạng thái mặc định: chờ xử lý
        // ]);

        // // Lưu từng sản phẩm trong giỏ hàng vào bảng order_items
        // foreach ($cartItems as $item) {
        //     $order->items()->create([
        //         'product_id' => $item->product_id,
        //         'quantity' => $item->quantity,
        //         'price' => $item->product->price,
        //     ]);
        // }

        // // Xóa giỏ hàng sau khi đặt hàng thành công
        // Cart::where('user_id', auth()->id())->delete();

        // // Gửi email xác nhận đơn hàng (nếu cần)
        // // Mail::to(auth()->user()->email)->send(new OrderConfirmationMail($order));

        // return redirect()->route('order.show', $order->id)->with('success', 'Đặt hàng thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show($orderId)
    {
        $order = Order::with('orderDetails.book')->findOrFail($orderId); // Lấy thông tin đơn hàng cùng với các chi tiết (sách)
        
        return view('admin.orders.show', compact('order'));
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

    public function updateStatus(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->order_status = $request->status; // Cập nhật trạng thái
        $order->save();

        return redirect()->route('admin.orders.index')->with('success', 'Trạng thái đơn hàng đã được cập nhật');
    }
    


    public function updateShipping(Request $request, $id)
    {
        $this->orderService->updateShippingInfo($id, $request->all());
        return redirect()->route('admin.orders.show', $id)->with('success', 'Cập nhật thông tin giao hàng thành công');
    }
}
