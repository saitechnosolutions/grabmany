@extends('layouts.default')
@section('main-content')

    <style>
        .form-control {
            display: block;
            width: 60%;
            height: 37px;
            padding: 5px 7px;
            font-size: -0.0625rem;
            font-weight: 400;
            line-height: 1;
            color: #343a40;
            background-color: transparent !important;
            background-clip: padding-box;
            border: 1px solid #1d1d1d;
            border-radius: 10px;
            -webkit-box-shadow: none;
            box-shadow: none;
            -webkit-transition: border-color 0.3s ease, -webkit-box-shadow 0.3s ease;
            transition: border-color 0.3s ease, -webkit-box-shadow 0.3s ease;
            -o-transition: border-color 0.3s ease, box-shadow 0.3s ease;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            transition: border-color 0.3s ease, box-shadow 0.3s ease, -webkit-box-shadow 0.3s ease;
        }

        .card:hover {
            filter: drop-shadow(0px 2px 3px #01236a);
        }
    </style>
    <!-- twoColumns -->
    <div class="twoColumns container-fluid   pt-md-16 pb-md-4 pt-10 pb-4 px-5">
        <div class="row">
            <div class="col-lg-12">
                <header class="show-head d-flex flex-wrap justify-content-between mb-7">
                    <ul class="list-unstyled viewFilterLinks d-flex flex-nowrap align-items-center">
                    </ul>
                    <div class="sortGroup">
                        <div class="d-flex flex-nowrap align-items-center">
                            <strong class="groupTitle mr-2">Sort by:</strong>
                            <div class="shop-sort">
                                <select class="form-select form-control orderby" id="product_sort_filter" name="orderby"
                                    aria-label="Sort select example">
                                    <option value="menu_order" selected="selected">Default Sorting</option>
                                    <option value="1">Sort by latest</option>
                                    <option value="2">Sort by price: low to high</option>
                                    <option value="3">Sort by price: high to low</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </header>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-lg-3 p-4 sm-mb-4"
                style="border:1px solid #f9f9f9; border-radius:16px; background-color: #f9f9f9;">
                <!-- Product Categories -->
                <section class="widget mb-5">
                    <h5 class="fw-bold text-uppercase mb-4" style="color:#095256;" style="">Product Categories</h5>
                    <form id="categoryFilter">
                        <div class="form-check mb-2">
                            <input class="form-check-input category-radio" type="radio" name="category" id="cat_all"
                                value="all" checked>
                            <label class="form-check-label" for="cat_all">All</label>
                        </div>
                        @php
                            $cat = App\Models\category::join('products', 'products.category_id', '=', 'categories.id')
                                ->select(
                                    'categories.id',
                                    'categories.category_name',
                                    DB::raw('COUNT(products.id) as product_count'),
                                )
                                ->groupBy('categories.id', 'categories.category_name')
                                ->get();
                        @endphp

                        @foreach ($cat as $category)
                            <div class="form-check mb-2">
                                <input class="form-check-input category-radio" type="radio" name="category"
                                    id="cat_{{ $category->id }}" value="{{ $category->id }}">
                                <label class="form-check-label d-flex justify-content-between align-items-center"
                                    for="cat_{{ $category->id }}">
                                    {{ $category->category_name }}
                                    <span class="badge bg-secondary text-white">{{ $category->product_count }}</span>
                                </label>
                            </div>
                        @endforeach
                    </form>
                </section>

                <!-- Price Filter -->
                <section class="widget">
                    <h5 class="fw-bold text-uppercase mb-4" style="color:#095256;">Filter by Price</h5>
                    <div class="price-range-section">
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <input type="number" class="form-control" id="prod_price_filter_min" placeholder="Min">
                            </div>
                            <div class="col-6">
                                <input type="number" class="form-control" id="prod_price_filter_max" placeholder="Max">
                            </div>
                        </div>
                        <button class="btn btn-dark w-100" id="prod_price_filter">Apply Filter</button>
                    </div>
                </section>
            </div>

            <div class="col-lg-9">
                @if ($products->count())
                    <div class="row" id="product-container">
                        @foreach ($products as $product)
                            <div class="col-lg-4 mt-3 col-12 col-sm-6  featureCol mb-7 produc"
                                data-cat="{{ $product->category_id }}" data-price="{{ $product->product_regular_price }}"
                                data-date="{{ $product->created_at }}">
                                @php

                                    $firstVarient = \App\Models\ProductVarient::where(
                                        'product_id',
                                        $product->id,
                                    )->first();
                                @endphp
                                <div class="card" style="height:480px">
                                    <div class="card-header bg-transparent text-right">
                                        <a href="/product-details/{{ $product->prod_unique_name }}"><img
                                                src="{{ env('MAIN_URL') }}images/{{ $product->product_image }}" class="card-img-top"
                                                alt="Prod Image" style="object-fit:contain;height:300px;"></a>
                                    </div>


                                    <div class="card-body">
                                        <h5 class="card-title text-center"><a
                                                href="/product-details/{{ $product->prod_unique_name }}">{{ $product->product_name }}</a>
                                        </h5>
                                        <div class="row">
                                            <div class="col-lg-12 text-center" style="color: #1aad64">
                                                @if ($firstVarient->mrp_price == $firstVarient->offer_price)
                                                    ₹{{ $firstVarient->mrp_price }}
                                                @else
                                                    <del style="color: #004085"> ₹ {{ $firstVarient->mrp_price }}</del>
                                                    ₹{{ $firstVarient->offer_price }}
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-lg-12 text-center" style="display: flex;justify-content: center">
                                                <a href="/product-details/{{ $product->prod_unique_name }}"
                                                    class="btn btnTheme btnShop p-2 text-white w-full">Buy</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        <!-- content -->
    </div>

    {{-- MODAL --}}

    <div class="modal fade" id="prodCartModal" tabindex="-1" aria-labelledby="prodCartModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-5">
                    <div class="d-flex flex-wrap gap-4">
                        <div class="fw-bold text-uppercase me-2" style="margin-right:10px;">Size:
                        </div>
                        <div class="prod_size_append_prod d-flex justify-content-between align-items-center g-4">

                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-4 mt-4">
                        <div class="fw-bold text-uppercase me-2 home_prod_color_title" style="margin-right:10px;">Color:
                        </div>
                        <div class="prod_color_append_home d-flex justify-content-between align-items-center g-4">

                        </div>
                    </div>

                    <input type="hidden" name="prodCartModal_prod_id" id="prodCartModal_prod_id">
                    @if (Auth::check())
                        <input type="hidden" name="prodCartModal_user_id" id="prodCartModal_user_id"
                            value="{{ Auth::user()->id }}">
                    @endif

                    <div class="text-right">
                        <button type="button" class="btn btn-secondary cartModal_close_btn"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary prodCartModal_submit_btn">Submit</button>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script></script>
@endsection