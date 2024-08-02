<!DOCTYPE html>
<html>
@include('partials._head')

<body>
    <div class="container mx-auto mt-8 ml-64">
        <h1 class="text-2xl font-bold mb-4">Edit Product</h1>
        <form action="{{ route('Products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Product Name:</label>
                <input type="text" name="name" id="name" value="{{ $product->name }}" class="w-full px-3 py-2 border rounded">
            </div>
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
            <div class="mb-4">
                <label for="price" class="block text-gray-700">Price:</label>
                <input type="text" name="price" id="price" value="{{ $product->price }}" class="w-full px-3 py-2 border rounded">
            </div>
            <div class="mb-4">
                <label for="stock" class="block text-gray-700">Stock:</label>
                <input type="text" name="stock" id="stock" value="{{ $product->stock }}" class="w-full px-3 py-2 border rounded">
            </div>
            <div class="mb-4">
                <label for="image" class="block text-gray-700">Product Image:</label>
                <input type="file" name="image" id="image" class="w-full px-3 py-2 border rounded">
                @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-20 h-20 mt-2">
                @endif
            </div>
            <div class="flex justify-between">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
                <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Discard</a>
            </div>
        </form>
    </div>

    @include('partials._footer')
</body>

</html>