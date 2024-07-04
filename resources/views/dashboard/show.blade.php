<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials._head')
    <link href="/path/to/your/tailwind.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="flex justify-center items-center h-full">
        <a href="{{ route('dashboard.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200 mt-3">
            <!-- SVG content -->
            <svg xmlns="http://www.w3.org/2000/svg" width="3em" height="3em" viewBox="0 0 24 24">
                <path fill="grey" d="M10 20v-6h4v6h5v-8h3L12 3L2 12h3v8z" />
            </svg>
        </a>
    </div>

    <div class=" w-auto h-5/6 p-4 mt-2 ">
        <div class="max-w-xl mx-auto bg-white shadow-md rounded-lg overflow-hidden">
            <div class="px-4 py-5">
                <h2 class="text-xl font-semibold text-gray-800">{{ $product->name }}</h2>
                @if($product->image_path)
                <img src="{{ asset('storage/'. $product->image_path) }}" alt="{{ $product->name }}" class=" h-64 object-cover ">
                @endif
                <p class="text-gray-600">{{ $product->description }}</p>
            </div>
            <div class="px-4 py-4 bg-gray-50">
                <span class="text-gray-700">Price: </span>
                <span class="font-semibold">${{ number_format($product->price, 2) }}</span>
            </div>

        </div>
    </div>

    @include('partials._footer');
</body>

</html>