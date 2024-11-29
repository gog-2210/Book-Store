<div class="bg-white shadow-md p-4 flex justify-between items-center">
    <div class="text-xl font-semibold">
        <a href="{{ route('admin.index') }}">Trang quản trị</a>
    </div>
    @if (Route::has('login'))
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

                <!-- Dropdown -->
                <div class="absolute right-0 mt-2 w-48 bg-white border rounded shadow hidden" id="userDropdown">
                    <a href="{{ route('frontend.index') }}" class="block px-4 py-2 hover:bg-gray-100">Trang Khách</a>
                    <a href="" class="block px-4 py-2 hover:bg-gray-100">Tài khoản</a>
                    <a href="" class="block px-4 py-2 hover:bg-gray-100">Cài đặt</a>
                    <form action="{{ route('logout') }}" method="POST" class="block">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Đăng xuất</button>
                    </form>
                </div>
            </div>
        @endauth
    @endif
</div>

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
