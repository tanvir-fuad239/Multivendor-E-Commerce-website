@extends('admin.master')

@section('main-content')

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-2">
    <div class="breadcrumb-title pe-3">All Sub Category</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">All Sub category</li>
            </ol>
        </nav>
    </div>
</div>
<br>
<!--end breadcrumb-->
<a href="{{ route('subcategory.add') }}" class="btn btn-sm btn-primary">Add Sub Category</a>
<hr/>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>#SL</th>
                        <th>Category Name</th>
                        <th>Sub Category Name</th>
                        <th>Action</th>                     
                    </tr>
                </thead>
                <tbody>

                    @foreach ($sub_categories as $key=>$sub_category )

                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $sub_category->category->category_name }}
                            </td>
                            <td>{{ $sub_category->subcategory_name }}</td>
                            {{-- Modal starts here --}}
                            <div class="modal fade" id="deleteSubcategoryModal{{ $sub_category->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body"><h6>Are you sure to delete this subcategory?</h6></div>
                                        <div class="modal-footer">
                                            <a href="{{ route('subcategory.delete', $sub_category->id) }}" class="btn btn-danger">Delete</a>
                                            <a href="{{ route('subcategory.all') }}" class="btn btn-secondary">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Modal ends here --}}
                            <td>
                                <a href="{{ route('subcategory.edit', $sub_category->id) }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteSubcategoryModal{{ $sub_category->id }}"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    
                    @endforeach

                    
                </tbody>
                <tfoot>
                    <tr>
                        <th>#SL</th>
                        <th>Category Name</th>
                        <th>Sub Category Name</th>
                        <th>Action</th>  
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>


@endsection