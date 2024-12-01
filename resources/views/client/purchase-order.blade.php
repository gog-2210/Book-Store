@extends('client.layout.app')

@section('content')
<div class="container mx-auto py-6 max-w-5xl">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Danh sách đơn hàng</h1>

    @if($orders->isEmpty())
        <p class="text-gray-600">Bạn chưa có đơn hàng nào.</p>
    @else
        <div class="bg-white shadow-lg rounded-lg p-6">
            <table class="w-full table-auto border-collapse border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left">Mã đơn hàng</th>
                        <th class="px-4 py-3 text-left">Ngày đặt</th>
                        <th class="px-4 py-3 text-center">Tổng cộng</th>
                        <th class="px-4 py-3 text-center">Trạng thái</th>
                        <th class="px-4 py-3 text-center">Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr class="border-b">
                            <td class="px-4 py-3">#{{ $order->id }}</td>
                            <td class="px-4 py-3">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-3 text-center text-cyan-600 font-semibold">
                                {{ number_format($order->payment->amount, 0, ',', '.') }} đ
                            </td>
                            <td class="px-4 py-3 text-center">
                                <span class="px-2 py-1 rounded-full text-white
                                    @if ($order->order_status === 'Hoàn thành') bg-green-500
                                    @elseif ($order->order_status === 'Đang xử lý đơn hàng') bg-yellow-500
                                    @else bg-red-500 @endif">
                                    {{ $order->order_status }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <a href="{{ route('order.show', $order->id) }}"
                                    class="text-cyan-600 hover:underline">
                                    Xem
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
