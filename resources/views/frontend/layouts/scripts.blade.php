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

  {{-- axios cdn  --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.8/axios.min.js" integrity="sha512-PJa3oQSLWRB7wHZ7GQ/g+qyv6r4mbuhmiDb8BjSFZ8NZ2a42oTtAq5n0ucWAwcQDlikAtkub+tPVCw4np27WCg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
    
    // not yet be sloved
    function getAllHeroSliders(){

        $.ajax({

            url: '{{ route('frontend.all-hero-sliders') }}',
            type: 'GET',
            dataType: 'json',
            success: function(response){
                
                if(response.heroSlider != null){

                    let output        = '';
                    let sliderContent = '';
                    $.each(response.heroSlider, function(key,slider){
                        let sliderImage = window.location.origin + slider.image;
                        sliderContent += `
                                        <div class="single-hero-slider single-animation-wrap" style="background-image: url('${ sliderImage }')">
                                            <div class="slider-content">
                                                <h1 class="display-2 mb-40">
                                                    ${ slider.title }
                                                </h1>
                                            </div>
                                        </div>
                                        `
                    });
 
                    $("#slider").append(sliderContent);

         
                }

            },
            error: function(err){
                console.log(err);
            }

        });

    }

    getAllHeroSliders();


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