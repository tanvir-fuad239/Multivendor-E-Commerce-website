@extends('admin.master') 

@section('main-content')
	<!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-2">
        <div class="breadcrumb-title pe-3">Edit Cupon</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Cupon</li>
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
                        <h5 class="mb-0 text-primary">Edit Cupon</h5>
                    </div>
                    <hr>
                    <form action="{{ route('admin.cupons.update', $cupon->id) }}" method="post" class="row g-3">
                        @method('PUT')
                        @csrf 

                        {{-- cupon code  --}}
                        <div class="col-md-12 mb-2">
                            <label for="cupon_code" class="form-label">Code</label>
                            <input type="text" class="form-control" name="cupon_code" id="cupon_code" value="{{ old('cupon_code',$cupon->code) }}">
                            @error('cupon_code')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- cupon amount  --}}
                        <div class="col-md-12 mb-2">
                            <label for="cupon_amount" class="form-label">Amount</label>
                            <input type="text" class="form-control" name="cupon_amount" id="cupon_amount" value="{{ old('cupon_amount',$cupon->amount) }}">
                            @error('cupon_amount')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- cupon type  --}}
                        <div class="col-12">
                            <label for="cupon_type" class="form-label">Type</label>
                            <select class="form-select" id="cupon_type" name="cupon_type" class="form-control">
                                <option> -- select type --</option>
                                
                                <option value="fixed" {{ (old('cupon_type', $cupon->type) == 'fixed') ? 'selected' : '' }}>Fixed</option>
                                <option value="percent" {{ (old('cupon_type', $cupon->type) == 'percent') ? 'selected' : '' }}>Percent</option>
                            
                                @error('cupon_type')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </select>
                        </div>

                        {{-- minimum amount  --}}
                        <div class="col-md-12 mb-2">
                            <label for="min_amount" class="form-label">Minimum Amount</label>
                            <input type="text" class="form-control" name="min_amount" id="min_amount" value="{{ old('min_amount',$cupon->minimum_amount) }}">
                            @error('min_amount')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- usage limit  --}}
                        <div class="col-md-12 mb-2">
                            <label for="usage_limit" class="form-label">Cupon Usage Limit</label>
                            <input type="text" class="form-control" name="usage_limit" id="usage_limit" value="{{ old('usage_limit',$cupon->usage_limit) }}">
                            @error('usage_limit')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- user usage limit  --}}
                        <div class="col-md-12 mb-2">
                            <label for="used_limit" class="form-label">User Usage Limit</label>
                            <input type="text" class="form-control" name="used_limit" id="used_limit" value="{{ old('used_limit',$cupon->used) }}">
                            @error('used_limit')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- valid from  --}}
                        <div class="col-md-12 mb-2">
                            <label for="valid_from" class="form-label">Valid From</label>
                            <input type="datetime-local" class="form-control" name="valid_from" id="valid_from" value="{{ old('valid_from',$cupon->valid_from) }}">
                            @error('valid_from')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- expires at  --}}
                        <div class="col-md-12 mb-2">
                            <label for="expire_at" class="form-label">Expires At</label>
                            <input type="datetime-local" class="form-control" name="expire_at" id="expire_at" value="{{ old('expire_at',$cupon->expires_at) }}">
                            @error('expire_at')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-12 mb-2">
                            <button type="submit" class="btn btn-primary px-5">Update</button>
                        </div>

                    </form>
                </div>
            </div>

@endsection