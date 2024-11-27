@props([
    'type' => 'info', // Loại thông báo (info, success, error, warning)
    'timeout' => 2000 // Thời gian chờ trước khi tự động ẩn (mặc định: 3 giây)
])

<div
    x-data="{ show: true }"
    x-show="show"
    x-init="setTimeout(() => show = false, {{ $timeout }})"
    class="fixed top-20 right-4 z-50 max-w-sm w-full p-4 border-l-4 rounded-md shadow-lg"
    :class="{
        'bg-blue-100 border-blue-500 text-blue-700': '{{ $type }}' === 'info',
        'bg-green-100 border-green-500 text-green-700': '{{ $type }}' === 'success',
        'bg-yellow-100 border-yellow-500 text-yellow-700': '{{ $type }}' === 'warning',
        'bg-red-100 border-red-500 text-red-700': '{{ $type }}' === 'error'
    }"
    role="alert"
>
    <div class="flex items-start justify-between">
        <div class="flex items-center">
            @if ($type === 'info')
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <circle cx="12" cy="12" r="10" stroke-linejoin="round" stroke-width="2"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 17V11"/>
                    <circle cx="1" cy="1" r="1" transform="matrix(1 0 0 -1 11 9)" />
                </svg>
            @elseif ($type === 'success')
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            @elseif ($type === 'warning')
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-width="1.3" stroke-linecap="round" d="M13.0618 4.4295C12.6211 3.54786 11.3635 3.54786 10.9228 4.4295L3.88996 18.5006C3.49244 19.2959 4.07057 20.2317 4.95945 20.2317H19.0252C19.914 20.2317 20.4922 19.2959 20.0947 18.5006L13.0618 4.4295ZM9.34184 3.6387C10.4339 1.45376 13.5507 1.45377 14.6428 3.63871L21.6756 17.7098C22.6608 19.6809 21.228 22 19.0252 22H4.95945C2.75657 22 1.32382 19.6809 2.30898 17.7098L9.34184 3.6387Z"/>
                <path d="M12 8V13" stroke-width="1.7" stroke-linecap="round"/>
                <path d="M12 16L12 16.5" stroke-width="1.7" stroke-linecap="round"/>

                </svg>

            @elseif ($type === 'error')
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            @endif
            <span>{{ $slot }}</span>
        </div>
        <button
            @click="show = false"
            class="ml-4 text-gray-500 hover:text-gray-700 focus:outline-none focus:ring focus:ring-gray-300 rounded"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>
