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
                <a href="#" class="flex items-center px-6 py-3 hover:bg-gray-700 rounded-md transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 10h11M9 21V3M21 16H3" />
                    </svg>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center px-6 py-3 hover:bg-gray-700 rounded-md transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m-6-7a6 6 0 100-12 6 6 0 000 12zm6 0a6 6 0 100-12 6 6 0 000 12z" />
                    </svg>
                    <span>Users</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center px-6 py-3 hover:bg-gray-700 rounded-md transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.75 19.5h-2.25m8.5-2.25H6m10.5-2.25h-7.5m8.5-2.25h-2.25m0-8.25H6.5m4.75 0h4m0 0l2-2m-2 2l2 2m4 4-4-4m-4 4-4-4" />
                    </svg>
                    <span>Settings</span>
                </a>
            </li>
        </ul>
    </nav>

    <div class="px-6 py-4 border-t border-gray-700">
    </div>
</div>
