<!DOCTYPE html>
<html>
@include('partials._head');

<body class="flex">


    <!-- sidebar -->
    @include('partials._sideBar')

    <!-- end of sidebar -->

    <!-- main body -->
    <div class="ml-64 w-full p-0 m-0 bg-slate-700 sticky top-0 z-50">

        <!-- navbar -->
        <div class="bg-slate-700 sticky top-0 z-50">
            @include('partials._dashNav')
        </div>



        <!-- end of navbar -->

        <!-- data div -->
        <div class="product-container bg-gray-300 font-sans h-screen">
            @include('partials._cardComponent');
        </div>
        <!-- end of data div -->

    </div>
    <!-- end of main body -->


    <!-- footer -->
    <div class="bg-slate-700 sticky bottom-0 z-50">
        @include('partials._footer')
    </div>

    <!-- end of footer -->
</body>

</html>