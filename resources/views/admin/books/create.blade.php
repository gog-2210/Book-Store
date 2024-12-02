@extends('admin.layout.app')

@section('content')
    <h1 class="text-xl font-semibold mb-4 text-center">Thêm Sách Mới</h1>

    <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-3 gap-4">
            <!-- Tên Sách -->
            <div>
                <label for="book_name" class="block">Tên Sách</label>
                <input type="text" name="book_name" value="{{ old('book_name') }}" class="border p-2 w-full" placeholder="Tên sách...">
            </div>

            <!-- Tác Giả -->
            <div>
                <label for="author" class="block">Tác giả</label>
                <input type="text" name="author" value="{{ old('author') }}" class="border p-2 w-full" placeholder="Tác giả...">
            </div>

            <!-- Danh Mục -->
            <div>
                <label for="category_id" class="block">Danh mục</label>
                <select name="category_id" class="border p-2 w-full">
                    <option value="">Chọn danh mục</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Công Ty -->
            <div>
                <label for="company_id" class="block">Công ty</label>
                <select name="company_id" class="border p-2 w-full">
                    <option value="">Chọn công ty</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                            {{ $company->company_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Nhà Xuất Bản -->
            <div>
                <label for="publishing_house" class="block">Nhà xuất bản</label>
                <input type="text" name="publishing_house" value="{{ old('publishing_house') }}" class="border p-2 w-full" placeholder="Nhà xuất bản...">
            </div>

            <!-- Ngày Xuất Bản -->
            <div>
                <label for="publish_date" class="block">Ngày xuất bản</label>
                <input type="date" name="publish_date" value="{{ old('publish_date') }}" class="border p-2 w-full">
            </div>

            <!-- Người Dịch -->
            <div>
                <label for="translator" class="block">Người dịch</label>
                <input type="text" name="translator" value="{{ old('translator') }}" class="border p-2 w-full" placeholder="Người dịch...">
            </div>

            <!-- Số Trang -->
            <div>
                <label for="number_of_pages" class="block">Số trang</label>
                <input type="number" name="number_of_pages" value="{{ old('number_of_pages') }}" class="border p-2 w-full" placeholder="Số trang...">
            </div>

            <!-- Số Lượng -->
            <div>
                <label for="quantity" class="block">Số lượng</label>
                <input type="number" name="quantity" value="{{ old('quantity') }}" class="border p-2 w-full" placeholder="Số lượng...">
            </div>

            <!-- Số Ấn Bản Bán Được -->
            <div>
                <label for="sold" class="block">Số ấn bản bán được</label>
                <input type="number" name="sold" value="{{ old('sold') }}" class="border p-2 w-full" placeholder="Số bán...">
            </div>

            <!-- Giá -->
            <div>
                <label for="price" class="block">Giá</label>
                <input type="text" name="price" value="{{ old('price') }}" class="border p-2 w-full" placeholder="Giá...">
            </div>

            <!-- Mô Tả -->
            <div>
                <label for="description" class="block">Mô tả</label>
                <textarea name="description" class="border p-2 w-full" rows="4" placeholder="Mô tả sách...">{{ old('description') }}</textarea>
            </div>

            <!-- Hình Ảnh -->
            <div>
                <label for="book_image">Hình ảnh sách</label>
                <input type="file" name="book_image" class="border p-2 w-full">
                @error('book_image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="bg-blue-500 text-white p-2 rounded">Thêm sách</button>
        </div>
    </form>

    <a href="{{ route('admin.books.index') }}" class="bg-blue-500 text-white p-2 rounded mt-4 inline-block">Trở lại</a>
@endsection
