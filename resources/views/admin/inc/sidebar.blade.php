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
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                      </svg>
                      
                    <span>Users</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.categories.index') }}" class="flex items-center px-6 py-3 hover:bg-gray-700 rounded-md transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m-6-7a6 6 0 100-12 6 6 0 000 12zm6 0a6 6 0 100-12 6 6 0 000 12z" />
                    </svg>
                    <span>Categories</span>
                </a>                
            </li>
            <li>
                <a href="{{ route('admin.companies.index') }}" class="flex items-center px-6 py-3 hover:bg-gray-700 rounded-md transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205 3 1m1.5.5-1.5-.5M6.75 7.364V3h-3v18m3-13.636 10.5-3.819" />
                      </svg>       
                    <span>Companies</span>
                </a>                
            </li>
            <li>
                <a href="{{ route('admin.books.index') }}" class="flex items-center px-6 py-3 hover:bg-gray-700 rounded-md transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round" 
                        d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                      </svg>                      
                    <span>Books</span>
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
