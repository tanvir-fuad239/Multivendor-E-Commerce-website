@extends('frontend.master')

 
@section('main-content')

        @include('frontend.home.hero_slider')
        <!--End hero slider-->
        
        @include('frontend.home.category_slider') 
        <!--End category slider-->

        @include('frontend.home.banner')
        <!--End banners-->
 
        @include('frontend.home.product_tabs')
        <!--Products Tabs-->

        @include('frontend.home.best_sales')
        <!--End Best Sales-->

        <!-- TV Category -->
        @include('frontend.home.tv_category')
        <!--End TV Category -->
 
        <!-- Tshirt Category -->
        @include('frontend.home.tshirt_category')
        <!--End Tshirt Category -->

        <!-- Computer Category -->
        @include('frontend.home.computer_category')
        <!--End Computer Category -->
        
        {{-- hot deals --}}
        @include('frontend.home.hot_deals')
        <!--End 4 columns-->
 
  <!--Vendor List -->

  @include('frontend.home.vendor_list')

 <!--End Vendor List -->

@endsection