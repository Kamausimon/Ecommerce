<!DOCTYPE html>
<html>
@include('partials._head')

<body class="flex bg-gray-100">
    <!-- Sidebar -->
    @include('partials._adminSidebar')

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-h-screen">
        <!-- Header (Optional) -->
        <header class="bg-white shadow">
            <div class="container mx-auto py-6 px-4">
                <h1 class="text-3xl font-bold text-gray-900">Edit Product</h1>
            </div>
        </header>

        <!-- Content -->
        <main class="flex-1">
            <div class="container mx-auto py-6 px-4">
                <form action="{{ route('Products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
                    @csrf
                    @method('PUT')
                    <!-- Product Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700">Product Name:</label>
                        <input type="text" name="name" id="name" value="{{ $product->name }}" class="w-full px-3 py-2 border rounded">
                    </div>
                    <!-- Category -->
                    <div class="mb-4">
                        <label for="category" class="block text-gray-700">Category:</label>
                        <select name="category_id" id="category" class="w-full px-3 py-2 border rounded">
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Price -->
                    <div class="mb-4">
                        <label for="price" class="block text-gray-700">Price:</label>
                        <input type="text" name="price" id="price" value="{{ $product->price }}" class="w-full px-3 py-2 border rounded">
                    </div>
                    <!-- Stock -->
                    <div class="mb-4">
                        <label for="stock" class="block text-gray-700">Stock:</label>
                        <input type="text" name="stock" id="stock" value="{{ $product->stock }}" class="w-full px-3 py-2 border rounded">
                    </div>
                    <!-- Image -->
                    <div class="mb-4">
                        <label for="image" class="block text-gray-700">Product Image:</label>
                        <input type="file" name="image" id="image" class="w-full px-3 py-2 border rounded">
                        @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-20 h-20 mt-2">
                        @endif
                    </div>
                    <!-- Buttons -->
                    <div class="flex justify-between">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
                        <a href="{{ route('Admin.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Discard</a>
                    </div>
                </form>
            </div>
        </main>

        <!-- Footer -->
        @include('partials._footer')
    </div>

    <!-- JavaScript for Sidebar Toggle (if not already included) -->
    <script>
        // Sidebar Toggle
        const menuButton = document.getElementById('menu-button');
        const sidebar = document.getElementById('sidebar');

        menuButton.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });
    </script>
</body>

</html>
