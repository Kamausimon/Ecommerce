<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials._head')
    <link href="/path/to/your/tailwind.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="flex justify-center items-center h-full">
        <a href="{{ route('dashboard.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
            <!-- SVG content -->
        </a>
    </div>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-xl mx-auto bg-white shadow-md rounded-lg overflow-hidden">
            <div class="px-4 py-5">
                <h2 class="text-xl font-semibold text-gray-800">{{ $product->name }}</h2>
                <p class="text-gray-600">{{ $product->description }}</p>
            </div>
            <div class="px-4 py-4 bg-gray-50">
                <span class="text-gray-700">Price: </span>
                <span class="font-semibold">${{ number_format($product->price, 2) }}</span>
            </div>
            @if($product->image_path)
            <img src="{{ asset('storage/'. $product->image_path) }}" alt="{{ $product->name }}" class="w-full h-64 object-cover">
            @endif
        </div>
    </div>

    @include('partials._footer');
</body>

</html>