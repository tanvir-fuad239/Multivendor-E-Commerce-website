@extends('vendor.master') 

@section('main-content')

        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
				<!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Vendor Profile</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('vendor.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Vendor Profilep</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="container">
                <div class="main-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-center text-center">
                                        <img src="{{ empty($vendor_info->photo)? asset('uploads/vendor/avatar.png') : getImage($vendor_info->photo, "vendor")}}" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
                                        <div class="mt-3">
                                            <h4>{{ $vendor_info->name }}</h4>
                                            <p class="text-secondary mb-1">{{ $vendor_info->email }}</p>
                                            <p class="text-muted font-size-sm">{{ $vendor_info->address }}</p>
                                        </div>
                                    </div>
                                    <hr class="my-4" />
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe me-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>Website</h6>
                                            <span class="text-secondary">https://NomWeb.com</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook me-2 icon-inline text-primary"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>Facebook</h6>
                                            <span class="text-secondary">Tanvir_Fuad</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github me-2 icon-inline"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>Github</h6>
                                            <span class="text-secondary">tanvir_fuad239</span>
                                        </li>
                                        
                                    
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">

                                    <form action="{{ route('vendor.profile.update') }}" method="post" enctype="multipart/form-data">
                                    
                                        @csrf

                                        {{-- username --}}
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Username</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" value="{{ $vendor_info->username }}" disabled />
                                            </div>
                                        </div>

                                        {{-- name --}}
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Full Name</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" name="name" value="{{ $vendor_info->name }}" />
                                            </div>
                                        </div>

                                        {{-- email --}}
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Email</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="email" class="form-control" name="email" value="{{ $vendor_info->email }}" />
                                            </div>
                                        </div>

                                        {{-- photo --}}
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Photo</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="file" class="form-control" name="photo" id="photo" />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <img src="{{ empty($vendor_info->photo)? asset('uploads/vendor/avatar.png') : asset('uploads/vendor/images/' . $vendor_info->photo)}}" alt="" height="120px" width="120px" id="selected_photo">
                                            </div>
                                        </div>

                                        {{-- phone --}}
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Phone</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" name="phone" value="{{ $vendor_info->phone }}" />
                                            </div>
                                        </div>
                                        
                                        {{-- address --}}
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Address</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" name="address" value="{{ $vendor_info->address }}" />
                                            </div>
                                        </div>

                                           {{-- short info --}}
                                           <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Short Info</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" name="short_info" value="{{ $vendor_info->vendor_short_info }}" />
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="submit" class="btn btn-primary px-4" value="Profile Update" />
                                            </div>
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
    
    </script>
@endsection