@extends('admin.layout.app')

@section('content')
<div class="bg-white p-6 rounded shadow-lg">
    <h1 class="text-3xl font-bold mb-4 text-center">Thêm Mới Người Dùng</h1>
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block font-semibold">Tên Người Dùng:</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="border p-2 w-full" required>
            <x-error-message field="name" />
        </div>
        <div class="mb-4">
            <label for="email" class="block font-semibold">Email:</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" class="border p-2 w-full" required>
            <x-error-message field="email" />
        </div>

        <div class="mb-4">
            <label for="email_verified_at" class="block font-semibold">Xác Nhận Email:</label>
            <select name="email_verified_at" id="email_verified_at" class="border p-2 w-full">
                <option value="">Chọn Trạng Thái</option>
                <option value="{{now()}}">Đã Xác Nhận</option>
                <option value="">Chưa Xác Nhận</option>
            </select>
            <x-error-message field="email_verified_at" />
        </div>

        <div class="mb-4">
            <label for="phone" class="block font-semibold">Số Điện Thoại:</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="border p-2 w-full">
            <x-error-message field="phone" />
        </div>

        <div class="mb-4">
            <label for="address" class="block font-semibold">Địa Chỉ:</label>
            <input type="text" name="address" id="address" value="{{ old('address') }}" class="border p-2 w-full"
                required>
            <x-error-message field="address" />
        </div>

        <div class="mb-4">
            <label for="role" class="block font-semibold">Vai Trò:</label>
            <select name="role" id="role" class="border p-2 w-full" required>
                <option value="">Chọn Vai Trò</option>
                <option value="1">Admin</option>
                <option value="0">User</option>
            </select>
            <x-error-message field="role" />
        </div>
        <div class="mb-4">
            <label for="password" class="block font-semibold">Mật Khẩu:</label>
            <input type="password" name="password" id="password" class="border p-2 w-full" required>
            <x-error-message field="password" />
        </div>
        <div class="mb-4">
            <label for="password_confirmation" class="block font-semibold">Nhập Lại Mật Khẩu:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="border p-2 w-full"
                required>
            <x-error-message field="password" />
        </div>
        <div>
            <button type="submit" class="bg-green-500 text-white p-2 rounded">Thêm Mới</button>
            <a href="{{ route('admin.users.index') }}" class="bg-gray-500 text-white p-2 rounded">Quay Lại</a>
        </div>
    </form>
</div>
@endsection
