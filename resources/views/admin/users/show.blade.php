@extends('admin.layout.app')

@section('content')
<div class="bg-white p-6 rounded shadow-lg max-w-4xl mx-auto">
    <h1 class="text-3xl font-bold mb-8 text-center text-gray-800">Thông tin người dùng</h1>

    <!-- Container -->
    <div class="grid grid-cols-12 gap-4">
        <!-- Tên người dùng -->
        <div class="col-span-4 font-semibold text-gray-700">Tên người dùng:</div>
        <div class="col-span-8 text-gray-900">{{ $user->name }}</div>

        <!-- Email -->
        <div class="col-span-4 font-semibold text-gray-700">Email:</div>
        <div class="col-span-8 text-gray-900">{{ $user->email }}</div>

        <!-- Số điện thoại -->
        <div class="col-span-4 font-semibold text-gray-700">Số điện thoại:</div>
        <div class="col-span-8 text-gray-900">
            {{ $user->phone ?? 'Chưa cập nhật' }}
        </div>

        <!-- Địa chỉ -->
        <div class="col-span-4 font-semibold text-gray-700">Địa chỉ:</div>
        <div class="col-span-8 text-gray-900">
            {{ $user->address ?? 'Chưa cập nhật' }}
        </div>

        <!-- Xác thực email -->
        <div class="col-span-4 font-semibold text-gray-700">Xác thực email:</div>
        <div class="col-span-8">
            @if ($user->email_verified_at)
                <span class="px-3 py-1 text-sm bg-green-100 text-green-600 font-medium rounded">Đã xác thực</span>
            @else
                <span class="px-3 py-1 text-sm bg-red-100 text-red-600 font-medium rounded">Chưa xác thực</span>
            @endif
        </div>

        <!-- Khóa tài khoản -->
        <div class="col-span-4 font-semibold text-gray-700">Khóa tài khoản:</div>
        <div class="col-span-8">
            @if ($user->blocked)
                <span class="px-3 py-1 text-sm bg-red-100 text-red-600 font-medium rounded">Bị khóa</span>
            @else
                <span class="px-3 py-1 text-sm bg-green-100 text-green-600 font-medium rounded">Chưa bị khóa</span>
            @endif
        </div>

        <!-- Trạng thái -->
        <div class="col-span-4 font-semibold text-gray-700">Trạng thái:</div>
        <div class="col-span-8">
            @if ($user->deleted_at)
                <span class="px-3 py-1 text-sm bg-red-100 text-red-600 font-medium rounded">Đã xóa</span>
            @else
                <span class="px-3 py-1 text-sm bg-green-100 text-green-600 font-medium rounded">Chưa bị xóa</span>
            @endif
        </div>


        <!-- Ngày tạo -->
        <div class="col-span-4 font-semibold text-gray-700">Ngày tạo:</div>
        <div class="col-span-8 text-gray-900">{{ $user->created_at ?? 'N/A'}}</div>

        <!-- Ngày cập nhật -->
        <div class="col-span-4 font-semibold text-gray-700">Ngày cập nhật:</div>
        <div class="col-span-8 text-gray-900">{{ $user->updated_at }}</div>

        <!-- Ngày xóa -->
        <div class="col-span-4 font-semibold text-gray-700">Ngày xóa:</div>
        <div class="col-span-8 text-gray-900">
            {{ $user->deleted_at ?? 'Chưa bị xóa' }}
        </div>
    </div>
    <!-- Nút Quay Lại -->
    <div class="mt-6 text-center">
        <a href="{{ route('admin.users.index') }}"
            class="px-6 py-2 text-white bg-blue-500 hover:bg-blue-600 rounded shadow font-semibold transition duration-200">
            Quay lại
        </a>
    </div>
</div>
@endsection
