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

        <!-- Computer Category -->
        @include('frontend.home.food_category')
        <!--End Computer Category -->
        
        {{-- hot deals --}}
        @include('frontend.home.hot_deals')
        <!--End 4 columns-->
 
  <!--Vendor List -->

  @include('frontend.home.vendor_list')

 <!--End Vendor List -->

@endsection