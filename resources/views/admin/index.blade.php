@extends('admin.layout.app')

@section('content')
<div class="bg-gray-50 p-6 rounded-lg">
    <!-- Title -->
    <h1 class="text-4xl font-extrabold text-gray-800 mb-8">Admin Dashboard</h1>

    <!-- Filter Section -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <form method="GET" action="{{ route('admin.index') }}" class="flex flex-wrap gap-4 items-center">
            <!-- Date Filter -->
            <div>
                <label for="date" class="block text-sm font-semibold text-gray-700">Ngày:</label>
                <input type="date" name="date" id="date" value="{{ request('date') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <!-- Month Filter -->
            <div>
                <label for="month" class="block text-sm font-semibold text-gray-700">Tháng:</label>
                <input type="month" name="month" id="month" value="{{ request('month') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <!-- Year Filter -->
            <div>
                <label for="year" class="block text-sm font-semibold text-gray-700">Năm:</label>
                <input type="number" name="year" id="year" value="{{ request('year') }}" min="2000"
                    max="{{ now()->format('Y') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <!-- Filter Button -->
            <div class="self-end">
                <button type="submit"
                    class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600">
                    Lọc
                </button>
            </div>
        </form>
    </div>

    <!-- Statistics Section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gradient-to-r from-green-400 to-green-500 text-white p-6 rounded-lg shadow-md text-center">
            <h3 class="text-xl font-semibold">Doanh thu ngày</h3>
            <p class="text-3xl font-bold mt-2">{{ number_format($revenueToday, 0, ',', '.') }} VND</p>
        </div>
        <div class="bg-gradient-to-r from-orange-400 to-orange-500 text-white p-6 rounded-lg shadow-md text-center">
            <h3 class="text-xl font-semibold">Doanh thu tháng</h3>
            <p class="text-3xl font-bold mt-2">{{ number_format($revenueThisMonth, 0, ',', '.') }} VND</p>
        </div>
        <div class="bg-gradient-to-r from-blue-400 to-blue-500 text-white p-6 rounded-lg shadow-md text-center">
            <h3 class="text-xl font-semibold">Doanh thu năm</h3>
            <p class="text-3xl font-bold mt-2">{{ number_format($revenueThisYear, 0, ',', '.') }} VND</p>
        </div>
    </div>

    <!-- Orders Statistics Section -->
    <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Thống kê đơn hàng</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="text-center p-4 bg-yellow-100 rounded-lg shadow">
                <p class="text-sm font-semibold text-yellow-600">Đang chờ xử lý</p>
                <p class="text-3xl font-bold text-yellow-700">{{ $pendingOrders }}</p>
            </div>
            <div class="text-center p-4 bg-green-100 rounded-lg shadow">
                <p class="text-sm font-semibold text-green-600">Đã giao thành công</p>
                <p class="text-3xl font-bold text-green-700">{{ $deliveredOrders }}</p>
            </div>
            <div class="text-center p-4 bg-red-100 rounded-lg shadow">
                <p class="text-sm font-semibold text-red-600">Đã hủy</p>
                <p class="text-3xl font-bold text-red-700">{{ $canceledOrders }}</p>
            </div>
            <div class="text-center p-4 bg-blue-100 rounded-lg shadow">
                <p class="text-sm font-semibold text-blue-600">Tổng số đơn hàng</p>
                <p class="text-3xl font-bold text-blue-700">{{ $totalOrders }}</p>
            </div>
        </div>
    </div>

    <!-- Latest Orders Section -->
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Đơn hàng mới nhất</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left border border-gray-200">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="p-4">Mã đơn hàng</th>
                        <th class="p-4">Khách hàng</th>
                        <th class="p-4">Trạng thái</th>
                        <th class="p-4">Tổng tiền</th>
                        <th class="p-4">Ngày đặt</th>
                        <th class="p-4">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($latestOrders as $order)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-4">{{ $order->id }}</td>
                            <td class="p-4">{{ $order->nameReceiver }}</td>
                            <td class="p-4">
                                <span class="px-3 py-1 rounded-full
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
                            </td>
                            <td class="p-4">{{ number_format($order->payment->amount, 0, ',', '.') }} VND</td>
                            <td class="p-4">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td class="p-4">
                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                    class="text-blue-500 hover:underline">Xem</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
