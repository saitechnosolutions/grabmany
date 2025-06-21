@extends('layouts.default')
@section('main-content')

    <style>
        .selectable-card {
            cursor: pointer;
            border: 1px solid #ccc;
            transition: 0.2s;
        }

        .selectable-card.active {
            border: 2px solid #004085;
            /* dark blue */
        }

        .accordion-mode-toggle {
            position: absolute;
            text-align: right;
            max-width: 600px;
            margin: auto;
            margin-bottom: 1em;
            padding: 1.0em;
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 0.5em;
            background: rgba(0, 0, 0, 0.486);
        }

        .accordion-mode-toggle button {
            background: #fff;
            color: Black;
            border: none;
            border-radius: 4px;
            padding: 0.5em 1em;
            font-size: 1em;
            cursor: pointer;
            transition: 600ms;
        }

        .accordion-mode-toggle button:hover {
            background: #ff00006f;
        }

        .accordion {
            max-width: 600px;
            margin: auto;
        }

        .accordion-item {
            border-radius: 0.5em;
            overflow: hidden;
            background: #fff;
            color: #000;
            margin-bottom: 1em;
            min-width: 550px;
        }

        .accordion-header {
            width: 100%;
            text-align: left;
            background: #fff;
            color: #000;
            border: none;
            padding: 1em;
            font-size: 1.1em;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            transition: 300ms;
        }

        .accordion-header:hover {
            background: #004085;
            color: #fff;
        }

        .accordion-header .title {
            flex-grow: 1;
        }

        .accordion-header .triangle {
            padding: 0.5em;
        }

        .accordion-header .triangle {
            transition: transform 300ms ease;
            opacity: 0.25;
        }

        .accordion-header:hover .triangle {
            opacity: 0.5;
        }

        .accordion-header.rotated .triangle {
            transform: rotate(90deg);
            opacity: 1;
        }

        .accordion-content {
            max-height: 0;
            opacity: 0;
            overflow: hidden;
            transition: max-height 400ms ease, opacity 400ms ease;
            padding: 0 1em;
        }

        .accordion-content.show {
            opacity: 1;
            padding: 1em;
        }

        .page-wrapper {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            min-height: 100%;
            padding-bottom: 3em;
        }

        .product_dec_Sec1 {
            display: block;
            /* max-width: 800px; */
            max-width: 681px;
            margin: 1em auto 3em;
        }

        .product_dec_Sec1 a {
            display: block;
            margin-bottom: 15px;
        }

        .product_dec_Sec1 .gallery-top {
            /* height: 392px !important; */
            height: 480px !important;
            border: 1px solid #ebebeb;
            border-radius: 3px;
            margin-bottom: 5px;
        }

        .product_dec_Sec1 .gallery-top .swiper-slide {
            position: relative;
            overflow: hidden;
        }

        .product_dec_Sec1 .gallery-top .swiper-slide a {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
        }

        .product_dec_Sec1 .gallery-top .swiper-slide a img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .product_dec_Sec1 .gallery-top .swiper-slide .easyzoom-flyout img {
            min-width: 100%;
            min-height: 100%;
        }

        .product_dec_Sec1 .swiper-button-next.swiper-button-white,
        .product_dec_Sec1 .swiper-button-prev.swiper-button-white {
            color: #ed4082;

        }

        .product_dec_Sec1 .gallery-thumbs .swiper-slide {
            position: relative;
            transition: border .15s linear;
            border: 1px solid #ebebeb;
            border-radius: 3px;
            cursor: pointer;
            overflow: hidden;
            height: calc(100% - 2px);
        }

        .product_dec_Sec1 .gallery-thumbs .swiper-slide.swiper-slide-thumb-active {
            border-color: #d5829e;
        }

        .product_dec_Sec1 .gallery-thumbs .swiper-slide img {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            max-width: 100%;
            height: 100%;
        }

        .gallery-thumbs .swiper-wrapper {
            flex-direction: row;
            width: 100%;
            margin-right: 0px !important;
        }

        @media (min-width: 480px) {
            .gallery-thumbs .swiper-wrapper {
                flex-direction: column;
            }
        }

        .gallery-top {
            position: relative;
            /* width: 100%; */
            width: 700px;
            height: 75vh;
        }

        @media (min-width: 480px) {
            .gallery-top {
                width: 80%;
                height: 100vh;
                margin-right: 10px;
            }
        }

        .gallery-thumbs {
            /* width: 100%; */
            width: 160px !important;
            height: 25vh;
            padding-top: 10px;
        }

        @media (min-width: 480px) {
            .gallery-thumbs {
                width: 20%;
                height: 100vh;
                padding: 0;
            }
        }

        .gallery-thumbs .swiper-wrapper {
            flex-direction: row;
            width: 160px;
            margin-right: 0px !important;
        }

        @media (min-width: 480px) {
            .gallery-thumbs .swiper-wrapper {
                flex-direction: column;
            }
        }

        .gallery-thumbs .swiper-slide {
            /* width: 25%; */
            width: 60% !important;
            flex-flow: row nowrap;
            height: 100%;
            opacity: 0.75;
            cursor: pointer;
        }

        @media (min-width: 480px) {
            .gallery-thumbs .swiper-slide {
                flex-flow: column nowrap;
                width: 100%;
            }
        }

        .gallery-thumbs .swiper-slide-thumb-active {
            opacity: 1;
        }

        .gallery-top .swiper-wrapper {
            display: flex;
        }

        .gallery-top .swiper-slide {
            flex-shrink: 0;
            width: 100%;
            /* ✅ Full width slide */
            opacity: 0;
            height: auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .gallery-top .swiper-slide.swiper-slide-active {
            opacity: 1;
        }

        .pill-counter-widget {
            max-width: 200px;
            margin-bottom: 20px;
        }

        .pill-counter-widget .btn {
            border-radius: 0;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: bold;
        }

        .pill-counter-widget .btn:first-child {
            border-top-left-radius: 25px;
            border-bottom-left-radius: 25px;
        }

        .pill-counter-widget .btn:last-child {
            border-top-right-radius: 25px;
            border-bottom-right-radius: 25px;
        }

        .pill-counter-widget .form-control {
            border-radius: 0;
            text-align: center;
            height: 50px;
            font-size: 16px;
            font-weight: 500;
            border-left: 0;
            border-right: 0;
        }

        .pill-counter-widget .form-control:focus {
            box-shadow: none;
            border-color: #dee2e6;
        }

        .pill-counter-widget .btn:focus {
            box-shadow: none;
        }

        .custom-order-summary {
            width: 100%;
            border-collapse: collapse;
        }

        .custom-order-summary th,
        .custom-order-summary td {
            border: 1px solid #dee2e6;
            vertical-align: middle;
            padding: 12px;
        }

        .custom-order-summary th {
            background-color: #f8f9fa;
            font-weight: 600;
        }

        .custom-order-summary td.text-end,
        .custom-order-summary th.text-end {
            text-align: right;
        }

        .custom-order-summary tfoot tr td,
        .custom-order-summary tfoot tr th {
            border-top: none;
        }

        .custom-order-summary tfoot tr:last-child {
            border-top: 2px solid #dee2e6;
        }

        .custom-order-summary .amount {
            display: inline-block;
            min-width: 60px;
            text-align: right;
        }
    </style>

    @if ($product_single)
        <!-- twoColumns -->
        <div class="twoColumns container-fluid pt-xl-23 pb-xl-20 pt-lg-20 pb-lg-20 py-md-16 py-10">

            @php
                $firstVarient = \App\Models\ProductVarient::where('product_id', $product_single->id)->first();
                $pro_thu = App\Models\ProductChildImages::where('variant_id', $firstVarient->id)->get();

                $prod_varients = \App\Models\ProductVarient::where('product_id', $product_single->id)->get();

                $groupedVarients = \App\Models\ProductVarient::where('product_id', $product_single->id)
                    ->get()
                    ->groupBy('size_value');

                $desc1 = App\Models\ProductChildImages::where('variant_id', $firstVarient->id)->get();
            @endphp



            <div class="row mb-6">
                <div class="col-12 col-lg-7 order-lg-1">
                    <div class="product_dec_Sec1 sticky-top" style="z-index:10">
                        <div class="swiper-container-wrapper d-flex">
                            <!-- Thumbnail Gallery (Left) -->
                            <div class="swiper-container gallery-thumbs">
                                <div class="swiper-wrapper">
                                    @foreach ($desc1 as $des)
                                        <div class="swiper-slide thump_cus_img">
                                            <img src="{{ env('MAIN_URL') }}images/{{ $des->product_child_image }}"
                                                alt="">
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Main Gallery (Right) -->
                            <div class="swiper-container gallery-top">
                                <div class="swiper-wrapper">
                                    @foreach ($desc1 as $des)
                                        <div class="swiper-slide easyzoom easyzoom--overlay is-ready">
                                            <a href="{{ env('MAIN_URL') }}images/{{ $des->product_child_image }}">
                                                <img src="{{ env('MAIN_URL') }}images/{{ $des->product_child_image }}"
                                                    alt="">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-12 col-lg-5 order-lg-3" style="z-index:50">
                    <!-- productTextHolder -->
                    <div class="productTextHolder overflow-hidden">
                        <div class="row">
                            <div class="col-lg-9">
                                <h2 class="fwEbold mb-2" style="font-family: DMSerifDisplay;font-weight:300;">
                                    {{ $product_single->product_name }}</h2>
                                <h5>
                                    {{ $product_single->product_description }}
                                </h5>
                            </div>
                            <div class="col-lg-3 text-center">
                                @if (Auth::check())
                                    <button class="btn btn-danger p-2" id="add_new_wishlist_submit_prod"
                                        data-product_id="{{ $product_single->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-heart-icon lucide-heart">
                                            <path
                                                d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z" />
                                        </svg>
                                    </button>
                                @else
                                    <a href="/login" class="btn btn-danger p-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-heart-icon lucide-heart">
                                            <path
                                                d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z" />
                                        </svg></a>
                                @endif

                            </div>
                        </div>


                        <strong class="price d-block mb-5 text-green">₹
                            {{ $firstVarient->mrp_price }}</strong>

                        <div class="d-flex flex-wrap gap-4">
                            <div class="fw-bold text-uppercase me-2" style="margin-right:10px;">Size:
                            </div>
                            @foreach ($groupedVarients as $size => $variants)
                                @php
                                    $variant = $variants->first();
                                    $available = $variant->product_qty > 0;
                                @endphp

                                <div class="selectable-card rounded text-center p-2 me-2 prod_size_select"
                                    data-size_value="{{ $size }}" data-product_id="{{ $variant->product_id }}"
                                    style="width: 100px; {{ $available ? '' : 'color: red;' }} margin-right:5px;">
                                    <div class="fw-bold">{{ $size }}</div>
                                </div>
                            @endforeach
                        </div>


                        <div class="d-flex flex-wrap gap-2 mt-2 mb-4">
                            <div class="available_color_title fw-bold text-uppercase me-2"
                                style="display: none;margin-right:10px;">Color:
                            </div>
                            <div class="prod_size_append d-flex flex-wrap gap-2"></div>
                        </div>

                        {{-- <input type="number" placeholder="1" class="input qty-input" id="qty-input" name="prod_qty_input"> --}}
                        <div class="pill-counter-widget">
                            <div class="input-group">
                                <button class="btn btn-outline-secondary" type="button" id="decreaseBtn">−</button>
                                <input type="number" class="form-control" id="quantityInput" value="1" min="0"
                                    max="50">
                                <button class="btn btn-outline-secondary" type="button" id="increaseBtn">+</button>
                            </div>
                        </div>
                        <div class="row overflow-hidden mb-4 mt-2">
                            @if (Auth::check())
                                <div class="col-lg-6">
                                    <button class="btn btnTheme btnShop fwEbold text-white md-round p-3 addtocart"
                                        data-product_id="{{ $product_single->id }}" data-product_quantity="1"
                                        data-price="{{ $product_single->product_regular_price }}"
                                        data-user_id="{{ Auth::user()->id }}" id="addtocart">Add To Cart
                                        <i class="fas fa-arrow-right ml-2"></i></button>
                                </div>
                                <div class="col-lg-6">
                                    <a href="single_check/{{ $product_single->id }}"
                                        class="btn btnTheme btnShop fwEbold text-white md-round p-3">Buy
                                        <i class="fas fa-arrow-right ml-2"></i></a>
                                </div>
                            @else
                                <div class="col-lg-6">
                                    <a href="/login" class="btn btnTheme btnShop fwEbold text-white md-round p-3">Add
                                        To Cart
                                        <i class="fas fa-arrow-right ml-2"></i></a>
                                </div>
                                <div class="col-lg-6">
                                    <form action="" method="post" id="single_prod_checkout">
                                        <input type="hidden" name="checkout_prod_price"
                                            value="{{ $firstVarient->mrp_price }}" id="checkout_prod_price">
                                        <input type="hidden" name="checkout_prod_varient_id" value=""
                                            id="hidden_prod_varient_id">
                                        <input type="hidden" name="checkout_prod_varient_color" value=""
                                            id="hidden_prod_varient_color">
                                        <input type="hidden" name="checkout_prod_varient_size" value=""
                                            id="hidden_prod_varient_size">
                                        <input type="hidden" name="checkout_prod_varient_qty" value=""
                                            id="hidden_prod_varient_qty">
                                        <input type="hidden" name="checkout_prod_id" value="{{ $firstVarient->id }}"
                                            id="checkout_prod_id">
                                        <button type="submit"
                                            class="btn btnTheme btnShop fwEbold text-white md-round p-3">
                                            Buy
                                            <i class="fas fa-arrow-right ml-2"></i>
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>


                        <div class="page-wrapper">

                            <div class="accordion" data-mode="single">
                                <div class="accordion-item">
                                    <button class="accordion-header">
                                        <span class="title">Brand</span><span class="triangle">▶</span>
                                    </button>
                                    <div class="accordion-content">
                                        <p>
                                            {{ $product_single->brand_name }}
                                        </p>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <button class="accordion-header">
                                        <span class="title">Material</span><span class="triangle">▶</span>
                                    </button>
                                    <div class="accordion-content">
                                        <p>
                                            {{ $product_single->brand_material }}
                                        </p>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <button class="accordion-header">
                                        <span class="title">Description</span><span class="triangle">▶</span>
                                    </button>
                                    <div class="accordion-content">
                                        <p>
                                            {{ $product_single->product_specification }}
                                        </p>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <button class="accordion-header">
                                        <span class="title">Size Chart</span><span class="triangle">▶</span>
                                    </button>
                                    <div class="accordion-content">
                                        <p>
                                            <!--{{ $product_single->product_description }}-->
                                            <img src="{{ env('MAIN_URL') }}images/{{ $product_single->size_chart_image }}"
                                                alt="image" class="img-fluid">
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <ul class="list-unstyled socialNetwork d-flex flex-wrap mb-sm-11 mb-4">
                            <li class="text-uppercase mr-5">SHARE THIS PRODUCT:</li>
                            <li class="mr-4"><a href="javascript:void(0);" class="fab fa-facebook-f"></a></li>
                            <li class="mr-4"><a href="javascript:void(0);" class="fab fa-google-plus-g"></a></li>
                            <li class="mr-4"><a href="javascript:void(0);" class="fab fa-twitter"></a></li>
                            <li class="mr-4"><a href="javascript:void(0);" class="fab fa-pinterest-p"></a></li>
                        </ul>

                    </div>
                </div>
            </div>
            @if (Auth::check())
                <input type="hidden" value="{{ Auth::user()->id }}" id="logged_user_id">
            @else
                <input type="hidden" value="" id="logged_user_id">
            @endif

        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul class="list-unstyled tabSetList d-flex justify-content-center mb-9">
                        <li>
                            <a href="#tab2-0" class="playfair fwEbold pb-2">Reviews ( 2 )</a>
                        </li>
                    </ul>
                    <div class="tab-content mb-xl-11 mb-lg-10 mb-md-8 mb-5">
                        <div id="tab2-0">
                            <p>No Reviews Yet</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <section class="featureSec container overflow-hidden pt-xl-12 pb-xl-29 pt-lg-10 pb-lg-14 pt-md-8 pb-md-10 py-5">
        <div class="row">
            <!-- mainHeader -->
            <header class="col-12 mainHeader mb-5 text-center">
                <h1 class="headingIV fwEblod mb-4" style="font-family: DMSerifDisplay;font-weight:300;">Related products
                </h1>
            </header>
        </div>
        <div class="row">
            <!-- featureCol -->
            @php
                $prod = App\Models\products::where('id', '!=', $product_single->id)
                    ->where('category_id', $product_single->category_id)
                    ->get();
            @endphp
            @foreach ($prod as $product)
                <div class="col-lg-3">
                    <div class="card" style="border-radius: 15px">
                        <div class="card-header bg-transparent text-right">
                            <!--<button class="" style="background:none;border:none;">-->
                            <!--    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"-->
                            <!--        viewBox="0 0 24 24" fill="none" stroke="#a31621" stroke-width="2"-->
                            <!--        stroke-linecap="round" stroke-linejoin="round"-->
                            <!--        class="lucide lucide-heart-icon lucide-heart">-->
                            <!--        <path-->
                            <!--            d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z" />-->
                            <!--    </svg>-->
                            <!--</button>-->
                            <a href="/product-details/{{ $product->prod_unique_name }}"><img
                                    src="{{ env('MAIN_URL') }}images/{{ $product->product_image }}" class="card-img-top"
                                    alt="Prod Image"></a>
                        </div>


                        <div class="card-body">
                            <h5 class="card-title text-center"><a
                                    href="/product-details/{{ $product->prod_unique_name }}">{{ $product->product_name }}</a>
                            </h5>
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    @if ($firstVarient->mrp_price == $firstVarient->offer_price)
                                        ₹{{ $firstVarient->mrp_price }}
                                    @else
                                        <del> ₹ {{ $firstVarient->mrp_price }}</del>
                                        ₹{{ $firstVarient->offer_price }}
                                    @endif
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-12">
                                    <!--<button class="btn btnTheme btnShop p-2 text-white w-full" style="min-width:270px">-->
                                    <!--     Add to Cart                -->
                                    <!-- </button> -->
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
        </div>
        @endforeach
        </div>

        {{-- *CHECKOUT MODAL --}}

        <div class="modal fade" id="staticBackdropcheckout" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropcheckoutLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropcheckoutLabel">Order Details</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="checkOutMM" enctype="multipart/form-data">
                            <div class="single_checkout_step_one">
                                @if (Auth::check())
                                    <div class="row">
                                        <div class="col-md-12 shibill">
                                            <h5 class="mb-3">Billing Address</h5>
                                            <div class="mb-3">
                                                <input type="text" class="form-control name_bill" name="customer_name"
                                                    placeholder="Full Name" value="{{ Auth::user()->name ?? '' }}">
                                            </div>
                                            <div class="mb-3">
                                                <input type="text" class="form-control address_bill"
                                                    name="customer_address" placeholder="Street Address">
                                            </div>
                                            <div class="mb-3">
                                                <input type="email" class="form-control email_bill"
                                                    name="customer_email" placeholder="Email Address"
                                                    value="{{ Auth::user()->email ?? '' }}">
                                            </div>
                                            <div class="mb-3">
                                                <input type="tel" class="form-control number_bill"
                                                    name="customer_phone_number" placeholder="Phone Number"
                                                    value="{{ Auth::user()->phone ?? '' }}">
                                            </div>
                                            <div class="mb-3">
                                                <select class="form-control state_bill" name="customer_state">
                                                    <option value="">Select State</option>
                                                    @php $states = App\Models\state::all(); @endphp
                                                    @foreach ($states as $state)
                                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <select class="form-control city_bill" name="customer_city">
                                                    <option value="">Select City</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <input type="text" class="form-control zip_bill"
                                                    name="customer_postal_code" placeholder="Postcode / Zip">
                                            </div>

                                            <!-- Shipping Address Toggle -->
                                            <p id="ship-to-different-address">
                                                <input id="ship-to-different-address-checkbox" type="checkbox"
                                                    name="ship_to_different_address" value="1">
                                                <label for="ship-to-different-address-checkbox">
                                                    Billing and Shipping Address are Same
                                                    <span class="checkmark"></span>
                                                </label>
                                            </p>

                                            <!-- Shipping Address -->
                                            <div class="ship-form">
                                                <h5 class="mb-3">Shipping Address</h5>
                                                <div class="mb-3">
                                                    <input type="text" class="form-control name_ship"
                                                        name="customer_shippingname" placeholder="Full Name">
                                                </div>
                                                <div class="mb-3">
                                                    <input type="text" class="form-control address_ship"
                                                        name="customer_shippingaddress" placeholder="Street Address">
                                                </div>
                                                <div class="mb-3">
                                                    <input type="email" class="form-control email_ship"
                                                        name="customer_shippingemail" placeholder="Email Address">
                                                </div>
                                                <div class="mb-3">
                                                    <input type="tel" class="form-control number_ship"
                                                        name="customer_shippingphone" placeholder="Phone Number">
                                                </div>
                                                <div class="mb-3">
                                                    <select class="form-control state_ship" id="state_ship"
                                                        name="customer_shippingstate">
                                                        <option value="">Select State</option>
                                                        @foreach ($states as $state)
                                                            <option value="{{ $state->id }}">{{ $state->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <select class="form-control city_ship" id="city_ship"
                                                        name="customer_shippingcity">
                                                        <option value="">Select City</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <input type="text" class="form-control zip_ship"
                                                        name="customer_shippingpostal_code" placeholder="Postcode / Zip">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                @else
                                    <div class="row p-3">
                                        <div class="col-md-6 shibill">
                                            <h5 class="mb-3">Billing Address</h5>
                                            <div class="mb-3">
                                                <input type="text" class="form-control name_bill" name="customer_name"
                                                    placeholder="Full Name" value="">
                                            </div>
                                            <div class="mb-3">
                                                <input type="email" class="form-control email_bill"
                                                    name="customer_email" placeholder="Email Address" value="">
                                            </div>
                                            <div class="mb-3">
                                                <input type="tel" class="form-control number_bill"
                                                    name="customer_phone_number" placeholder="Phone Number"
                                                    value="">
                                            </div>
                                            <div class="mb-3">
                                                <input type="text" class="form-control address_bill"
                                                    name="customer_address" placeholder="Street Address">
                                            </div>
                                            <div class="mb-3">
                                                <select class="form-control state_bill" name="customer_state">
                                                    <option value="">Select State</option>
                                                    @php $states = App\Models\state::all(); @endphp
                                                    @foreach ($states as $state)
                                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <select class="form-control city_bill" name="customer_city">
                                                    <option value="">Select City</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <input type="text" class="form-control zip_bill"
                                                    name="customer_postal_code" placeholder="Postcode / Zip">
                                            </div>

                                            <!-- Shipping Address Toggle -->
                                            <p id="ship-to-different-address">
                                                <input id="ship-to-different-address-checkbox" type="checkbox"
                                                    name="ship_to_different_address" value="1">
                                                <label for="ship-to-different-address-checkbox">
                                                    Billing and Shipping Address are Same
                                                    <span class="checkmark"></span>
                                                </label>
                                            </p>

                                        </div>

                                        <div class="col-lg-6">
                                            <div class="ship-form">
                                                <h5 class="mb-3">Shipping Address</h5>
                                                <div class="mb-3">
                                                    <input type="text" class="form-control name_ship"
                                                        name="customer_shippingname" placeholder="Full Name">
                                                </div>
                                                <div class="mb-3">
                                                    <input type="email" class="form-control email_ship"
                                                        name="customer_shippingemail" placeholder="Email Address">
                                                </div>
                                                <div class="mb-3">
                                                    <input type="tel" class="form-control number_ship"
                                                        name="customer_shippingphone" placeholder="Phone Number">
                                                </div>
                                                <div class="mb-3">
                                                    <input type="text" class="form-control address_ship"
                                                        name="customer_shippingaddress" placeholder="Street Address">
                                                </div>
                                                <div class="mb-3">
                                                    <select class="form-control state_ship" id="state_ship"
                                                        name="customer_shippingstate">
                                                        <option value="">Select State</option>
                                                        @foreach ($states as $state)
                                                            <option value="{{ $state->id }}">{{ $state->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <select class="form-control city_ship" id="city_ship"
                                                        name="customer_shippingcity">
                                                        <option value="">Select City</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <input type="text" class="form-control zip_ship"
                                                        name="customer_shippingpostal_code" placeholder="Postcode / Zip">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif


                                <!-- Submit Button -->
                                <div class="row mt-3">
                                    <div class="col text-center">
                                        <button class="btn btnTheme  fwEbold text-white py-3 px-4" type="button"
                                            id="proceed_second_checkout_step">Proceed
                                            to
                                            Checkout</button>
                                    </div>
                                </div>
                            </div>

                            <div class="single_checkout_step_two">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="your-order mb-30">
                                            <div class="row mt-2 mb-4">
                                                <div class="col-lg-6 single_check_billing_details">

                                                </div>
                                                <div class="col-lg-6 single_check_shipping_details">

                                                </div>
                                            </div>
                                            <div class="">
                                                <table class="table table-bordered custom-order-summary">
                                                    <thead class="align-middle">
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Image</th>
                                                            <th>Product Price</th>
                                                            <th>Quantity</th>
                                                            <th>Color</th>
                                                            <th>Size</th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- Dynamic rows will be appended via JavaScript -->
                                                    </tbody>
                                                    <tfoot class="align-middle">
                                                        <tr style="border: none;">
                                                            <td colspan="5" style="border: none"></td>
                                                            <th class="text-center">Subtotal</th>
                                                            <td class="text-end">
                                                                <span class="amount cart_total">₹0</span>
                                                                <input type="hidden" class="amount" name="cart_total"
                                                                    value="">
                                                            </td>
                                                        </tr>
                                                        <tr style="border: none;">
                                                            <td colspan="5" style="border: none"></td>
                                                            <th class="text-center">Shipping</th>
                                                            <td class="text-end">
                                                                <span class="amount shipingamt"
                                                                    id="shippingamt">₹50</span>
                                                            </td>
                                                        </tr>
                                                        <tr style="border-top: none;">
                                                            <td colspan="5" style="border: none"></td>
                                                            <th class="text-center">
                                                                <h5 class="m-0">Order Total</h5>
                                                            </th>
                                                            <td class="text-end">
                                                                <h5 class="m-0"><strong><span
                                                                            class="amount total">₹0</span></strong></h5>
                                                                <input type="hidden" class="amount total-hidden"
                                                                    name="total" value="">
                                                            </td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-lg-4"></div>
                                                <div class="col-lg-4 text-center">
                                                    <button class="btn btnTheme  fwEbold text-white py-3 px-4"
                                                        type="submit" style="max-width: 230px">Pay Now</button>
                                                </div>
                                                <div class="col-lg-4"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $(document).on("click", '#add_new_wishlist_submit_prod', function() {

                var product_main_id = $(this).data("product_id");
                var user_id = $("#logged_user_id").val();
                var productqty = $('#qty-input').val() || 1;

                var size_value = $(".prod_size_select.active").data("size_value");
                var color_value = $(".prod_color_select.active").data("color");

                if (!size_value || !color_value) {
                    Swal.fire({
                        icon: "warning",
                        title: "Select Size & Color",
                        text: "Please select both size and color before adding to wishlist.",
                    });
                    return;
                }

                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });

                $.ajax({
                    url: "/wishlist/store",
                    type: "POST",
                    data: {
                        product_main_id: product_main_id,
                        user_id: user_id,
                        productqty: productqty,
                        size_value: size_value,
                        color_value: color_value,
                    },
                    success: function(response) {
                        if (response.status == 200) {
                            Swal.fire("Success", "Product Added To Wishlist", "success");

                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 1500,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.onmouseenter = Swal.stopTimer;
                                    toast.onmouseleave = Swal.resumeTimer;
                                },
                            });

                            Toast.fire({
                                icon: "success",
                                title: "Product Added To Wishlist",
                            });

                            setTimeout(function() {
                                window.location.reload();
                            }, 1500);
                        } else {
                            Swal.fire({
                                icon: "info",
                                text: "This product is already in the Wishlist",
                            });
                        }
                    },
                });
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('.available_color_title').hide();

            // Handle size selection
            $(document).on('click', '.prod_size_select', function() {
                // Remove previous selection
                $('.prod_size_select').removeClass('active');
                $(this).addClass('active');

                let size_value = $(this).data('size_value');
                let prod_id = $(this).data('product_id');

                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });

                $.ajax({
                    url: "/product/fetchcolordetails",
                    type: "POST",
                    data: {
                        size_value: size_value,
                        prod_id: prod_id,
                    },
                    success: function(response) {
                        let colorHtml = '';

                        if (response.status == 200 && response.products.length > 0) {
                            $.each(response.products, function(index, product) {
                                colorHtml += `
                                <div class="selectable-card rounded prod_color_select"
                                    data-color="${product.color_value}"
                                    style="
                                        width: 50px;
                                        height: 50px;
                                        background-color: ${product.color_value};
                                        margin-right: 5px;">
                                </div>
                            `;
                            });
                            $('.available_color_title').show();
                            $('#hidden_prod_varient_size').val(size_value);
                        } else {
                            colorHtml = `<div class="text-danger">No Available Colors</div>`;
                            $('.available_color_title').hide();
                        }

                        $('.prod_size_append').html(colorHtml);
                    }
                });
            });

            // Handle color selection
            $(document).on('click', '.prod_color_select', function() {
                $('.prod_color_select').removeClass('active');
                $(this).addClass('active');
                var color_value = $(".prod_color_select.active").data("color");
                $('#hidden_prod_varient_color').val(color_value);
            });
        });
    </script>

    <script>
        $(document).on("click", "#addtocart", function(e) {
            e.preventDefault();

            var product_id = $(this).data("product_id");
            var user_id = $("#logged_user_id").val();
            var price = $(this).data("price");
            var product_quantity = $("#qty-input").val() || 1;

            var size_value = $(".prod_size_select.active").data("size_value");
            var color_value = $(".prod_color_select.active").data("color");

            if (!size_value || !color_value) {
                Swal.fire({
                    icon: "warning",
                    title: "Select Size & Color",
                    text: "Please select both size and color before adding to wishlist.",
                });
                return;
            }

            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                url: "/cart/store",
                type: "POST",
                data: {
                    product_id: product_id,
                    user_id: user_id,
                    product_quantity: product_quantity,
                    size_value: size_value,
                    color_value: color_value,
                },
                dataType: "JSON",
                success: function(result) {
                    if (result.status == 200) {
                        Swal.fire("Success", "Product Added To Cart", "success");

                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            },
                        });

                        Toast.fire({
                            icon: "success",
                            title: "Product Added To Cart",
                        });

                        setTimeout(function() {
                            window.location.reload();
                        }, 1500);
                    } else {
                        Swal.fire({
                            icon: "warning",
                            title: "Already Added!",
                            text: `This item is already in your cart.`,
                            confirmButtonColor: "#28a745",
                        });
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Failed to add item to cart.",
                        confirmButtonColor: "#dc3545",
                    });
                },
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const accordion = document.querySelector('.accordion');
            const headers = accordion.querySelectorAll('.accordion-header');
            const toggleBtn = document.getElementById('modeToggle');

            function closeAll() {
                accordion.querySelectorAll('.accordion-item').forEach(item => {
                    const content = item.querySelector('.accordion-content');
                    content.style.maxHeight = '0px';
                    content.classList.remove('show');
                    item.querySelector('.accordion-header').classList.remove('rotated');
                });
            }

            function handleHeaderClick(header) {
                const item = header.parentElement;
                const content = item.querySelector('.accordion-content');
                const isOpen = content.classList.contains('show');
                const mode = accordion.dataset.mode;

                if (mode === 'single') closeAll();

                if (isOpen) {
                    content.style.maxHeight = content.scrollHeight + 'px';
                    requestAnimationFrame(() => {
                        content.style.maxHeight = '0px';
                    });
                } else {
                    content.style.maxHeight = content.scrollHeight + 'px';
                }

                content.classList.toggle('show', !isOpen);
                header.classList.toggle('rotated', !isOpen);
            }

            headers.forEach(header => {
                header.addEventListener('click', () => handleHeaderClick(header));
            });

            toggleBtn.addEventListener('click', () => {
                const isSingle = accordion.dataset.mode === 'single';
                accordion.dataset.mode = isSingle ? 'multiple' : 'single';
                // toggleBtn.textContent = isSingle ? 'Switch to Single' : 'Switch to Multi';
                toggleBtn.textContent = isSingle ? 'Multiple' : 'Single';

                if (!isSingle) {
                    const openItems = accordion.querySelectorAll('.accordion-content.show');
                    openItems.forEach((content, idx) => {
                        if (idx === 0) return;
                        content.style.maxHeight = '0px';
                        content.classList.remove('show');
                        content.closest('.accordion-item').querySelector('.accordion-header')
                            .classList.remove('rotated');
                    });
                }
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            const yearSpan = document.getElementById('year');
            if (yearSpan) {
                yearSpan.textContent = new Date().getFullYear();
            }
        });
    </script>
@endsection
