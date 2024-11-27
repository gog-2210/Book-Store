@extends('layout.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center text-gray-800">Quên mật khẩu</h2>
        <p class="text-sm text-gray-600 text-center mt-2">
            Nhập email của bạn để nhận liên kết đặt lại mật khẩu.
        </p>

        <form action="{{ route('password.email') }}" method="POST" class="mt-6">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-cyan-300 focus:border-cyan-500"
                />
                <x-error-message field="email"/>
            </div>

            <button
                type="submit"
                class="w-full py-2 px-4 bg-cyan-600 text-white font-semibold rounded-lg hover:bg-cyan-700 focus:outline-none focus:ring focus:ring-cyan-300"
            >
                Gửi liên kết đặt lại mật khẩu
            </button>
        </form>

        <div class="text-center mt-4">
            <a href="{{ route('login') }}" class="text-cyan-600 hover:underline">Quay lại đăng nhập</a>
        </div>
    </div>
</div>
@endsection
