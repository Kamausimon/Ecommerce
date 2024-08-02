<!DOCTYPE html>
<html>
@include('partials._head')

<body>
    <div>
        @include('partials._adminSidebar')
    </div>


    <!-- data div -->
    <div class="container mx-auto  ml-64">
        <h1 class="text-2xl font-bold mb-4">Product List</h1>
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

    @include('partials._footer')
</body>

</html>