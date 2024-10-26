<div class="flex flex-row justify-between items-center p-4 bg-slate-700 sticky top-0 z-10">
    <!-- Search Form -->
    <div>
        <form action="{{ route('Product.search') }}" method="GET" class="flex gap-2">
            <input type="search" name="query" placeholder="search here" class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700">Search</button>
        </form>
    </div>

    <!-- User Actions -->
    <div class="flex gap-x-4 items-center">
        @if(Auth::check() && Auth::user()->role === 'admin')
        <a href="{{ route('Admin.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
            Admin Dashboard
        </a>
        @endif

        <a href="{{route('cart.index')}}" class="flex items-center text-white hover:text-blue-500">
            <span class="mr-1">Cart</span>
            <!-- Cart Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor">
                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a... (SVG Path Data) ..."></path>
            </svg>
        </a>

        <a href="{{route('profile.index')}}" class="flex items-center text-white hover:text-blue-500">
            <span class="mr-1">Account</span>
            <!-- Account Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor">
                <path d="M4 18a4 4 0 0 1 4-4h8a... (SVG Path Data) ..."></path>
            </svg>
        </a>

        <form action="{{ route('Auth.logout') }}" method="POST">
            @csrf
            <button type="submit" class="flex items-center bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">
                <span class="mr-1">Logout</span>
                <!-- Logout Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor">
                    <path d="M5 5h7V3H3v18h9v-2H5z"></path>
                    <path d="M21 12l-4-4v3H9v2h8v3z"></path>
                </svg>
            </button>
        </form>
    </div>
</div>
