@extends('admin.master') 

@section('main-content')
	<!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-2">
        <div class="breadcrumb-title pe-3">Edit Banner</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Banner</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-xl-7 mx-auto">
            <div class="card border-top border-0 border-4 border-primary">
                <div class="card-body p-5">
                    <div class="card-title d-flex align-items-center">
                        <div><i class="me-1 font-22 text-primary"></i>
                        </div>
                        <h5 class="mb-0 text-primary">Edit Banner</h5>
                    </div>
                    <hr>
                    <form action="{{ route('admin.banners.update', $banner->id) }}" method="post" enctype="multipart/form-data" class="row g-3">

                        @csrf 
                        @method('PUT')

                            {{-- banner name  --}}
                            <div class="col-md-12 mb-2">
                                <label for="banner_name" class="form-label">Title</label>
                                <input type="text" class="form-control" name="banner_name" id="banner_name" value="{{ old('banner_name', $banner->title) }}">
                                @error('banner_name')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>
    
                            {{-- banner image  --}}
                            <div class="col-md-12 mb-2">
                                <label for="banner_image" class="form-label">Image</label>
                                <input type="file" class="form-control" name="banner_image" id="slider_image">
                                @error('banner_image')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>
    
                            <div class="col-md-4 mb-2" id="display_image">
                                <img src="{{ asset($banner->image) }}" alt=""  id="selected_photo" height="90px" width="90px">
                            </div>
    
                            {{-- banner url  --}}
                            <div class="col-md-12 mb-2">
                                <label for="validationUrl" class="form-label">Url</label>
                                <input type="text" class="form-control" id="validationUrl" aria-describedby="inputGroupPrepend" name="banner_url" value="{{ old('banner_url', $banner->url) }}">
                            </div>
    
                        <div class="col-12 mb-2">
                            <button type="submit" class="btn btn-primary px-5">Update Banner</button>
                        </div>
                    </form>
                </div>
            </div>

@endsection