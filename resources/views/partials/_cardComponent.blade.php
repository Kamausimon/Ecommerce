<div>

    @if($Product->count())
    <div>
        @foreach($Product as $produce)
        <img class="w-full h-48 object-cover" src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}">
        <div class="p-4">
            <h2 class="text-lg font-semibold text-gray-900">{{ $product->name }}</h2>
            <p class="mt-2 text-gray-600">{{ $product->description }}</p>
            <div class="mt-4 flex items-center justify-between">
                <span class="text-lg font-bold text-gray-900">${{ number_format($product->price, 2) }}</span>
                <a href="{{ route('products.show', $product->id) }}" class="px-3 py-2 bg-indigo-600 text-white text-xs font-semibold rounded uppercase hover:bg-indigo-700">View Details</a>
            </div>
        </div>

        @endforeach
    </div>
    @endif
</div>