@extends('admin.layout.app')

@section('content')
<div class="bg-white p-6 rounded shadow-lg">
    <h1 class="text-3xl font-bold mb-4 text-center">Danh Sách Người Dùng</h1>

    <!-- Form tìm kiếm -->
    <form action="{{ route('admin.users.index') }}" method="GET" class="mb-4">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <input type="text" name="name" value="{{ request()->input('name') }}" class="border p-2" placeholder="Tìm kiếm theo tên...">
            <input type="email" name="email" value="{{ request()->input('email') }}" class="border p-2" placeholder="Tìm kiếm theo email...">
            <input type="text" name="phone" value="{{ request()->input('phone') }}" class="border p-2" placeholder="Tìm kiếm theo số điện thoại...">
        </div>
        <button type="submit" class="bg-blue-500 text-white p-2 rounded mt-4">Tìm kiếm</button>
    </form>

    <!-- Bảng danh sách người dùng -->
    <table class="w-full table-auto border-collapse">
        <thead>
            <tr>
                <th class="border px-4 py-2">Tên Người Dùng</th>
                <th class="border px-4 py-2">Email</th>
                <th class="border px-4 py-2">Số Điện Thoại</th>
                <th class="border px-4 py-2">Địa chỉ</th>
                <th class="border px-4 py-2">Trạng Thái</th>

                <th class="border px-4 py-2">Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td class="border px-4 py-2">{{ $user->name }}</td>
                    <td class="border px-4 py-2">{{ $user->email }}</td>
                    <td class="border px-4 py-2">{{ $user->phone }}</td>
                    <td class="border px-4 py-2">{{ $user->address }}</td>
                    <td class="border px-4 py-2">
                        {{ $user->deleted_at ? 'Đã Khoá' : 'Hoạt Động' }}
                    </td> 
                    <td class="border px-4 py-2">
                        <!-- Các nút hành động -->
                        @if($user->deleted_at)
                            <form action="{{ route('admin.users.unlock', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-green-500">Khôi phục</button>
                            </form>
                        @else
                            <!-- Nút Khóa -->
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Khoá</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Phân trang -->
    <div class="mt-4">
        {{ $users->appends(request()->only(['name', 'email', 'phone']))->links() }}
    </div>
</div>
@endsection
