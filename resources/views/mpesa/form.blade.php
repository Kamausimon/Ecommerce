<!DOCTYPE html>
<html>
@include('partials._head')

<body>
    <!-- nav -->
    <div class="bg-slate-700 fixed top-0 z-50 w-full">
        @include('partials._dashNav')
    </div>

    <!-- data div -->

    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">M-Pesa Payment</h2>
        <form id="mpesaForm" method="POST" action="{{ route('mpesa.payment') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-4">
                <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Phone Number</label>
                <input type="text" id="phone" name="phone" placeholder="2547XXXXXXXX" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('phone')
                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="amount" class="block text-gray-700 text-sm font-bold mb-2">Amount</label>
                <input type="number" id="amount" name="amount" value="{{$cartTotal}}" min="1" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
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