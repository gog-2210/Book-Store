@extends('layout.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-3xl font-semibold text-center text-blue-600">Xác minh email</h1>

        <p class="mt-4 text-center text-gray-500">
            Vui lòng kiểm tra email của bạn để xác minh tài khoản. Nếu bạn chưa nhận được email, nhấn nút bên dưới để gửi lại.
        </p>

        <!-- Form for resending verification email -->
        <form method="POST" action="{{ route('verification.send') }}" class="mt-6">
            @csrf
            <div class="text-center">
                <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-full font-semibold text-lg shadow-lg hover:bg-blue-600 transition duration-300 transform hover:scale-105">
                    Gửi lại email xác minh
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
