@extends('admin.layout.app')

@section('content')
<div class="bg-white p-6 rounded shadow-lg">
    <h1 class="text-3xl font-bold mb-4 text-center">Thêm Mới Danh Mục</h1>

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="category_name" class="block text-sm font-medium text-gray-700">Tên Danh Mục</label>
            <input type="text" name="category_name" id="category_name" class="border p-2 w-full" required>
        </div>

        <div class="mb-4">
            <label for="parent_id" class="block text-sm font-medium text-gray-700">Danh Mục Cha</label>
            <select name="parent_id" id="parent_id" class="border p-2 w-full">
                <option value="">Chọn danh mục cha</option>
                @foreach ($parentCategories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white p-2 rounded">Lưu</button>
    </form>
</div>
@endsection
