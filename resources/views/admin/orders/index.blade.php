@extends('admin.layout.app')

@section('content')
<div class="bg-white p-6 rounded shadow-lg">
    <h1 class="text-3xl font-bold mb-4 text-center">Danh sách đơn hàng</h1>

    <!-- Form Lọc -->
    <form method="GET" action="{{ route('admin.orders.index') }}" class="mb-6">
        <div class="grid grid-cols-3 gap-4">
            <!-- Lọc theo ngày -->
            <div>
                <label for="start_date" class="block font-semibold text-gray-700">Từ ngày:</label>
                <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}"
                    class="border border-gray-300 rounded p-2 w-full">
            </div>
            <div>
                <label for="end_date" class="block font-semibold text-gray-700">Đến ngày:</label>
                <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}"
                    class="border border-gray-300 rounded p-2 w-full">
            </div>

            <!-- Lọc theo trạng thái -->
            <div>
                <label for="order_status" class="block font-semibold text-gray-700">Trạng thái:</label>
                <select id="order_status" name="order_status" class="border border-gray-300 rounded p-2 w-full">
                    <option value="">-- Tất cả --</option>
                    <option value="pending" {{ request('order_status') == 'pending' ? 'selected' : '' }}>Chờ xử lý
                    </option>
                    <option value="shipped" {{ request('order_status') == 'shipped' ? 'selected' : '' }}>Đang giao
                    </option>
                    <option value="delivered" {{ request('order_status') == 'delivered' ? 'selected' : '' }}>Đã giao
                    </option>
                    <option value="canceled" {{ request('order_status') == 'canceled' ? 'selected' : '' }}>Hủy</option>
                </select>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded shadow hover:bg-blue-600">
                Lọc
            </button>
            <a href="{{ route('admin.orders.index') }}"
                class="px-6 py-2 bg-gray-300 text-gray-700 rounded shadow hover:bg-gray-400">
                Xóa lọc
            </a>
        </div>
    </form>

    <!-- Danh sách đơn hàng -->
    <div class="overflow-x-auto">
        <table class="w-full table-auto border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-4 py-2">Mã Đơn</th>
                    <th class="border px-4 py-2">Tên Người Nhận</th>
                    <th class="border px-4 py-2">Trạng Thái</th>
                    <th class="border px-4 py-2">Tổng tiền</th>
                    <th class="border px-4 py-2">Ngày Tạo</th>
                    <th class="border px-4 py-2">Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td class="border px-4 py-2 text-center">{{ $order->id }}</td>
                        <td class="border px-4 py-2">{{ $order->nameReceiver }}</td>
                        <td class="border px-4 py-2 text-center">
                            <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                                @csrf
                                <select name="order_status" onchange="this.form.submit()"
                                    class="border p-1 rounded-md text-sm">
                                    <option class="" value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Chờ xử lý
                                    </option>
                                    <option value="shipped" {{ $order->order_status == 'shipped' ? 'selected' : '' }}>Đang
                                        giao
                                    </option>
                                    <option value="delivered" {{ $order->order_status == 'delivered' ? 'selected' : '' }}>Đã
                                        giao
                                        thành công
                                    </option>
                                    <option value="canceled" {{ $order->order_status == 'canceled' ? 'selected' : '' }}>Đã hủy
                                    </option>
                                </select>
                            </form>
                        </td>
                        <td class="border px-4 py-2 text-center">
                            {{ number_format($order->payment->amount, 0, ',', '.') }} đ
                        </td>
                        <td class="border px-4 py-2 text-center">{{ $order->created_at->format('d-m-Y H:i') }}</td>
                        <td class="border px-4 py-2 text-center">
                            <a href=" {{ route('admin.orders.show', $order->id) }}"
                                class="text-blue-600 hover:text-blue-800">Xem
                                chi tiết</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Phân trang -->
    <div class="mt-6">
        {{ $orders->links() }}
    </div>
</div>
@endsection
