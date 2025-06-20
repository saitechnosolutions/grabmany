<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\products;
use App\Models\ProductSlot;
use App\Models\ProductVarient;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class productController extends Controller {
    public function showproducts( $id ) {
        $products = products::all();
        return view( 'pages.product', compact( 'products' ) );
    }

    public function showsingleproducts( $id ) {
        $product_single = products::where( 'prod_unique_name', $id )->first();
        // dd( $product_single );
        return view( 'pages.single_product', compact( 'product_single' ) );
    }

    public function showallproducts( Request $request ) {
        $products = products::all();
        return view( 'pages.product', compact( 'products' ) );
    }

    public function fetchColorDetails( Request $request ) {
        try {
            $size_value = $request->size_value;
            $product_id = $request->prod_id;

            $products = ProductVarient::where( 'product_id', $product_id )
            ->where( 'size_value', $size_value )
            ->get();

            return response()->json( [
                'status'=>'200',
                'message'=>'color details fetched successfully',
                'products'=> $products
            ] );
        } catch ( \Throwable $th ) {
            Log::error( $th );
        }
    }

    public function storewishlistprod( Request $request ) {
        try {
            $product_id = $request->product_main_id;
            $user_id = $request->user_id;
            $productqty = $request->productqty;
            $size_value = $request->size_value;
            $color_value = $request->color_value;

            $prod_varient = ProductVarient::where( 'product_id', $product_id )
            ->where( 'color_value', $color_value )
            ->where( 'size_value', $size_value )
            ->first();

            Wishlist::create( [
                'user_id'=>$user_id,
                'product_id'=>$product_id,
                'product_varient_id'=>$prod_varient->id,
                'product_quantity'=>$productqty,
            ] );

            return response()->json( [
                'status'=>'200',
                'message'=>'Product Added To Wishlist',
            ] );
        } catch ( \Throwable $th ) {
            Log::error( $th );
        }
    }

    public function storecartprod( Request $request ) {
        try {
            $product_id = $request->product_id;
            $user_id = $request->user_id;
            $productqty = $request->product_quantity;
            $size_value = $request->size_value;
            $color_value = $request->color_value;

            $prod_varient = ProductVarient::where( 'product_id', $product_id )
            ->where( 'color_value', $color_value )
            ->where( 'size_value', $size_value )
            ->first();

            $isCartExist = cart::where( 'user_id', $user_id )->where( 'product_id', $product_id )->first();

            if ( !$isCartExist ) {
                cart::create( [
                    'user_id'=>$user_id,
                    'product_id'=>$product_id,
                    'product_varient_id'=>$prod_varient->id,
                    'product_quantity'=>$productqty
                ] );
            } else {
                // dd( $isCartExist );
                // to check the cart qty for update
                return response()->json( [
                    'status'=>'400',
                    'message'=>'Product Already Exists',
                ] );
            }

            return response()->json( [
                'status'=>'200',
                'message'=>'Product Added To Wishlist',
            ] );
        } catch ( \Throwable $th ) {
            Log::error( $th );
        }
    }

    public function getvarientdetails( Request $request ) {
        try {
            $prod_id = $request->prod_id;

            $groupedVarients = ProductVarient::where( 'product_id', $prod_id )
            ->get()
            ->groupBy( 'size_value' );

            return response()->json( [
                'status'=>'200',
                'message'=>'Varient Details Fetched Successfully',
                'groupedvarients'=>$groupedVarients,
            ] );
        } catch ( \Throwable $th ) {
            Log::error( $th );
        }
    }

    public function filterbyprice( Request $request ) {
        try {
            $minvalue = $request->minvalue;
            $maxvalue = $request->maxvalue;

            $filteredProducts = ProductVarient::with( 'product' ) // if related
            ->whereBetween( 'offer_price', [ $minvalue, $maxvalue ] )
            ->get();

            return response()->json( [
                'status'=>'200',
                'message'=>'Products Filtered Successfully',
                'products'=> $filteredProducts
            ] );

        } catch ( \Throwable $th ) {
            Log::error( $th );
        }
    }

    public function filterbycategory( Request $request ) {
        try {
            $selected_category = $request->selectedCategory;

            $filteredProducts = ProductVarient::with( 'product' ) // if related
            ->where( 'categoryid', $selected_category )
            ->get();

            return response()->json( [
                'status'=>'200',
                'message'=>'Products Filtered Successfully',
                'products'=> $filteredProducts
            ] );
        } catch ( \Throwable $th ) {
            Log::error( $th );
        }
    }

    public function filterbysort( Request $request ) {
        try {
            $sortvalue = $request->sortvalue;

            if ( $sortvalue == 1 ) {
                $filteredProducts = ProductVarient::with( 'product' ) // if related
                ->orderBy( 'created_at', 'desc' )
                ->get();

            } elseif ( $sortvalue == 2 ) {
                $filteredProducts = ProductVarient::with( 'product' ) // if related
                ->orderBy( 'offer_price', 'asc' )
                ->get();

            } else {
                $filteredProducts = ProductVarient::with( 'product' ) // if related
                ->orderBy( 'offer_price', 'desc' )
                ->get();

            }

            return response()->json( [
                'status'=>'200',
                'message'=>'Products Filtered Successfully',
                'products'=> $filteredProducts
            ] );
        } catch ( \Throwable $th ) {
            Log::error( $th );
        }
    }

    public function fetchordersummary( Request $request ) {
        try {
            $orderId = $request->orderId;

            $orderDetails = ProductSlot::with( 'Varient' )->where( 'order_id', $orderId )->get();

            return response()->json( [
                'status'=>'200',
                'message'=>'Details Fetched Successfully',
                'orderDetails'=>$orderDetails,
            ] );
        } catch ( \Throwable $th ) {
            Log::error( $th );
        }
    }

}