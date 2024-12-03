@extends('admin.layout.app')

@section('content')
    <h1 class="text-xl font-semibold mb-4">Chi Tiết Đơn Hàng #{{ $order->id }}</h1>

    <!-- Thông tin người nhận -->
    <div class="mb-4">
        <p><strong>Tên Người Nhận:</strong> {{ $order->nameReceiver }}</p>
        <p><strong>Số Điện Thoại:</strong> {{ $order->phoneReceiver }}</p>
        <p><strong>Địa Chỉ:</strong> {{ $order->addressReceiver }}</p>
        <p><strong>Trạng Thái:</strong> {{ $order->order_status }}</p>
    </div>

    <!-- Bảng chi tiết đơn hàng -->
    <table class="min-w-full border-collapse border">
        <thead>
            <tr>
                <th class="border p-2">Tên Sách</th>
                <th class="border p-2">Số Lượng</th>
                <th class="border p-2">Giá</th>
                <th class="border p-2">Tổng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->orderDetails as $orderDetail)
                <tr>
                    <td class="border p-2">{{ $orderDetail->book->book_name }}</td>
                    <td class="border p-2">{{ $orderDetail->quantity }}</td>
                    <td class="border p-2">{{ number_format($orderDetail->price, 0, ',', '.') }} đ</td>
                    <td class="border p-2">{{ number_format($orderDetail->quantity * $orderDetail->price, 0, ',', '.') }} đ</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tổng tiền đơn hàng -->
    <div class="mt-4">
        <p><strong>Tổng Tiền:</strong> {{ number_format($order->orderDetails->sum(function ($detail) { return $detail->quantity * $detail->price; }), 0, ',', '.') }} đ</p>
    </div>

    <!-- Form thay đổi trạng thái -->
    <div class="mt-4">
        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="inline">
            @csrf
            @method('PATCH')
            <label for="status">Thay đổi trạng thái:</label>
            <select name="status" id="status" class="border p-2" onchange="this.form.submit()">
                <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Chưa xử lý</option>
                <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                <option value="shipped" {{ $order->order_status == 'shipped' ? 'selected' : '' }}>Đã giao hàng</option>
                <option value="completed" {{ $order->order_status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
            </select>
        </form>
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.orders.index') }}" class="bg-blue-500 text-white p-2 rounded">Quay lại danh sách đơn hàng</a>
    </div>
@endsection
