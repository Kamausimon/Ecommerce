<!DOCTYPE html>

<html>
@include('partials._head')

<body>
    <!-- nav -->
    @include('partials._nav')

    <!-- end of nav -->

    <!-- data -->
    <div class="w-full max-w-xs mx-auto mt-36">

        <form action="/login" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @if ($errors->has('login'))
            <span class="text-red-600 text-md">{{ $errors->first('login') }}</span>
            @endif
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email:
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="email" id="email" placeholder="email..">
                @error('email')
                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password:
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="password" name="password" id="password" placeholder="password..">
                <input type="checkbox" id="togglePassword"> Show Password
                @error('password')
                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="remember" class="mb-1">
                    <input type="checkbox" id="remember" name="remember">
                    <span>Remember me</span>
                </label>
            </div>

            <div class=" flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Login
                </button>
                <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="/forgotPassword">
                    Forgot Password?
                </a>
            </div>
        </form>
    </div>

    <!-- end of data -->


    @include('partials._footer')
    <script defer>
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');


        togglePassword.addEventListener('click', function(e) {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        })
    </script>
</body>

</html>