@include('admin.layouts.styles')
    <!--wrapper-->
    <div class="wrapper">

        <!--sidebar wrapper -->
        @include('admin.layouts.sidebar')
        <!--end sidebar wrapper -->

        <!--start header -->
        @include('admin.layouts.header')
        <!--end header -->

        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">

                @yield('main-content')

            </div>
        </div>
        <!--end page wrapper -->

        @include('admin.layouts.footer')
    </div>
@include('admin.layouts.script')