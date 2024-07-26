<!DOCTYPE html>
<html>
@include('partials._head')

<body>
    <div class="bg-slate-700 fixed top-0 z-50 w-full">
        @include('partials._dashNav')
    </div>

    <!-- data div -->
    <div class="flex flex-col items-center mt-40">
        <div class="w-full max-w-4xl">
            <table class="min-w-full divide-y divide-gray-200 shadow overflow-hidden rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Item
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Price
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Quantity
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Total
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($cart as $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full" src="{{ asset('storage/' . $item['image_path']) }}" alt="{{ $item['name'] }}">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $item['name'] }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            Ksh{{ number_format($item['price'], 2) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <button onclick="changeQuantity('decrease',  {{ $item['id'] }})">-</button>
                            <span id="quantity-{{ $item['id'] }}">{{ $item['quantity'] }}</span>
                            <button onclick="changeQuantity('increase', {{ $item['id'] }})">+</button>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            Ksh<span id="total-{{ $item['id'] }}">{{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <form action="{{route('cart.remove')}}" method="POST">
                                @csrf
                                @METHOD('DELETE')
                                <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
                                    <path fill="grey" d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V9c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2zM18 4h-2.5l-.71-.71c-.18-.18-.44-.29-.7-.29H9.91c-.26 0-.52.11-.7.29L8.5 4H6c-.55 0-1 .45-1 1s.45 1 1 1h12c.55 0 1-.45 1-1s-.45-1-1-1" />
                                </svg>
                            </form>

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                            Your cart is empty
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @include('partials._footer')
    <script>
        function changeQuantity(action, itemId) {
            let quantityElement = document.getElementById(`quantity-${itemId}`);
            let quantity = parseInt(quantityElement.innerText);
            if (action === 'increase') {
                quantity += 1;
            } else if (action === 'decrease' && quantity > 1) {
                quantity -= 1;
            }
            quantityElement.innerText = quantity;
            updateQuantityInDatabase(itemId, quantity);
            updateTotalPrice(itemId, quantity);
        }

        function deleteItem(itemId) {
            // Send request to server to delete item
            // On success, remove the item row from the table
            document.querySelector(`#row-${itemId}`).remove();
        }

        function updateQuantityInDatabase(itemId, quantity) {
            // Use fetch API or XMLHttpRequest to send the updated quantity to the server
        }

        function updateTotalPrice(itemId, quantity) {
            let pricePerItem = /* Price per item fetched from the server or stored in a data attribute */
                document.getElementById(`total-${itemId}`).innerText = (pricePerItem * quantity).toFixed(2);
        }
    </script>
</body>

</html>