@extends('layout.app')
@section('content')
<div class="container mx-auto">
    <h3 class="text-xl font-bold">Danh sách người dùng</h3>
    <ul class="list-none">
        @foreach($users as $user)
            <li class="py-2">
                <a href="{{ route('chat.getMessages', $user->id) }}"
                    class="text-blue-500 hover:underline">{{ $user->name }}</a>
            </li>
        @endforeach
    </ul>
</div>
@endsection
