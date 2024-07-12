<!DOCTYPE html>

<html>
@include('partials._head')

<body>
    <!-- nav start -->
    @include('partials._nav')

    <!-- nav end -->

    <!-- data -->
    <div class="product-container bg-gray-300 font-sans h-screen ">
        @include('partials._cardComponent');
    </div>
    <!-- end of data div -->

    <!-- footer -->
    @include('partials._footer')
</body>

</html>