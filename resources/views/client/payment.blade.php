@extends('client.layout.app')

@section('content')
<div class="container mx-auto py-10 max-w-4xl">
    <h1 class="text-4xl font-bold text-gray-800 mb-8 text-center">Thông tin thanh toán</h1>

    <form action="{{ route('payment.store') }}" method="GET" class="bg-white shadow-md rounded-lg p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Họ và tên người nhận -->
            <div>
                <label for="nameReceiver" class="block text-gray-700 font-semibold">Họ và tên người nhận</label>
                <input type="text" name="nameReceiver" id="nameReceiver" value="{{ Auth::user()->name }}" required
                    class="w-full mt-2 border border-gray-400 rounded-lg p-3 focus:ring-cyan-500 focus:border-cyan-500">
            </div>

            <!-- Số điện thoại -->
            <div>
                <label for="phoneReceiver" class="block text-gray-700 font-semibold">Số điện thoại</label>
                <input type="text" name="phoneReceiver" id="phoneReceiver" value="{{ Auth::user()->phone }}" required
                    class="w-full mt-2 border border-gray-400 rounded-lg p-3 focus:ring-cyan-500 focus:border-cyan-500">
            </div>
        </div>

        <!-- Địa chỉ giao hàng -->
        <div class="mb-6">
            <label for="shipping_address" class="block text-gray-700 font-semibold">Địa chỉ giao hàng</label>
            <input type="text" name="shipping_address" id="shipping_address" value="{{ Auth::user()->address }}" required
                class="w-full mt-2 border border-gray-400 rounded-lg p-3 focus:ring-cyan-500 focus:border-cyan-500">
        </div>

        <!-- Danh sách sản phẩm -->
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Sản phẩm của bạn</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left border border-gray-200 rounded-lg">
                    <thead class="bg-gray-100 text-gray-600 uppercase text-sm">
                        <tr>
                            <th class="px-4 py-3">Sản phẩm</th>
                            <th class="px-4 py-3 text-center">Số lượng</th>
                            <th class="px-4 py-3 text-center">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($cartItems as $item)
                            <tr>
                                <input type="hidden" name="cart_items[]" value="{{ $item->id }}">
                                <td class="px-4 py-4 flex items-center">
                                    <a href="{{ route('book.show', $item->book->id) }}" class="flex items-center space-x-4">
                                        <img src="{{ asset('storage/'.$item->book->book_image) }}" alt="{{ $item->book->book_name }}"
                                            class="w-16 h-16 object-cover rounded-lg shadow-md">
                                        <div>
                                            <p class="font-semibold text-gray-700">
                                                {{ Str::limit($item->book->book_name, 50) }}
                                            </p>
                                            <p class="text-sm text-gray-500">Giá:
                                                {{ number_format($item->book->price, 0, ',', '.') }} đ
                                            </p>
                                        </div>
                                    </a>
                                </td>
                                <td class="px-4 py-4 text-center text-gray-700">{{ $item->quantity }}</td>
                                <td class="px-4 py-4 text-center font-medium text-cyan-600">
                                    {{ number_format($item->quantity * $item->book->price, 0, ',', '.') }} đ
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tổng cộng -->
        <div class="flex justify-between items-center border-t pt-6">
            <p class="text-2xl font-semibold text-gray-800">Tổng cộng:
                <span class="text-cyan-600">{{ number_format($totalPrice, 0, ',', '.') }} đ</span>
            </p>
            <button type="submit"
                class="px-8 py-3 bg-cyan-600 text-white font-medium text-lg rounded-lg hover:bg-cyan-700 transition shadow-lg">
                Thanh toán
            </button>
        </div>
    </form>
</div>
@endsection
