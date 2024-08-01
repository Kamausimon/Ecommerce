<!DOCTYPE html>
<html>
@include('partials._head')

<body>
    <!-- nav -->
    <div class="bg-slate-700 fixed top-0 z-50 w-full">
        @include('partials._dashNav')
    </div>

    <!-- data div -->

    <div class="container mx-auto p-4 mt-40">

        <div class="flex w-full justify-between items-center">
            <button onclick="history.back()" class="mb-5 ml-8 bg-white text-white font-bold py-2 px-4 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 16 16">
                    <path fill="black" fill-rule="evenodd" d="m2.87 7.75l1.97 1.97a.75.75 0 1 1-1.06 1.06L.53 7.53L0 7l.53-.53l3.25-3.25a.75.75 0 0 1 1.06 1.06L2.87 6.25h9.88a3.25 3.25 0 0 1 0 6.5h-2a.75.75 0 0 1 0-1.5h2a1.75 1.75 0 1 0 0-3.5z" clip-rule="evenodd" />
                </svg>
            </button>
            <div class="flex-grow text-center">
                <a href="{{route('dashboard.index')}}" class="ml-4 mb-5 inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
                        <path fill="grey" d="M10 20v-6h4v6h5v-8h3L12 3L2 12h3v8z" />
                    </svg>
                </a>
            </div>
        </div>

        <h2 class="text-2xl font-bold mb-4">M-Pesa Payment</h2>
        <form id="mpesaForm" method="POST" action="{{ route('mpesa.payment') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-4">
                <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Phone Number</label>
                <input type="text" id="phone" name="phone" placeholder="2547XXXXXXXX" value="{{old('phone')}}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('phone')
                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="amount" class="block text-gray-700 text-sm font-bold mb-2">Amount</label>
                <input type="number" id="amount" name="amount" value="{{$cartTotal}}" readonly required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('amount')
                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Pay with M-Pesa</button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#mpesaForm').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                        } else {
                            alert('Payment failed. Please try again.');
                        }
                    },
                    error: function() {
                        alert('An error occurred. Please try again.');
                    }
                });
            });
        });
    </script>

    @include('partials._footer')
</body>

</html>