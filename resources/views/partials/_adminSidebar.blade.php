<!-- Sidebar -->
<div id="sidebar" class="fixed lg:static inset-y-0 left-0 z-30 w-64 overflow-y-auto bg-gray-100 transform -translate-x-full lg:translate-x-0 transition-transform duration-200 ease-in-out">
    <!-- Logo Section -->
    <a href="{{ route('Admin.index') }}" class="mt-3 flex items-center justify-center lg:justify-start">
        <img class="block mt-4 w-32" src="/images/shope-high-resolution-logo-transparent.png" alt="logo" />
    </a>

    <!-- Navigation Section -->
    <div class="mt-24 flex flex-col space-y-4 px-4">
        <!-- Products Dropdown -->
        <div class="relative">
            <button class="w-full text-left text-gray-700 hover:bg-gray-200 px-4 py-2 rounded-md focus:outline-none flex justify-between items-center" id="productsDropdownButton">
                Products
                <svg class="w-4 h-4 transform transition-transform duration-200" id="productsDropdownIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div class="hidden mt-2 bg-white rounded-md shadow-lg z-10" id="productsDropdownMenu">
                <a href="{{ route('Admin.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Products List</a>
                <a href="{{ route('Products.create') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Create Product</a>
            </div>
        </div>
        <!-- Other Navigation Items -->
        <a href="#" class="text-gray-700 hover:bg-gray-200 px-4 py-2 rounded-md">Sales</a>
        <a href="#" class="text-gray-700 hover:bg-gray-200 px-4 py-2 rounded-md">Customers</a>
        <a href="#" class="text-gray-700 hover:bg-gray-200 px-4 py-2 rounded-md">Analytics</a>
        <a href="#" class="text-gray-700 hover:bg-gray-200 px-4 py-2 rounded-md">Notifications</a>
        <a href="{{route('dashboard.index')}}" class="text-gray-700 hover:bg-gray-200 px-4 py-2 rounded-md">Client Area</a>
    </div>

    <!-- Logout Form Section -->
    <div class="absolute bottom-0 w-full px-4 py-4">
        <form action="{{ route('Admin.logout') }}" method="POST">
            @csrf
            <button class="w-full text-left text-gray-700 hover:bg-gray-200 px-4 py-2 rounded-md flex items-center">
                Logout
                <svg class="ml-auto w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="gray">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7" />
                </svg>
            </button>
        </form>
    </div>
</div>

<!-- Mobile Menu Button -->
<button id="menu-button" class="fixed top-4 left-4 z-40 text-gray-500 focus:outline-none lg:hidden">
    <!-- Hamburger Icon -->
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4 6h16M4 12h16M4 18h16"></path>
    </svg>
</button>

<!-- JavaScript for Sidebar Toggle and Dropdown -->
<script>
    // Sidebar Toggle
    const menuButton = document.getElementById('menu-button');
    const sidebar = document.getElementById('sidebar');

    menuButton.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
    });

    // Dropdown Menu
    document.getElementById('productsDropdownButton').addEventListener('click', function() {
        var menu = document.getElementById('productsDropdownMenu');
        var icon = document.getElementById('productsDropdownIcon');
        menu.classList.toggle('hidden');
        icon.classList.toggle('transform');
        icon.classList.toggle('rotate-180');
    });
</script>
