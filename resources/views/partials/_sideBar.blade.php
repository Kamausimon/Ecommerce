<div class="lg:fixed w-64 p-0 m-0 h-screen bg-white">
    <a href="{{ route('dashboard.index') }}" class="mt-3">
        <img class="block mt-4" src="/images/shope-high-resolution-logo-transparent.png" alt="logo" />
    </a>

    <div>
        <h2 class="text-xl font-semibold text-gray-700">Categories</h2>
        <ul class="mt-4">
            @foreach($categories as $category)
            <li class="relative">
                <button class="w-full text-left flex justify-between items-center py-2 px-4 text-gray-700 hover:bg-gray-100 focus:outline-none">
                    {{ $category->name }}
                    @if($category->subcategories->count() > 0)
                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                    </svg>
                    @endif
                </button>
                @if($category->subcategories->count() > 0)
                <ul class="absolute left-0 mt-1 hidden bg-white border border-gray-200 shadow-lg rounded-md overflow-hidden z-10">
                    @foreach($category->subcategories as $subcategory)
                    <li>
                        <a href="#" class="block py-2 px-4 text-gray-700 hover:bg-gray-100 subcategory-link" data-id="{{ $subcategory->id }}">{{ $subcategory->name }}</a>
                    </li>
                    @endforeach
                </ul>
                @endif
            </li>
            @endforeach
        </ul>
    </div>
</div>

<div id="products-container" class="ml-72 p-4">
    <h2 class="text-xl font-semibold text-gray-700">Products</h2>
    <div id="products-list" class="grid grid-cols-1 gap-4 mt-4">
        <!-- Products will be loaded here dynamically -->
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('button');
        buttons.forEach(button => {
            button.addEventListener('click', function() {
                const dropdown = this.nextElementSibling;
                dropdown.classList.toggle('hidden');
                // Close other dropdowns
                document.querySelectorAll('ul.absolute').forEach(menu => {
                    if (menu !== dropdown) {
                        menu.classList.add('hidden');
                    }
                });
            });
        });

        const subcategoryLinks = document.querySelectorAll('.subcategory-link');
        subcategoryLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const subcategoryId = this.dataset.id;

                fetch(`/products-by-subcategory/${subcategoryId}`)
                    .then(response => response.json())
                    .then(products => {
                        const productsList = document.getElementById('products-list');
                        productsList.innerHTML = ''; // Clear existing products

                        products.forEach(product => {
                            const productDiv = document.createElement('div');
                            productDiv.classList.add('border', 'p-4', 'rounded', 'shadow');
                            productDiv.innerHTML = `
                                <h3 class="text-lg font-semibold">${product.name}</h3>
                                <p>${product.description}</p>
                                <p class="text-gray-500">${product.price}</p>
                            `;
                            productsList.appendChild(productDiv);
                        });
                    });
            });
        });
    });
</script>