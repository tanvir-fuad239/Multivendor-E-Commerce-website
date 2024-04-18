@extends('admin.master') 

@section('main-content')
	<!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-2">
        <div class="breadcrumb-title pe-3">Edit Slider</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Slider</li>
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
                        <h5 class="mb-0 text-primary">Edit Slider</h5>
                    </div>
                    <hr>
                    <form action="{{ route('admin.hero-sliders.update', $slider->id) }}" method="post" enctype="multipart/form-data" class="row g-3">

                        @csrf 
                        @method('PUT')

                        {{-- slider name  --}}
                        <div class="col-md-12 mb-2">
                            <label for="slider_name" class="form-label">Title</label>
                            <input type="text" class="form-control" name="slider_name" id="slider_name" value="{{ old('slider_name', $slider->title) }}">
                            @error('slider_name')
                                <p class="text-danger mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- slider image  --}}
                        <div class="col-md-12 mb-2">
                            <label for="slider_image" class="form-label">Image</label>
                            <input type="file" class="form-control" name="slider_image" id="slider_image">
                            @error('slider_image')
                                <p class="text-danger mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-2" id="display_image">
                            <img src="{{ asset($slider->image) }}" alt=""  id="selected_photo" height="90px" width="90px">
                        </div>
                        
                        {{-- slider description  --}}
                        <div class="col-md-12 mb-2">
                            <label for="slider_description" class="form-label">Description</label>
                            <textarea name="slider_description" id="slider_description" cols="20" rows="10" class="form-control">{{ old('slider_description', $slider->description) }}</textarea>
                            @error('slider_description')
                                <p class="text-danger mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                   

                        <div class="col-12 mb-2">
                            <button type="submit" class="btn btn-primary px-5">Update Slider</button>
                        </div>
                    </form>
                </div>
            </div>

@endsection