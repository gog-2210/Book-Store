<header class="bg-white shadow p-4 px-20">
    <div class="container mx-auto flex items-center justify-between">
        <!-- Logo -->
        <a href="/" class="text-lg font-bold flex items-center text-gray-600">
            <img src="/images/logo.png" alt="Logo" class="h-10 mr-2">BOOK STORE
        </a>

        <!-- Category Icon with Hover Dropdown -->
        <div class="relative group ml-20">
            <!-- Category Icon -->
            <div class="flex items-center cursor-pointer" onclick="toggleDropdown(event)">
                <svg fill="#000000" class="h-6 w-6 text-gray-700 transition-colors duration-200" viewBox="0 0 35 35"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M11.933,15.055H3.479A3.232,3.232,0,0,1,.25,11.827V3.478A3.232,3.232,0,0,1,3.479.25h8.454a3.232,3.232,0,0,1,3.228,3.228v8.349A3.232,3.232,0,0,1,11.933,15.055ZM3.479,2.75a.73.73,0,0,0-.729.728v8.349a.73.73,0,0,0,.729.728h8.454a.729.729,0,0,0,.728-.728V3.478a.729.729,0,0,0-.728-.728Z" />
                    <path
                        d="M11.974,34.75H3.52A3.233,3.233,0,0,1,.291,31.521V23.173A3.232,3.232,0,0,1,3.52,19.945h8.454A3.232,3.232,0,0,1,15.2,23.173v8.348A3.232,3.232,0,0,1,11.974,34.75ZM3.52,22.445a.73.73,0,0,0-.729.728v8.348a.73.73,0,0,0,.729.729h8.454a.73.73,0,0,0,.728-.729V23.173a.729.729,0,0,0-.728-.728Z" />
                    <path
                        d="M31.522,34.75H23.068a3.233,3.233,0,0,1-3.229-3.229V23.173a3.232,3.232,0,0,1,3.229-3.228h8.454a3.232,3.232,0,0,1,3.228,3.228v8.348A3.232,3.232,0,0,1,31.522,34.75Zm-8.454-12.3a.73.73,0,0,0-.729.728v8.348a.73.73,0,0,0,.729.729h8.454a.73.73,0,0,0,.728-.729V23.173a.729.729,0,0,0-.728-.728Z" />
                    <path
                        d="M27.3,15.055a7.4,7.4,0,1,1,7.455-7.4A7.437,7.437,0,0,1,27.3,15.055Zm0-12.3a4.9,4.9,0,1,0,4.955,4.9A4.935,4.935,0,0,0,27.3,2.75Z" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-700 transition-colors duration-200"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M6 9l6 6 6-6"></path>
                </svg>
            </div>

            <!-- Dropdown Menu on Click -->
            <div class="relative">
                <!-- Dropdown Menu -->
                <div
                    class="absolute hidden bg-white border border-gray-300 shadow-lg rounded-md mt-2 w-80 z-10 category-dropdown">
                    @foreach($itemParentCategories as $category)
                        <div class="parent-category relative group pc-{{ $category->id }}">
                            <!-- Parent Category Item -->
                            <a href="{{ route('category.show', $category->id) }}"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100 font-bold">
                                {{ $category->category_name }}
                            </a>

                            <!-- Subcategories (Hidden by Default) -->
                            @if ($category->subCategories->count() > 0)
                                @auth
                                    <div
                                        class="sub-categories absolute left-full top-0 hidden bg-white border border-gray-300 shadow-lg rounded-md w-60 mt-1 group-[.pc-{{ $category->id }}]:block">
                                        @foreach($category->subCategories as $subCategory)
                                            <a href="{{ route('category.show', $subCategory->id) }}"
                                                class="block px-4 py-2 text-gray-600 hover:bg-gray-200">
                                                {{ $subCategory->category_name }}
                                            </a>
                                        @endforeach
                                    </div>
                                @endauth
                                @guest
                                    <div
                                        class="sub-categories flex flex-wrap left-full top-0 bg-white border border-gray-300 shadow-lg rounded-md w-auto mt-1 group-[.pc-{{ $category->id }}]:block">
                                        @foreach($category->subCategories as $subCategory)
                                            <a href="{{ route('category.show', $subCategory->id) }}"
                                                class="block px-4 py-2 text-gray-600 hover:bg-gray-200 whitespace-nowrap">
                                                {{ $subCategory->category_name }}
                                            </a>
                                        @endforeach
                                    </div>
                                @endguest

                            @endif
                            <!-- <div
                                    class="sub-categories absolute left-full top-0 hidden bg-white border border-gray-300 shadow-lg rounded-md w-60 mt-1 group-[.pc-{{ $category->id }}]:block">
                                    @foreach($category->subCategories as $subCategory)
                                        <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-200">
                                            {{ $subCategory->category_name }}
                                        </a>
                                    @endforeach
                                </div> -->
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

        <!-- Search bar -->
        <div class="flex-grow mx-4 mr-16">
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
        <div class="flex items-center space-x-6">
        </div>



        <!-- Cart and User Section -->
        <div class="flex items-center space-x-4">
            <a href="{{ route('cart') }}" class="relative flex items-center space-x-2">
                <div class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        class="h-6 w-6 group-hover:fill-cyan-700" fill="#2F2F2F" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M2 1C1.44772 1 1 1.44772 1 2C1 2.55228 1.44772 3 2 3H3.21922L6.78345 17.2569C5.73276 17.7236 5 18.7762 5 20C5 21.6569 6.34315 23 8 23C9.65685 23 11 21.6569 11 20C11 19.6494 10.9398 19.3128 10.8293 19H15.1707C15.0602 19.3128 15 19.6494 15 20C15 21.6569 16.3431 23 18 23C19.6569 23 21 21.6569 21 20C21 18.3431 19.6569 17 18 17H8.78078L8.28078 15H18C20.0642 15 21.3019 13.6959 21.9887 12.2559C22.6599 10.8487 22.8935 9.16692 22.975 7.94368C23.0884 6.24014 21.6803 5 20.1211 5H5.78078L5.15951 2.51493C4.93692 1.62459 4.13696 1 3.21922 1H2ZM18 13H7.78078L6.28078 7H20.1211C20.6742 7 21.0063 7.40675 20.9794 7.81078C20.9034 8.9522 20.6906 10.3318 20.1836 11.3949C19.6922 12.4251 19.0201 13 18 13ZM18 20.9938C17.4511 20.9938 17.0062 20.5489 17.0062 20C17.0062 19.4511 17.4511 19.0062 18 19.0062C18.5489 19.0062 18.9938 19.4511 18.9938 20C18.9938 20.5489 18.5489 20.9938 18 20.9938ZM7.00617 20C7.00617 20.5489 7.45112 20.9938 8 20.9938C8.54888 20.9938 8.99383 20.5489 8.99383 20C8.99383 19.4511 8.54888 19.0062 8 19.0062C7.45112 19.0062 7.00617 19.4511 7.00617 20Z" />
                    </svg>
                    @auth
                        @if ($cart->count() > 0)
                            <span
                                class="absolute top-0 right-0 -mt-1 -mr-1 bg-red-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                                {{ $cart->count() }}
                            </span>
                        @endif
                    @endauth
                </div>

                <div>
                    <span class="text-gray-600 group-hover:text-cyan-700 font-semibold">Giỏ hàng</span>
                </div>
            </a>

            @auth
                <div class="relative z-10">
                    <button class="flex items-center space-x-2" id="userDropdownButton">
                        <span>{{ Auth::user()->name }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    @if (Auth::user())
                        <div class="absolute right-0 mt-2 w-48 bg-white border rounded shadow hidden" id="userDropdown">
                            @if (Auth::user()->role === 1)
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

    // Close dropdown
    document.addEventListener('click', function (e) {
        const dropdown = document.getElementById('userDropdown');
        const button = document.getElementById('userDropdownButton');
        if (!button.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });

    function toggleDropdown(event) {
        event.stopPropagation();
        const dropdown = event.target.closest('.group')?.querySelector('.category-dropdown');
        if (dropdown) {
            dropdown.classList.toggle('hidden');
        }
    }


    // Close dropdown
    document.addEventListener('click', function (event) {
        const dropdowns = document.querySelectorAll('.category-dropdown');
        dropdowns.forEach(function (dropdown) {
            if (!dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        const itemParentCategories = document.querySelectorAll('.parent-category');
        if (itemParentCategories.length > 0) {
            itemParentCategories.forEach((parent) => {
                parent.addEventListener('mouseenter', function () {
                    const subCategories = parent.querySelector('.sub-categories');
                    if (subCategories) {
                        subCategories.classList.remove('hidden');
                    }
                });

                parent.addEventListener('mouseleave', function () {
                    const subCategories = parent.querySelector('.sub-categories');
                    if (subCategories) {
                        subCategories.classList.add('hidden');
                    }
                });
            });
        }
    });

</script>
