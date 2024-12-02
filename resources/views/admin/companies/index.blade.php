@extends('admin.layout.app')

@section('content')
<div class="bg-white p-6 rounded shadow-lg">
    <h1 class="text-3xl font-bold mb-4 text-center">Danh Sách Công Ty</h1>

    <a href="{{ route('admin.companies.create') }}" class="bg-green-500 text-white p-2 rounded mb-4 inline-block">Thêm Mới Công Ty</a>

    <!-- Form tìm kiếm -->
    <form action="{{ route('admin.companies.index') }}" method="GET" class="mb-4">
        <input type="text" name="search" value="{{ request()->input('search') }}" class="border p-2" placeholder="Tìm kiếm theo tên công ty...">
        <button type="submit" class="bg-blue-500 text-white p-2 rounded">Tìm kiếm</button>
    </form>

    <!-- Bảng danh sách công ty -->
    <table class="w-full table-auto border-collapse">
        <thead>
            <tr>
                <th class="border px-4 py-2">Tên Công Ty</th>
                <th class="border px-4 py-2">Thông Tin</th>
                <th class="border px-4 py-2">Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($companies as $company)
                <tr>
                    <td class="border px-4 py-2">
                        <a href="{{ route('admin.companies.show', $company->id) }}" class="text-blue-500">{{ $company->company_name }}</a>
                    </td>
                    <td class="border px-4 py-2">{{ $company->company_info }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('admin.companies.edit', $company->id) }}" class="text-blue-500">Chỉnh sửa</a>/
                        <form action="{{ route('admin.companies.destroy', $company->id) }}" method="POST" style="display:inline;">
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
        {{ $companies->appends(['search' => request()->input('search')])->links() }}
    </div>
</div>
@endsection
