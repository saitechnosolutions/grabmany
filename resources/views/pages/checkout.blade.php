@extends('layouts.default')
@section('main-content')
    <style>
        input.form-control,
        select.form-select {
            padding: 10px;
            font-size: 16px;
        }

        h5 {
            font-weight: 600;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
            margin-bottom: 20px;
        }

        .form-control {
            background-color: #fff !important;
        }
    </style>

    <div class="container-fluid my-4 sec-pad px-5">
        @if (isset($checkout))
            @php
                $subTotal = $checkout['subtotal'];
                $total = number_format($subTotal + 0, 2);
                $productSalep = $checkout['regularprice'];
                $ProductId = $checkout['proid'];
            @endphp

            <form id="checkOutMM" enctype="multipart/form-data">
                <div class="row">
                    <!-- Billing Address -->
                    <div class="col-md-6 shibill">
                        <h5 class="mb-3">Billing Address</h5>
                        <div class="mb-3">
                            <input type="text" class="form-control name_bill" name="customer_name" placeholder="Full Name"
                                value="{{ Auth::user()->name ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control address_bill" name="customer_address"
                                placeholder="Street Address">
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control email_bill" name="customer_email"
                                placeholder="Email Address" value="{{ Auth::user()->email ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <input type="tel" class="form-control number_bill" name="customer_phone_number"
                                placeholder="Phone Number" value="{{ Auth::user()->phone ?? '' }}">
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
                            <input type="text" class="form-control zip_bill" name="customer_postal_code"
                                placeholder="Postcode / Zip">
                        </div>

                        <!-- Shipping Address Toggle -->
                        <p id="ship-to-different-address">
                            <input id="ship-to-different-address-checkbox" type="checkbox" name="ship_to_different_address"
                                value="1">
                            <label for="ship-to-different-address-checkbox">
                                Billing and Shipping Address are Same
                                <span class="checkmark"></span>
                            </label>
                        </p>

                        <!-- Shipping Address -->
                        <div class="ship-form">
                            <h5 class="mb-3">Shipping Address</h5>
                            <div class="mb-3">
                                <input type="text" class="form-control name_ship" name="customer_shippingname"
                                    placeholder="Full Name">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control address_ship" name="customer_shippingaddress"
                                    placeholder="Street Address">
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control email_ship" name="customer_shippingemail"
                                    placeholder="Email Address">
                            </div>
                            <div class="mb-3">
                                <input type="tel" class="form-control number_ship" name="customer_shippingphone"
                                    placeholder="Phone Number">
                            </div>
                            <div class="mb-3">
                                <select class="form-control state_ship" id="state_ship" name="customer_shippingstate">
                                    <option value="">Select State</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <select class="form-control city_ship" id="city_ship" name="customer_shippingcity">
                                    <option value="">Select City</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control zip_ship" name="customer_shippingpostal_code"
                                    placeholder="Postcode / Zip">
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="col-lg-6 col-md-6">
                        <div class="your-order mb-30">
                            <h3>Your order</h3>
                            <div class="your-order-table table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="product-name">Product</th>
                                            <th class="product-image">Image</th>
                                            <th class="product-image">Product Price</th>
                                            <th class="product-total">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($checkout['product_name'] as $index => $product_name)
                                            @php
                                                $product_image = $checkout['product_image'][$index];
                                                $qty = $checkout['product_quantity'][$index];
                                                $price = $checkout['regularprice'][$index];
                                                $prodTotal = $checkout['totalprice'][$index];
                                            @endphp
                                            <tr class="cart_item">
                                                <td class="product-name">
                                                    {{ is_array($product_name) ? $product_name['product_name'] ?? 'Unnamed Product' : $product_name }}
                                                    <strong class="product-quantity"> x
                                                        {{ is_array($qty) ? implode(',', $qty) : $qty }}</strong>
                                                </td>
                                                <td class="product-image">
                                                    <img src="{{ env('MAIN_URL') }}images/{{ is_array($product_image) ? $product_image['image'] ?? 'noimage.jpg' : $product_image }}"
                                                        alt="{{ is_array($product_name) ? $product_name['product_name'] ?? 'Product' : $product_name }}"
                                                        style="width: 60px;">
                                                </td>
                                                <td class="product-price">
                                                    ₹{{ is_array($price) ? implode(',', $price) : $price }}
                                                </td>

                                                <td class="product-total">
                                                    <span class="amount"> ₹{{ $prodTotal }} </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="cart-subtotal">
                                            <th>Cart Subtotal</th>
                                            <td></td>
                                            <td><span class="amount cart_total"> ₹{{ $subTotal }} </span>
                                                <input type="hidden" class="amount" name="cart_total"
                                                    value="{{ $subTotal }}">
                                            </td>
                                        </tr>
                                        <tr class="shipping">
                                            <th>Shipping</th>
                                            <td></td>
                                            <td><span class="amount shipingamt" id="shippingamt"> ₹50 </span>
                                            </td>
                                        </tr>
                                        <tr class="order-total">
                                            <th>Order Total</th>
                                            <td></td>
                                            <td>₹<strong><span class="amount total"> {{ $total }} </span></strong>
                                                <input type="hidden" class="amount total-hidden" name="total"
                                                    id="" value="{{ $total }} ">
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                                @foreach ($checkout['proid'] as $key => $product)
                                    <input type="hidden" name="ProductId[]" value="{{ $checkout['proid'][$key] }}">
                                    <input type="hidden" name="Product_ver_Id[]"
                                        value="{{ $checkout['pro_ver_id'][$key] }}">
                                    <input type="hidden" name="productSalep[]"
                                        value="{{ $checkout['regularprice'][$key] }}">
                                    <input type="hidden" name="productFinalProName[]"
                                        value="{{ $checkout['product_name'][$key] }}">
                                    <input type="hidden" name="productCartProTotal[]"
                                        value="{{ $checkout['totalprice'][$key] }}">
                                    <input type="hidden" name="productFinalQuantity[]"
                                        value="{{ $checkout['product_quantity'][$key] }}">
                                @endforeach
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="row mt-3">
                    <div class="col text-center">
                        <button class="btn btnTheme  fwEbold text-white py-3 px-4" type="submit">Proceed to
                            Checkout</button>
                    </div>
                </div>
            </form>
        @else
            <p>No data found</p>
        @endif
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function updateTotal() {
                let totalPrice = parseFloat({{ $subTotal ?? '' }}); // from PHP

                // Extract numeric value from shipping text
                let shippingText = $("#shippingamt").text().trim();
                let shippingAmt = parseFloat(shippingText.replace(/[^\d.-]/g, '')) || 0;

                let newTotal = totalPrice + shippingAmt;

                // Update the text content of .total span
                $(".total").text(newTotal.toFixed(2));
                $(".total-hidden").text(newTotal.toFixed(2));
            }

            updateTotal(); // Call on page load
        });
    </script>

@endsection
@section('scripts')
@endsection
