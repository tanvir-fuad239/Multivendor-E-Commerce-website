@extends('admin.master')

@section('main-content')

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-2">
    <div class="breadcrumb-title pe-3">All Cupons</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">All Cupons</li>
            </ol>
        </nav>
    </div>
</div>
<br>
<!--end breadcrumb-->
<a href="{{ route('admin.cupons.create') }}" class="btn btn-sm btn-primary">Add Cupon</a>
<hr/>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>#SL</th>
                        <th>Code</th>
                        <th>Amount</th>
                        <th>Type</th>
                        <th>Minimum Amount</th>
                        <th>Usage Limit</th>
                        <th>User uses</th>
                        <th>Valid From</th>
                        <th>Expires At</th>
                        <th>Status</th>
                        <th>Action</th>                     
                    </tr>
                </thead>
                <tbody>

                    @foreach ($cupons as $key=>$cupon )

                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $cupon->code }}</td>
                            <td>{{ $cupon->amount }}</td>
                            <td>{{ $cupon->type }}</td>
                            <td>{{ $cupon->minimum_amount }}</td>
                            <td>{{ $cupon->usage_limit }}</td>
                            <td>{{ $cupon->used }}</td>
                            <td>{{ $cupon->valid_from }}</td>
                            <td>{{ $cupon->expires_at }}</td>
                            <td>
                                @if($cupon->status == 1)
                                    <a href="javascript:void(0)" data-id="{{ $cupon->id }}" data-status="1" class="cupon-toggle"><i class="fas fa-toggle-on fs-2"></i></a>
                                @else
                                    <a href="javascript:void(0)" data-id="{{ $cupon->id }}" data-status="0" class="cupon-toggle"><i class="fas fa-toggle-off fs-2"></i></a>
                                @endif
                            </td>

                            {{-- Modal starts here --}}
                            <div class="modal fade" id="deleteCuponModal{{ $cupon->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body"><h6>Are you sure to delete this cupon?</h6></div>
                                        <div class="modal-footer">
                                            <form action="{{ route('admin.cupons.destroy', $cupon->id) }}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                            <a href="{{ route('admin.cupons.index') }}" class="btn btn-secondary">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Modal ends here --}}

                            <td>
                                <a href="{{ route('admin.cupons.edit', $cupon->id) }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCuponModal{{ $cupon->id }}"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    
                    @endforeach

                    
                </tbody>
                <tfoot>
                    <tr>
                        <th>#SL</th>
                        <th>Code</th>
                        <th>Amount</th>
                        <th>Type</th>
                        <th>Minimum Amount</th>
                        <th>Usage Limit</th>
                        <th>User uses</th>
                        <th>Valid From</th>
                        <th>Expires At</th>
                        <th>Status</th>
                        <th>Action</th>     
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>


@endsection