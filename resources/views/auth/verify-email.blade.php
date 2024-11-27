@extends('layout.app')

@section('content')
<div class="mb-4 text-sm text-gray-600">
    {{ __('Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
</div>

@if (session('status') == 'verification-link-sent')
    <div class="mb-4 font-medium text-sm text-green-600">
        {{ __('A new verification link has been sent to the email address you provided in your profile settings.') }}
    </div>
@endif

<div class="mt-4 flex items-center justify-between">
    <form method="POST" action="">
        @csrf

        <div>
            <button type="submit">
                {{ __('Resend Verification Email') }}
            </button>
        </div>
    </form>

    <div>
        <a href=""
            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            {{ __('Edit Profile') }}</a>

        <form method="POST" action="" class="inline">
            @csrf

            <button type="submit"
                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ms-2">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</div>
@endsection
