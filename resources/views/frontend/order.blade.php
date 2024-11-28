@extends('frontend.layout.app')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-semibold mb-6">Lịch sử đơn hàng</h1>

    <!-- foreach ($orders as $order) -->
        <div class="bg-white shadow p-6 rounded mb-4">
            <h2 class="text-lg font-semibold">Mã đơn hàng:  $order->id </h2>
            <p>Ngày đặt:  $order->created_at->format('d/m/Y') </p>
            <p>Tổng tiền:  number_format($order->total_price, 0, ',', '.') đ</p>
            <p>Trạng thái: <span class="text-cyan-600"> ucfirst($order->status) </span></p>
            <a href=" route('order.show', $order->id) }}" class="text-cyan-600 hover:underline">Xem chi tiết</a>
        </div>
    <!-- endforeach -->
</div>
@endsection
