@extends('admin.master')

@section('main-content')

			<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Chai Pai Nest</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">{{ $pageTitle }}</li>
							</ol>
						</nav>
					</div>
				</div>
				<!--end breadcrumb-->

              <div class="card">
				  <div class="card-body p-4">
					  <h5 class="card-title">{{ $pageTitle }}</h5>
					  <hr/>
                       <div class="form-body mt-4">
                        <form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
					    <div class="row">

						   <div class="col-lg-8">
                           <div class="border border-3 p-4 rounded">
                            {{-- product name --}}
							<div class="mb-3">
								<label for="product_name" class="form-label">Product Name</label>
								<input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter product name" value="{{ $product->product_name }}">
							</div>

                            {{-- product code  --}}
							<div class="mb-3">
								<label for="product_code" class="form-label">Product Code</label>
                                <input type="text" class="form-control" id="product_code" name="product_code" placeholder="Enter product code" value="{{ $product->product_code }}">
							</div>

                            {{-- product quantity --}}
                            <div class="mb-3">
								<label for="product_qty" class="form-label">Product Quantity</label>
                                <input type="number" class="form-control" id="product_quantity" name="product_quantity" placeholder="Enter product quantity" value="{{ $product->product_quantity }}">
							</div>
                            
                            {{-- product tags  --}}
                            <div class="mb-3">
                                <label for="product_tags" class="form-label">Product Tags</label>
                                <input type="text" class="form-control" data-role="tagsinput" value="{{ implode(',', $product->tags()->pluck('product_tag')->toArray()) }}" id="product_tags" name="product_tag">
                            </div>

                             {{-- product color  --}}
                             <div class="mb-3">
                                <label for="product_color" class="form-label">Product Colors</label>
                                <input type="text" class="form-control" data-role="tagsinput" value="{{ implode(',', $product->colors()->pluck('product_color')->toArray()) }}" id="product_color" name="product_color">
                            </div>

                             {{-- product size  --}}
                             <div class="mb-3">
                                <label for="product_size" class="form-label">Product Sizes</label>
                                <input type="text" class="form-control" data-role="tagsinput" value="{{ implode(',', $product->sizes()->pluck('product_size')->toArray()) }}" id="product_size" name="product_size">
                            </div>

                            {{-- short description --}}
                            <div class="mb-3">
								<label for="short_descp" class="form-label">Short Description</label>
                                <textarea name="short_descp" id="short_descp" rows="3" class="form-control" placeholder="Enter short description">{{ $product->short_description }}</textarea>
							</div>

                            {{-- long description  --}}
                            <div class="mb-3">
								<label for="long_descp" class="form-label">Long Description</label>
                                <textarea id="mytextarea" name="long_descp" class="form-control" placeholder="Enter long description">{{ $product->long_description }}</textarea>
							</div>
                            
                            {{-- product image  --}}
                            <div class="mb-3">
								<label for="product_image" class="form-label">Product Thumbnail</label>
                               <input type="file" name="product_image" id="product_image" class="form-control" onchange="mainThumUrl(this)">
                               <img src="{{ getImage($product->product_image, "product") }}" alt="" id="mainThum" class="mt-2" height="80px" width="100px">
							</div>

                            {{-- multiple images --}}
                            <div class="mb-3">
								<label for="multi_imgs" class="form-label">Multiple Images</label>
                               <input type="file" name="multi_imgs[]" id="multi_imgs" class="form-control" multiple>
                               <div class="row mt-4 mx-2" id="preview_img">
                                    @foreach ($product->multi_imgs()->pluck('multi_image') as $img)
                                        <div class="col-1 gx-2">
                                            <img src="{{ getImage($img,"multi_imgs") }}" alt="" height="60px" width="50px">
                                        </div>
                                    @endforeach
                                </div>
							</div>

                            </div>
						   </div>

						<div class="col-lg-4">
							<div class="border border-3 p-4 rounded">
                              <div class="row g-3">

                                {{-- product price  --}}
                                <div class="mb-3">
                                    <label for="product_price" class="form-label">Product Price</label>
                                    <input type="number" class="form-control" id="product_price" name="product_price" placeholder="Enter product price" value="{{ $product->product_price }}">
                                </div>

                                {{-- discount price  --}}
                                <div class="mb-3">
                                    <label for="discount_price" class="form-label">Discount Price</label>
                                    <input type="number" class="form-control" id="discount_price" name="discount_price" placeholder="Enter discount price" value="{{ $product->discount_price }}">
                                </div>
                                
								  <div class="col-12">
									  <div class="d-grid">
                                         <button type="submit" class="btn btn-primary">Update Product</button>
									  </div>
								  </div>

							  </div> 
                              


                            </div>
						  </div>

                        </div><!--end row-->
                    </form>
					</div>
				  </div>
			  </div>
	<!--end page wrapper -->

@endsection		 