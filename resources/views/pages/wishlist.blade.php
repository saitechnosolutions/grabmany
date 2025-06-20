@extends('layouts.default')
@section('main-content')
	<style>
		.form-control {
			background-color: #fff !important;
		}
	</style>

	<!-- cartHolder -->
	<div class="cartHolder container pt-xl-21 pb-xl-24 py-lg-20 py-md-16 py-10">
		@php
			$wishlist = Auth::check() ? App\Models\Wishlist::where('user_id', Auth::user()->id)->get() : collect();
		@endphp
		<form action="/checkout" method="post">
			@csrf
			<div class="row">
				<div class="col-12 table-responsive mb-xl-22 mb-lg-20 mb-md-16 mb-10">
					<!-- cartTable -->


					<table class="table cartTable">
						@if($wishlist->isNotEmpty())
							<thead>
								<tr>
									<th>Product</th>
									<th>Price</th>
									<th>Quantity</th>
									<th>Total</th>
								</tr>
							</thead>

							<tbody>
								@foreach ($wishlist as $cat)
									@php
										$pro = App\Models\products::where('id', $cat->product_id)->first();
										$proVarient = App\Models\ProductVarient::where('id', $cat->product_varient_id)->first();
									@endphp
									<tr class="align-items-center">
										<td class="d-flex align-items-center border-top-0 border-bottom px-0 py-6">
											<div class="imgHolder">
												<img src="{{env('MAIN_URL')}}images/{{ $pro->product_image }}"
													alt="image description" class="img-fluid">
											</div>
											<span class="title pl-2"><a href="">{{ $pro->pro_name }}</a></span>

										</td>
										<td class="fwEbold border-top-0 border-bottom px-0 py-6">{{ $proVarient->offer_price }}
										</td>
										<td class="border-top-0 border-bottom px-0 py-6 pbtn"><input type="number" class="qty-input"
												data-cart-id="{{ $cat->id }}" data-price="{{ $pro->product_regular_price }}"
												value="{{ $cat->product_quantity }}">
										</td>
										<td class="fwEbold border-top-0 border-bottom px-0 py-6 total-price"
											id="total-{{ $cat->id }}">
											<span class="price-val">{{ $proVarient->offer_price }}</span> ₹
											<a href="javascript:void(0);" class="fas fa-times float-right removecart"
												data-id="{{ $pro?->id }}" data-user_id="{{Auth::User()->id}}"></a>
										</td>


										<input type="hidden" value="{{ $pro->id }}" name="proid[]" class="user_id">
										<input type="hidden" value="{{ $pro->product_image }}" name="product_image[]"
											class="imgHolder">
										<input type="hidden" value="{{ $pro->product_name }}" name="product_name[]" class="">
										<input type="hidden" value="{{ $pro->product_regular_price }}" name="regularprice[]"
											class="">
										<input type="hidden" value="{{$cat->total_price}}" name="totalprice[]" class="total-price">
										<input type="hidden" value="{{ $cat->product_quantity }}" class="qty-input"
											name="product_quantity[]">
									</tr>
								@endforeach
							</tbody>
						@else
							<tr>
								<td colspan="4" class="text-center">Your Wishlist is empty.</td>
							</tr>
						@endif
					</table>
				</div>
			</div>

			
		</form>
	</div>


@endsection