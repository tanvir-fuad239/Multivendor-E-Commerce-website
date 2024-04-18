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
                        <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
					    <div class="row">

						   <div class="col-lg-8">
                           <div class="border border-3 p-4 rounded">

                            {{-- product name --}}
							<div class="mb-3">
								<label for="product_name" class="form-label">Product Name</label>
								<input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter product name">
							</div>

                            {{-- product code  --}}
							<div class="mb-3">
								<label for="product_code" class="form-label">Product Code</label>
                                <input type="text" class="form-control" id="product_code" name="product_code" placeholder="Enter product code">
							</div>

                            {{-- product quantity --}}
                            <div class="mb-3">
								<label for="product_qty" class="form-label">Product Quantity</label>
                                <input type="number" class="form-control" id="product_quantity" name="product_quantity" placeholder="Enter product quantity">
							</div>
                            
                            {{-- product tags  --}}
                            <div class="mb-3">
                                <label for="product_tags" class="form-label">Product Tags</label>
                                <input type="text" class="form-control" data-role="tagsinput" value="New Product" id="product_tags" name="product_tag">
                            </div>

                             {{-- product color  --}}
                             <div class="mb-3">
                                <label for="product_color" class="form-label">Product Colors</label>
                                <input type="text" class="form-control" data-role="tagsinput" value="Red" id="product_color" name="product_color">
                            </div>

                             {{-- product size  --}}
                             <div class="mb-3">
                                <label for="product_size" class="form-label">Product Sizes</label>
                                <input type="text" class="form-control" data-role="tagsinput" value="Small" id="product_size" name="product_size">
                            </div>

                            {{-- short description --}}
                            <div class="mb-3">
								<label for="short_descp" class="form-label">Short Description</label>
                                <textarea name="short_descp" id="short_descp" rows="3" class="form-control" placeholder="Enter short description"></textarea>
							</div>

                            {{-- long description  --}}
                            <div class="mb-3">
								<label for="long_descp" class="form-label">Long Description</label>
                                <textarea id="mytextarea" name="long_descp" class="form-control" placeholder="Enter long description"></textarea>
							</div>
                            
                            {{-- product image  --}}
                            <div class="mb-3">
								<label for="product_image" class="form-label">Product Thumbnail</label>
                               <input type="file" name="product_image" id="product_image" class="form-control" onchange="mainThumUrl(this)">
                               <img src="" alt="" id="mainThum" class="mt-2">
							</div>

                            {{-- multiple images --}}
                            <div class="mb-3">
								<label for="multi_imgs" class="form-label">Multiple Images</label>
                               <input type="file" name="multi_imgs[]" id="multi_imgs" class="form-control" multiple>
                               <div class="row" id="preview_img">
									 
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
                                    <input type="number" class="form-control" id="product_price" name="product_price" placeholder="Enter product price">
                                </div>

                                {{-- discount price  --}}
                                <div class="mb-3">
                                    <label for="discount_price" class="form-label">Discount Price</label>
                                    <input type="number" class="form-control" id="discount_price" name="discount_price" placeholder="Enter discount price">
                                </div>
                                
                                {{-- product brand  --}}
								<div class="col-12">
									<label for="product_brand" class="form-label">Brand</label>
									<select class="form-select" id="product_brand" name="product_brand" class="form-control">
										<option> -- select brand --</option>
										@foreach ($brands as $brand)
											<option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
										@endforeach
									  </select>
								</div>

							    {{-- product category  --}}
								<div class="col-12">
									<label for="product_category" class="form-label">Category</label>
									<select class="form-select" id="categoryDropdown" name="product_category" class="form-control">
										<option> -- select category --</option>
										@foreach ($categories as $category)
											<option value="{{ $category->id }}">{{ $category->category_name }}</option>
										@endforeach
									  </select>
								</div>

                                {{-- product subcategory  --}}
								<div class="col-12">
									<label for="product_subcategory" class="form-label">Subcategory</label>
									<select class="form-select" id="subcategoryDropdown" name="product_subcategory" class="form-control">
										
										{{-- dynamically shows the subcategories here --}}
										<option value="">Please select a category first</option>
								
									  </select>
								</div>

								{{-- vendor  --}}
								<div class="col-12">
									<label for="vendor_id" class="form-label">Vendor</label>
									<select class="form-select" id="vendor_id" name="vendor_id" class="form-control">
										<option> -- select vendor --</option>
										@foreach ($vendors as $vendor)
											<option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
										@endforeach
									  </select>
								</div>
								  <div class="col-6">

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="hot_deals" name="hot_deals">
                                        <label class="form-check-label" for="hot_deals">Hot Deals</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="featured" name="featured">
                                        <label class="form-check-label" for="featured">Featured</label>
                                    </div>

								  </div>
                                  <div class="col-6">

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="special_offers" name="special_offers">
                                        <label class="form-check-label" for="special_offers">Special Offers</label>
                                    </div>
                                    
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="special_deals" name="special_deals">
                                        <label class="form-check-label" for="special_deals">Special Deals</label>
                                    </div>

								  </div>
								  <div class="col-12">
									  <div class="d-grid">
                                         <button type="submit" class="btn btn-primary">Save Product</button>
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