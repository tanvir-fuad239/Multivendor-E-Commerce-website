@extends('frontend.master') 

@section('main-content')
 
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('frontend.home') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Shop
                <span></span> Cart
            </div>
        </div>
    </div>
    <div class="container mb-80 mt-50">
        <div class="row">
            <div class="col-lg-8 mb-40">
                <h1 class="heading-2 mb-10">Your Cart</h1>
                <div class="d-flex justify-content-between">
                    <h6 class="text-body product-count">There {{ $totalProducts == 1 ? 'is' : 'are' }}<span class="text-brand"> {{ $totalProducts }}</span> product{{ $totalProducts == 1 ? '' : 's'}} in your cart</h6>    

                    @if($totalProducts > 0)
                        <h6 class="text-body display-clear-cart"><a href="{{ route('frontend.clear-cart') }}" class="text-muted"><i class="fi-rs-trash mr-5"></i>Clear Cart</a></h6>
                    @endif
                    
                </div>
            </div>
        </div>

        @if($totalProducts > 0)
            <div class="row display-cart-table">
                <div class="col-lg-12">
                    <div class="table-responsive shopping-summery">
                        <table class="table table-wishlist">
                            <thead>
                                <tr class="main-heading">
                                    <th class="custome-checkbox start pl-30">
                                    </th>
                                    <th scope="col" colspan="2">Product</th>
                                    <th scope="col">Unit Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col" class="end">Remove</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($cart as $key=>$item)

                                    <tr class="{{ $key == 0 ?  'pt-30' : ''}}" >
                                        <td class="custome-checkbox pl-30">
                                        </td>
                                        <td class="image product-thumbnail pt-40"><img src="{{ asset('/uploads/product/images/' . $item['image']) }}" alt="#"></td>
                                        <td class="product-des product-name">
                                            <h6 class="mb-5"><a class="product-name mb-10 text-heading" href="shop-product-right.html">{{ $item['name'] }}</a></h6>
                                            <div class="product-rate-cover">
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width:90%">
                                                    </div>
                                                </div>
                                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                                            </div>
                                        </td>
                                        <td class="price" data-title="Price">
                                            <h4 class="text-body">&#2547;{{ $item['price'] }}</h4>
                                        </td>
                                        <td class="text-center detail-info" data-title="Stock">
                                            <div class="detail-extralink mr-15">
                                                <div class="detail-qty border radius">
                                                    <div class="mb-1"><a href="javascript:void(0)" class="product_increase" data-id="{{ $item['id'] }}"><i class="fa-solid fa-angle-up"></i></a></div>

                                                    <span class="text-dark">{{ $item['quantity'] }}</span>
                                         
                                                    <div class="mt-1"><a href="javascript:void(0)" class="product_decrease" data-id="{{ $item['id'] }}"><i class="fa-solid fa-angle-down"></i></a></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="price" data-title="Price">
                                            <h4 class="text-brand">&#2547;{{ $item['price'] * $item['quantity'] }}</h4>
                                        </td>
                                        <td class="action text-center" data-title="Remove"><a href="javascript:void(0)" data-id="{{ $item['id'] }}" class="text-body remove-product"><i class="fi-rs-trash"></i></a></td>
                                    </tr>

                                @endforeach

                            
                            
                            </tbody>
                        </table>
                    </div>
                    

                    <div class="row mt-50">

                            <div class="col-lg-5">
                            <div class="p-40">
                                <h4 class="mb-10">Apply Coupon</h4>
                                <p class="mb-30"><span class="font-lg text-muted">Using A Promo Code?</p>
                                <form action="#">
                                    <div class="d-flex justify-content-between">
                                        <input class="font-medium mr-15 coupon" name="Coupon" placeholder="Enter Your Coupon">
                                        <button class="btn"><i class="fi-rs-label mr-10"></i>Apply</button>
                                    </div>
                                </form>
                            </div>
                        </div>


                        <div class="col-lg-7">
                                <div class="divider-2 mb-30"></div>
                        


                            <div class="border p-md-4 cart-totals ml-30">
                        <div class="table-responsive">
                            <table class="table no-border">
                                <tbody>
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Subtotal</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end" id="sub_total">&#2547;{{ $subTotal }}</h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" colspan="2">
                                            <div class="divider-2 mt-10 mb-10"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Shipping</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h5 class="text-brand text-end">&#2547;{{ $shippingCharge }}</h4</td> </tr> <tr>
                                        <td scope="col" colspan="2">
                                            <div class="divider-2 mt-10 mb-10"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Total</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end" id="total">&#2547;{{ $subTotal + $shippingCharge }}</h4>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <a href="#" class="btn mb-20 w-100">Proceed To CheckOut<i class="fi-rs-sign-out ml-15"></i></a>
                    </div>
                        </div>


                    
                    </div>
                </div>
                    
            </div>

            {{-- it renders through ajax --}}
            <p class="text-center cart-empty-text" style="display: none;">Your cart is empty.</p>
        @else
            <p class="text-center">Your cart is empty.</p>
        @endif
    </div>

@endsection