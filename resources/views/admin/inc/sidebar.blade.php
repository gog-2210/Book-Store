<div class="h-screen w-64 bg-gray-900 text-gray-200 fixed top-0 left-0 shadow-lg flex flex-col">
    <!-- Header -->
    <div class="px-6 py-4 flex items-center justify-around">
        <img src="{{asset('images/logo.png')}}" class="h-14">
        <h2 class="text-2xl font-bold text-white">BookStore</h2>
        <!-- <button class="text-gray-400 hover:text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button> -->
    </div>

    <!-- Menu -->
    <nav class="mt-6 flex-1">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('admin.index') }}" class="flex items-center px-6 py-3 hover:bg-gray-700 rounded-md transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h7v7H3V3zm11 0h7v4h-7V3zM3 14h7v7H3v-7zm11-3h7v10h-7V11z" />
                    </svg>
                    <span>Bảng điều khiển</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.users.index') }}"
                    class="flex items-center px-6 py-3 hover:bg-gray-700 rounded-md transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="h-5 w-5 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>

                    <span>Người dùng</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.orders.index') }}"
                    class="flex items-center px-6 py-3 hover:bg-gray-700 rounded-md transition">

                    <i class="fas fa-box mr-3 text-white"></i>
                    <span>Đơn Hàng</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.books.index') }}"
                    class="flex items-center px-6 py-3 hover:bg-gray-700 rounded-md transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="h-5 w-5 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                    </svg>
                    <span>Quản lý sách</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.categories.index') }}"
                    class="flex items-center px-6 py-3 hover:bg-gray-700 rounded-md transition">
                    <svg fill="#ffffff" viewBox="0 0 32 32" stroke-width="2" class="h-5 w-5 mr-3"
                        xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <style>
                                .cls-1 {
                                    fill: none;
                                }
                            </style>
                        </defs>
                        <path
                            d="M29,10H24v2h5v6H22v2h3v2.142a4,4,0,1,0,2,0V20h2a2.0027,2.0027,0,0,0,2-2V12A2.0023,2.0023,0,0,0,29,10ZM28,26a2,2,0,1,1-2-2A2.0027,2.0027,0,0,1,28,26Z" />
                        <path
                            d="M19,6H14V8h5v6H12v2h3v6.142a4,4,0,1,0,2,0V16h2a2.0023,2.0023,0,0,0,2-2V8A2.0023,2.0023,0,0,0,19,6ZM18,26a2,2,0,1,1-2-2A2.0027,2.0027,0,0,1,18,26Z" />
                        <path
                            d="M9,2H3A2.002,2.002,0,0,0,1,4v6a2.002,2.002,0,0,0,2,2H5V22.142a4,4,0,1,0,2,0V12H9a2.002,2.002,0,0,0,2-2V4A2.002,2.002,0,0,0,9,2ZM8,26a2,2,0,1,1-2-2A2.0023,2.0023,0,0,1,8,26ZM3,10V4H9l.0015,6Z" />
                        <rect id="_Transparent_Rectangle_" data-name="&lt;Transparent Rectangle&gt;" class="cls-1"
                            width="32" height="32" />
                    </svg>
                    <span>Quản lý danh mục</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.companies.index') }}"
                    class="flex items-center px-6 py-3 hover:bg-gray-700 rounded-md transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="h-5 w-5 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205 3 1m1.5.5-1.5-.5M6.75 7.364V3h-3v18m3-13.636 10.5-3.819" />
                    </svg>
                    <span>Quản lý nhà cung cấp</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center px-6 py-3 hover:bg-gray-700 rounded-md transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" stroke="currentColor" fill="#fff"
                        viewBox="0 0 24 24">
                        <path
                            d="M 9.6679688 2 L 9.1757812 4.5234375 C 8.3550224 4.8338012 7.5961042 5.2674041 6.9296875 5.8144531 L 4.5058594 4.9785156 L 2.1738281 9.0214844 L 4.1132812 10.707031 C 4.0445153 11.128986 4 11.558619 4 12 C 4 12.441381 4.0445153 12.871014 4.1132812 13.292969 L 2.1738281 14.978516 L 4.5058594 19.021484 L 6.9296875 18.185547 C 7.5961042 18.732596 8.3550224 19.166199 9.1757812 19.476562 L 9.6679688 22 L 14.332031 22 L 14.824219 19.476562 C 15.644978 19.166199 16.403896 18.732596 17.070312 18.185547 L 19.494141 19.021484 L 21.826172 14.978516 L 19.886719 13.292969 C 19.955485 12.871014 20 12.441381 20 12 C 20 11.558619 19.955485 11.128986 19.886719 10.707031 L 21.826172 9.0214844 L 19.494141 4.9785156 L 17.070312 5.8144531 C 16.403896 5.2674041 15.644978 4.8338012 14.824219 4.5234375 L 14.332031 2 L 9.6679688 2 z M 12 8 C 14.209 8 16 9.791 16 12 C 16 14.209 14.209 16 12 16 C 9.791 16 8 14.209 8 12 C 8 9.791 9.791 8 12 8 z">
                        </path>
                    </svg>
                    <span>Cài đặt</span>
                </a>
            </li>
        </ul>
    </nav>

    <div class="px-6 py-4 border-t border-gray-700">
    </div>
</div>
