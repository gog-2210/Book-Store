@extends('client.layout.app')

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
                            <!-- Checkbox "Chọn tất cả" -->
                            <th class="px-4 py-3 text-center">
                                <input type="checkbox" id="select-all" class="form-checkbox">
                            </th>
                            <th class="px-4 py-3">Sản phẩm</th>
                            <th class="px-4 py-3 text-center">Số lượng</th>
                            <th class="px-4 py-3 text-center">Thành tiền</th>
                            <th class="px-4 py-3 text-center">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $item)
                            <tr class="border-b">
                                <td class="px-4 py-3 text-center">
                                    <!-- Checkbox cho từng sản phẩm -->
                                    <input type="checkbox" name="cart_items[]" value="{{ $item->id }}"
                                        class="form-checkbox item-checkbox">
                                </td>
                                <td class="px-4 py-3 flex items-center space-x-4">
                                    <a href="{{ route('book.show', $item->book->id) }}" class="flex items-center space-x-4">
                                        <img src="{{ asset('storage/'.$item->book->book_image) }}" alt="{{ $item->book->name }}"
                                            class="w-16 h-16 object-cover rounded-lg">
                                        <div>
                                            <p class="font-semibold">{{$item->book->name }}</p>
                                            <p class="text-sm text-gray-600">{{ Str::limit($item->book->book_name, 30) }}
                                            </p>
                                        </div>
                                    </a>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <form id="form_cart_update" method="POST" name="cart_update" action="{{ route('cart.update', $item->id) }}"
                                        class="flex items-center justify-center">
                                        @csrf
                                        @method('PUT')

                                        <!-- Nút trừ -->
                                        <button type="button" id="decrease"
                                            class="px-2 py-1 bg-gray-200 text-gray-800 rounded hover:bg-gray-300"
                                            onclick="updateQuantityAndSubmit(this, -1, '{{ $item->id }}')"
                                            @if($item->quantity <= 1) disabled @endif>
                                            -
                                        </button>

                                        <!-- Input số lượng -->
                                        <input type="number" name="quantity" value="{{ $item->quantity }}"
                                            class="w-16 mx-2 border-gray-300 rounded text-center" min="1"
                                            id="quantity-{{ $item->id }}" readonly>

                                        <!-- Nút cộng -->
                                        <button type="button" id="increase"
                                            class="px-2 py-1 bg-gray-200 text-gray-800 rounded hover:bg-gray-300"
                                            onclick="updateQuantityAndSubmit(this, 1, '{{ $item->id }}')">
                                            +
                                        </button>
                                    </form>
                                </td>
                                <td class="px-4 py-3 text-center font-medium">
                                    {{ number_format($item->quantity * $item->book->price, 0, ',', '.') }}đ
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <form id="form_cart_destroy" name="cart_destroy" method="POST" action="{{ route('cart.destroy', $item->id) }}">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" id="destroy" class="text-red-600 hover:underline">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Tổng cộng -->
                <div class="flex justify-between items-center mt-6">
                    <div>
                        <a href="{{ route('client.index') }}" class="text-cyan-600 hover:underline">Tiếp tục mua sắm</a>
                    </div>
                    <div>
                        <p class="text-xl font-semibold text-gray-700">Tổng cộng:
                            <span id="total_price" class="text-cyan-600">0 đ</span>
                        </p>
                    </div>
                </div>

                <!-- Hành động -->
                <div class="mt-6 flex justify-end space-x-4">
                    <button type="button" id="submit_payment_create" onclick="submit_payment_create()" name="buy"
                        class="bg-cyan-600 text-white px-6 py-2 rounded-lg hover:bg-cyan-700">Thanh
                        toán</button>
                </div>

        </div>
    </div>
</div>

<script>
    // Chức năng chọn tất cả sản phẩm
    const selectAllCheckbox = document.getElementById('select-all');
    const itemCheckboxes = document.querySelectorAll('.item-checkbox');
    const totalPriceElement = document.querySelector('#total_price');

    selectAllCheckbox.addEventListener('change', function () {
        itemCheckboxes.forEach(checkbox => {
            checkbox.checked = selectAllCheckbox.checked;
        });
        updateTotalPrice();
    });

    // Cập nhật tổng cộng khi thay đổi lựa chọn checkbox
    itemCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateTotalPrice);
    });
    function updateTotalPrice() {
        let total = 0;

        itemCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                const price = parseFloat(checkbox.closest('tr').querySelector('.font-medium').innerText.replace(/\D/g, ''));
                total += price;
            }
        });

        totalPriceElement.textContent = new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND'
        }).format(total);
    }

    function updateQuantityAndSubmit(button, change, itemId) {
        const input = button.parentElement.querySelector('input[name="quantity"]');
        let currentQuantity = parseInt(input.value);

        currentQuantity += change;

        if (currentQuantity < 1) currentQuantity = 1;

        input.value = currentQuantity;

        button.parentElement.submit();
    }

    function submit_payment_create() {
        const form = document.createElement('form');
        form.method = 'GET';
        form.action = '{{ route('payment.create') }}';

        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'cart_items';
        input.value = JSON.stringify(Array.from(document.querySelectorAll('.item-checkbox:checked')).map(checkbox => checkbox.value));

        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
    }
</script>
@endsection
