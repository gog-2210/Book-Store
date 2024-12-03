@extends('admin.layout.app')

@section('content')
<div class="bg-white p-6 rounded shadow-lg">
    <h1 class="text-3xl font-bold mb-4 text-center">Danh Sách Đơn Hàng</h1>

    <!-- Form tìm kiếm -->
    <form action="{{ route('admin.orders.index') }}" method="GET" class="mb-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm..." class="border p-2 rounded">
        <button type="submit" class="bg-blue-500 text-white p-2 rounded">Tìm kiếm</button>
    </form>

    <!-- Bảng danh sách đơn hàng -->
    <table class="w-full table-auto border-collapse">
        <thead>
            <tr>
                <th class="border px-4 py-2">Mã Đơn Hàng</th>
                <th class="border px-4 py-2">Tên Người Nhận</th>
                <th class="border px-4 py-2">Số Điện Thoại</th>
                <th class="border px-4 py-2">Trạng Thái</th>
                <th class="border p-2">Hành Động</th>
                <th class="border p-2">Thay Đổi Trạng Thái</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td class="border px-4 py-2">{{ $order->id }}</td>
                    <td class="border px-4 py-2">{{ $order->nameReceiver }}</td>
                    <td class="border px-4 py-2">{{ $order->phoneReceiver }}</td>
                    <td class="border px-4 py-2">{{ $order->order_status }}</td>
                    <td class="border p-2">
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="text-blue-500">Chi Tiết</a>
                    </td>
                    <td class="border p-2">
                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="border p-2" onchange="this.form.submit()">
                                <option value="Chưa xử lý" {{ $order->order_status == 'Chưa xử lý' ? 'selected' : '' }}>Chưa xử lý</option>
                                <option value="Đang xử lý" {{ $order->order_status == 'Đang xử lý' ? 'selected' : '' }}>Đang xử lý</option>
                                <option value="Đã giao hàng" {{ $order->order_status == 'Đã giao hàng' ? 'selected' : '' }}>Đã giao hàng</option>
                                <option value="Hoàn thành" {{ $order->order_status == 'Hoàn thành' ? 'selected' : '' }}>Hoàn thành</option>
                                <option value="Đã hủy" {{ $order->order_status == 'Đã hủy' ? 'selected' : '' }}>Đã hủy</option>
                            </select>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Phân trang -->
    <div class="mt-4">
        {{ $orders->links() }}
    </div>
</div>
@endsection
