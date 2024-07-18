<!DOCTYPE html>
<html>

@include('partials._head')

<body class="bg-slate-700">


    @include("partials._nav")
    <!--div housing the registration form-->
    <div class="w-full max-w-xs mx-auto mt-24">


        <form action="/registerUser" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="fName">
                    Name:
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{old('name')}}" type="text" name="name" id="name" placeholder="Enter Name Here..">
                @error('name')
                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email:
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{old('email')}}" type="text" name="email" id="email" placeholder="email..">
                @error('email')
                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="mobile">
                    Mobile:
                </label>
                <div class="flex">
                    <span class="shadow appearance-none border rounded-l w-auto py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-200">+254</span>
                    <input class="shadow appearance-none border-t border-b border-r rounded-r w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('mobile') }}" type="text" name="mobile" id="mobile" placeholder="mobile..">
                </div>
                @error('mobile')
                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>


            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password:
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{old('password')}}" type="password" name="password" id="password" placeholder="password..">
                <input type="checkbox" id="togglePassword"> Show Password
                @error('password')
                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="passwordConfirm">
                    Password Confirm:
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="password" value="{{old('passwordConfirm')}}" name="password_confirmation" id="password_confirmation" placeholder="retype password...">
                @error('password_confirmation')
                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Register
                </button>
            </div>
        </form>
    </div>
    <!--end of the div-->

    <!--footer-->
    @include('partials._footer')
    <!--end of footer-->
    <script defer>
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        const passwordConfirmation = document.getElementById('password_confirmation');

        togglePassword.addEventListener('click', function(e) {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            passwordConfirmation.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        })
    </script>
</body>

</html>