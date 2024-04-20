<section class="home-slider position-relative mb-30">
    <div class="container">
        <div class="home-slide-cover mt-30">
            <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">

                @foreach ($heroSliders as $heroSlider )
                    <div class="single-hero-slider single-animation-wrap" style="background-image: url({{ asset($heroSlider->image) }})">
                        <div class="slider-content">
                            <h1 class="display-6 mb-40">

                                @php
                                    $firstPart = substr($heroSlider->title, 0, 20);
                                    $remainingPart = substr($heroSlider->title, 20);
                                @endphp

                                {{ $firstPart }}<br>{{ $remainingPart }}
                            </h1>
                            <p class="mb-65">Save up to 50% off on your first order</p>
                            <form class="form-subcriber d-flex">
                                <input type="email" placeholder="Your emaill address" />
                                <button class="btn" type="submit">Subscribe</button>
                            </form>
                        </div>
                    </div>
                @endforeach
 
                
            </div>
            <div class="slider-arrow hero-slider-1-arrow"></div>
        </div>
    </div>
</section>
 

 