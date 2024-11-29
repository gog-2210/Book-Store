@extends('client.layout.app')

@section('content')
<div class="container mx-auto py-6 max-w-4xl">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Hồ sơ</h1>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <!-- Cập nhật thông tin -->
            <div class="bg-gray-100 rounded-lg p-6 shadow-md">
                <h2 class="text-xl font-bold text-gray-700 mb-4">Thông tin cá nhân</h2>
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-600">Tên</label>
                        <input type="text" id="name" name="name" class="w-full border-gray-300 rounded-lg mt-1 p-2 focus:ring-cyan-500 focus:border-cyan-500" value="{{ old('name', Auth::user()->name) }}" required>
                        <x-error-message field="name" />
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                        <input type="email" id="email" name="email" class="w-full border-gray-300 rounded-lg mt-1 p-2 focus:ring-cyan-500 focus:border-cyan-500" value="{{ old('email', Auth::user()->email) }}" readonly>
                        <x-error-message field="email" />
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="block text-sm font-medium text-gray-600">Số điện thoại</label>
                        <input type="text" id="phone" name="phone" class="w-full border-gray-300 rounded-lg mt-1 p-2 focus:ring-cyan-500 focus:border-cyan-500" value="{{ old('phone', Auth::user()->phone) }}">
                        <x-error-message field="phone" />
                    </div>

                    <div class="mb-4">
                        <label for="address" class="block text-sm font-medium text-gray-600">Địa chỉ</label>
                        <input type="text" id="address" name="address" class="w-full border-gray-300 rounded-lg mt-1 p-2 focus:ring-cyan-500 focus:border-cyan-500" value="{{ old('address', Auth::user()->address) }}">
                        <x-error-message field="address" />
                    </div>

                    <button type="submit" class="w-full bg-cyan-600 text-white px-4 py-2 rounded-lg hover:bg-cyan-700 focus:ring-2 focus:ring-cyan-500">Cập nhật thông tin</button>
                </form>
            </div>

            <!-- Đổi mật khẩu -->
            <div class="bg-gray-100 rounded-lg p-6 shadow-md">
                <h2 class="text-xl font-bold text-gray-700 mb-4">Đổi mật khẩu</h2>
                <form method="POST" action="{{ route('profile.changePassword') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="current_password" class="block text-sm font-medium text-gray-600">Mật khẩu hiện tại</label>
                        <input type="password" id="current_password" name="current_password" class="w-full border-gray-300 rounded-lg mt-1 p-2 focus:ring-cyan-500 focus:border-cyan-500" required>
                        <x-error-message field="current_password" />
                    </div>

                    <div class="mb-4">
                        <label for="new_password" class="block text-sm font-medium text-gray-600">Mật khẩu mới</label>
                        <input type="password" id="new_password" name="new_password" class="w-full border-gray-300 rounded-lg mt-1 p-2 focus:ring-cyan-500 focus:border-cyan-500" required>
                        <x-error-message field="new_password" />
                    </div>

                    <div class="mb-4">
                        <label for="new_password_confirmation" class="block text-sm font-medium text-gray-600">Xác nhận mật khẩu mới</label>
                        <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="w-full border-gray-300 rounded-lg mt-1 p-2 focus:ring-cyan-500 focus:border-cyan-500" required>
                        <x-error-message field="new_password_confirmation" />
                        <x-error-message field="new_password" />
                    </div>

                    <button type="submit" class="w-full bg-cyan-600 text-white px-4 py-2 rounded-lg hover:bg-cyan-700 focus:ring-2 focus:ring-cyan-500">Đổi mật khẩu</button>
                </form>
            </div>
        </div>

        <!-- Xác minh email -->
        @if (!Auth::user()->hasVerifiedEmail())
            <div class="bg-yellow-50 text-yellow-800 p-6 rounded-lg mt-6 shadow-md">
                <h2 class="text-xl font-bold text-yellow-700 mb-4">Xác minh email</h2>
                <p>Email của bạn chưa được xác minh. Nhấn nút bên dưới để gửi lại email xác minh.</p>
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="mt-4 bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 focus:ring-2 focus:ring-yellow-400">Gửi lại email xác minh</button>
                </form>
            </div>
        @endif

        <!-- Xóa tài khoản -->
        <div class="bg-red-50 text-red-800 p-6 rounded-lg mt-6 shadow-md">
            <h2 class="text-xl font-bold text-red-700 mb-4">Xóa tài khoản</h2>
            <p>Hành động này sẽ xóa tài khoản của bạn và không thể hoàn tác. Vui lòng xác nhận nếu bạn chắc chắn.</p>
            <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Bạn có chắc chắn muốn xóa tài khoản này không?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="mt-4 bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 focus:ring-2 focus:ring-red-500">Xóa tài khoản</button>
            </form>
        </div>
    </div>
</div>
@endsection
