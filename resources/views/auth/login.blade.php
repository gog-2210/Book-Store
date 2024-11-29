@extends('layout.app')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full p-6 bg-white border border-gray-200 rounded-lg shadow-md">
        <!-- Quay lại trang chủ -->
        <div class="mb-4">
            <a href="{{ url('/') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7"></path>
                </svg>
                <span class="text-sm">Quay lại trang chủ</span>
            </a>
        </div>

        <h2 class="text-2xl font-bold text-center text-gray-700">Đăng nhập</h2>

        <!-- Form Đăng Nhập -->
        <form action="{{ route('login') }}" method="POST" class="mt-6">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" placeholder="Nhập email của bạn"
                    class="mt-1 w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-300 focus:outline-none"
                    value="{{ old('email') }}"
                    required>
                <x-error-message field="email" />
            </div>

            <!-- Mật khẩu -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Mật khẩu</label>
                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu của bạn"
                    class="mt-1 w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-300 focus:outline-none"
                    required>
                <x-error-message field="password" />
            </div>

            <!-- Ghi nhớ & Quên mật khẩu -->
            <div class="flex items-center justify-between mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="remember"
                        class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring focus:ring-blue-300">
                    <span class="ml-2 text-sm text-gray-600">Ghi nhớ</span>
                </label>
                <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">Quên mật khẩu?</a>
            </div>

            <!-- Nút Đăng nhập -->
            <button type="submit"
                class="w-full py-2 px-4 text-white bg-blue-600 hover:bg-blue-700 rounded-md focus:ring focus:ring-blue-300 focus:outline-none">
                Đăng nhập
            </button>
        </form>

        <!-- Hoặc phân cách -->
        <div class="relative mt-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative text-sm text-center text-gray-500 bg-white px-2 w-10 mx-auto">hoặc</div>
        </div>

        <!-- Đăng nhập với mạng xã hội -->
        <div class="mt-6 space-y-4">
            <a href="{{ route('google') }}"
                class="flex items-center justify-center w-full px-4 py-2 border border-gray-300 text-gray-700 hover:bg-gray-100 rounded-md focus:ring focus:ring-gray-300 focus:outline-none">
                <img src="/images/google.png" alt="Google" class="h-5 w-5 mr-2"> Đăng nhập với Google
            </a>
            <a href="{{ route('facebook') }}"
                class="flex items-center justify-center w-full px-4 py-2 border bg-[#1877F2] text-white border-gray-300 hover:bg-blue-600 rounded-md focus:ring focus:ring-gray-300 focus:outline-none">
                <img src="/images/facebook.png" alt="Facebook" class="h-5 w-5 mr-2"> Đăng nhập với Facebook
            </a>
        </div>

        <!-- Liên kết đăng ký -->
        <p class="mt-6 text-sm text-center text-gray-600">
            Chưa có tài khoản?
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Đăng ký</a>
        </p>
    </div>
</div>
@endsection
