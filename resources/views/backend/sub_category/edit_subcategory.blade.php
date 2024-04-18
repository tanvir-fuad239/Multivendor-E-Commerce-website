@extends('admin.master') 

@section('main-content')
	<!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-2">
        <div class="breadcrumb-title pe-3">Edit Sub Category</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Sub Category</li>
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
                        <h5 class="mb-0 text-primary">Edit Sub Category</h5>
                    </div>
                    <hr>
                    <form action="{{ route('subcategory.update', $sub_category->id) }}" method="post" class="row g-3">

                        @csrf 

                        {{-- subcategory name  --}}
                        <div class="col-md-12 mb-2">
                            <label for="category_name" class="form-label">Sub Category Name</label>
                            <input type="text" class="form-control" name="subcategory_name" id="subcategory_name" value="{{ $sub_category->subcategory_name }}">
                        </div>

                       
                        <div class="col-12 mb-2">
                            <button type="submit" class="btn btn-primary px-5">Update Sub Category</button>
                        </div>
                    </form>
                </div>
            </div>

@endsection