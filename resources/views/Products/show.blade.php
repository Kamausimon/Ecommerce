<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials._head')

</head>

<body class="flex flex-col lg:flex-row bg-white">

    @include('partials._adminSidebar')

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-h-screen">
        <!-- Header (Optional) -->
        <header class="bg-white shadow">
            <div class="container mx-auto py-6 px-4">
                <h1 class="text-3xl font-bold text-gray-900">Show Product</h1>
            </div>
        </header>

        <div class="w-full lg:w-auto h-auto p-4 mt-2">
            <a href="{{route('Admin.index')}}" class="ml-4 inline-block mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 16 16">
                    <path fill="black" fill-rule="evenodd" d="m2.87 7.75l1.97 1.97a.75.75 0 1 1-1.06 1.06L.53 7.53L0 7l.53-.53l3.25-3.25a.75.75 0 0 1 1.06 1.06L2.87 6.25h9.88a3.25 3.25 0 0 1 0 6.5h-2a.75.75 0 0 1 0-1.5h2a1.75 1.75 0 1 0 0-3.5z" clip-rule="evenodd" />
                </svg>
            </a>
            <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md overflow-hidden flex flex-col md:flex-row">
                @if($product->image_path)
                <div class="flex-none md:ml-8 p-0">
                    <img src="{{ asset('storage/'. $product->image_path) }}" alt="{{ $product->name }}" class="h-64 w-full md:w-80 object-cover">
                </div>
                @endif

                <div class="flex-grow p-4 flex flex-col justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">{{ $product->name }}</h2>
                        <div class="py-2">
                            <span class="text-gray-700">Price: </span>
                            <span class="font-semibold">Ksh{{ number_format($product->price, 2) }}</span>
                        </div>
                    </div>
                    <span class="italic underline text-lg mt-3">Features</span>
                    <div class="text-gray-600 mt-4">
                        <ul class="list-disc pl-5">
                            @foreach(explode(',', $product->description) as $item)
                            <li>{{ trim($item) }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials._footer')
</body>

</html>
