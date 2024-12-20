<div class="max-w-7xl mx-auto py-4 sm:px-6 lg:px-8">
    @if($products->count())
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($products as $product)
        <div class="bg-white shadow-md rounded-lg overflow-hidden p-3 flex flex-col justify-between">
            <div>
                <img class="h-64 w-full object-cover" src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}">
                <p class="text-gray-800 text-lg font-semibold mt-2">{{ $product->name }}</p>
            </div>
            <div class="p-4 flex justify-between items-center">
                <span class="text-lg font-bold text-gray-900">Ksh {{ number_format($product->price, 2) }}</span>

                @if(Auth::check())
                <a href="{{ route('dashboard.show', $product->id) }}" class="px-3 py-2 bg-indigo-600 text-white text-xs font-semibold rounded uppercase hover:bg-indigo-700">View Details</a>
                @else
                <a href="{{ route('landing.show', $product->id) }}" class="px-3 py-2 bg-indigo-600 text-white text-xs font-semibold rounded uppercase hover:bg-indigo-700">View Details</a>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-6">
        {{ $products->links() }}
    </div>
    @else
    <p class="text-center text-gray-700">No products found</p>
    @endif
</div>
