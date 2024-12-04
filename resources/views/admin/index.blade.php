@extends('admin.layout.app')

@section('content')
<div class="bg-white p-6 rounded shadow-lg">

    <h1 class="text-3xl font-bold">Admin Dashboard</h1>
    <p class="mt-4">Welcome to your dashboard. Here you can manage your site.</p>
</div>
    <a href="{{ route('chat.getUsers') }}" 
        class="fixed bottom-4 right-4 bg-blue-500 text-white px-6 py-3 rounded-full shadow-lg hover:bg-blue-600 transition-all">
         Chat
    </a>
@endsection
