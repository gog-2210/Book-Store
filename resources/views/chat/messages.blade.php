@extends('layout.app')

@section('content')
    <div class="container mx-auto">
        <h3 class="text-xl font-bold">Chat với {{ $receiver->name }}</h3>
        <div id="messages" class="bg-gray-100 p-4 rounded shadow">
            @foreach($messages as $message)
                <div class="mb-2">
                    <strong>{{ $message->sender_id == Auth::id() ? 'Bạn' : $receiver->name }}:</strong>
                    <p>{{ $message->message }}</p>
                </div>
            @endforeach
        </div>

        <form action="{{ route('chat.sendMessage') }}" method="POST" class="mt-4">
            @csrf
            <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
            <textarea name="message" rows="3" class="w-full p-2 border rounded" required></textarea>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Gửi</button>
        </form>
    </div>

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', { cluster: '{{ env('PUSHER_APP_CLUSTER') }}' });
        var channel = pusher.subscribe('private-chat.{{ $receiver->id }}');

        channel.bind('MessageSent', function(data) {
            var messages = document.getElementById('messages');
            messages.innerHTML += `<div class="mb-2">
                <strong>${data.sender_id == {{ Auth::id() }} ? 'Bạn' : '{{ $receiver->name }}'}:</strong>
                <p>${data.message}</p>
            </div>`;
        });
    </script>
@endsection
