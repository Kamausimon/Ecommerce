<div class="flex flex-row justify-between items-center p-4 bg-slate-800 sticky top-0 z-50">
    <a href="{{ route('User.welcome') }}">
        <img class="block w-24 h-auto ml-6" src="/images/shope-high-resolution-logo-transparent.png" alt="logo" />
    </a>

    <!-- Mobile Menu Button -->
    <div class="lg:hidden">
        <button id="mobile-menu-button" class="text-white focus:outline-none" aria-label="Toggle mobile menu">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>
    </div>

    <!-- Navigation Links -->
    <div id="nav-links" class="hidden lg:flex lg:flex-row lg:items-center lg:gap-4">
        @if(request()->routeIs('User.welcome'))
        <a href="#" class="text-white hover:underline">Categories</a>
        <a href="#" class="text-white hover:underline">What's new</a>

        <div>
            <form action="/search" method="GET" class="flex gap-2">
                <input type="search" name="query" placeholder="search here" class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700">Search</button>
            </form>
        </div>
        @endif

        <div class="flex gap-4">


            @if(!request()->routeIs('Auth.login'))
            <a href="{{ route('Auth.login') }}" class="ml-4 mr-2 flex items-center justify-center w-10 h-10 rounded-full hover:bg-gray-100 text-white">
                Login
            </a>
            @endif

            @if(!request()->routeIs('Auth.register'))
            <a href="{{ route('Auth.register') }}" class="ml-4 mr-2 flex items-center justify-center w-10 h-10 rounded-full hover:bg-gray-100 text-white">
                Register
            </a>
            @endif
        </div>
    </div>
</div>

<!-- Mobile Menu -->
<div id="mobile-menu" class="lg:hidden  flex flex-col items-center bg-slate-800 p-4 transition-all duration-300 ease-in-out">
    @if(request()->routeIs('User.welcome'))
    <a href="#" class="text-white mb-2 hover:underline">Categories</a>
    <a href="#" class="text-white mb-2 hover:underline">What's new</a>

    <div class="mb-2">
        <form action="/search" method="GET" class="flex gap-2">
            <input type="search" name="query" placeholder="search here" class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700">Search</button>
        </form>
    </div>
    @endif

    <div class="flex flex-col gap-2">


        @if(!request()->routeIs('Auth.login'))
        <a href="{{ route('Auth.login') }}" class="ml-4 mr-2 flex items-center justify-center w-10 h-10 rounded-full hover:bg-gray-100 text-white">
            Login
        </a>
        @endif

        @if(!request()->routeIs('Auth.register'))
        <a href="{{ route('Auth.register') }}" class="ml-4 mr-2 flex items-center justify-center w-10 h-10 rounded-full hover:bg-gray-100 text-white">
            Register
        </a>
        @endif
    </div>
</div>

<script>
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        var menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>