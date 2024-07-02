<!DOCTYPE html>
<html>
@include('partials._head');

<body class="flex">


    <!-- sidebar -->
    @include('partials._sidebar')

    <!-- end of sidebar -->

    <!-- main body -->
    <div class="ml-64 w-full bg-slate-700">

        <!-- navbar -->
        @include('partials._dashNav')
        <!-- end of navbar -->

        <!-- data div -->
        <div class="bg-gray-300 font-sans h-screen">
            @include('partials._cardComponent');
        </div>
        <!-- end of data div -->

    </div>
    <!-- end of main body -->


    <!-- footer -->
    @include('partials._footer')
    <!-- end of footer -->
</body>

</html>