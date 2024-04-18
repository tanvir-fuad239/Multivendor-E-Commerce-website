@extends('admin.master')

@section('main-content')

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-2">
    <div class="breadcrumb-title pe-3">Active Vendor List</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Active Vendor</li>
            </ol>
        </nav>
    </div>
</div>
<br>
<!--end breadcrumb-->
 
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>#SL</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Join Date</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Action</th>                        
                    </tr>
                </thead>
                <tbody>

                    @foreach ($active_vendor as $key=>$ac_vendor )

                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $ac_vendor->name }}</td>
                            <td>{{ $ac_vendor->username }}</td>
                            <td>{{ $ac_vendor->email }}</td>
                            <td>{{ $ac_vendor->phone }}</td>
                            <td>{{ $ac_vendor->vendor_join }}</td>
                            <td>{{ $ac_vendor->address }}</td>
                            <td>
                                <a href="{{ route('active.to.inactive', $ac_vendor->id) }}" class="btn btn-success btn-sm">Active</a>
                            </td>
                            <td>

                                    	<!-- Button trigger modal -->
										<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#activevendor{{ $ac_vendor->id }}">View Details</button>
										<!-- Modal -->
										<div class="modal fade" id="activevendor{{ $ac_vendor->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Vendor Information</h5>
														<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
													</div>
													<div class="modal-body">

                                                        <form action="{{ route('active.vendor.info.update', $ac_vendor->id ) }}" method="post" class="row g-3">

                                                            @csrf 
                                                          
                                                            {{-- name  --}}
                                                            <div class="col-md-12 mb-1">
                                                                <label for="name" class="form-label">Full Name</label>
                                                                <input type="text" class="form-control" name="name" id="name" value="{{ $ac_vendor->name  }}">
                                                            </div>
                                    
                                                            {{-- username  --}}
                                                            <div class="col-md-12 mb-1">
                                                                <label for="username" class="form-label">Username</label>
                                                                <input type="text" class="form-control" name="username" id="username" disabled value="{{ $ac_vendor->username  }}">
                                                            </div>

                                                            {{-- email  --}}
                                                            <div class="col-md-12 mb-1">
                                                                <label for="email" class="form-label">Email</label>
                                                                <input type="email" class="form-control" name="email" id="email" disabled value="{{ $ac_vendor->email  }}">
                                                            </div>

                                                            {{-- phone  --}}
                                                            <div class="col-md-12 mb-1">
                                                                <label for="phone" class="form-label">Phone Number</label>
                                                                <input type="text" class="form-control" name="phone" id="phone" value="{{ $ac_vendor->phone  }}">
                                                            </div>

                                                            {{-- address  --}}
                                                            <div class="col-md-12 mb-1">
                                                                <label for="address" class="form-label">Address</label>
                                                                <input type="text" class="form-control" name="address" id="address" value="{{ $ac_vendor->address  }}">
                                                            </div>

                                                            {{-- status  --}}
                                                            <div class="col-md-12 mb-1">
                                                                <label for="status" class="form-label">Vendor Status</label>
                                                                 <select name="status" id="status" class="form-control">
                                                                    <option value="{{ $ac_vendor->status }}">{{ $ac_vendor->status }}
                                                                    </option>
                                                                    <option value="active">Active</option>
                                                                    <option value="inactive">inactive</option>
                                                                 </select>
                                                            </div>

                                    
                                                            <div class="col-12 mb-1">
                                                                <button type="submit" class="btn btn-primary px-5">Update Information</button>
                                                            </div>
                                                        </form>

                                                    </div>

												</div>
											</div>
										</div>

                                <a href="{{ route('active.vendor.delete', $ac_vendor->id) }}" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    
                    @endforeach
                    
                </tbody>
                <tfoot>
                    <tr>
                        <th>#SL</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Join Date</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Action</th>      
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>


@endsection