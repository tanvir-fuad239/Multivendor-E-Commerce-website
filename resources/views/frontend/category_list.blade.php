@extends('frontend.master')

@section('main-content')
        <div class="page-header mt-30 mb-75">
            <div class="container">
                <div class="archive-header">
                    <div class="row align-items-center">
                        <div class="col-xl-3">
                            <h1 class="mb-15">{{ $pageTitle }}</h1>
                            <div class="breadcrumb">
                                <a href="{{ route('frontend.home') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                                <span></span> {{ $pageTitle }}
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
      
        <section class="popular-categories section-padding">
            <div class="container wow animate__animated animate__fadeIn">
                <div class="section-title">
                    <div class="title">
                        <h3>Available Categories</h3>
                    </div>
                    <div class="slider-arrow slider-arrow-2 flex-right carausel-10-columns-arrow" id="carausel-10-columns-arrows"></div>
                </div>
                <div class="carausel-10-columns-cover position-relative">
                    <div class="carausel-10-columns" id="carausel-10-columns">

                        @foreach($allCategories as $category)

                            <div class="card-2 bg-9 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                                <figure class="img-hover-scale overflow-hidden">
                                    <a href="{{ route('frontend.product.all', $category->id) }}"><img src="{{ getImage($category->category_image, "category") }}" alt="" height="50px" /></a>
                                </figure>
                                <h6><a href="{{ route('frontend.product.all', $category->id) }}">{{ $category->category_name }}</a></h6>
                                <span>
                                    @if ($category->products->count() == 1)
                                        {{ $category->products->count() }} item

                                    @else
                                        {{ $category->products->count() }} items
                                    @endif
                                </span>
                            </div>
            
                        @endforeach
                      
                  
                    </div>
                </div>
            </div>
        </section>

 
@endsection 