@extends('client.layout.app')

@section('content')
<div class="container mx-auto py-6 max-w-5xl">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Chi tiết đơn hàng #{{ $order->id }}</h1>

    <div class="bg-white shadow-lg rounded-lg p-6">
        <div class="mb-6 bg-white shadow-md rounded-lg p-6">
            <div class="mb-4">
                <h2 class="text-xl font-semibold text-gray-800 mb-3">Thông tin đơn hàng</h2>
                <p class="text-lg flex items-center">
                    <strong class="w-1/3">Trạng thái:</strong>
                    <span class="px-3 py-1 rounded-lg
                @if ($order->order_status === 'pending') bg-yellow-100 text-yellow-800
                @elseif ($order->order_status === 'delivered') bg-green-100 text-green-800
                @elseif ($order->order_status === 'canceled') bg-red-100 text-red-800
                    @else bg-blue-100 text-blue-800
                @endif">
                        @if ($order->order_status === 'delivered')
                            Đã giao thành công
                        @elseif ($order->order_status === 'pending')
                            Chờ xử lý
                        @elseif ($order->order_status === 'canceled')
                            Đã hủy
                        @else
                            Đang giao
                        @endif
                    </span>
                </p>
                <div class="mt-4 border-t border-gray-200 pt-4">
                    <p class="text-lg flex">
                        <strong class="w-1/3">Người nhận:</strong>
                        <span class="text-gray-700">{{ $order->nameReceiver }}</span>
                    </p>
                    <p class="text-lg flex">
                        <strong class="w-1/3">Số điện thoại:</strong>
                        <span class="text-gray-700">{{ $order->phoneReceiver }}</span>
                    </p>
                    <p class="text-lg flex">
                        <strong class="w-1/3">Địa chỉ:</strong>
                        <span class="text-gray-700">{{ $order->shipping_address }}</span>
                    </p>
                    <p class="text-lg flex">
                        <strong class="w-1/3">Ngày đặt:</strong>
                        <span class="text-gray-700">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                    </p>
                    <p class="text-lg flex">
                        <strong class="w-1/3">Tổng cộng:</strong>
                        <span class="text-cyan-600 font-semibold">{{ number_format($totalPrice, 0, ',', '.') }} đ</span>
                    </p>
                </div>
            </div>
        </div>

        <h2 class="text-lg font-semibold text-gray-800 mt-6 mb-4">Sản phẩm</h2>
        <div class="overflow-x-auto">
            <table class="w-full border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3">Sản phẩm</th>
                        <th class="px-4 py-3 text-center">Giá</th>
                        <th class="px-4 py-3 text-center">Số lượng</th>
                        <th class="px-4 py-3 text-center">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderDetails as $detail)
                        <tr class="border-b">
                            <td class="px-4 py-3 flex items-center space-x-4">
                                <img src="{{ $detail->book->book_image }}" alt="{{ $detail->book->book_name }}"
                                    class="w-16 h-16 object-cover rounded-lg">
                                <span>{{ $detail->book->book_name }}</span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                {{ number_format($detail->price, 0, ',', '.') }} đ
                            </td>
                            <td class="px-4 py-3 text-center">{{ $detail->quantity }}</td>
                            <td class="px-4 py-3 text-center">
                                {{ number_format($detail->price * $detail->quantity, 0, ',', '.') }} đ
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
