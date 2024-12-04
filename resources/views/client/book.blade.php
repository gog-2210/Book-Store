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
                <p><strong>Tác giả:</strong> {{ $book->author ?? 'Không rõ' }}</p>
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
    </div>

    <div class="rating-container bg-white p-6 rounded-lg shadow-lg mt-6">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Đánh giá sản phẩm</h3>
        <div class="flex items-center mb-6">
            <div class="text-5xl font-bold text-gray-800">0<span class="text-2xl">/5</span></div>
            <div class="ml-4">
                <div class="flex items-center">
                    <span class="text-yellow-400 text-2xl">
                        ★★★★★
                    </span>
                    <span class="text-gray-500 text-sm ml-2">(0 đánh giá)</span>
                </div>
            </div>
        </div>

        <div class="rating-breakdown space-y-2">
            <div class="flex items-center">
                <span class="text-sm text-gray-600 w-12">5 sao</span>
                <div class="flex-grow h-2 bg-gray-200 rounded-full overflow-hidden">
                    <div class="h-full bg-yellow-400" style="width: 60%;"></div>
                </div>
                <span class="text-sm text-gray-600 w-12 text-right">60%</span>
            </div>
            <div class="flex items-center">
                <span class="text-sm text-gray-600 w-12">4 sao</span>
                <div class="flex-grow h-2 bg-gray-200 rounded-full overflow-hidden">
                    <div class="h-full bg-yellow-400" style="width: 40%;"></div>
                </div>
                <span class="text-sm text-gray-600 w-12 text-right">0%</span>
            </div>
            <div class="flex items-center">
                <span class="text-sm text-gray-600 w-12">3 sao</span>
                <div class="flex-grow h-2 bg-gray-200 rounded-full overflow-hidden">
                    <div class="h-full bg-yellow-400" style="width: 10%;"></div>
                </div>
                <span class="text-sm text-gray-600 w-12 text-right">10%</span>
            </div>
            <div class="flex items-center">
                <span class="text-sm text-gray-600 w-12">2 sao</span>
                <div class="flex-grow h-2 bg-gray-200 rounded-full overflow-hidden">
                    <div class="h-full bg-yellow-400" style="width: 20%;"></div>
                </div>
                <span class="text-sm text-gray-600 w-12 text-right">20%</span>
            </div>
            <div class="flex items-center">
                <span class="text-sm text-gray-600 w-12">1 sao</span>
                <div class="flex-grow h-2 bg-gray-200 rounded-full overflow-hidden">
                    <div class="h-full bg-yellow-400" style="width: 1%;"></div>
                </div>
                <span class="text-sm text-gray-600 w-12 text-right">1%</span>
            </div>
        </div>

        <div class="mt-6 text-sm text-gray-600">
            @guest
                <p>Chỉ có thành viên mới có thể viết nhận xét. Vui lòng
                    <a href="#" class="text-blue-500 hover:underline">đăng nhập</a> hoặc
                    <a href="#" class="text-blue-500 hover:underline">đăng ký</a>.
                </p>
            @endguest

            @auth
                <!-- Ô nhập bình luận -->
                <div class="mb-6">
                    <label for="comment" class="block text-lg font-medium text-gray-800 mb-2">Viết nhận xét của bạn</label>
                    <textarea id="comment" rows="4"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring focus:ring-blue-300 focus:border-blue-500"
                        placeholder="Nhập bình luận của bạn tại đây..."></textarea>
                    <button class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                        Gửi bình luận
                    </button>
                </div>
            @endauth

            <!-- Danh sách bình luận -->
            <h3 class="text-lg font-bold text-gray-800 mb-4">Bình luận</h3>
            <div class="space-y-4">
                <!-- Bình luận mẫu -->
                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 rounded-full bg-gray-200 flex-shrink-0"><img src="{{ asset('/images/logo.png') }}"></div>
                    <div>
                        <p class="font-bold text-gray-800">Chú pé đần 001</p>
                        <p class="text-gray-600">Sách hay voãi đoạn, quất chục quyển vẫn về phát cho cả dòng đọc luôn</p>
                        <p class="text-sm text-gray-400">2 ngày trước</p>
                    </div>
                </div>
                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 rounded-full bg-gray-200 flex-shrink-0"><img src="{{ asset('/images/avatarprofile.jpg') }}"></div>
                    <div>
                        <p class="font-bold text-gray-800">Chấn Bé ĐÙ 22</p>
                        <p class="text-gray-600">Sách cuốn thôi rồi luônn lượm ơiiiiiiiiiiiii</p>
                        <p class="text-sm text-gray-400">1 tuần trước</p>
                    </div>
                </div>
                <!-- Thêm nhiều bình luận khác -->
            </div>
        </div>
    </div>


    <!-- Sách liên quan -->
    <div class="mt-12">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Sách liên quan</h2>
        <div class="flex gap-6 overflow-x-auto hide-scrollbar overflow-y-hidden">
            @foreach($booksCategory as $bookCategory)
                <div class="flex-shrink-0 w-60">
                    <x-book-item :book="$bookCategory" />
                </div>
            @endforeach
        </div>
    </div>


    @endsection
