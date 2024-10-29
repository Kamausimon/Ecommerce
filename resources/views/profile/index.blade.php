<!DOCTYPE html>
<html>
<!-- Head -->
@include('partials._head')

<body>
    <!-- Navbar -->
    @include('partials._dashNav')

    <div>
        <h1 class="text-2xl font-bold text-center mt-4">Profile</h1>
        <div class="flex flex-col items-center mt-4">
            <div class="flex flex-col items-center">
                <img src="{{ asset('images/profile.png') }}" alt="profile" class="w-32 h-32 rounded-full">
                <h2 class="text-xl font-bold mt-2">{{ Auth::user()->name }}</h2>
                <p class="text-gray-500">{{ Auth::user()->email }}</p>
                <p class="text-gray-500">{{Auth::user()->mobile}}</p>
            </div>
            <div class="flex flex-col items-center mt-4">
                <a href="{{ route('profile.edit') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Edit Profile</a>
                <a href="{{ route('profile.passwordForm') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 mt-2">Change Password</a>
            </div>
        </div>
    </div>

</body>

</html>
