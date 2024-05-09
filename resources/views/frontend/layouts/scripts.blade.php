  <!-- Preloader Start -->
  {{-- <div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
            <div class="text-center">
                <img src="{{ asset('frontend') }}/assets/imgs/theme/loading.gif" alt="" />
            </div>
        </div>
    </div>
</div> --}}
<!-- Vendor JS-->
  <script src="{{ asset('frontend') }}/assets/js/vendor/modernizr-3.6.0.min.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/vendor/jquery-3.6.0.min.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/vendor/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/plugins/slick.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/plugins/jquery.syotimer.min.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/plugins/waypoints.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/plugins/wow.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/plugins/perfect-scrollbar.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/plugins/magnific-popup.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/plugins/select2.min.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/plugins/counterup.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/plugins/jquery.countdown.min.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/plugins/images-loaded.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/plugins/isotope.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/plugins/scrollup.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/plugins/jquery.vticker-min.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/plugins/jquery.theia.sticky.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/plugins/jquery.elevatezoom.js"></script>
  <!-- Template  JS -->
  <script src="{{ asset('frontend') }}/assets/js/main.js?v=5.3"></script>
  <script src="{{ asset('frontend') }}/assets/js/shop.js?v=5.3"></script>
  {{-- jquery cdn --}}
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    
  {{-- fontawesome cdn  --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 

  <script>

    $(document).ready(function(){
        
        $("#photo").change(function(e){
            let reader = new FileReader();
            reader.onload = function(e){
                $("#selected_photo").attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
 
    function getAllCategories(){

        $.ajax({

            url: '{{ route('frontend.all-categories') }}',
            type: 'GET',
            dataType: 'json', 
            success: function(response){
                
                if(response != null){
                    
                    if(response.total > 0){

                        let leftCategories  =   '';
                        let rightCategories =   ''
                        let imagesPath      =   "{{ asset('uploads/category/images') }}/";
                        let categoryList    =   '';
                        var baseUrl         =   '{{ route('frontend.product.all', ['category_id' => 'NULL']) }}'
                        
                        $.each(response.left, function(key, value){

                            let url         = baseUrl.replace('NULL', value.id);
                            leftCategories += ` <li>
                                                    <a href="${ url }"><img src="${ imagesPath + value.category_image }" alt="" />${ value.category_name }</a>
                                                </li>`;
                        });

                        $.each(response.right, function(key, value){

                            let url          = baseUrl.replace('NULL', value.id);
                            rightCategories += ` <li>
                                                    <a href="${ url }"><img src="${ imagesPath + value.category_image }" alt="" />${ value.category_name }</a>
                                                </li>`;

                        });

                        categoryList += `
                                        <ul>
                                            ${ leftCategories }
                                        </ul>
                                        <ul class="end">
                                            ${ rightCategories }
                                        </ul>
                                        `;

                        $("#categoryList").append(categoryList);
                    }

                    else{
                        
                        $("#categoryList").append(`<p class="text-center text-dark">No Category Available.</p>`);

                    }

                    if(response.total > 10){

                        let showMoreButton = '';
                        const url        = '{{ route('frontend.category.all') }}';

                        showMoreButton += `<div class="more_categories"><a href="${ url }"><span class="heading-sm-1">Show more...</span></a></div>`

                        $("#showMoreButton").append(showMoreButton);

                    }

                }

          

            },
            error: function(err){
                console.log(err);
            }

        });

    }

    getAllCategories();
    
    
    function getBanners(){

        $.ajax({

            url: '{{ route('frontend.all-banners') }}',
            type: 'GET',
            dataType: 'json',
            success: function(response){
                
                if(response.banner != null){

                    let bannerContent = '';
                    $.each(response.banner, function(key,banner){

                        let bannerImage = window.location.origin + banner.image;
                        bannerContent +=    `
                                                <div class=" ${ key == 2 ? 'col-lg-4 d-md-none d-lg-flex' : 'col-lg-4 col-md-6' }">
                                                    <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay="0">
                                                        <img src="${ bannerImage }" alt="" />
                                                        <div class="banner-text">
                                                            <h4>
                                                                ${ banner.title }
                                                            </h4>
                                                            <a href="${ banner.url }" class="btn btn-xs" target="_blank">Explore<i class="fi-rs-arrow-small-right"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            `
                    });

                    $("#bannerContent").append(bannerContent);

                }
            },
            error: function(err){
                console.log(err);
            }

        });

    }

    getBanners()

    function getFoodCategories(){

        $.ajax({

            url: '{{ route('frontend.food-categories') }}',
            type: 'GET',
            dataType: 'json',
            success: function(response){
                
                if(response.foodCategories != null){
                    
                    let productInfo = '';
                    let productImage = '';
                    let badge = ['hot','sale','new','premium','-14%'];
                    let badgeKey = 0;
                    let ProductBaseUrl         =   '{{ route('frontend.product-details', ['product_id' => 'NULL']) }}';
 
                    $.each(response.foodCategories.subcategories, function(key, subcategory){                
                        $.each(subcategory.products, function(key, product){

                            let ProductUrl = ProductBaseUrl.replace('NULL', product.id);
                            productImage  = window.location.origin + '/uploads/product/images/' + product.product_image;
                            productInfo += `
                                            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                                                    <div class="product-img-action-wrap">
                                                        <div class="product-img product-img-zoom">
                                                            <a href="${ ProductUrl }">
                                                                <img class="default-img" src="${ productImage }" alt="${ productImage }"/>
                                                            </a>
                                                        </div>
                                                        <div class="product-action-1">
                                                            <a aria-label="Add To Wishlist" class="action-btn" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                                            <a aria-label="Compare" class="action-btn" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                                            <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                                        </div>
                                                        <div class="product-badges product-badges-position product-badges-mrg">
                                                            <span class="hot">${ badge[badgeKey] }</span>
                                                        </div>
                                                    </div>
                                                    <div class="product-content-wrap">
                                                        <div class="product-category">
                                                            ${ subcategory.subcategory_name }
                                                        </div>
                                                        <h2><a href="${ ProductUrl }">${ product.product_name }</a></h2>
                                                        <div class="product-rate-cover">
                                                            <div class="product-rate d-inline-block">
                                                                <div class="product-rating" style="width: 90%"></div>
                                                            </div>
                                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                                        </div>
                                                        <div>
                                                            <span class="font-small text-muted">By <a href="vendor-details-1.html">${product.user.name.length > 20 ? product.user.name.substring(0, 20) + '...' : product.user.name}</a></span>
                                                        </div>
                                                        <div class="product-card-bottom">
                                                            <div class="product-price">
                                                                <span>&#2547;${ product.discount_price }</span>
                                                                <span class="old-price">&#2547;${ product.product_price }</span>
                                                            </div>
                                                            <div class="add-cart">
                                                                <a class="add" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            `
                           badgeKey++;            
                        });
                    });
                    
                    $("#food").append(productInfo);

                }
            },
            error: function(err){
                console.log(err);
            }

        });

    }

    getFoodCategories();

    function getAllHotProducts(){

        $.ajax({

            url: '{{ route('frontend.hot-products') }}',
            type: 'GET',
            dataType: 'json',
            success: function(result){
                
                if(result != null){

                    let ProductBaseUrl         =   '{{ route('frontend.product-details', ['product_id' => 'NULL']) }}';

                    if(result.hot_deals){

                        let hotDeals       = '';
                        let hotDealsImage  = '';
                     
                        $.each(result.hot_deals, function(key,hot){

                            hotDealsImage   =  window.location.origin + '/uploads/product/images/' + hot.product_image;

                            let ProductUrl = ProductBaseUrl.replace('NULL', hot.id);

                            hotDeals += `
                                     <article class="row align-items-center hover-up">
                                        <figure class="col-md-4 mb-0">
                                            <a href="${ ProductUrl }"><img src="${ hotDealsImage }" alt="" /></a>
                                        </figure>
                                        <div class="col-md-8 mb-0">
                                            <h6>
                                                <a href="${ ProductUrl }">${ hot.product_name }</a>
                                            </h6>
                                            <div class="product-rate-cover">
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width: 90%"></div>
                                                </div>
                                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                                            </div>
                                            <div class="product-price">
                                                <span>&#2547;${ hot.discount_price }</span>
                                                <span class="old-price">&#2547;${ hot.product_price }</span>
                                            </div>
                                        </div>
                                    </article>
                                        `

                        });

                        $("#hotDeals").append(hotDeals);
                    }

                    if(result.special_offer){

                        let specialOffers      = '';
                        let specialOfferImage  = '';


                        $.each(result.special_offer, function(key,specialOffer){

                            specialOfferImage   =  window.location.origin + '/uploads/product/images/' + specialOffer.product_image;
                            let ProductUrl = ProductBaseUrl.replace('NULL', specialOffer.id);

                            specialOffers += `
                                    <article class="row align-items-center hover-up">
                                        <figure class="col-md-4 mb-0">
                                            <a href="${ ProductUrl }"><img src="${ specialOfferImage }" alt="" /></a>
                                        </figure>
                                        <div class="col-md-8 mb-0">
                                            <h6>
                                                <a href="${ ProductUrl }">${ specialOffer.product_name }</a>
                                            </h6>
                                            <div class="product-rate-cover">
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width: 90%"></div>
                                                </div>
                                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                                            </div>
                                            <div class="product-price">
                                                <span>&#2547;${ specialOffer.discount_price }</span>
                                                <span class="old-price">&#2547;${ specialOffer.product_price }</span>
                                            </div>
                                        </div>
                                    </article>
                                        `

                        });

                        $("#specialOffer").append(specialOffers);
                    }

                    if(result.featured){

                        let featuredProducts      = '';
                        let featuredProductImage  = '';


                        $.each(result.featured, function(key,featuredProduct){

                            featuredProductImage   =  window.location.origin + '/uploads/product/images/' + featuredProduct.product_image;
                            let ProductUrl = ProductBaseUrl.replace('NULL', featuredProduct.id);


                            featuredProducts += `
                                    <article class="row align-items-center hover-up">
                                        <figure class="col-md-4 mb-0">
                                            <a href="${ ProductUrl }"><img src="${ featuredProductImage }" alt="" /></a>
                                        </figure>
                                        <div class="col-md-8 mb-0">
                                            <h6>
                                                <a href="${ ProductUrl }">${ featuredProduct.product_name }</a>
                                            </h6>
                                            <div class="product-rate-cover">
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width: 90%"></div>
                                                </div>
                                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                                            </div>
                                            <div class="product-price">
                                                <span>&#2547;${ featuredProduct.discount_price }</span>
                                                <span class="old-price">&#2547;${ featuredProduct.product_price }</span>
                                            </div>
                                        </div>
                                    </article>
                                        `

                        });

                        $("#featuredProduct").append(featuredProducts);
                    }

                    if(result.special_deals){

                        let specialDeals      = '';
                        let specialDealImage  = '';


                        $.each(result.special_deals, function(key,specialDeal){

                            specialDealImage   =  window.location.origin + '/uploads/product/images/' + specialDeal.product_image;
                            let ProductUrl = ProductBaseUrl.replace('NULL', specialDeal.id);

                            specialDeals += `
                                    <article class="row align-items-center hover-up">
                                        <figure class="col-md-4 mb-0">
                                            <a href="${ ProductUrl }"><img src="${ specialDealImage }" alt="" /></a>
                                        </figure>
                                        <div class="col-md-8 mb-0">
                                            <h6>
                                                <a href="${ ProductUrl }">${ specialDeal.product_name }</a>
                                            </h6>
                                            <div class="product-rate-cover">
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width: 90%"></div>
                                                </div>
                                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                                            </div>
                                            <div class="product-price">
                                                <span>&#2547;${ specialDeal.discount_price }</span>
                                                <span class="old-price">&#2547;${ specialDeal.product_price }</span>
                                            </div>
                                        </div>
                                    </article>
                                        `

                        });

                        $("#specialDeals").append(specialDeals);
                    }

                }
               

            },
            error: function(err){
                console.log(err);
            }


        });

    }

    getAllHotProducts();

    function displayCategoriesWithProducts(){

        $.ajax({

            url: '{{ route('frontend.display-categories') }}',
            type: 'GET',
            dataType: 'json',
            success: function(response){

                if(response.categoriesWithProducts != null){

                    let categoryList  = '';
                    let tab_pane      = '';
                    let finalOutput   = '';
                    var categoryBaseUrl         =   '{{ route('frontend.product.all', ['category_id' => 'NULL']) }}';
                    let ProductBaseUrl         =   '{{ route('frontend.product-details', ['product_id' => 'NULL']) }}';
                    
                    $.each(response.categoriesWithProducts, function(key,category){

                        categoryList += `   <li class="nav-item" role="presentation">
                                                <button class="nav-link ${ key == 0 ? 'active' : '' }" id="nav-tab-${ key + 1 }" data-bs-toggle="tab" data-bs-target="#category-${ key + 1 }" type="button" role="tab" aria-controls="category-${ key + 1 }" aria-selected="${ key == 0 ? 'true' : 'false' }">${ category.category_name }</button>
                                            </li>
                                        `
                        
                        let productList  = '';
                        let productImage = '';
                        let categoryUrl          = categoryBaseUrl.replace('NULL', category.id);
                        $.each(category.products, function(key,product){

                         
                            let ProductUrl = ProductBaseUrl.replace('NULL', product.id);
                            productImage   =  window.location.origin + '/uploads/product/images/' + product.product_image;
                            productList += `
                                            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                                                    <div class="product-img-action-wrap">
                                                        <div class="product-img product-img-zoom">
                                                            <a href="${ ProductUrl }">
                                                                <img class="default-img" src="${ productImage }" alt="${ productImage }" />
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
                                                            <a href="${ categoryUrl }">${ category.category_name }</a>
                                                        </div>
                                                        <h2><a href="${ ProductUrl }">${ product.product_name }</a></h2>
                                                        <div class="product-rate-cover">
                                                            <div class="product-rate d-inline-block">
                                                                <div class="product-rating" style="width: 90%"></div>
                                                            </div>
                                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                                        </div>
                                                        <div>
                                                            <span class="font-small text-muted">By <a href="vendor-details-1.html">${product.user.name.length > 20 ? product.user.name.substring(0, 20) + '...' : product.user.name}</a></span>
                                                            
                                                        </div>
                                                        <div class="product-card-bottom">
                                                            <div class="product-price">
                                                                <span>&#2547;${ product.discount_price }</span>
                                                                <p><span class="old-price">&#2547;${ product.product_price }</span></p>
                                                                
                                                            </div>
                                                            <div class="add-cart">
                                                                <a class="add add_to_cart" href="javascript:void(0) data-id="${product.id}"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end product card-->
                                            `

                        });

                        tab_pane += `
                                    <div class="tab-pane fade ${ key == 0 ? 'show active' : '' }" id="category-${ key + 1 }" role="tabpanel" aria-labelledby="category-${ key + 1 }">
                                        <div class="row product-grid-4">
                                            
                                            ${ productList }
                                         
                                        </div>
                                        
                                    </div>
                                    `

                    });
                    
                    finalOutput += `   <div class="section-title style-2 wow animate__animated              animate__fadeIn">
                                            <h3> New Products </h3>
                                            <ul class="nav nav-tabs links" id="myTab" role="tablist">
                                                ${ categoryList }
                                            </ul>
                                        </div>

                                        <div class="tab-content" id="myTabContent">
                                            ${ tab_pane }
                                        </div>
                                    `
              
                    $("#productTabs").append(finalOutput);
                }

            },
            error: function(err){
                console.log(err);
            }


        });

    }

    displayCategoriesWithProducts();

    function relatedProduct(){
         
        var product_id =  document.getElementById('related-products').getAttribute('data-product-id');
        var category_id = document.getElementById('related-products').getAttribute('data-category-id');

        $.ajax({

            url : '/related-product/' + product_id + '/' + category_id,
            type: 'GET',
            dataType: 'json',
            success: function(response){
                
                if(response.relatedProducts != null){

                    let productRelated      = '';
                    let productImage = '';
                    let relatedProductBaseUrl         =   '{{ route('frontend.product-details', ['product_id' => 'NULL']) }}';

                    if(response.relatedProducts.products.length  == 0){
                        productRelated += '<p>No Product Available.</p>'
                    }

                    else{

                        $.each(response.relatedProducts.products, function(key,product){

                            productImage          = window.location.origin + '/uploads/product/images/' + product.product_image; 
                            let relatedProductUrl = relatedProductBaseUrl.replace('NULL', product.id);
                            productRelated += `
                                        <div class="col-lg-3 col-md-4 col-12 col-sm-6 ${ key == 3 ? 'd-lg-block d-none' : '' }">
                                            <div class="product-cart-wrap hover-up">
                                                <div class="product-img-action-wrap">
                                                    <div class="product-img product-img-zoom">
                                                        <a href="${ relatedProductUrl }" tabindex="0">
                                                            <img class="default-img" src="${ productImage }" alt="${ productImage }" />
                                                        </a>
                                                    </div>
                                                    <div class="product-action-1">
                                                        <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-search"></i></a>
                                                        <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="shop-wishlist.html" tabindex="0"><i class="fi-rs-heart"></i></a>
                                                        <a aria-label="Compare" class="action-btn small hover-up" href="shop-compare.html" tabindex="0"><i class="fi-rs-shuffle"></i></a>
                                                    </div>
                                                    <div class="product-badges product-badges-position product-badges-mrg">
                                                        <span class="hot">Hot</span>
                                                    </div>
                                                </div>
                                                <div class="product-content-wrap">
                                                    <h2><a href="${ relatedProductUrl }" tabindex="0">${ product.product_name }</a></h2>
                                                    <div class="rating-result" title="90%">
                                                        <span> </span>
                                                    </div>
                                                    <div class="product-price">
                                                        <span>&#2547;${ product.discount_price }</span>
                                                        <span class="old-price">&#2547;${ product.product_price }</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        `

                        });
                    }

                    $("#related-products").append(productRelated);

                } 
            },
            error: function(err){
                console.log(err);
            }

        });
    }

    relatedProduct();

</script>

<script>

    document.addEventListener('DOMContentLoaded', function(){

        $(".add_to_cart").on('click', function(){
            let productId = $(this).data('id');
            
            $.ajax({

                url: '{{ url("/add-to-cart") }}/' + productId,
                type: 'GET',
                dataType: 'json',
                success: function(response){
                    
                    $('#count').text(response.count);

                    toastr.options =
                    {
                        closeButton : true,
                        progressBar : true,
                        positionClass: 'toast-top-right', 
                        timeOut: 3000 
                    }
                    toastr.success(response.success);


                },
                error: function(err){
                    toastr.options =
                    {
                        closeButton : true,
                        progressBar : true,
                        positionClass: 'toast-top-right', 
                        timeOut: 3000 
                    }
                    toastr.error(response.error);
                }

            });
        });

        $('.remove-product').on('click', function(){

            let productId = $(this).data('id');
            
            $.ajax({

                url: '{{ url("/remove-product") }}/' + productId,
                type: 'GET',
                dataType: 'json',
                success: function(response){

                    $('a[data-id="' + productId + '"]').closest('tr').remove();
                    $('#count').text(response.count);
                    $('#sub_total').text('৳' + response.subTotal);
                    $("#total").text('৳' + response.total);

                    if(response.count == 1){
                        $(".product-count").html('There is <span class="text-brand">' + response.count + '</span> product in your cart')
                    }
                    else{
                        $(".product-count").html('There are <span class="text-brand">' + response.count + '</span> products in your cart')
                    }                  

                    if(response.count > 0){
                        $(".display-clear-cart").show();
                        $(".display-cart-table").show();
                        $(".cart-empty-text").hide();
                    }
                    else{
                        $(".display-clear-cart").hide();
                        $(".display-cart-table").hide();
                        $(".cart-empty-text").show();
                    }
                    
                    toastr.options =
                    {
                        closeButton : true,
                        progressBar : true,
                        positionClass: 'toast-top-right', 
                        timeOut: 3000 
                    }
                    toastr.success(response.success);


                },
                error: function(err){
                    toastr.options =
                    {
                        closeButton : true,
                        progressBar : true,
                        positionClass: 'toast-top-right', 
                        timeOut: 3000 
                    }
                    toastr.error("Product couldn't be deleted. Please try again later.");
                }

            });

        })

        $('.product_increase').on('click', function(){

            let productId = $(this).data('id');
            
            $.ajax({

                url: '{{ url("/product-increase") }}/' + productId,
                type: 'GET',
                dataType: 'json',
                success: function(response){

                },
                error: function(err){
                    console.log(err);
                }

            });

        })

        $('.product_decrease').on('click', function(){

            let productId = $(this).data('id');
            alert(productId)

        })

    });

</script>

{{-- toastr js --}}
<script>

    @if(Session::has('message'))
        toastr.options =
        {
            closeButton : true,
            progressBar : true,
            positionClass: 'toast-top-right', 
            timeOut: 3000 
        }
        toastr.success("{{ session('message') }}");
    @endif
    
    @if (Session::has('error'))
        toastr.options =
        {
            closeButton : true,
            progressBar : true,
            positionClass: 'toast-top-right', 
            timeOut: 3000 
        }
        toastr.success("{{ session('error') }}");
    @endif

</script> 




</body>

</html>