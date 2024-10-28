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
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16">
                <path fill="currentColor"
                    d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607L1.61 2H.5a.5.5 0 0 1-.5-.5M5
       12a2 2 0 1 0 0 4a2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4a2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2a1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
            </svg>
        </a>

        <a href="{{route('profile.index')}}" class="flex items-center text-white hover:text-blue-500">
            <span class="mr-1">Account</span>
            <!-- Account Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                <path fill="currentColor" d="M12 19.2c-2.5 0-4.71-1.28-6-3.2c.03-2 4-3.1 6-3.1s5.97 1.1 6 3.1a7.23
7.23 0 0 1-6 3.2M12 5a3 3 0 0 1 3 3a3 3 0 0 1-3 3a3 3 0 0 1-3-3a3 3 0 0 1 3-3m0-3A10 10 0 0 0 2 12a10 10 0 0 0 10 10a10 10 0 0 0 10-10c0-5.53-4.5-10-10-10" />
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
