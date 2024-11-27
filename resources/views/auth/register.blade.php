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
        <h2 class="text-2xl font-bold text-center text-gray-700">Register</h2>

        <!-- Register Form -->
        <form action="{{ route('register') }}" method="POST" class="mt-6">
            @csrf

            <!-- Username -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" id="name" name="name" placeholder="Enter your username"
                    class="mt-1 w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-300 focus:outline-none"
                    value="{{ old('name') }}" required>
                <x-error-message field="name" />
            </div>

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

            <!-- Confirm Password -->
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm
                    Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    placeholder="Confirm your password"
                    class="mt-1 w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-300 focus:outline-none"
                    required>
                <x-error-message field="password" />
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full py-2 px-4 text-white bg-blue-600 hover:bg-blue-700 rounded-md focus:ring focus:ring-blue-300 focus:outline-none">
                Register
            </button>
        </form>

        <!-- Or Divider -->
        <div class="relative mt-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative text-sm text-center text-gray-500 bg-white px-2 w-10 mx-auto">or</div>
        </div>

        <!-- Social Login route('social.login', 'google')-->

        <div class="mt-6 space-y-4">
            <a href=""
                class="flex items-center justify-center w-full px-4 py-2 border border-gray-300 text-gray-700 hover:bg-gray-100 rounded-md focus:ring focus:ring-gray-300 focus:outline-none">
                <img src="/images/google-logo.png" alt="Google" class="h-5 w-5 mr-2"> Register with Google
            </a>
            <!-- route('social.login', 'facebook') -->
            <a href=""
                class="flex items-center justify-center w-full px-4 py-2 border border-gray-300 text-gray-700 hover:bg-gray-100 rounded-md focus:ring focus:ring-gray-300 focus:outline-none">
                <img src="/images/facebook-logo.png" alt="Facebook" class="h-5 w-5 mr-2"> Register with Facebook
            </a>
        </div>

        <!-- Login Link -->
        <p class="mt-6 text-sm text-center text-gray-600">
            Already have an account?
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a>
        </p>
    </div>
</div>
