<div class="lg:fixed w-64 p-0 m-0 h-screen bg-gray-100 flex flex-col justify-between">
    <!-- Logo Section -->
    <a href="{{ route('admin.index') }}" class="mt-3">
        <img class="block mt-4" src="/images/shope-high-resolution-logo-transparent.png" alt="logo" />
    </a>

    <!-- Navigation Section -->
    <div class="relative mt-24 flex flex-col space-y-12 mb-12">
        <button class="text-grey hover:bg-gray-200 px-4 py-2 rounded-md focus:outline-none" id="productsDropdownButton">
            Products
        </button>
        <div class="hidden absolute mt-2 w-48 bg-white rounded-md shadow-lg z-10" id="productsDropdownMenu">
            <a href="{{ route('Products.index') }}" class="block px-4 py-2 text-grey hover:bg-gray-200">Products List</a>
            <a href="{{ route('Products.create') }}" class="block px-4 py-2 text-grey hover:bg-gray-200">Create Product</a>
        </div>
        <button class="text-grey hover:bg-gray-200 px-4 py-2 rounded-md focus:outline-none">
            Sales
        </button>
        <button class="text-grey hover:bg-gray-200 px-4 py-2 rounded-md focus:outline-none">
            Customers
        </button>
        <button class="text-grey hover:bg-gray-200 px-4 py-2 rounded-md focus:outline-none">
            Analytics
        </button>
        <button class="text-grey hover:bg-gray-200 px-4 py-2 rounded-md focus:outline-none">
            Notifications
        </button>
    </div>

    <!-- Logout Form Section -->
    <form action="{{ route('Auth.logout') }}" method="POST" class="px-4 py-2 mx-11 mb-12">
        @csrf
        <div class="flex space-x-1 items-center">
            <span class="ml-2">Logout</span>
            <svg class="mt-1" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                <path fill="grey" d="M5 5h7V3H3v18h9v-2H5z" />
                <path fill="grey" d="m21 12l-4-4v3H9v2h8v3z" />
            </svg>
        </div>
    </form>
</div>

<script>
    document.getElementById('productsDropdownButton').addEventListener('click', function() {
        var menu = document.getElementById('productsDropdownMenu');
        menu.classList.toggle('hidden');
    });
</script>