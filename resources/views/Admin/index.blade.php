<!DOCTYPE html>
<html>
@include('partials._head')

<body class="flex">
    <!-- Sidebar -->
    @include('partials._adminSidebar')

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-h-screen">
        <!-- Header or Navbar (Optional) -->
        <header class="bg-white shadow">
            <div class="container mx-auto py-6 px-4">
                <h1 class="text-3xl font-bold text-gray-900">Product List</h1>
            </div>
        </header>

        <!-- Content -->
        <main class="flex-1">
            <div class="container mx-auto py-6 px-4">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">Product</th>
                            <th class="py-2 px-4 border-b">Category</th>
                            <th class="py-2 px-4 border-b">Price</th>
                            <th class="py-2 px-4 border-b">Stock</th>
                            <th class="py-2 px-4 border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td class="py-2 px-4 border-b flex items-center">
                                <img src="{{ asset('storage/' . $product->image_path) }}" class="w-10 h-10 mr-4">
                                {{ $product->name }}
                            </td>
                            <td class="py-2 px-4 border-b">{{ $product->category->name }}</td>
                            <td class="py-2 px-4 border-b">{{ $product->price }}</td>
                            <td class="py-2 px-4 border-b">{{ $product->stock }}</td>
                            <td class="py-2 px-4 border-b">
                                <a href="{{ route('Products.edit', $product->id) }}" class="text-blue-500 hover:underline">Edit</a>
                                <form action="{{ route('Products.delete', $product->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>

        <!-- Footer -->
        @include('partials._footer')
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