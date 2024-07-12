<div class="flex flex-row justify-between p-6 ">
    <div>
        <form action="{{route('Products.search')}}" method="GET" class="flex gap-2">
            <input type="search" placeholder="search here" class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700">Search</button>
        </form>
    </div>

    <div>
        <div class="flex gap-4">
            <a href="{{route('cart.index')}}" class="flex items-center justify-center w-10 h-10 rounded-full hover:bg-gray-100">
                Cart:
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512" fill="white">
                    <circle cx="176" cy="416" r="32" />
                    <circle cx="400" cy="416" r="32" />
                    <path d="M167.78 304h261.34l38.4-192H133.89l-8.47-48H32v32h66.58l48 272H432v-32H173.42z" />
                </svg>
            </a>

            <a href="{{route('profile.index')}}" class="flex items-center justify-center w-10 h-10 rounded-full hover:bg-gray-100">
                Account:
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
                    <g stroke-linejoin="round">
                        <path d="M4 18a4 4 0 0 1 4-4h8a4 4 0 0 1 4 4a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2z" />
                        <circle cx="12" cy="7" r="3" />
                    </g>
                </svg>
            </a>
        </div>
    </div>

</div>