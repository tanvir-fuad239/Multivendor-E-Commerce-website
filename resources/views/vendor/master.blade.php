@include('vendor.layouts.styles')
    <!--wrapper-->
    <div class="wrapper">

        <!--sidebar wrapper -->
        @include('vendor.layouts.sidebar')
        <!--end sidebar wrapper -->

        <!--start header -->
        @include('vendor.layouts.header')
        <!--end header -->

        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">

                @yield('main-content')

            </div>
        </div>
        <!--end page wrapper -->

        @include('vendor.layouts.footer')
    </div>
@include('vendor.layouts.script')