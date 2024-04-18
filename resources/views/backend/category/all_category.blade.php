@extends('admin.master')

@section('main-content')

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-2">
    <div class="breadcrumb-title pe-3">All Category</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">All category</li>
            </ol>
        </nav>
    </div>
</div>
<br>
<!--end breadcrumb-->
<a href="{{ route('category.add') }}" class="btn btn-sm btn-primary">Add Category</a>
<hr/>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>#SL</th>
                        <th>Category Name</th>
                        <th>Category Image</th>
                        <th>Action</th>                     
                    </tr>
                </thead>
                <tbody>

                    @foreach ($categories as $key=>$category )

                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $category->category_name }}</td>
                            <td><img src="{{ empty($category->category_image) ? asset('/uploads/category/product.png') : getImage($category->category_image, "category") }}" alt="{{ getImage($category->category_image, "category") }}" height="60px" width="100px"></td>
                            {{-- Modal starts here --}}
                            <div class="modal fade" id="deleteCategoryModal{{ $category->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body"><h6>Are you sure to delete this category?</h6></div>
                                        <div class="modal-footer">
                                            <a href="{{ route('category.delete', $category->id) }}" class="btn btn-danger">Delete</a>
                                            <a href="{{ route('category.all') }}" class="btn btn-secondary">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Modal ends here --}}
                            <td>
                                <a href="{{ route('category.edit', $category->id) }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal{{ $category->id }}"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    
                    @endforeach

                    
                </tbody>
                <tfoot>
                    <tr>
                        <th>#SL</th>
                        <th>Category Name</th>
                        <th>Category Image</th>
                        <th>Action</th>   
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>


@endsection