@extends('admin.layout.app')

@section('content')
<div class="bg-white p-6 rounded shadow-lg">
    <h1 class="text-3xl font-bold mb-4 text-center">Danh Mục</h1>

    <a href="{{ route('admin.categories.create') }}" class="bg-green-500 text-white p-2 rounded mb-4 inline-block">Thêm Mới Danh Mục</a>

    <!-- Form tìm kiếm -->
    <form action="{{ route('admin.categories.index') }}" method="GET" class="mb-4">
        <input type="text" name="search" value="{{ request()->input('search') }}" class="border p-2" placeholder="Tìm kiếm danh mục...">
        <button type="submit" class="bg-blue-500 text-white p-2 rounded">Tìm kiếm</button>
    </form>

    <!-- Bảng danh sách categories -->
    <table class="w-full table-auto border-collapse">
        <thead>
            <tr>
                <th class="border px-4 py-2">Tên Danh Mục</th>
                <th class="border px-4 py-2">Danh Mục Cha</th> <!-- Thêm cột danh mục cha -->
                <th class="border px-4 py-2">Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td class="border px-4 py-2">
                        <a href="{{ route('admin.categories.show', $category->id) }}" class="text-blue-600 hover:underline">
                            {{ $category->category_name }}
                        </a>
                    </td>
                    <td class="border px-4 py-2">
                        <!-- Kiểm tra nếu có danh mục cha thì hiển thị tên, nếu không thì để trống -->
                        {{ $category->parentCategory ? $category->parentCategory->category_name : 'Không có' }}
                    </td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-blue-500">Chỉnh sửa</a>
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Phân trang -->
    <div class="mt-4">
        {{ $categories->appends(['search' => request()->input('search')])->links() }}
    </div>
</div>
@endsection
