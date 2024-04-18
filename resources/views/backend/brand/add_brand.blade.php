@extends('admin.master') 

@section('main-content')
	<!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-2">
        <div class="breadcrumb-title pe-3">Add Brand</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add Brand</li>
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
                        <h5 class="mb-0 text-primary">Add Brand</h5>
                    </div>
                    <hr>
                    <form action="{{ route('brand.store') }}" method="post" enctype="multipart/form-data" class="row g-3">

                        @csrf 

                        {{-- brand name  --}}
                        <div class="col-md-12 mb-2">
                            <label for="brand_name" class="form-label">Brand Name</label>
                            <input type="text" class="form-control" name="brand_name" id="brand_name" required>
                        </div>

                        {{-- brand image  --}}
                        <div class="col-md-12 mb-2">
                            <label for="brand_image" class="form-label">Brand Image</label>
                            <input type="file" class="form-control" name="brand_image" id="brand_image">
                        </div>

                        <div class="col-12 mb-2">
                            <button type="submit" class="btn btn-primary px-5">Save Brand</button>
                        </div>
                    </form>
                </div>
            </div>

@endsection