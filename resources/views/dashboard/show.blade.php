<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials._head')
    <link href="/path/to/your/tailwind.css" rel="stylesheet">
</head>

<body class="bg-white">

    @include('partials._sideBar')

    <div class="ml-64 max-h-screen mb-0">
        <div class=" bg-slate-700">
            @include('partials._dashNav')
        </div>

        <div class="w-auto h-5/6 p-4 mt-2 ">
            <a href="{{route('dashboard.index')}}" class="ml-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 48 48">
                    <path fill="#2f88ff" fill-rule="evenodd" stroke="#000" stroke-linejoin="round" stroke-width="4" d="M44 40.8361C39.1069 34.8632 34.7617 31.4739 30.9644 30.6682C27.1671 29.8625 23.5517 29.7408 20.1182 30.303V41L4 23.5453L20.1182 7V17.167C26.4667 17.2172 31.8638 19.4948 36.3095 24C40.7553 28.5052 43.3187 34.1172 44 40.8361Z" clip-rule="evenodd" />
                </svg>
            </a>
            <div class="max-w-2xl  mx-auto  rounded-lg overflow-hidden flex">
                @if($product->image_path)
                <div class="flex-none ml-8 p-0">
                    <img src="{{ asset('storage/'. $product->image_path) }}" alt="{{ $product->name }}" class="h-80 object-cover">
                </div>
                @endif

                <div class="flex-grow p-4 flex flex-col  justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">{{ $product->name }}</h2>
                        <div class="py-2">
                            <span class="text-gray-700">Price: </span>
                            <span class="font-semibold">Ksh{{ number_format($product->price, 2) }}</span>
                        </div>
                        <form action="{{route('cart.add')}}" method="POST" class="mt-4">
                            @csrf
                            <input type="hidden" name="product[id]" value="{{$product->id}}">
                            <input type="hidden" name="product[name]" value="{{$product->name}}">
                            <input type="hidden" name="product[price]" value="{{$product->price}}">
                            <input type="hidden" name="product[image_path]" value="{{$product->image_path}}">
                            <input type="number" name="quantity" value="1" class="px-1 py-2 mt-1 mb-2 border border-sky-500">
                            <button type="submit" class="px-14 py-2 bg-blue-500 text-white rounded hover:bg-blue-800">Add To Cart</button>
                        </form>
                    </div>
                    <span class="italic underline text-lg mt-3"> features</span>
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

    @include('partials._footer');
</body>

</html>