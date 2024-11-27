@extends('layout.app')

@section('content')
<div class="mb-4 text-sm text-gray-600">
    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
</div>

<form method="POST" action="">
    @csrf

    <div>
        <label for="password" value="{{ __('Password') }}">
            <input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" autofocus />
        </label>
    </div>

    <div class="flex justify-end mt-4">
        <x-button class="ms-4">
            {{ __('Confirm') }}
        </x-button>
    </div>
</form>
@endsection
