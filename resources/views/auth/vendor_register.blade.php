@extends('frontend.master')

@section('main-content')

    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('frontend.home') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Become a vendor
                </div>
            </div>
        </div>
        <div class="page-content pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                        <div class="row">
                            <div class="col-lg-6 col-md-8">
                                <div class="login_wrap widget-taber-content background-white">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h1 class="mb-5">Become a vendor</h1>
                                            <p class="mb-30">Already have an account? <a href="{{ route('vendor.login') }}">Login</a></p>
                                        </div>
                                        <form action="{{ route('vendor.store') }}" method="post">

                                            @csrf 
                                            
                                            {{-- name --}}
                                            <div class="form-group">
                                                <input type="text" required="" name="name" placeholder="Full Name" />
                                            </div>

                                            {{-- username --}}
                                            <div class="form-group">
                                                <input type="text" required="" name="username" placeholder="Username" />
                                            </div>

                                            {{-- email --}}
                                            <div class="form-group">
                                                <input type="email" required="" name="email" placeholder="Email" />
                                            </div>

                                            {{-- phone --}}
                                            <div class="form-group">
                                                <input type="text" required="" name="phone" placeholder="Phone Number" />
                                            </div>

                                            {{-- join_date --}}
                                            <div class="form-group">
                                                <select name="vendor_join" id="vendor_join" class="form-control">

                                                    <option value=""> --join date-- </option>
                                                    <option value="2024">2024</option>
                                                    <option value="2023">2023</option>
                                                    <option value="2022">2022</option>
                                                    <option value="2021">2021</option>

                                                </select>
                                            </div>

                                            {{-- password --}}
                                            <div class="form-group">
                                                <input required="" type="password" name="password" placeholder="Password" />
                                            </div> 

                                            {{-- confrim password  --}}
                                            <div class="form-group">
                                                <input required="" type="password" name="confirm_password" placeholder="Confirm Password" />
                                            </div>
                                           
                                
                                            <div class="login_footer form-group mb-50">
                                                <div class="chek-form">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox12" value="" />
                                                        <label class="form-check-label" for="exampleCheckbox12"><span>I agree to terms &amp; Policy.</span></label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mb-30">
                                                <button type="submit" class="btn btn-fill-out btn-block hover-up font-weight-bold" name="login">Register</button>
                                            </div>

                                            <p class="font-xs text-muted"><strong>Note:</strong>Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our privacy policy</p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 pr-30 d-none d-lg-block">
                                <div class="card-login mt-115">
                                    <a href="#" class="social-login facebook-login">
                                        <img src="{{ asset('frontend') }}/assets/imgs/theme/icons/logo-facebook.svg" alt="" />
                                        <span>Continue with Facebook</span>
                                    </a>
                                    <a href="#" class="social-login google-login">
                                        <img src="{{ asset('frontend') }}/assets/imgs/theme/icons/logo-google.svg" alt="" />
                                        <span>Continue with Google</span>
                                    </a>
                                    <a href="#" class="social-login apple-login">
                                        <img src="{{ asset('frontend') }}/assets/imgs/theme/icons/logo-apple.svg" alt="" />
                                        <span>Continue with Apple</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection