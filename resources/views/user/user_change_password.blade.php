@extends('frontend.master')

@section('main-content')

    <div class="page-content my-5">
        <div class="container">
            <div class="row">
                <div class="col-xl-10 col-lg-10 col-md-8 offset-3">
                    <div class="row">
                        <div class="heading_s1 mt-5">
                            <img class="border-radius-15" src="{{ asset('frontend') }}/assets/imgs/page/reset_password.svg" alt="" />
                            <h2 class="mb-15 mt-15">Set new password</h2>
                            <p class="mb-30">Please create a new password that you don’t use on any other site.</p>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div class="login_wrap widget-taber-content background-white">
                                <div class="padding_eight_all bg-white"> 

                        <form action="{{ route('user.password.update') }}" method="post">

                            @csrf 

                            @if (session('success'))

                                <div class="alert border-0 border-start border-5 border-success alert-dismissible fade show py-2 shadow-lg">
                                    <div class="d-flex align-items-center">
                                        <div class="font-35 text-success"><i class='bx bxs-check-circle'></i>
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="mb-0 text-success">Success Alert</h6>
                                            <div>{{ session('success') }}</div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                
                            @elseif (session('error1'))
                                
                                <div class="alert border-0 border-start border-5 border-danger alert-dismissible fade show py-2 shadow-lg shadow-lg">
                                    <div class="d-flex align-items-center">
                                        <div class="font-35 text-danger"><i class='bx bxs-check-circle'></i>
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="mb-0 text-danger">Danger Alert</h6>
                                            <div>{{ session('error1') }}</div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>

                            @elseif (session('error2'))

                                <div class="alert border-0 border-start border-5 border-danger alert-dismissible fade show py-2 shadow-lg">
                                    <div class="d-flex align-items-center">
                                        <div class="font-35 text-danger"><i class='bx bxs-check-circle'></i>
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="mb-0 text-danger">Danger Alert</h6>
                                            <div>{{ session('error2') }}</div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>

                            @elseif (session('error3'))

                                <div class="alert border-0 border-start border-5 border-danger alert-dismissible fade show py-2 shadow-lg">
                                    <div class="d-flex align-items-center">
                                        <div class="font-35 text-danger"><i class='bx bxs-check-circle'></i>
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="mb-0 text-danger">Danger Alert</h6>
                                            <div>{{ session('error3') }}</div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>

                            @endif

                            {{-- old password  --}}
                            <div class="form-group">
                                <input type="password"  name="old_password" placeholder="Old Password" />
                            </div>

                            {{-- new password  --}}
                            <div class="form-group">
                                <input type="password"   name="new_password" placeholder="New Password" />
                            </div>

                            {{-- confirm password  --}}
                            <div class="form-group">
                                <input type="password" name="confirm_password" placeholder="Confirm password" />
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Change password</button>
                            </div>

                        </form>

                                </div>
                            </div>
                        </div>
              
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection