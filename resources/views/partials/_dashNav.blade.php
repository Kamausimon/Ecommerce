<div class="flex flex-row justify-between p-6 ">
    <div>
        <form action="{{ route('Product.search') }}" method="GET" class="flex gap-2">
            <input type="search" name="query" placeholder="search here" class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700">Search</button>
        </form>

    </div>

    <div>
        <div class="flex gap-x-10">
            @if(Auth::check() && Auth::user()->role === 'admin')
            <div class="flex items-center justify-center  hover:bg-gray-100 text-white">
                <a href="{{ route('admin.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
                    Admin Dashboard
                </a>
            </div>
            @endif

            <a href="{{route('cart.index')}}" class="flex items-center justify-center w-10 h-10 rounded-full hover:bg-gray-100 text-white ">
                <span class="mr-1">Cart:</span>
                <div class="w-10 h-10 rounded-full flex justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16">
                        <path fill="white" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607L1.61 2H.5a.5.5 0 0 1-.5-.5M5 12a2 2 0 1 0 0 4a2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4a2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2a1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
                    </svg>
                </div>
            </a>

            <a href="{{route('profile.index')}}" class=" ml-3 mr-3 flex items-center justify-center w-10 h-10 rounded-full hover:bg-gray-100 text-white">
                <span class="mr-1"> Account:</span>
                <div class="w-10 h-10 rounded-full flex justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
                        <g stroke-linejoin="round">
                            <path d="M4 18a4 4 0 0 1 4-4h8a4 4 0 0 1 4 4a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2z" />
                            <circle cx="12" cy="7" r="3" />
                        </g>
                    </svg>
                </div>
            </a>

            <form action="{{ route('Auth.logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 p-2 ml-2 hover:bg-red-800 rounded-md">
                    <div class="flex space-x-3">
                        <span class="ml-2">Logout</span>
                        <svg class="mt-1" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <path fill="grey" d="M5 5h7V3H3v18h9v-2H5z" />
                            <path fill="grey" d="m21 12l-4-4v3H9v2h8v3z" />
                        </svg>
                    </div>

                </button>
            </form>

        </div>
    </div>

</div>