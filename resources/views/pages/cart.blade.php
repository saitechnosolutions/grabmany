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
            $cart = Auth::check() ? App\Models\cart::where('user_id', Auth::user()->id)->get() : collect();
        @endphp
        <form action="/checkout" method="post">
            @csrf
            <div class="row">
                <div class="col-12 table-responsive mb-xl-22 mb-lg-20 mb-md-16 mb-10">
                    <!-- cartTable -->


                    <table class="table table-bordered cartTable">
                        @if ($cart->isNotEmpty())
                            <thead>
                                <tr>
                                    <th class="text-center">Product</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Total</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($cart as $cat)
                                    @php
                                        $pro = App\Models\products::where('id', $cat->product_id)->first();
                                        $proVarient = App\Models\ProductVarient::where(
                                            'id',
                                            $cat->product_varient_id,
                                        )->first();
                                    @endphp
                                    <tr class="align-items-center">
                                        <td
                                            class="d-flex align-items-center border-top-0 border-bottom px-0 py-6 text-center">
                                            <div class="imgHolder text-center">
                                                <img src="{{ env('MAIN_URL') }}images/{{ $pro->product_image }}"
                                                    alt="image description" class="img-fluid">
                                            </div>
                                            <span class="title pl-2"><a href="">{{ $pro->pro_name }}</a></span>

                                        </td>
                                        <td class="fwEbold border-top-0 border-bottom px-0 py-6 text-center">
                                            {{ $proVarient->offer_price }}
                                        </td>
                                        <td class="border-top-0 border-bottom px-0 py-6 pbtn text-center"><input
                                                type="number" class="qty-input" data-cart-id="{{ $cat->id }}"
                                                data-price="{{ $pro->product_regular_price }}"
                                                value="{{ $cat->product_quantity }}">
                                        </td>
                                        <td class="fwEbold border-top-0 border-bottom px-0 py-6 total-price text-center"
                                            id="total-{{ $cat->id }}">
                                            <span class="price-val">{{ $proVarient->offer_price }}</span> ₹
                                            <a href="javascript:void(0);" class="fas fa-times float-right removecart"
                                                data-id="{{ $pro?->id }}" data-user_id="{{ Auth::User()->id }}"></a>
                                        </td>


                                        <input type="hidden" value="{{ $pro->id }}" name="proid[]" class="user_id">
                                        <input type="hidden" value="{{ $proVarient->id }}" name="pro_ver_id[]"
                                            class="user_id">
                                        <input type="hidden" value="{{ $pro->product_image }}" name="product_image[]"
                                            class="imgHolder">
                                        <input type="hidden" value="{{ $pro->product_name }}" name="product_name[]"
                                            class="">
                                        <input type="hidden" value="{{ $proVarient->offer_price }}" name="regularprice[]"
                                            class="">
                                        <input type="hidden" value="{{ $cat->total_price }}" name="totalprice[]"
                                            class="total-price">
                                        <input type="hidden" value="{{ $cat->product_quantity }}" class="qty-input"
                                            name="product_quantity[]">
                                    </tr>
                                @endforeach
                            </tbody>
                        @else
                            <tr>
                                <td colspan="4" class="text-center">Your cart is empty.</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>

            @if ($cart->isNotEmpty())
                <div class="row">
                    <div class="col-12">
                        <!-- <form action="javascript:void(0);" class="cartForm mb-5"> -->
                        {{-- <div class="form-group mb-0">
							<label for="note" class="fwEbold text-uppercase d-block mb-1">Add note</label>
							<textarea id="note" class="form-control"></textarea>
						</div> --}}
                        <!-- </form> -->
                    </div>

                    <div class="col-12 col-md-6">
                        <!-- <form action="javascript:void(0);" class="couponForm mb-md-0 mb-5"> -->
                        {{-- <fieldset>
                            <div class="mt-holder d-inline-block align-bottom mr-lg-5 mr-0 mb-lg-0 mb-2">
                                <label for="code" class="fwEbold text-uppercase d-block mb-1">Promo code</label>
                                <input type="text" id="code" class="form-control">
                            </div>
                            <button type="submit"
                                class="btn btnTheme btnCart fwEbold text-center text-white md-round py-3 px-4 py-md-3 px-md-4">Apply</button>
                        </fieldset> --}}
                        <!-- </form> -->
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="d-flex justify-content-between">
                            <strong class="txt fwEbold text-uppercase mb-1">Subtotal</strong>
                            <strong class="price fwEbold text-uppercase mb-1" id="subtotal">0 ₹</strong>
                            <input class="price" type="hidden" id="subtotal-hidden" name="subtotal">
                        </div>

                        <button type="submit"
                            class="btn btnTheme btnCart fwEbold text-center text-white md-round py-3 px-4 py-md-3 px-md-4">Checkout</button>
                    </div>
                </div>
            @endif
        </form>
    </div>


@endsection
