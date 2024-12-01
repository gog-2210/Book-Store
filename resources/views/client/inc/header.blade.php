<header class="bg-white shadow p-4">
    <div class="container mx-auto flex items-center justify-between">
        <!-- Logo -->
        <a href="/" class="text-lg font-bold flex items-center text-gray-600">
            <img src="/images/logo.png" alt="Logo" class="h-10 mr-2">BOOK STORE
        </a>

        <!-- Search bar -->
        <div class="flex-grow mx-20">
            <form action="" method="GET" class="flex">
                <input type="text" name="q" placeholder="Tìm kiếm..." class="flex-grow p-2 border rounded-l-md">
                <button type="submit"
                    class="bg-blue-500 text-white p-2 rounded-r-md hover:bg-blue-600 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M11 2a9 9 0 105.64 16.11l5.63 5.63a1 1 0 001.41-1.41l-5.63-5.63A9 9 0 0011 2zm0 2a7 7 0 110 14 7 7 0 010-14z" />
                    </svg>

                </button>
            </form>
        </div>


        <!-- Cart and User Section -->
        <div class="flex items-center space-x-4">
            <!-- Cart -->
            <a href="{{ route('cart') }}" class="flex items-center space-x-1 hover:text-cyan-700 group">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="h-6 w-6 group-hover:fill-cyan-700"
                    fill="#2F2F2F" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M2 1C1.44772 1 1 1.44772 1 2C1 2.55228 1.44772 3 2 3H3.21922L6.78345 17.2569C5.73276 17.7236 5 18.7762 5 20C5 21.6569 6.34315 23 8 23C9.65685 23 11 21.6569 11 20C11 19.6494 10.9398 19.3128 10.8293 19H15.1707C15.0602 19.3128 15 19.6494 15 20C15 21.6569 16.3431 23 18 23C19.6569 23 21 21.6569 21 20C21 18.3431 19.6569 17 18 17H8.78078L8.28078 15H18C20.0642 15 21.3019 13.6959 21.9887 12.2559C22.6599 10.8487 22.8935 9.16692 22.975 7.94368C23.0884 6.24014 21.6803 5 20.1211 5H5.78078L5.15951 2.51493C4.93692 1.62459 4.13696 1 3.21922 1H2ZM18 13H7.78078L6.28078 7H20.1211C20.6742 7 21.0063 7.40675 20.9794 7.81078C20.9034 8.9522 20.6906 10.3318 20.1836 11.3949C19.6922 12.4251 19.0201 13 18 13ZM18 20.9938C17.4511 20.9938 17.0062 20.5489 17.0062 20C17.0062 19.4511 17.4511 19.0062 18 19.0062C18.5489 19.0062 18.9938 19.4511 18.9938 20C18.9938 20.5489 18.5489 20.9938 18 20.9938ZM7.00617 20C7.00617 20.5489 7.45112 20.9938 8 20.9938C8.54888 20.9938 8.99383 20.5489 8.99383 20C8.99383 19.4511 8.54888 19.0062 8 19.0062C7.45112 19.0062 7.00617 19.4511 7.00617 20Z" />
                </svg>
                <span class="text-gray-600 group-hover:text-cyan-700 font-semibold">Giỏ hàng</span>
            </a>

            <!-- User -->
            @auth
                <!-- Dropdown for authenticated user -->
                <div class="relative z-10">
                    <button class="flex items-center space-x-2" id="userDropdownButton">
                        <span>{{ Auth::user()->name }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    @if (Auth::user())
                        <!-- Hiển thị "Nhân viên" nếu là staff -->
                        <!-- Dropdown -->
                        <div class="absolute right-0 mt-2 w-48 bg-white border rounded shadow hidden" id="userDropdown">
                            @if (Auth::user()->role === 1)
                                <!-- Hiển thị nếu là admin -->
                                <a href="{{route('admin.index')}}" class="block px-4 py-2 hover:bg-gray-100">Trang Quản trị</a>
                            @endif
                            <a href="{{route('profile')}}" class="block px-4 py-2 hover:bg-gray-100">Tài khoản</a>
                            <a href="{{route('order')}}" class="block px-4 py-2 hover:bg-gray-100">Đơn mua</a>
                            <form action="{{ route('logout') }}" method="POST" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Đăng xuất</button>
                            </form>
                        </div>
                    @endif

                </div>
            @else
                <a href="{{ route('login') }}"
                    class="font-semibold text-gray-600 hover:text-cyan-700 focus:outline focus:outline-2 focus:rounded-sm focus:outline-cyan-800">Đăng
                    Nhập</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="ml-4 font-semibold text-gray-600 hover:text-cyan-700 focus:outline focus:outline-2 focus:rounded-sm focus:outline-cyan-800">Đăng
                        ký</a>
                @endif
            @endauth
        </div>
    </div>
</header>

<script>
    // Toggle dropdown visibility
    document.getElementById('userDropdownButton').addEventListener('click', function () {
        const dropdown = document.getElementById('userDropdown');
        dropdown.classList.toggle('hidden');
    });

    // Close dropdown if clicking outside
    document.addEventListener('click', function (e) {
        const dropdown = document.getElementById('userDropdown');
        const button = document.getElementById('userDropdownButton');
        if (!button.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script>
