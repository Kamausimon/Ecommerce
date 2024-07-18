<div class="flex flex-row justify-between items-center p-4 bg-slate-800 sticky top-0 z-50 ">
    <a href="{{route('landing.index')}}">
        <img class="block w-24 h-auto ml-6" src="/images/shope-high-resolution-logo-transparent.png" alt="logo" />
    </a>
    @if(request()->routeIs('landing.index'))
    <a href="#" class="text-white">Categories</a>
    <a href="#" class="text-white">What's new</a>

    <div>
        <form action="/search" method="GET" class="flex gap-2">
            <input type="search" placeholder="search here" class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700">Search</button>
        </form>
    </div>
    @endif
    <div>
        <div class="flex gap-4">
            @if(request()->routeIs('landing.index'))
            <a href="{{ route('cart.index') }}" class="flex items-center justify-center w-10 h-10 rounded-full hover:bg-gray-100 text-white">
                Cart
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="26" viewBox="0 0 512 512" fill="white">
                    <circle cx="176" cy="416" r="32" />
                    <circle cx="400" cy="416" r="32" />
                    <path d="M167.78 304h261.34l38.4-192H133.89l-8.47-48H32v32h66.58l48 272H432v-32H173.42z" />
                </svg>
            </a>
            @endif
            @if(!request()->routeIs('Auth.login'))
            <a href="{{ route('Auth.login') }}" class=" ml-4 mr-2 flex items-center justify-center w-10 h-10 rounded-full hover:bg-gray-100 text-white">
                Login
            </a>
            @endif

            @if(!request()->routeIs('Auth.register'))
            <a href="{{ route('Auth.register') }}" class=" ml-4 mr-2 flex items-center justify-center w-10 h-10 rounded-full hover:bg-gray-100 text-white">
                Register
            </a>
            @endif
        </div>
    </div>
</div>