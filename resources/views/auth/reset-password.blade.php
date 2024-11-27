@extends('layout.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center text-gray-800">Đặt lại mật khẩu</h2>
        <p class="text-sm text-gray-600 text-center mt-2">
            Nhập mật khẩu mới để đặt lại.
        </p>

        <form action="{{ route('password.update') }}" method="POST" class="mt-6">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ request()->query('email') }}">
            <x-error-message field="email" />
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Mật khẩu mới</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-cyan-300 focus:border-cyan-500"
                />
                <x-error-message field="password" />
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Xác nhận mật khẩu</label>
                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-cyan-300 focus:border-cyan-500"
                />
                <x-error-message field="password" />
            </div>

            <button
                type="submit"
                class="w-full py-2 px-4 bg-cyan-600 text-white font-semibold rounded-lg hover:bg-cyan-700 focus:outline-none focus:ring focus:ring-cyan-300"
            >
                Đặt lại mật khẩu
            </button>
        </form>

        <div class="text-center mt-4">
            <a href="{{ route('login') }}" class="text-cyan-600 hover:underline">Quay lại đăng nhập</a>
        </div>
    </div>
</div>
@endsection
