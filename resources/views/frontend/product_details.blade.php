@extends('frontend.master')

@section('main-content')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('frontend.home') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                     <span></span>{{ $product->product_name }}
                </div>
            </div>
        </div>
        <div class="container mb-30">
            <div class="row">
                <div class="col-xl-10 col-lg-12 m-auto">
                    <div class="product-detail accordion-detail">
                        <div class="row mb-50 mt-30">
                            <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                                <div class="detail-gallery">
                                    {{-- <span class="zoom-icon"><i class="fi-rs-search"></i></span> --}}
                                    @php
                                        $images = $product->multi_imgs;
                                        $count = count($images);
                                    @endphp
                                    <!-- MAIN SLIDES -->
                                    <div class="product-image-slider">
                                     
                                        @for ($i = 0; $i <= $count; $i++)  
                                            @if ($i == 0)
                                                <figure class="border-radius-10">
                                                    <img src="{{ asset('uploads/product/images/' . $product->product_image) }}" alt="product image" height="600px" width="500px" class="img-fluid"/>
                                                </figure>
                                            @else
                                                <figure class="border-radius-10">
                                                    <img src="{{ asset('uploads/multi_imgs/images/' . $images[$i-1]->multi_image) }}" alt="product image" height="600px" width="500px" class="img-fluid"/>
                                                </figure>
                                            @endif
                                        @endfor
                                  
                           
                                    </div>
                                    <!-- THUMBNAILS -->
                                    <div class="slider-nav-thumbnails">
                                      
                                        @for ($i = 0; $i <= $count; $i++)  
                                            @if ($i == 0)
                                                <div><img src="{{ asset('uploads/product/images/' . $product->product_image) }}" alt="product image" height="100px" width="100px" /></div>
                                            @else
                                                <div><img src="{{ asset('uploads/multi_imgs/images/' . $images[$i-1]->multi_image) }}" alt="product image" height="100px" width="100px" /></div>
                                            @endif
                                        @endfor
                      
                                    </div>
                                </div>
                                <!-- End Gallery -->
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="detail-info pr-30 pl-30">

                                    @if($product->product_quantity > 0)
                                        <span class="stock-status in-stock">In Stock</span>
                                    @else
                                        <span class="stock-status out-stock">Out of Stock</span>
                                    @endif

                                    <h2 class="title-detail">{{ $product->product_name }}</h2>
                                    {{-- <div class="product-detail-rating">
                                        <div class="product-rate-cover text-end">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                        </div>
                                    </div> --}}
                                    <div class="clearfix product-price-cover">
                                        <div class="product-price primary-color float-left">
                                            <span class="current-price text-brand">&#2547;{{ $product->discount_price }}</span>
                                            <span>
                                                {{-- <span class="save-price font-md color3 ml-15">26% Off</span> --}}
                                                <span class="old-price font-md ml-15">&#2547;{{ $product->product_price }}</span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="short-desc mb-30">
                                        <p class="font-lg">{{ $product->short_description }}</p>
                                    </div>
                                    <div class="attr-detail attr-size mb-30">
                                        <strong class="mr-10">Size: </strong>
                                        <ul class="list-filter size-filter font-small">
                                            @foreach ($product->sizes as $size)
                                                <li><a href="javascript:void(0)">{{ $size->product_size }}</a></li>
                                            @endforeach
                                       
                                        </ul>
                                    </div>
                                    <div class="detail-extralink mb-50">
                                        <div class="product-extra-link2">
                                            <button type="submit" class="button button-add-to-cart"><i class="fi-rs-shopping-cart"></i>Add to cart</button>
                                            <a aria-label="Add To Wishlist" class="action-btn hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                        </div>
                                    </div>
                                    <div class="font-xs">
                                        <ul class="mr-50 float-start">
                                            <li class="mb-5">Type: <span class="text-brand">{{ $product->subcategory->subcategory_name }}</span></li>
                                            <li class="mb-5">MFG:<span class="text-brand"> Jun 4.2024</span></li>
                                            <li>LIFE: <span class="text-brand">70 days</span></li>
                                        </ul>
                                        <ul class="float-start">
                                            <li class="mb-5">SKU:  <span class="text-brand">{{ $product->product_code }}</span></li>

                                            <li class="mb-5">Tags: <span class="text-brand">{{ implode(',' , $product->tags()->pluck('product_tag')->toArray()) }}</span></li>

                                            @if($product->product_quantity == 1)
                                                <li>Stock:<span class="in-stock text-brand ml-5">{{ $product->product_quantity }} Item In Stock</span></li>
                                            @elseif ($product->product_quantity < 1)
                                                <li>Stock:<span class="stock-status out-stock ml-5">Product is out of stock</span></li>
                                            @else
                                                <li>Stock:<span class="in-stock text-brand ml-5">{{ $product->product_quantity }} Items In Stock</span></li>
                                            @endif
                                         
                                        </ul>
                                    </div>
                                </div>
                                <!-- Detail Info -->
                            </div>
                        </div>
                        <div class="product-info">
                            <div class="tab-style3">
                                <ul class="nav nav-tabs text-uppercase">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Description</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab" href="#Additional-info">Additional info</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="Vendor-info-tab" data-bs-toggle="tab" href="#Vendor-info">Vendor</a>
                                    </li>
                                    
                                </ul>
                                <div class="tab-content shop_info_tab entry-main-content">
                                    <div class="tab-pane fade show active" id="Description">
                                        <div class="">
                                            <p>{{ $product->long_description }}</p>
                                            <h4 class="mt-30">Packaging & Delivery</h4>
                                            <hr class="wp-block-separator is-style-wide" />
                                            <p>Less lion goodness that euphemistically robin expeditiously bluebird smugly scratched far while thus cackled sheepishly rigid after due one assenting regarding censorious while occasional or this more crane went more as this less much amid overhung anathematic because much held one exuberantly sheep goodness so where rat wry well concomitantly.</p>
                                            <p>Scallop or far crud plain remarkably far by thus far iguana lewd precociously and and less rattlesnake contrary caustic wow this near alas and next and pled the yikes articulate about as less cackled dalmatian in much less well jeering for the thanks blindly sentimental whimpered less across objectively fanciful grimaced wildly some wow and rose jeepers outgrew lugubrious luridly irrationally attractively dachshund.</p>
                                            <h4 class="mt-30">Suggested Use</h4>
                                            <ul class="product-more-infor mt-30">
                                                <li>Refrigeration not necessary.</li>
                                                <li>Stir before serving</li>
                                            </ul>
                                            <h4 class="mt-30">Other Ingredients</h4>
                                            <ul class="product-more-infor mt-30">
                                                <li>Organic raw pecans, organic raw cashews.</li>
                                                <li>This butter was produced using a LTG (Low Temperature Grinding) process</li>
                                                <li>Made in machinery that processes tree nuts but does not process peanuts, gluten, dairy or soy</li>
                                            </ul>
                                            <h4 class="mt-30">Warnings</h4>
                                            <ul class="product-more-infor mt-30">
                                                <li>Oil separation occurs naturally. May contain pieces of shell.</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="Additional-info">
                                        <table class="font-md">
                                            <tbody>
                                                <tr class="stand-up">
                                                    <th>Stand Up</th>
                                                    <td>
                                                        <p>35″L x 24″W x 37-45″H(front to back wheel)</p>
                                                    </td>
                                                </tr>
                                                <tr class="folded-wo-wheels">
                                                    <th>Folded (w/o wheels)</th>
                                                    <td>
                                                        <p>32.5″L x 18.5″W x 16.5″H</p>
                                                    </td>
                                                </tr>
                                                <tr class="folded-w-wheels">
                                                    <th>Folded (w/ wheels)</th>
                                                    <td>
                                                        <p>32.5″L x 24″W x 18.5″H</p>
                                                    </td>
                                                </tr>
                                                <tr class="door-pass-through">
                                                    <th>Door Pass Through</th>
                                                    <td>
                                                        <p>24</p>
                                                    </td>
                                                </tr>
                                                <tr class="frame">
                                                    <th>Frame</th>
                                                    <td>
                                                        <p>Aluminum</p>
                                                    </td>
                                                </tr>
                                                <tr class="weight-wo-wheels">
                                                    <th>Weight (w/o wheels)</th>
                                                    <td>
                                                        <p>20 LBS</p>
                                                    </td>
                                                </tr>
                                                <tr class="weight-capacity">
                                                    <th>Weight Capacity</th>
                                                    <td>
                                                        <p>60 LBS</p>
                                                    </td>
                                                </tr>
                                                <tr class="width">
                                                    <th>Width</th>
                                                    <td>
                                                        <p>24″</p>
                                                    </td>
                                                </tr>
                                                <tr class="handle-height-ground-to-handle">
                                                    <th>Handle height (ground to handle)</th>
                                                    <td>
                                                        <p>37-45″</p>
                                                    </td>
                                                </tr>
                                                <tr class="wheels">
                                                    <th>Wheels</th>
                                                    <td>
                                                        <p>12″ air / wide track slick tread</p>
                                                    </td>
                                                </tr>
                                                <tr class="seat-back-height">
                                                    <th>Seat back height</th>
                                                    <td>
                                                        <p>21.5″</p>
                                                    </td>
                                                </tr>
                                                <tr class="head-room-inside-canopy">
                                                    <th>Head room (inside canopy)</th>
                                                    <td>
                                                        <p>25″</p>
                                                    </td>
                                                </tr>
                                                <tr class="pa_color">
                                                    <th>Color</th>
                                                    <td>
                                                        <p>Black, Blue, Red, White</p>
                                                    </td>
                                                </tr>
                                                <tr class="pa_size">
                                                    <th>Size</th>
                                                    <td>
                                                        <p>M, S</p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="Vendor-info">
                                        <div class="vendor-logo d-flex mb-30">
                                            <img src="{{ $product->user->photo }}" alt="" />
                                            <div class="vendor-name ml-15">
                                                <h6>
                                                    <a href="vendor-details-2.html">{{ $product->user->name }}</a>
                                                </h6>
                                                <div class="product-rate-cover text-end">
                                                    <div class="product-rate d-inline-block">
                                                        <div class="product-rating" style="width: 90%"></div>
                                                    </div>
                                                    <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="contact-infor mb-50">
                                            <li><img src="{{ asset('frontend') }}/assets/imgs/theme/icons/icon-location.svg" alt="" /><strong>Address: </strong> <span>{{ $product->user->address }}</span></li>
                                            <li><img src="{{ asset('frontend') }}/assets/imgs/theme/icons/icon-contact.svg" alt="" /><strong>Contact Seller:</strong><span>{{ $product->user->phone }}</span></li>
                                        </ul>
                                        <div class="d-flex mb-55">
                                            <div class="mr-30">
                                                <p class="text-brand font-xs">Rating</p>
                                                <h4 class="mb-0">92%</h4>
                                            </div>
                                            <div class="mr-30">
                                                <p class="text-brand font-xs">Ship on time</p>
                                                <h4 class="mb-0">100%</h4>
                                            </div>
                                            <div>
                                                <p class="text-brand font-xs">Chat response</p>
                                                <h4 class="mb-0">89%</h4>
                                            </div>
                                        </div>
                                        <p>Noodles & Company is an American fast-casual restaurant that offers international and American noodle dishes and pasta in addition to soups and salads. Noodles & Company was founded in 1995 by Aaron Kennedy and is headquartered in Broomfield, Colorado. The company went public in 2013 and recorded a $457 million revenue in 2017.In late 2018, there were 460 Noodles & Company locations across 29 states and Washington, D.C.</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row mt-60">
                            <div class="col-12">
                                <h2 class="section-title style-1 mb-30">Related products</h2>
                            </div>
                            <div class="col-12">
                                <div class="row related-products" id="related-products"  data-product-id="{{ $product->id }}" data-category-id="{{ $product->category->id }}">
                                    
                                    {{-- dynamic product here --}}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
  
@endsection