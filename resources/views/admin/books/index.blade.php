@extends('admin.layout.app')

@section('content')
<div class="bg-white p-6 rounded shadow-lg">
    <h1 class="text-3xl font-bold mb-4 text-center">Danh sách Sách</h1>

    <a href="{{ route('admin.books.create') }}" class="bg-green-500 text-white p-2 rounded mb-4 inline-block">Thêm Mới Sách</a>

    <!-- Tìm kiếm và lọc sách -->
    <form action="{{ route('admin.books.index') }}" method="GET" class="mb-4">
        <div class="grid grid-cols-3 gap-4">
            <!-- Tìm kiếm theo tên sách -->
            <div>
                <label for="book_name" class="block">Tên Sách</label>
                <input type="text" name="book_name" value="{{ request('book_name') }}" class="border p-2 w-full" placeholder="Tên sách...">
            </div>

            <!-- Chọn category con -->
            <div>
                <label for="subCategory" class="block">Danh mục</label>
                <select name="subCategory" class="border p-2 w-full">
                    <option value="">Chọn Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('subCategory') == $category->id ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tìm kiếm theo tác giả -->
            <div>
                <label for="author" class="block">Tác giả</label>
                <input type="text" name="author" value="{{ request('author') }}" class="border p-2 w-full" placeholder="Tác giả...">
            </div>

            <!-- Nút tìm kiếm -->
            <div class="flex items-end">
                <button type="submit" class="bg-blue-500 text-white p-2 rounded">Tìm kiếm</button>
            </div>
        </div>
    </form>

    <!-- Hiển thị danh sách sách -->
    <div class="overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Hình ảnh</th>
                    <th class="border px-4 py-2">Tên sách</th>
                    <th class="border px-4 py-2">Tác giả</th>
                    <th class="border px-4 py-2">Danh mục</th>
                    <th class="border px-4 py-2">Giá</th>
                    <th class="border px-4 py-2">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                    <tr>
                        <td class="border px-4 py-2">
                            <!-- Hiển thị hình ảnh -->
                            @if ($book->book_image)
                                <img src="{{ asset('storage/' . $book->book_image) }}" alt="Hình ảnh sách" class="h-16">
                            @else
                                <p>Không có hình ảnh</p>
                            @endif
                        </td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('admin.books.show', $book->id) }}" class="text-blue-500">{{ $book->book_name }}</a>
                        </td>
                        <td class="border px-4 py-2">{{ $book->author }}</td>
                        <td class="border px-4 py-2">{{ $book->category->category_name }}</td>
                        <td class="border px-4 py-2">{{ number_format($book->price, 0, ',', '.') }} ₫</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('admin.books.edit', $book->id) }}" class="text-blue-500">Sửa</a> |
                            <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Phân trang -->
    <div class="mt-4">
        {{ $books->links() }}
    </div>
</div>
@endsection
