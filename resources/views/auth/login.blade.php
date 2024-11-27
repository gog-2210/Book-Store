@extends('layout.app')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full p-6 bg-white border border-gray-200 rounded-lg shadow-md">
        <!-- Back to home -->
        <div class="mb-4">
            <a href="{{ url('/') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7"></path>
                </svg>
                <span class="text-sm">Back to Home</span>
            </a>
        </div>

        <h2 class="text-2xl font-bold text-center text-gray-700">Login</h2>

        <!-- Login Form  -->
        <form action="{{ route('login') }}" method="POST" class="mt-6">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email"
                    class="mt-1 w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-300 focus:outline-none"
                    value="{{ old('email') }}"
                    required>
                <x-error-message field="email" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password"
                    class="mt-1 w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-300 focus:outline-none"
                    required>
                <x-error-message field="password" />
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="remember"
                        class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring focus:ring-blue-300">
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
                <!-- route('password.request') -->
                <a href="" class="text-sm text-blue-600 hover:underline">Forgot password?</a>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full py-2 px-4 text-white bg-blue-600 hover:bg-blue-700 rounded-md focus:ring focus:ring-blue-300 focus:outline-none">
                Login
            </button>
        </form>

        <!-- Or Divider -->
        <div class="relative mt-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative text-sm text-center text-gray-500 bg-white px-2 w-10 mx-auto">or</div>
        </div>

        <!-- Social Login -->
        <div class="mt-6 space-y-4">
            <a href=""
                class="flex items-center justify-center w-full px-4 py-2 border border-gray-300 text-gray-700 hover:bg-gray-100 rounded-md focus:ring focus:ring-gray-300 focus:outline-none">
                <img src="/images/google-logo.png" alt="Google" class="h-5 w-5 mr-2"> Login with Google
            </a>
            <a href="{{ route('facebook') }}"
                class="flex items-center justify-center w-full px-4 py-2 border border-gray-300 text-gray-700 hover:bg-gray-100 rounded-md focus:ring focus:ring-gray-300 focus:outline-none">
                <img src="/images/facebook-logo.png" alt="Facebook" class="h-5 w-5 mr-2"> Login with Facebook
            </a>
        </div>

        <!-- Register Link -->
        <p class="mt-6 text-sm text-center text-gray-600">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register</a>
        </p>
    </div>
</div>
@endsection
