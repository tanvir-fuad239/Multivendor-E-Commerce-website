@extends('frontend.master') 

@section('main-content')
        <div class="page-header mt-30 mb-50">
            <div class="container">
                <div class="archive-header">
                    <div class="row align-items-center">
                        <div class="col-xl-3">
                            <h1 class="mb-15">{{ $categoryWithProduct->category_name }}</h1>
                            <div class="breadcrumb">
                                <a href="{{ route('frontend.home') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                                <span></span> Shop <span></span> {{ $categoryWithProduct->category_name }}
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
        <div class="container mb-30">
            <div class="row flex-row-reverse">
                <div class="col-lg-4-5">
                    <div class="shop-product-fillter">
                        <div class="totall-product">
                            @if($categoryWithProduct->products->count() == 1)
                                <p>We found <strong class="text-brand">{{ $categoryWithProduct->products->count() }}</strong> item for you!</p>  
                            @else
                                <p>We found <strong class="text-brand">{{ $categoryWithProduct->products->count() }}</strong> items for you!</p>
                            @endif
                        </div>
                    </div>
                    <div class="row product-grid">
                        
                        @forelse ($categoryWithProduct->products as $product)
                            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="shop-product-right.html">
                                                <img class="default-img" src="{{ getImage($product->product_image, "product") }}" alt="" height="100px"/>
                                                <img class="hover-img" src="{{ getImage($product->product_image, "product") }}" alt="" height="100px"/>
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Add To Wishlist" class="action-btn" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                            <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="hot">Hot</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">

                                            @php
                                               $subCategory = App\Models\SubCategory::where('category_id', $categoryWithProduct->id)->first(); 
                                               $vendor = App\Models\User::where('id', $product->vendor_id)->where("role", "vendor")->first();
                                            @endphp

                                            <span>{{ $subCategory->subcategory_name }}</span>
                                        </div>
                                        <h2><a href="shop-product-right.html">{{ $product->product_name }}</a></h2>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                        <div>
                                            <span class="font-small text-muted">By <a href="{{ route('frontend.vendor.details') }}">{{ showTitle($vendor->name, 18) }}</a></span>
                                        </div>
                                        <div class="product-card-bottom">
                                            <div class="product-price">
                                                <span>{{ getAmount($product->discount_price) }}</span>
                                                <span class="old-price">{{ getAmount($product->product_price) }}</span>
                                            </div>
                                            <div class="add-cart">
                                                <a class="add" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-dark">No Product Availabe.</p>
                        @endforelse
                       
                        <!--end product card-->
 
                    </div>
         
                    @if ($categoryWithProduct->products->count() > 15)
                            
                        <!--product grid-->
                        <div class="pagination-area mt-20 mb-20">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-start">
                                    <li class="page-item">
                                        <a class="page-link" href="#"><i class="fi-rs-arrow-small-left"></i></a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item active"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                                    <li class="page-item"><a class="page-link" href="#">6</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#"><i class="fi-rs-arrow-small-right"></i></a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <!--End Deals-->
                    
                    @endif 
                    
                </div>
                <div class="col-lg-1-5 primary-sidebar sticky-sidebar">

                    <div class="sidebar-widget widget-category-2 mb-30">
                        <h5 class="section-title style-1 mb-30">Category</h5>
                        <ul>
                            @forelse ($restCategories as $category)
                                <li>
                                    <a href="{{ route('frontend.product.all', $category->id) }}"> <img src="{{ getImage($category->category_image, "category") }}" alt="" />{{ $category->category_name }}</a><span class="count">{{ $category->products->count() }}</span>
                                </li>
                            @empty
                                <p class="text-center">Others category not available.</p>
                            @endforelse
                      
                        </ul>
                    </div>

                    <!-- Fillter By Price -->
                    <div class="sidebar-widget price_range range mb-30">
                        <h5 class="section-title style-1 mb-30">Fill by price</h5>
                        <div class="price-filter">
                            <div class="price-filter-inner">
                                <div id="slider-range" class="mb-20"></div>
                                <div class="d-flex justify-content-between">
                                    <div class="caption">From: <strong id="slider-range-value1" class="text-brand"></strong></div>
                                    <div class="caption">To: <strong id="slider-range-value2" class="text-brand"></strong></div>
                                </div>
                            </div>
                        </div>
                        <div class="list-group">
                            <div class="list-group-item mb-10 mt-10">
                                <label class="fw-900">Color</label>
                                <div class="custome-checkbox">
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="" />
                                    <label class="form-check-label" for="exampleCheckbox1"><span>Red (56)</span></label>
                                    <br />
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox2" value="" />
                                    <label class="form-check-label" for="exampleCheckbox2"><span>Green (78)</span></label>
                                    <br />
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox3" value="" />
                                    <label class="form-check-label" for="exampleCheckbox3"><span>Blue (54)</span></label>
                                </div>
                                <label class="fw-900 mt-15">Item Condition</label>
                                <div class="custome-checkbox">
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox11" value="" />
                                    <label class="form-check-label" for="exampleCheckbox11"><span>New (1506)</span></label>
                                    <br />
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox21" value="" />
                                    <label class="form-check-label" for="exampleCheckbox21"><span>Refurbished (27)</span></label>
                                    <br />
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox31" value="" />
                                    <label class="form-check-label" for="exampleCheckbox31"><span>Used (45)</span></label>
                                </div>
                            </div>
                        </div>
                        <a href="shop-grid-right.html" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i> Fillter</a>
                    </div>
                    <!-- Product sidebar Widget -->
                    <div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
                        <h5 class="section-title style-1 mb-30">New products</h5>
                        <div class="single-post clearfix">
                            <div class="image">
                                <img src="{{ asset('frontend') }}/assets/imgs/shop/thumbnail-3.jpg" alt="#" />
                            </div>
                            <div class="content pt-10">
                                <h5><a href="shop-product-detail.html">Chen Cardigan</a></h5>
                                <p class="price mb-0 mt-5">$99.50</p>
                                <div class="product-rate">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="single-post clearfix">
                            <div class="image">
                                <img src="{{ asset('frontend') }}/assets/imgs/shop/thumbnail-4.jpg" alt="#" />
                            </div>
                            <div class="content pt-10">
                                <h6><a href="shop-product-detail.html">Chen Sweater</a></h6>
                                <p class="price mb-0 mt-5">$89.50</p>
                                <div class="product-rate">
                                    <div class="product-rating" style="width: 80%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="single-post clearfix">
                            <div class="image">
                                <img src="{{ asset('frontend') }}/assets/imgs/shop/thumbnail-5.jpg" alt="#" />
                            </div>
                            <div class="content pt-10">
                                <h6><a href="shop-product-detail.html">Colorful Jacket</a></h6>
                                <p class="price mb-0 mt-5">$25</p>
                                <div class="product-rate">
                                    <div class="product-rating" style="width: 60%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
  