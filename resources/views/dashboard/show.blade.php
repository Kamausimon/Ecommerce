<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials._head')
    <link href="/path/to/your/tailwind.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    @include('partials._sidebar')

    <div class="ml-64">
        <div class=" bg-slate-700">
            @include('partials._dashNav')
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
    </div>

    @include('partials._footer');
</body>

</html>