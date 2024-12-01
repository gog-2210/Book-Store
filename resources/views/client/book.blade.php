@extends('client.layout.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Chi tiết sách -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Hình ảnh sách -->
        <div class="flex justify-center">
            <img src="{{ asset('storage/' . $book->book_image) }}" alt="{{ $book->book_name }}"
                class="w-full max-w-md object-cover shadow-lg rounded-lg">
        </div>

        <!-- Thông tin sách -->
        <div>
            <!-- Tên sách -->
            <h1 class="text-2xl font-bold text-gray-800">{{ $book->book_name }}</h1>

            <!-- Giá cả -->
            <div class="mt-4">
                <div class="flex items-center space-x-4">
                    <span class="text-3xl font-semibold text-red-600">
                        {{ number_format($book->price, 0, ',', '.') }} VND
                    </span>
                    @if($book->cover_price && $book->cover_price > $book->price)
                        <span class="text-sm text-gray-500 line-through">
                            {{ number_format($book->cover_price, 0, ',', '.') }} VND
                        </span>
                        <span class="text-sm text-green-500 font-bold">
                            -{{ number_format((1 - $book->price / $book->cover_price) * 100, 0) }}%
                        </span>
                    @endif
                </div>
            </div>

            <!-- Mô tả ngắn -->
            <p class="mt-6 text-gray-600">{{ $book->description }}</p>

            <!-- Thông tin bổ sung -->
            <div class="mt-6">
                <p><strong>Tác giả:</strong> {{ $book->author->author_name ?? 'Không rõ' }}</p>
                <p><strong>Nhà xuất bản:</strong> {{ $book->publishing_house ?? 'Không rõ' }}</p>
                <p><strong>Số trang:</strong> {{ $book->number_of_pages ?? 'Không rõ' }}</p>
                <p><strong>Chất lượng:</strong> {{ $book->quality ?? 'Không rõ' }}</p>
            </div>

            <!-- Nút hành động -->
            <form action="{{ route('cart.store') }}" method="POST">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                <input type="hidden" name="price" value="{{ $book->price }}">
                <input type="hidden" name="quantity" value="1"> <!-- Số lượng mặc định -->
                <div class="mt-8">
                    @if (($book->quantity - $book->sold) > 0)
                        <p class="red-text mb-3">Chỉ còn <b>{{ $book->quantity - $book->sold }}</b> cuốn</p>

                        <!-- Nút Thêm vào giỏ hàng -->
                        <button class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-700 transition"
                            type="submit" name="action" value="addToCart">
                            Thêm vào giỏ hàng
                        </button>

                        <!-- Nút Mua ngay -->
                        <button class="bg-red-600 text-white px-6 py-3 rounded-lg shadow hover:bg-red-700 transition"
                            type="submit" name="action" value="buyNow">
                            Mua ngay
                        </button>
                    @elseif (($book->quantity - $book->sold) <= 0)
                        <button class="bg-red-300 text-white px-6 py-3 rounded-lg shadow" type="button" disabled>
                            Sản phẩm hết hàng
                        </button>
                    @else
                        <button class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-700 transition"
                            type="button" disabled>
                            Thêm vào giỏ hàng
                        </button>
                    @endif
                </div>
            </form>

        </div>

        <!-- Sách liên quan -->
        <div class="mt-12">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Sách liên quan</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($booksCategory as $bookCategory)
                    <x-book-item :book="$bookCategory" />
                @endforeach
            </div>
        </div>
    </div>
    @endsection
