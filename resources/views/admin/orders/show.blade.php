@extends('admin.layout.app')

@section('content')
<div class="bg-white p-6 rounded shadow-lg">
    <h1 class="text-3xl font-bold text-center">Đơn hàng</h1>
    <h2 class="text-base font-mono text-center mb-6">ID: #{{ $order->id }}</h2>

    <div class="mb-6 bg-white shadow-md rounded-lg p-6">
        <!-- Thông tin người nhận -->
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
                <a href="{{ route('admin.users.show', $order->user->id) }}"
                    class="text-blue-500 hover:underline"><span>{{ $order->nameReceiver }}</span></a>

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
        </div>
    </div>
    <!-- Danh sách sản phẩm -->
    <h2 class="text-2xl font-bold mb-4">Danh sách sản phẩm</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-md">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Ảnh</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Tên Sách</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600">Giá Gốc</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600">Giá Bán</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600">Số Lượng</th>
                    <th class="px-4 py-3 text-right text-sm font-semibold text-gray-600">Thành Tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderDetails as $detail)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-4">
                            <img src="{{ $detail->book->book_image }}" alt="{{ $detail->book->book_name }}"
                                class="w-16 h-20 object-cover rounded">
                        </td>
                        <td class="px-4 py-4 text-gray-800">{{ $detail->book->book_name }}</td>
                        <td class="px-4 py-4 text-center text-gray-600">{{ number_format($detail->book->price) }} VND</td>
                        <td class="px-4 py-4 text-center text-gray-600">{{ number_format($detail->price) }} VND</td>
                        <td class="px-4 py-4 text-center text-gray-800">{{ $detail->quantity }}</td>
                        <td class="px-4 py-4 text-right text-gray-800 font-medium">
                            {{ number_format($detail->quantity * $detail->price) }} VND
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Tổng tiền -->
    <div class="mt-6 text-right">
        <p class="text-lg font-semibold">Phí giao hàng: {{ number_format($order->shipping_fee) }} VND</p>
        <p class="text-lg font-semibold">Tổng tiền: {{ number_format($order->payment->amount) }} VND</p>
    </div>

    <!-- Hành động -->
    <div class="mt-4 text-center">
        <a href="{{ route('admin.orders.index') }}"
            class="px-6 py-2 ml-4 text-white bg-blue-500 hover:bg-blue-600 rounded shadow font-semibold">
            Quay lại
        </a>
    </div>
</div>
@endsection
