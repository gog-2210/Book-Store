@extends('frontend.layout.app')

@section('content')
<div class="container mx-auto py-6 max-w-4xl">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Giỏ hàng của bạn</h1>

    <!-- Giỏ hàng -->
    <div class="bg-white shadow-lg rounded-lg p-6">
        <!-- Danh sách sản phẩm -->
        <div class="overflow-x-auto">
            <table class="w-full table-auto border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-100 text-gray-700 text-left">
                        <th class="px-4 py-3">Sản phẩm</th>
                        <th class="px-4 py-3 text-center">Số lượng</th>
                        <th class="px-4 py-3 text-center">Giá</th>
                        <th class="px-4 py-3 text-center">Thành tiền</th>
                        <th class="px-4 py-3 text-center">Xóa</th>
                    </tr>
                </thead>
                <tbody>

                <!-- foreach ($cartItems as $item) -->
                        <tr class="border-b">
                            <td class="px-4 py-3 flex items-center space-x-4">
                                <img src=" $item->product->image_url }}" alt=" $item->product->name }}" class="w-16 h-16 object-cover rounded-lg">
                                <div>
                                <p class="font-semibold">$item->product->name </p>
                                    <p class="text-sm text-gray-600">Mã sản phẩm:  $item->product->sku </p>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <form method="POST" action="route('cart.update', $item->id) }}" class="flex items-center justify-center">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="quantity" value=" $item->quantity }}" class="w-16 border-gray-300 rounded text-center" min="1">
                                    <button type="submit" class="ml-2 text-cyan-600 hover:underline">Cập nhật</button>
                                </form>
                            </td>
                            <td class="px-4 py-3 text-center font-medium"> number_format($item->product->price, 0, ',', '.') đ</td>
                            <td class="px-4 py-3 text-center font-medium"> number_format($item->quantity * $item->product->price, 0, ',', '.') đ</td>
                            <td class="px-4 py-3 text-center">
                                <form method="POST" action=" route('cart.destroy', $item->id) ">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    <!-- endforeach -->


                </tbody>
            </table>
        </div>

        <!-- Tổng cộng -->
        <div class="flex justify-between items-center mt-6">
            <div>
                <a href="{{ route('frontend.index') }}" class="text-cyan-600 hover:underline">Tiếp tục mua sắm</a>
            </div>
            <div>
                <p class="text-xl font-semibold text-gray-700">Tổng cộng:
                    <span class="text-cyan-600"> number_format($totalPrice, 0, ',', '.') đ</span>
                </p>
            </div>
        </div>

        <!-- Hành động -->
        <div class="mt-6 flex justify-end space-x-4">
            <a href="{{ route('cart.clear') }}" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Xóa
                toàn bộ</a>
            <a href="{{ route('checkout.index') }}"
                class="bg-cyan-600 text-white px-6 py-2 rounded-lg hover:bg-cyan-700">Tiến hành thanh toán</a>
        </div>
    </div>
</div>
@endsection
