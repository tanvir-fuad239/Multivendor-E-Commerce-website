@extends('admin.master')

@section('main-content')

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-2">
    <div class="breadcrumb-title pe-3">All Brand</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">All Brand</li>
            </ol>
        </nav>
    </div>
</div>
<br>
<!--end breadcrumb-->

<a href="{{ route('brand.add') }}" class="btn btn-sm btn-primary">Add Brand</a>
<hr/>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>#SL</th>
                        <th>Brand Name</th>
                        <th>Brand Image</th>
                        <th>Action</th>                     
                    </tr>
                </thead>
                <tbody>

                    @foreach ($brands as $key=>$brand )

                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $brand->brand_name }}</td>
                            <td><img src="{{ getImage($brand->brand_image, "brand") }}" alt="" height="60px" width="100px"></td>
                            <td>
                                <a href="{{ route('brand.edit', $brand->id) }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="{{ route('brand.delete', $brand->id) }}" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    
                    @endforeach

                    
                </tbody>
                <tfoot>
                    <tr>
                        <th>#SL</th>
                        <th>Brand Name</th>
                        <th>Brand Image</th>
                        <th>Action</th>  
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>


@endsection