@extends('admin.master')

@section('main-content')
 
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Chai Pai Nest</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="{{ Route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">{{ $pageTitle }}</li>
							</ol>
						</nav>
					</div>
				</div>
				<!--end breadcrumb-->

				 <div class="card">
					<div class="row g-0">
					  <div class="col-md-4 border-end">
						<img src="{{ getImage($product->product_image, "product") }}" class="img-fluid p-img" alt="{{ getImage($product->product_image, "product") }}">

						<div class="row mb-3 row-cols-auto g-2 justify-content-center mt-3">
							@forelse ($product->multi_imgs as $img)
								<div class="col"><img src="{{ getImage($img->multi_image, "multi_imgs") }}" width="70" height="50px" class="border rounded" alt="{{ getImage($img->multi_image, "multi_imgs") }}"></div>
							@empty
								<h4 class="text-center">No image available</h4>
							@endforelse
						</div>

					
					  </div>
					  <div class="col-md-8">
						<div class="card-body">
						  <h4 class="card-title">{{ $product->product_name }}</h4>
						  <div class="d-flex gap-3 py-3">
							<div class="cursor-pointer">
								<i class='bx bxs-star text-warning'></i>
								<i class='bx bxs-star text-warning'></i>
								<i class='bx bxs-star text-warning'></i>
								<i class='bx bxs-star text-warning'></i>
								<i class='bx bxs-star text-secondary'></i>
							  </div>	
							  <div>{{ getRandomNumber(100,600) }} reviews</div>
							  <div class="text-success"><i class='bx bxs-cart-alt align-middle'></i> {{ getRandomNumber(100,600) }} orders</div>
						  </div>
						  <div class="mb-3"> 
							<span class="price h4">{{ getAmount($product->discount_price) }}</span> 
							<span class="text-muted"><strike>{{ getAmount($product->product_price) }}</strike></span> 
						</div>
						  <p class="card-text fs-6">{{ $product->short_description }}</p>
						  <dl class="row">
							<dt class="col-sm-3">Stock</dt>
							<dd class="col-sm-9">{{ $product->product_quantity }}</dd>

							<dt class="col-sm-3">Code</dt>
							<dd class="col-sm-9">{{ $product->product_code }}</dd>
						  
							<dt class="col-sm-3">Colors</dt>
							<dd class="col-sm-9">
								{{ implode(',' , $product->colors()->pluck('product_color')->toArray()) }}
							</dd>
						  
							<dt class="col-sm-3">Sizes</dt>
							<dd class="col-sm-9">
								{{ implode(',' , $product->sizes()->pluck('product_size')->toArray()) }}
							</dd>
						  </dl>
						  <hr>

						{{-- Modal starts here --}}
							<div class="modal fade" id="deleteProductModal{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-body"><h6>Are you sure to delete this product?</h6></div>
										<div class="modal-footer">
											<a href="{{ route('product.destroy', $product->id) }}" class="btn btn-danger">Delete</a>
											<a href="{{ route('product.show', $product->id) }}" class="btn btn-secondary">Cancel</a>
										</div>
									</div>
								</div>
							</div>
				 		{{-- Modal ends here --}}

						<div class="d-flex gap-3 mt-3">
							<a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
							<a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteProductModal{{ $product->id }}"><span class="text"><i class="fa-solid fa-trash"></i></span>
							</a>

							@if($product->status == 1 )
								<a href="{{ route('product.inactive', [$product->id, $product->status]) }}"><span class="text"><i class="fas fa-toggle-on fs-1"></i></span></a> 
							@else
							 	<a href="{{ route('product.active', [$product->id, $product->status]) }}"><span class="text"><i class="fas fa-toggle-off fs-1"></i></span></a>
							@endif

						</div>
						</div>
					  </div>
					</div>
                    <hr/>
					<div class="card-body">
						<ul class="nav nav-tabs nav-primary mb-0" role="tablist">
							<li class="nav-item" role="presentation">
								<a class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab" aria-selected="true">
									<div class="d-flex align-items-center">
										<div class="tab-icon"><i class='bx bx-comment-detail font-18 me-1'></i>
										</div>
										<div class="tab-title">Product Description</div>
									</div>
								</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" data-bs-toggle="tab" href="#primaryprofile" role="tab" aria-selected="false">
									<div class="d-flex align-items-center">
										<div class="tab-icon"><i class='bx bx-bookmark-alt font-18 me-1'></i>
										</div>
										<div class="tab-title">Tags</div>
									</div>
								</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" data-bs-toggle="tab" href="#primarycontact" role="tab" aria-selected="false">
									<div class="d-flex align-items-center">
										<div class="tab-icon"><i class='bx bx-star font-18 me-1'></i>
										</div>
										<div class="tab-title">Reviews</div>
									</div>
								</a>
							</li>
						</ul>
						<div class="tab-content pt-3">
							<div class="tab-pane fade show active" id="primaryhome" role="tabpanel">
								<p>{{ $product->long_description }}</p>
							</div>
							<div class="tab-pane fade" id="primaryprofile" role="tabpanel">
								<p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
							</div>
							<div class="tab-pane fade" id="primarycontact" role="tabpanel">
								<p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
							</div>
						</div>
					</div>

				  </div>

@endsection