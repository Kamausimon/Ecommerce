<!DOCTYPE html>
<html>
@include('partials._head') <!-- Ensure Tailwind CSS is linked here -->

<body class="bg-gray-100">
    @include('partials._nav')

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-xl mx-auto bg-white shadow-md rounded-lg overflow-hidden">
            <div class="px-4 py-5">
                <h2 class="text-2xl font-semibold text-gray-800">{{ $product->name }}</h2>
                @if($product->image_path)
                <img src="{{ asset('storage/'. $product->image_path) }}" alt="{{ $product->name }}" class="mt-4 w-full h-64 object-cover">
                @endif
                <p class="mt-4 text-gray-600">{{ $product->description }}</p>
            </div>
            <div class="px-4 py-4 bg-gray-50">
                <span class="text-gray-700">Price: </span>
                <span class="font-semibold">${{ number_format($product->price, 2) }}</span>
            </div>
        </div>
    </div>

    @include('partials._footer')
</body>

</html>