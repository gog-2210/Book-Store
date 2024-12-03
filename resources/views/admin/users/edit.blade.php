@extends('admin.layout.app')

@section('content')

<div class="bg-white p-6 rounded shadow-lg">
    <h1 class="text-3xl font-bold mb-4 text-center">Chỉnh Sửa Người Dùng</h1>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block font-semibold">Tên Người Dùng:</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="border p-2 w-full"
                required>
            <x-error-message field="name" />
        </div>

        <div class="mb-4">
            <label for="email" class="block font-semibold">Email:</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                class="border p-2 w-full" required>
            <x-error-message field="email" />
        </div>

        <div class="mb-4">
            <label for="phone" class="block font-semibold">Số Điện Thoại:</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                class="border p-2 w-full">
            <x-error-message field="phone" />
        </div>

        <div class="mb-4">
            <label for="block" class="block font-semibold">Khóa tài khoản:</label>
            <select name="block" id="block" class="border p-2 w-full">
                <option value="">Chọn Trạng Thái</option>
                <option value="0" {{ old('block', $user->block) === false ? 'selected' : '' }}>Chưa bị chặn</option>
                <option value="1" {{ old('block', $user->block) === true ? 'selected' : '' }}>Đã bị chặn</option>
            </select>
            <x-error-message field="block" />
        </div>

        <div class="mb-4">
            <label for="role" class="block font-semibold">Vai Trò:</label>
            <select name="role" id="role" class="border p-2 w-full">
                <option value="">Chọn Vai Trò</option>
                <option value="1" {{ old('role', $user->role) === 1 ? 'selected' : '' }}>Admin</option>
                <option value="0" {{ old('role', $user->role) === 0 ? 'selected' : '' }}>User</option>
            </select>
            <x-error-message field="role" />
        </div>

        <div class="mb-4">
            <label for="address" class="block font-semibold">Địa Chỉ:</label>
            <input type="text" name="address" id="address" value="{{ old('address', $user->address) }}"
                class="border p-2 w-full" required>
            <x-error-message field="address" />
        </div>

        <div>
            <button type="submit" class="bg-blue-500 text-white p-2 rounded">Cập Nhật</button>
            <a href="{{ route('admin.users.index') }}" class="bg-gray-500 text-white p-2 rounded">Quay Lại</a>
        </div>
    </form>
</div>


@endsection
