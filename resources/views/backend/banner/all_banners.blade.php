@extends('admin.master')

@section('main-content')

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-2">
    <div class="breadcrumb-title pe-3">All Banners</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">All Banners</li>
            </ol>
        </nav>
    </div>
</div>
<br>
<!--end breadcrumb-->
<a href="{{ route('admin.banners.create') }}" class="btn btn-sm btn-primary">Add Banner</a>
<hr/>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>#SL</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Url</th>
                      
                        <th>Action</th>                     
                    </tr>
                </thead>
                <tbody>

                    @foreach ($allBanners as $key=>$banner)
                    
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $banner->title }}</td>
                            <td><img src="{{ asset($banner->image) }}" alt="{{ asset($banner->image) }}" height="60px" width="100px"></td>
                            <td>{{ $banner->url }}</td>
                       
                            {{-- Modal starts here --}}
                            <div class="modal fade" id="deleteBannerModal{{ $banner->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body"><h6>Are you sure to delete this banner?</h6></div>
                                        <div class="modal-footer">
                                            <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" type="submit">Delete</button>
                                            </form>
                                            <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Modal ends here --}}
                            <td>
                                <a href="{{ route('admin.banners.edit', $banner->id) }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="javascript:void(0)" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteBannerModal{{ $banner->id }}"><i class="fa-solid fa-trash"></i></a> 
                               
                            </td>
                          
                        </tr>

                    @endforeach
                   

                    
                </tbody>
                <tfoot>
                    <tr>
                        <th>#SL</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Url</th>
                        <th>Action</th>    
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>


@endsection