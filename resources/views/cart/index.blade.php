<!DOCTYPE html>
<html>
@include('partials._head')

<body>
    <div class="bg-slate-700 fixed top-0 z-50 w-full">
        @include('partials._dashNav')
    </div>

    <!-- data div -->
    <div class="flex flex-col items-center mt-40">
        <a href="{{route('dashboard.index')}}" class="ml-4 mb-5">
            <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
                <path fill="grey" d="M10 20v-6h4v6h5v-8h3L12 3L2 12h3v8z" />
            </svg>
        </a>
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
                    @forelse($cart as $id => $item)

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
                            {{ $item['quantity'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            Ksh{{ number_format($item['price'] * $item['quantity'], 2) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <form action="{{route('cart.remove', $id)}}" method="POST">
                                @csrf
                                @METHOD('DELETE')
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
                                        <path fill="grey" d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V9c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2zM18 4h-2.5l-.71-.71c-.18-.18-.44-.29-.7-.29H9.91c-.26 0-.52.11-.7.29L8.5 4H6c-.55 0-1 .45-1 1s.45 1 1 1h12c.55 0 1-.45 1-1s-.45-1-1-1" />
                                    </svg>
                                </button>

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
                    <tr>
                        <td colspan="3" class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium text-gray-900">
                            Total:
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            Ksh{{ number_format($subtotal, 2) }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium text-gray-900">
                            Discount:
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            Ksh{{ number_format($discount, 2) }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium text-gray-900">
                            Subtotal:
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            Ksh{{ number_format($total, 2) }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center">
                            <form action="{{ route('payment.complete') }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Complete Payment
                                </button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    @include('partials._footer')
    <script>

    </script>
</body>

</html>