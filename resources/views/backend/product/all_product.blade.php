@extends('admin.master') 

@section('main-content')
	<!--start page wrapper -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-lg-3 col-xl-2">
                            <a href="{{ route('product.create') }}" class="btn btn-primary mb-3 mb-lg-0"><i class='bx bxs-plus-square'></i>New Product</a>
                        </div>

                        <div class="col-lg-9 col-xl-10">
                            <div class="row row-cols-lg-auto g-3">
                                {{-- search bar  --}}
                                <div class="col-12">
                                    <form class="float-lg-end" method="get">
                                        <div class="position-relative">
                                            <input type="text" class="form-control ps-5 col-12 search" placeholder="Search Product..." name="search" value="{{ request()->search }}"> <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search search-icon"></i></span>
                                        </div>
                                    </form>
                                </div>
                                {{-- search bar ends --}}     
                                <div class="col-12 ms-auto">
                                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                        <button type="button" class="btn btn-white">Sort By</button>
                                        <div class="btn-group" role="group">
                                            <button id="btnGroupDrop1" type="button" class="btn btn-white dropdown-toggle dropdown-toggle-nocaret px-1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class='bx bx-chevron-down'></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">

                                                <li><a href="{{ route('product.all') }}" class="dropdown-item">Default</a></li>
                                                <li><a href="{{ route('product.sort', "name") }}" class="dropdown-item">Name</a></li>
                                                <li><a href="{{ route('product.sort', "price") }}" class="dropdown-item">Price</a></li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-white">Price Range</button>
                                        <div class="btn-group" role="group">
                                            <button id="btnGroupDrop1" type="button" class="btn btn-white dropdown-toggle dropdown-toggle-nocaret px-1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class='bx bx-slider'></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-start" aria-labelledby="btnGroupDrop1">
                                            <li><a class="dropdown-item" href="{{ route('product.filter', ["500","20000"] ) }}">{{ getAmount() }}  500 - 20,000</a></li>
                                            <li><a class="dropdown-item" href="{{ route('product.filter', ["20000", "100000"]) }}">{{ getAmount() }} 20,000 - 100,000</a></li>
                                            <li><a class="dropdown-item" href="{{ route('product.filter', ["100000", "null"]) }}">{{ getAmount() }} 100,000 - more</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5 product-grid">
        
        @forelse ($allProducts as $product)

            <div class="col">
                <div class="card">
                    <img src="{{ getImage($product->product_image, "product") }}" class="card-img-top" alt="{{ getImage($product->product_image, "product") }}" height="200px">
                    <div class="">
                        <div class="position-absolute top-0 end-0 m-3 product-discount"><span class="">{{ getRandomNumber(10,70) }}%</span></div>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title cursor-pointer"><a href="{{ route('product.show', $product->id) }}">{{ showTitle($product->product_name, 24) }}</a></h6>
                        <div class="clearfix">
                            <p class="mb-0 float-start"><strong>{{ getRandomNumber(100,500) }}</strong> Sales</p>
                            <p class="mb-0 float-end fw-bold"><span class="me-2 text-decoration-line-through text-secondary">{{ getAmount($product->product_price) }}</span><span>{{ getAmount($product->discount_price) }}</span></p>
                        </div>
                        <div class="d-flex align-items-center mt-3 fs-6">
                            <div class="cursor-pointer">
                            <i class='bx bxs-star text-warning'></i>
                            <i class='bx bxs-star text-warning'></i>
                            <i class='bx bxs-star text-warning'></i>
                            <i class='bx bxs-star text-warning'></i>
                            <i class='bx bxs-star text-secondary'></i>
                            </div>	
                            <p class="mb-0 ms-auto">4.2</p>
                        </div>
                    </div>
                </div>
            </div>
       
        @empty
            <h2 class="text-center fw-bold m-auto">No Product Found</h2>
        @endforelse
    
    </div><!--end row-->
    <!--end page wrapper -->

@endsection