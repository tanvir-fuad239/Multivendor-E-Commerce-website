@extends('admin.master') 

@section('main-content')
	<!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-2">
        <div class="breadcrumb-title pe-3">Edit Category</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
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
                        <h5 class="mb-0 text-primary">Edit Category</h5>
                    </div>
                    <hr>
                    <form action="{{ route('category.update',  $category->id) }}" method="post" enctype="multipart/form-data" class="row g-3">

                        @csrf 

                        {{-- category name  --}}
                        <div class="col-md-12 mb-2">
                            <label for="category_name" class="form-label">Category Name</label>
                            <input type="text" class="form-control" name="category_name" id="category_name" value="{{ $category->category_name }}">
                        </div>

                        {{-- category image  --}}
                        <div class="col-md-12 mb-2">
                            <label for="category_image" class="form-label">Category Image</label>
                            <input type="file" class="form-control" name="category_image" id="photo">
                        </div>
                        
                        <div class="col-md-4 mb-2">
                            <img src="{{ empty($category->category_image)? asset("uploads/category/product.png") : asset('uploads/category/images/' . $category->category_image) }}" alt=""  id="selected_photo" height="90px" width="90px">
                        </div>

                        <div class="col-12 mb-2">
                            <button type="submit" class="btn btn-primary px-5">Update Category</button>
                        </div>
                    </form>
                </div>
            </div>

@endsection