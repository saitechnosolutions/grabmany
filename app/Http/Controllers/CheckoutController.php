<?php

namespace App\Http\Controllers;

use App\Models\checkout;
use App\Models\customers;
use App\Models\orderproducts;
use App\Models\ProductOrder;
use App\Models\products;
use App\Models\ProductSlot;
use App\Models\ProductVarient;
use App\Models\state;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Api;
use Razorpay\Api\Product;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $states = state::all();
        $checkout = $request->all();
        return view('pages.checkout', compact('checkout', 'states'));
    }

    public function singlecheckout($id, Request $request)
    {
        $states = state::all();

        // Simulated product fetch – replace with actual product fetch from DB
        $product = products::findOrFail($id);
        // optional

        // Example structure
        $checkout = [
            'subtotal' => $product->product_regular_price, // Assuming 'price' is the field
            'regularprice' => [$product->product_regular_price],
            'proid' => [$product->id],
            'product_name' => [$product->product_name],
            'product_image' => [$product->product_image],
            'product_quantity' => [1],
            'totalprice' => [$product->product_regular_price]
        ];

        return view('pages.checkout', compact('checkout', 'states'));
    }

    public function getStateShipCities($stateid1)
    {

        $cities1 = DB::table('cities')
            ->select('name')
            ->where('state_id', '=', $stateid1)
            ->get();

        return response()->json($cities1);
    }

    public function getStateCities($state_id)
    {
        $cities = DB::table('cities')
            ->select('name')
            ->where('state_id', '=', $state_id)
            ->get();

        return response()->json($cities);
    }

    public function check(Request $request)
    {

        $user_id = null;

        $maxValue = DB::table('order_products')->max('id');
        $invID = ($maxValue !== null) ? $maxValue + 1 : 1;
        $invID = str_pad($invID, 5, '0', STR_PAD_LEFT);
        $order_id = 'PRPROSE' . $invID;

        $ProductFinalTotal = (int)$request->total;

        $customerdetail = new customers();
        $customerdetail->order_id = $order_id;
        $customerdetail->customername = $request->customername;
        $customerdetail->email = $request->email;
        $customerdetail->phone_number = $request->phone_number;
        $customerdetail->address = $request->address;
        $customerdetail->total_price = (int)$request->total;
        $customerdetail->shippingname = $request->shippingname;
        $customerdetail->shippingphone = $request->shippingphone;
        $customerdetail->shippingemail = $request->shippingemail;
        $customerdetail->shippingstate = $request->shippingstate;
        $customerdetail->shippingcity = $request->shippingcity;
        $customerdetail->postal_code = $request->postal_code;
        $customerdetail->shippingpostal_code = $request->shippingpostal_code;
        $customerdetail->shippingaddress = $request->shippingaddress;
        $customerdetail->user_id = Auth::id();
        $customerdetail->state = $request->state;
        $customerdetail->city = $request->city;
        $shippingAmt = 50;
        $customerdetail->shippingamt = $shippingAmt;
        $customerdetail->netamount = (int)$request->total + $shippingAmt;
        //   dd( $customerdetail->netamount = ( int )$request->total );
        $customerdetail->payment_status = 0;
        $customerdetail->delivery_status = 0;
        $customerdetail->order_date = now();
        $customerdetail->shippingamt = 0;

        if ($request->has('loggin')) {
            $user_id = Auth::id();
            $customerdetail->user_id = $user_id;
            for (
                $i = 0;
                $i < count($request->ProductId);
                $i++
            ) {
                $checkoutproducts = new checkout();
                $checkoutproducts->product_id = $request->ProductId[$i];
                $checkoutproducts->user_id = $user_id;
                $checkoutproducts->product_quantity = $request->productFinalQuantity[$i];
                $checkoutproducts->price = $request->productSalep[$i];
                $checkoutproducts->subtotal = (int)$request->productCartProTotal[$i];
                $checkoutproducts->totalprice = (int)$request->total;
                $checkoutproducts->carttotal = (int)$request->subtotal;
                $checkoutproducts->save();

                $orderproducts = new orderproducts();
                $orderproducts->product_id = $request->ProductId[$i];
                $orderproducts->user_id = $user_id;
                $orderproducts->product_quantity = $request->productFinalQuantity[$i];
                $orderproducts->product_price = $request->productSalep[$i];
                $orderproducts->cart_price = (int)$request->productCartProTotal[$i];
                $orderproducts->total_price = (int)$request->total + $shippingAmt;
                $orderproducts->order_id = $order_id;
                $orderproducts->customername = $request->customername;
                $orderproducts->phone_number = $request->phone_number;
                $orderproducts->payment_status = 0;
                $orderproducts->shippingamt = $shippingAmt;
                $orderproducts->netamount = (int)$request->total + $shippingAmt;
                $orderproducts->shippingamt = 0;
                $orderproducts->delivery_status = 0;
                $orderproducts->save();
            }
        }
        $user = new User();

        if ($request->has('guest')) {

            $isUserExist = $user::where('email', $request->input('email_bill'))->first();

            if (!$isUserExist) {
                $user->name = $request->input('name_bill');
                $user->email = $request->input('email_bill');
                $user->phone = $request->input('number_bill');
                $user->password = Hash::make($request->input('password'));
                $user->mode = 'guest';
                $user->save();
                $user_id = $user->id;
                // move after saving

                dd($user_id);
            } else {
                $user_id = $isUserExist->id;
            }

            $checkoutproducts = new checkout();
            $checkoutproducts->product_id = $request->product_id;
            $checkoutproducts->user_id = $user_id;
            $checkoutproducts->product_quantity = $request->product_quantity;
            $checkoutproducts->price = $request->product_regular_price;
            $checkoutproducts->subtotal = $request->totalprice;
            $checkoutproducts->totprice = $request->total;
            $checkoutproducts->carttotal = $request->subtotal;
            $checkoutproducts->save();

            $orderproducts = new orderproducts();
            $orderproducts->product_id = $request->product_id;
            $orderproducts->user_id = $user_id;
            $orderproducts->product_quantity = $request->product_quantity;
            $orderproducts->cart_price = $request->product_regularprice;
            $orderproducts->price = $request->totalprice;
            $orderproducts->total_price = $request->total;
            $orderproducts->order_id = $order_id;
            $orderproducts->customername = $request->name_bill;
            $orderproducts->phone = $request->number_bill;
            $orderproducts->payment_status = 0;
            $orderproducts->delivery_status = 0;
            $orderproducts->netamount = $request->total;
            $orderproducts->shippingamt = 0;
            $orderproducts->save();
        }

        $customerdetail->user_id = $user_id;

        $customerdetail->save();
        // dd( $ProductFinalTotal );
        return redirect()->back()->with('success', 'Store Successfully');
        // return redirect()->route( 'myorder' );
        //   return view( 'pages.razorpayView', compact( 'orderid', 'ProductFinalTotal' ) );

    }

    public function checkoutnew(Request $request)
    {
        try {
            $prod_price = $request->checkout_prod_price;
            $color_value = $request->color_value;
            $size_value = $request->size_value;
            $prod_id = $request->prod_id;
            $product_quantity = $request->product_quantity;

            $product_Varient = ProductVarient::where('product_id', $prod_id)
                ->where('size_value', $size_value)
                ->where('color_value', $color_value)
                ->first();

            $product = products::find($prod_id);
            // Assuming you have a Product model

            $total_price = $prod_price * $product_quantity;

            return response()->json([
                'status' => 200,
                'message' => 'checkout Details Fetched Successfully',
                'product' => [
                    'id' => $product->id,
                    'name' => $product->product_name,
                    'image' => $product->product_image,
                    'price' => $prod_price,
                    'quantity' => $product_quantity,
                    'color' => $color_value,
                    'size' => $size_value,
                    'total' => $total_price,
                    'prod_varient_id' => $product_Varient->id,
                ],
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['status' => 500, 'message' => 'Error processing checkout']);
        }
    }

    public function createRazorpayOrder(Request $request)
    {
        try {
            // Retrieve all form fields
            $formFields = $request->all();

            // Extract arrays from form data
            $productIds = $formFields['ProductId'] ?? [];
            $productQuantities = $formFields['productFinalQuantity'] ?? [];
            $productPrices = $formFields['productSalep'] ?? [];
            // corrected key

            $amount = 0;

            // Calculate total amount
            for (
                $i = 0;
                $i < count($productIds);
                $i++
            ) {
                $qty = isset($productQuantities[$i]) ? (int) $productQuantities[$i] : 0;
                $price = isset($productPrices[$i]) ? (float) $productPrices[$i] : 0;
                $amount += $qty * $price;
            }

            // Convert to paise ( required by Razorpay )
            $amountInPaise = $amount * 100;

            // Create Razorpay order
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

            $razorpayOrder = $api->order->create([
                'receipt'         => 'rcpt_' . uniqid(),
                'amount'          => $amountInPaise,
                'currency'        => 'INR',
                'payment_capture' => 1,
            ]);

            // Return order details to frontend
            return response()->json([
                'status'     => 'success',
                'order_id'   => $razorpayOrder['id'],
                'amount'     => $razorpayOrder['amount'],
                'key'      => env('RAZORPAY_KEY'),
            ]);
        } catch (\Exception $e) {
            Log::error('Razorpay order creation failed: ' . $e->getMessage());

            return response()->json([
                'status'  => 'error',
                'message' => 'Failed to create Razorpay order. Please try again later.',
            ], 500);
        }
    }



    public function checkoutmm(Request $request)
    {
        $attributes = [
            'razorpay_order_id' => $request->razorpay_order_id,
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'razorpay_signature' => $request->razorpay_signature
        ];

        try {
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $api->utility->verifyPaymentSignature($attributes);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Payment verification failed.'], 403);
        }

        $currentTime = Carbon::now('Asia/Kolkata');
        $data = $request->all();
        $userId = $request->user_id;
        $delivery_amt = $request->total;

        $lastId = ProductOrder::max('id') ?? 0;
        $orderId = 'GM-ORD-' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);

        ProductOrder::create([
            'order_id' => $orderId,
            'date_ordered_on' => now(),
            'user_id' => $userId,
            'payment_status' => 1,
            'razorpay_order_id' => $request->razorpay_order_id,
            'razorpay_payment_id' => $request->razorpay_payment_id,
        ]);

        $user_details = DB::table('users')
            ->select('name', 'phone_number', 'user_default_address_id')
            ->where('id', $userId)
            ->first();

        $firstname = str_replace("'", '"', $request->customer_name);
        $phone = str_replace("'", '"', $request->customer_phone_number);
        $email = str_replace("'", '"', $request->customer_email);
        $address = str_replace("'", '"', $request->customer_address);
        $pincode = str_replace("'", '"', $request->customer_postal_code);
        $state = str_replace("'", '"', $request->customer_state);
        $city = str_replace("'", '"', $request->customer_city);
        $areaname = $city;

        $data['shippingName'] = $firstname;
        $data['shippingEmail'] = $email;
        $data['shippingPhone'] = $phone;
        $data['shippingstate'] = $state;
        $data['shippingPinco'] = $pincode;

        $pincodeId = DB::table('all_india_pincodes')
            ->select('id')
            ->where('officename', $areaname)
            ->first();

        $pincodeIdValue = $pincodeId->id ?? null;

        if (!$user_details->user_default_address_id) {
            $useraddresid = DB::table('user_addresses')->insertGetId([
                'user_id' => $userId,
                'address_first_name' => $firstname,
                'address_phone_number' => $phone,
                'address_line_one' => $address,
                'pincode' => $pincode,
                'pincode_id' => $pincodeIdValue,
                'state' => $state,
                'city' => $city,
                'area_name' => $areaname,
            ]);

            DB::table('users')->where('id', $userId)->update([
                'name' => $firstname,
                'email' => $email,
                'user_default_address_id' => $useraddresid
            ]);
        } else {
            DB::table('user_addresses')
                ->where('id', $user_details->user_default_address_id)
                ->update([
                    'user_id' => $userId,
                    'address_first_name' => $firstname,
                    'address_phone_number' => $phone,
                    'address_line_one' => $address,
                    'pincode' => $pincode,
                    'pincode_id' => $pincodeIdValue,
                    'state' => $state,
                    'city' => $city,
                    'area_name' => $areaname,
                ]);

            DB::table('users')->where('id', $userId)->update([
                'name' => $firstname,
                'email' => $email,
                'user_default_address_id' => $user_details->user_default_address_id
            ]);
        }

        // Re-fetch user details with updated address
        $user_details2 = DB::table('users')
            ->select('name', 'phone_number', 'user_default_address_id')
            ->where('id', $userId)
            ->first();

        $user_address = DB::table('user_addresses')
            ->select('address_line_one', 'city', 'state', 'pincode')
            ->where('id', $user_details2->user_default_address_id)
            ->first();

        $order = ProductOrder::where('order_id', $orderId)->first();

        $productId = (array) json_decode(json_encode($request->ProductId), true);
        $quantity = (array) json_decode(json_encode($request->productFinalQuantity), true);
        $productVarientId = (array) json_decode(json_encode($request->Product_ver_Id), true);

        $delvieryDate = Carbon::parse('17-06-2025')->format('Y-m-d');
        $slots = [];
        $grandTotalAmount = 0;
        $totalAmount = $request->total ?? 0;
        $gst_amount = $request->gst_amount ?? 0;
        $discount_amount = $request->discount_amount ?? 0;

        foreach ($productVarientId as $key => $value) {
            $variant = ProductVarient::find($value);
            if ($variant) {
                $grandTotalAmount += $variant->offer_price * $quantity[$key];
                $slots[] = [
                    'delivery_date' => $delvieryDate,
                    'order_id' => $orderId,
                    'product_id' => $productId[$key],
                    'product_varient_id' => $value,
                    'quantity' => $quantity[$key]
                ];
            }
        }

        $data['order_id'] = $orderId;
        $data['customer_name'] = $user_details2->name;
        $data['phone_number'] = $user_details2->phone_number;
        $data['address'] = $user_address->address_line_one ?? '';
        $data['city'] = $user_address->city ?? '';
        $data['state'] = $user_address->state ?? '';
        $data['pincode'] = $user_address->pincode ?? '';
        $data['total_amount'] = $totalAmount;
        $data['grand_total_amount'] = $grandTotalAmount;
        $data['gst_amount'] = $gst_amount;
        $data['discount_amount'] = $discount_amount;
        $data['slots'] = $slots;

        $order_details = (object) $data;
        $userDetails = (object) $data;

        // Save product slot details
        $this->createProductSlot(
            $slots,
            $totalAmount,
            $orderId,
            $grandTotalAmount,
            $gst_amount,
            $discount_amount,
            $delivery_amt,
        );

        return response()->json([
            'status' => '200',
            'message' => 'Order Placed Successfully'
        ]);
    }


    public function createSingleRazorpayOrder(Request $request)
    {
        try {
            // Extract values for single product
            $productId = $request->input('single_check_product_id');
            $productQuantity = (int) $request->input('single_check_product_quantity', 1);
            $productPrice = (float) $request->input('single_check_product_single_price', 0);

            $grand_total = $request->totalHidden;

            // Convert to paise ( required by Razorpay )
            $amountInPaise = $grand_total * 100;

            // Create Razorpay order
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

            $razorpayOrder = $api->order->create([
                'receipt'         => 'rcpt_' . uniqid(),
                'amount'          => $amountInPaise,
                'currency'        => 'INR',
                'payment_capture' => 1,
            ]);

            // Return order details to frontend
            return response()->json([
                'status'   => 'success',
                'order_id' => $razorpayOrder['id'],
                'amount'   => $razorpayOrder['amount'],
                'key'      => env('RAZORPAY_KEY'),
            ]);
        } catch (\Exception $e) {
            Log::error('Razorpay order creation failed: ' . $e->getMessage());

            return response()->json([
                'status'  => 'error',
                'message' => 'Failed to create Razorpay order. Please try again later.',
            ], 500);
        }
    }

    public function createneworder(Request $request)
    {

        $attributes = [
            'razorpay_order_id' => $request->razorpay_order_id,
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'razorpay_signature' => $request->razorpay_signature
        ];

        try {
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $api->utility->verifyPaymentSignature($attributes);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Payment verification failed.'], 403);
        }

        $currentTime = Carbon::now('Asia/Kolkata');
        $data = $request->all();
        $is_guest = $request->is_guest_user ?? 0;

        if ($is_guest && $is_guest == '1') {
            $userId = $request->single_check_product_user_id;
            $delivery_amt = $request->totalHidden;
            // $couponcodes = $request->couponcode;
            $lastId = ProductOrder::max('id');
            $orderId = 'GM-ORD-' . str_pad($lastId, 4, '0', STR_PAD_LEFT);
            ProductOrder::query()->create([
                'order_id' => $orderId,
                'date_ordered_on' => now(),
                'guest_user_id' => $userId,
                'payment_status' => 1,
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
            ]);

            // $user_details = DB::table( 'users' )->select( 'name', 'phone_number', 'user_default_address_id' )->where( 'id', $userId )->first();

            $firstname = str_replace("'", '"', $request->customer_name);
            $phone = str_replace("'", '"', $request->customer_phone_number);
            $email = str_replace("'", '"', $request->customer_email);
            $address = str_replace("'", '"', $request->customer_address);
            $pincode = str_replace("'", '"', $request->customer_postal_code);
            $state = str_replace("'", '"', $request->customer_state);
            $city = str_replace("'", '"', $request->customer_city);
            $areaname = str_replace("'", '"', $request->customer_city);

            $data['shippingName'] = $request->customer_name;
            $data['shippingEmail'] = $request->customer_email;
            $data['shippingPhone'] = $request->customer_phone_number;
            $data['shippingstate'] = $request->customer_state;
            $data['shippingPinco'] = $request->customer_postal_code;

            $useraddresid = DB::table('user_addresses')
                ->insertGetId([
                    'guest_user_id' => $userId,
                    'address_first_name' => $firstname,
                    'address_phone_number' => $phone,
                    'address_line_one' => $address,
                    'pincode' => $pincode,
                    'state' => $state,
                    'city' => $city,
                    'area_name' => $areaname,
                ]);

            $orderuseraddresid = DB::table('user_addresses')
                ->insertGetId([
                    'guest_user_id' => $userId,
                    'address_first_name' => $firstname,
                    'address_phone_number' => $phone,
                    'address_line_one' => $address,
                    'pincode' => $pincode,
                    'state' => $state,
                    'city' => $city,
                    'area_name' => $areaname,
                ]);

            $order = ProductOrder::query()->where('order_id', $orderId)->first();

            $productId = str_replace("'", '"', $request->single_check_product_id);
            $quantity = str_replace("'", '"', $request->single_check_product_quantity);
            $productVarientId = str_replace("'", '"', $request->single_check_product_varient_id);
            $delvieryDate  = date('Y-m-d', strtotime(Carbon::parse('21-06-2025')));

            $slots = [];
            $grandTotalAmount = $request->totalHidden ?? 0;
            $totalAmount = $request->single_check_product_total_price ?? 0;
            $gst_amount = $request->gst_amount ?? 0;
            $discount_amount = $request->discount_amount ?? 0;

            $slots[] = [
                'delivery_date' => $delvieryDate,
                'order_id' => $orderId,
                'product_id' => $productId,
                'product_varient_id' => $productVarientId,
                'quantity' => $quantity
            ];

            // to display the details for users
            $data['order_id'] = $orderId;
            $data['customer_name'] = $firstname;
            $data['phone_number'] = $phone;
            $data['address'] = $address;
            $data['city'] = $city;
            $data['state'] = $state;
            $data['pincode'] = $pincode;
            $data['total_amount'] = $totalAmount;
            $data['grand_total_amount'] = $grandTotalAmount;
            $data['gst_amount'] = $gst_amount;
            $data['discount_amount'] = $discount_amount;
            // $data[ 'coupons_id' ] = $couponcodes;
            $data['slots'] = $slots;

            // to convert array to object
            $order_details = (object) $data;
            $userDetails = (object) $data;

            // dd( $userDetails );
            $this->createProductSlot(
                $slots,
                $totalAmount,
                $orderId,
                $grandTotalAmount,
                $gst_amount,
                $discount_amount,
                $delivery_amt,
                // $couponcodes,
            );

            return response()->json([
                'status' => '200',
                'message' => 'Order Placed Successfully'
            ]);
        } else {
            dd($data);
            $userId = $request->single_check_product_user_id;
            $delivery_amt = $request->totalHidden;
            // $couponcodes = $request->couponcode;
            $lastId = ProductOrder::max('id');
            $orderId = 'GM-ORD-' . str_pad($lastId, 4, '0', STR_PAD_LEFT);
            ProductOrder::query()->create([
                'order_id' => $orderId,
                'date_ordered_on' => now(),
                'user_id' => $userId,
                'payment_status' => 0,
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
            ]);

            $user_details = DB::table('users')->select('name', 'phone_number', 'user_default_address_id')->where('id', $userId)->first();

            $firstname = str_replace("'", '"', $request->customer_name);
            $phone = str_replace("'", '"', $request->customer_phone_number);
            $email = str_replace("'", '"', $request->customer_email);
            $address = str_replace("'", '"', $request->customer_address);
            $pincode = str_replace("'", '"', $request->customer_postal_code);
            $state = str_replace("'", '"', $request->customer_state);
            $city = str_replace("'", '"', $request->customer_city);
            $areaname = str_replace("'", '"', $request->customer_city);

            $data['shippingName'] = $request->customer_name;
            $data['shippingEmail'] = $request->customer_email;
            $data['shippingPhone'] = $request->customer_phone_number;
            $data['shippingstate'] = $request->customer_state;
            $data['shippingPinco'] = $request->customer_postal_code;

            $pincodeId = DB::table('all_india_pincodes')->select('id')->where('officename', $areaname)->first();
            $pincodeIdValue = $pincodeId ? $pincodeId->id : null;
            if ($user_details->user_default_address_id == null) {
                $useraddresid = DB::table('user_addresses')
                    ->insertGetId([
                        'user_id' => $userId,
                        'address_first_name' => $firstname,
                        'address_phone_number' => $phone,
                        'address_line_one' => $address,
                        'pincode' => $pincode,
                        'pincode_id' => $pincodeIdValue,
                        'state' => $state,
                        'city' => $city,
                        'area_name' => $areaname,
                    ]);

                $userupdate = DB::table('users')
                    ->where('user_id', $userId,)
                    ->update([
                        'name' => $firstname,
                        'email' => $email,
                        'user_default_address_id' => $useraddresid
                    ]);
            } else {

                DB::table('user_addresses')->where('id', $user_details->user_default_address_id)
                    ->update([
                        'user_id' => $userId,
                        'address_first_name' => $firstname,
                        'address_phone_number' => $phone,
                        'address_line_one' => $address,
                        'pincode' => $pincode,
                        'pincode_id' => $pincodeIdValue,
                        'state' => $state,
                        'city' => $city,
                        'area_name' => $areaname,
                    ]);
                DB::table('users')
                    ->where('user_id', $userId,)
                    ->update([
                        'name' => $firstname,
                        'email' => $email,
                        'user_default_address_id' => $user_details->user_default_address_id
                    ]);
            }

            // get user details using user id
            $user_details2 = DB::table('users')->select('name', 'phone_number', 'user_default_address_id')->where('id', $userId)->first();

            $user_address = DB::table('user_addresses')->select('address_line_one', 'city', 'state', 'pincode')->where('id', $user_details2->user_default_address_id)->first();

            $order = ProductOrder::query()->where('order_id', $orderId)->first();

            $productId = str_replace("'", '"', $request->ProductId);
            $quantity = str_replace("'", '"', $request->productFinalQuantity);
            $productVarientId = str_replace("'", '"', $request->Product_ver_Id);
            $delvieryDate  = date('Y-m-d', strtotime(Carbon::parse('17-06-2025')));

            $slots = [];
            $grandTotalAmount = 0;
            $totalAmount = $request->total ?? 0;
            $gst_amount = $request->gst_amount ?? 0;
            $discount_amount = $request->discount_amount ?? 0;
            $userId = $order->user_id;
            $user = User::query()->where('user_id', $userId)->first();

            foreach ($productVarientId as $key => $value) {
                $grandTotalAmount += (ProductVarient::findOrFail($value)->offer_price * $quantity[$key]);
                $slots[] = [
                    'delivery_date' => $delvieryDate,
                    'order_id' => $orderId,
                    'product_id' => $productId[$key],
                    'product_varient_id' => $productVarientId[$key],
                    'quantity' => $quantity[$key]
                ];
            }

            // to display the details for users
            $data['order_id'] = $orderId;
            $data['customer_name'] = $user_details->name;
            $data['phone_number'] = $user_details->phone_number;
            $data['address'] = $user_address->address_line_one;
            $data['city'] = $user_address->city;
            $data['state'] = $user_address->state;
            $data['pincode'] = $user_address->pincode;
            $data['total_amount'] = $totalAmount;
            $data['grand_total_amount'] = $grandTotalAmount;
            $data['gst_amount'] = $gst_amount;
            $data['discount_amount'] = $discount_amount;
            // $data[ 'coupons_id' ] = $couponcodes;
            $data['slots'] = $slots;

            // to convert array to object
            $order_details = (object) $data;
            $userDetails = (object) $data;

            // dd( $userDetails );
            $this->createProductSlot(
                $slots,
                $totalAmount,
                $orderId,
                $grandTotalAmount,
                $gst_amount,
                $discount_amount,
                $delivery_amt,
                // $couponcodes,
            );

            return response()->json([
                'status' => '200',
                'message' => 'Order Placed Successfully'
            ]);
        }
    }

    public function createProductSlot($slots, $totalAmount, $orderId, $grandTotal, $gstAmount, $discountAmount, $delivery_amt,)
    {
        // dd( $grandTotal );
        $order = ProductOrder::query()->where('order_id', $orderId)->first();
        foreach ($slots as $slot) {
            $slot = json_decode(json_encode($slot), true);
            // dd( $slot );
            ProductSlot::create($slot);
        }
        $order->update([
            'total_amount' => $totalAmount,
            'gst_amount' => $gstAmount,
            'discount_amount' => $discountAmount,
            'delivery_charge' => $delivery_amt ?? 0,
            'grand_total_amount' => $grandTotal,
            // 'coupons_id' => $couponcodes
        ]);
    }
}
