  {{-- <!-- Preloader Start -->
  <div id="preloader-active">
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
            
                    $.each(response.foodCategories.subcategories, function(key, subcategory){                
                        $.each(subcategory.products, function(key, product){

                            productImage  = window.location.origin + '/uploads/product/images/' + product.product_image;
                            productInfo += `
                                            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                                                    <div class="product-img-action-wrap">
                                                        <div class="product-img product-img-zoom">
                                                            <a href="shop-product-right.html">
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
                                                        <h2><a href="shop-product-right.html">${ product.product_name }</a></h2>
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


</script>

{{-- toastr js --}}
<script>

    @if(Session::has('message'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true,
    }
            toastr.success("{{ session('message') }}");
    @endif


</script> 


</body>

</html>