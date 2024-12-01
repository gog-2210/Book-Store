<div
    class="group relative bg-white rounded-lg shadow-md overflow-hidden transform transition-transform duration-200 hover:scale-105 hover:shadow-xl">
    <a href="{{ route('book.show', $book->id) }}">
        <!-- Hình ảnh sách -->
        <img src="{{ asset('storage/' . $book->book_image) }}"
            class="w-full h-44 object-cover group-hover:opacity-80 transition-opacity duration-300"
            alt="{{ $book->book_name }}">

        <div class="p-4">
            <!-- Tiêu đề sách với chiều cao cố định -->
            <h5 class="text-lg font-semibold text-gray-800 line-clamp-2 min-h-14 max-h-14 overflow-hidden">{{ Str::limit($book->book_name , 46) }}
            </h5>

            <!-- Phần giá tiền -->
            <div class="mt-3 flex items-center">
                <!-- Giá hiện tại -->
                <div>
                    <span class="text-xl font-semibold text-red-700">{{ number_format($book->price, 0, ',', '.') }}
                        đ</span>
                </div>

                <!-- Phần giảm giá nằm phía bên phải -->
                @if($book->cover_price && $book->cover_price > $book->price)
                    <div class="ml-2 px-2 rounded-md bg-red-700">
                        <!-- Giảm giá % -->
                        <span class="text-sm text-white font-semibold">
                            -{{ round(100 - (($book->price / $book->cover_price) * 100), 0) }}%
                        </span>
                    </div>
                @endif
            </div>

            <!-- Hiển thị giá gốc ở dưới -->
            @if($book->cover_price && $book->cover_price > $book->price)
                <div class="mt-2 text-sm text-gray-500 line-through">
                    {{ number_format($book->cover_price, 0, ',', '.') }} đ
                </div>
            @endif
        </div>
    </a>
</div>
