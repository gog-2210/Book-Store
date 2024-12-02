@extends('admin.layout.app')

@section('content')
<div class="bg-white p-6 rounded shadow-lg">
    <h1 class="text-3xl font-bold mb-4 text-center">Chi Tiết Danh Mục</h1>

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Tên Danh Mục</label>
        <p>{{ $category->category_name }}</p>
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Danh Mục Cha</label>
        <p>{{ $category->parentCategory ? $category->parentCategory->category_name : 'Không có' }}</p>
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Thứ Tự</label>
        <p>{{ $category->order }}</p>
    </div>

    <a href="{{ route('admin.categories.index') }}" class="bg-blue-500 text-white p-2 rounded">Quay lại</a>
</div>
@endsection
