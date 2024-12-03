@extends('admin.layout.app')

@section('content')
<div class="bg-white p-6 rounded shadow-lg">
    <h1 class="text-3xl font-bold mb-4 text-center">Danh sách người dùng</h1>

    <a href="{{ route('admin.users.create') }}" class="bg-green-500 text-white p-2 rounded mb-4 inline-block">Thêm mới
        người dùng</a>

    <!-- Form tìm kiếm -->
    <form action="{{ route('admin.users.index') }}" method="GET" class="mb-4">
        <input type="text" name="search" value="{{ request()->input('search') }}" class="border p-2"
            placeholder="Tìm kiếm theo tên người dùng...">
        <button type="submit" class="bg-blue-500 text-white p-2 rounded">Tìm kiếm</button>
    </form>

    <!-- Bảng danh sách người dùng -->
    <table class="w-full table-auto border-collapse">
        <thead>
            <tr>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Tên người dùng</th>
                <th class="border px-4 py-2">Email</th>
                <th class="border px-4 py-2">Xác thực email</th>
                <th class="border px-4 py-2">Khóa tài khoản</th>
                <th class="border px-4 py-2">Đã xóa</th>
                <th class="border px-4 py-2">Hành động</th>
            </tr>
        </thead>

            @foreach ($users as $user)
                @if ($user->id == 1)
                    @continue
                @endif
                <tr>
                    <td class="border px-4 py-2">{{ $user->id }}</td>
                    <td class="border px-4 py-2">
                        @if ($user->deleted_at)
                            <span class="line-through">{{ $user->name }}</span>
                        @else
                            <a href="{{ route('admin.users.show', $user->id) }}" class="text-blue-500">{{ $user->name }}</a>
                        @endif

                    </td>
                    <td class="border px-4 py-2">{{ $user->email }}</td>
                    <td class="border px-4 py-2">
                        @if ($user->email_verified_at)
                            <span class="px-3 py-1 text-sm bg-green-100 text-green-600 font-medium rounded">Đã xác thực</span>
                        @else
                            <span class="px-3 py-1 text-sm bg-red-100 text-red-600 font-medium rounded">Chưa xác thực</span>
                        @endif
                    </td>
                    <td class="border px-4 py-2">
                        @if ($user->blocked)
                            <span class="px-3 py-1 text-sm bg-red-100 text-red-600 font-medium rounded">Bị khóa</span>
                        @else
                            <span class="px-3 py-1 text-sm bg-green-100 text-green-600 font-medium rounded">Chưa bị khóa</span>
                        @endif
                    </td>
                    <td class="border px-4 py-2">
                        @if ($user->deleted_at)
                            <span class="px-3 py-1 text-sm bg-red-100 text-red-600 font-medium rounded">Đã xóa</span>
                        @else
                            <span class="px-3 py-1 text-sm bg-green-100 text-green-600 font-medium rounded">Chưa bị xóa</span>
                        @endif
                    </td>
                    <td class="border px-4 py-2">
                        @if ($user->deleted_at)
                            <form action="{{ route('admin.users.restore', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="text-green-500">Khôi phục</button>
                            </form>
                        @else
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-500">Chỉnh sửa</a>/
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Xóa</button>
                            </form>
                        @endif

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Phân trang -->
    <div class="mt-4">
        {{ $users->appends(['search' => request()->input('search')])->links() }}
    </div>
</div>




@endsection
