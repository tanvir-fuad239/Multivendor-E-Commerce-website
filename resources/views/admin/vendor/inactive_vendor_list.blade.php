@extends('admin.master')

@section('main-content')

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-2">
    <div class="breadcrumb-title pe-3">Inactive Vendor List</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Inactive Vendor</li>
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

                    @foreach ($inactive_vendor as $key=>$inac_vendor )

                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $inac_vendor->name }}</td>
                            <td>{{ $inac_vendor->username }}</td>
                            <td>{{ $inac_vendor->email }}</td>
                            <td>{{ $inac_vendor->phone }}</td>
                            <td>{{ $inac_vendor->vendor_join }}</td>
                            <td>{{ $inac_vendor->address }}</td>
                            <td>
                                <a href="{{ route('inactive.to.active', $inac_vendor->id) }}" class="btn btn-danger btn-sm">Inactive</a>
                            </td>
                            <td>
                                	<!-- Button trigger modal -->
										<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#activevendor{{ $inac_vendor->id }}">View Details</button>
										<!-- Modal -->
										<div class="modal fade" id="activevendor{{ $inac_vendor->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Vendor Information</h5>
														<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
													</div>
													<div class="modal-body">

                                                        <form action="{{ route('inactive.vendor.info.update', $inac_vendor->id) }}" method="post" class="row g-3">

                                                            @csrf 
                                    
                                                            {{-- name  --}}
                                                            <div class="col-md-12 mb-1">
                                                                <label for="name" class="form-label">Full Name</label>
                                                                <input type="text" class="form-control" name="name" id="name" value="{{ $inac_vendor->name  }}">
                                                            </div>
                                    
                                                            {{-- username  --}}
                                                            <div class="col-md-12 mb-1">
                                                                <label for="username" class="form-label">Username</label>
                                                                <input type="text" class="form-control" name="username" id="username" disabled value="{{ $inac_vendor->username  }}">
                                                            </div>

                                                            {{-- email  --}}
                                                            <div class="col-md-12 mb-1">
                                                                <label for="email" class="form-label">Email</label>
                                                                <input type="email" class="form-control" name="email" id="email" disabled value="{{ $inac_vendor->email  }}">
                                                            </div>

                                                            {{-- phone  --}}
                                                            <div class="col-md-12 mb-1">
                                                                <label for="phone" class="form-label">Phone Number</label>
                                                                <input type="text" class="form-control" name="phone" id="phone" value="{{ $inac_vendor->phone  }}">
                                                            </div>

                                                            {{-- address  --}}
                                                            <div class="col-md-12 mb-1">
                                                                <label for="address" class="form-label">Address</label>
                                                                <input type="text" class="form-control" name="address" id="address" value="{{ $inac_vendor->address  }}">
                                                            </div>

                                                            {{-- status --}}
                                                            <div class="col-md-12 mb-1">
                                                                <label for="status" class="form-label">Vendor Status</label>
                                                                 <select name="status" id="status" class="form-control">
                                                                    <option value="{{ $inac_vendor->status }}">{{ $inac_vendor->status }}
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
                                        
                                <a href="{{ route('inactive.vendor.delete', $inac_vendor->id) }}" class="btn btn-sm btn-danger">Delete</a>
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