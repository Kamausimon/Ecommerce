<div class="lg:fixed w-64 p-0 m-0 h-screen bg-white">
    <a href="{{ route('dashboard.index') }}" class="mt-3">
        <img class="block mt-4" src="/images/shope-high-resolution-logo-transparent.png" alt="logo" />
    </a>
    <div>
        <h2 class="text-xl font-semibold text-gray-700">Categories</h2>
        <ul class="mt-4">
            @foreach($categories as $category)
            <li>
                {{ $category->name }}
                @if($category->subcategories->count() > 0)
                <ul>
                    @foreach($category->subcategories as $subcategory)
                    <li>
                        {{ $subcategory->name }}
                    </li>
                    @endforeach
                </ul>
                @endif
            </li>
            @endforeach
        </ul>
    </div>
</div>