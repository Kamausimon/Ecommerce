<!DOCTYPE html>
<html>
@include('partials._head')

<body class="flex">

    <!-- Sidebar -->
    @include('partials._sideBar')

    <!-- Main Body -->
    <div class="flex-1 flex flex-col min-h-screen">

        <!-- Navbar -->
        <div class="bg-slate-700 sticky top-0 z-20">
            <!-- Mobile Menu Button -->
            <div class="flex items-center p-4 lg:hidden">
                <button id="menu-button" class="text-white focus:outline-none">
                    <!-- Hamburger Icon -->
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <span class="ml-4 text-white text-lg">Dashboard</span>
            </div>
            @include('partials._dashNav')
        </div>

        <!-- Data Div -->
        <div class="flex-1 bg-gray-300 font-sans">
            @include('partials._cardComponent')
        </div>

        <!-- Footer -->
        <div class="bg-slate-700">
            @include('partials._footer')
        </div>

    </div>

    <!-- JavaScript for Toggling Sidebar -->
    <script>
        const menuButton = document.getElementById('menu-button');
        const sidebar = document.getElementById('sidebar');

        menuButton.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });
    </script>
</body>

</html>
