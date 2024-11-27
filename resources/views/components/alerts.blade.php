@if (session('success'))
    <x-popup-message type="success" timeout="3000">
        {{ session('success') }}
    </x-popup-message>
@endif

@if (session('error'))
    <x-popup-message type="error" timeout="3000">
        {{ session('error') }}
    </x-popup-message>
@endif

@if (session('warning'))
    <x-popup-message type="warning" timeout="3000">
        {{ session('warning') }}
    </x-popup-message>
@endif

@if (session('info'))
    <x-popup-message type="info" timeout="3000">
        {{ session('info') }}
    </x-popup-message>
@endif
