<!DOCTYPE html>
<html>
@include('partials._head') <!-- Ensure Tailwind CSS is linked here -->

<body class="bg-white">
    @include('partials._nav')

    <div class="max-w-2xl  mx-auto  rounded-lg overflow-hidden flex">
        @if($product->image_path)
        <div class="flex-none ml-8 p-0">
            <img src="{{ asset('storage/'. $product->image_path) }}" alt="{{ $product->name }}" class="h-80 object-cover">
        </div>
        @endif

        <div class="flex-grow p-4 flex flex-col  justify-between mt-5">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">{{ $product->name }}</h2>
                <div class="py-2">
                    <span class="text-gray-700">Price: </span>
                    <span class="font-semibold">Ksh{{ number_format($product->price, 2) }}</span>
                </div>

            </div>
            <span class="italic underline text-lg mt-3"> features</span>
            <div class="text-gray-600 mt-4">
                <ul class="list-disc pl-5">
                    @foreach(explode(':', $product->description) as $item)
                    <li>{{ trim($item) }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    @include('partials._footer')
</body>

</html>