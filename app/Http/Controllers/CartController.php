<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
  

    public function addtocart(Request $request)
    {
        $cart = new cart();

        $cart->product_id = $request->input('product_id');
        $cart->user_id = $request->input('user_id');
        $cart->product_quantity = $request->input('product_quantity');
        $cart->price = $request->input('price');

        $isCartExist = cart::where('user_id', $request->input('user_id'))->where('product_id', $request->input('product_id'))->first();
        $total_price = (int)$cart->product_quantity * (int)$request->input('price');
        $cart->total_price = $total_price;


        if (!$isCartExist) {
            $cart->save();
        } else {
            // dd($isCartExist);
            // to check the cart qty for update
            if ($isCartExist->product_quantity != $cart->product_quantity) {
                $total_price = (int)$cart->product_quantity * (int)$request->input('price');
                $cart::where('user_id', $request->input('user_id'))->where('product_id', $request->input('product_id'))->update(['product_quantity' => $cart->product_quantity, 'totprice' => $total_price]);
            } else {
                return response()->json(["status" => "error"]);
            }
        }
        $count = cart::where('user_id', $request->input('user_id'))->count();
        return response()->json(["status" => "success", "count" => $count]);
    }
    public function updateCart(Request $request)
    {
        $cart = cart::find($request->cart_id);
    
        if ($cart) {
            $cart->product_quantity = $request->quantity;
            $cart->total_price = $request->total_price;
            $cart->save();
    
            return response()->json(['message' => 'Cart updated successfully']);
        }
    
        return response()->json(['message' => 'Cart item not found'], 404);
    }
    public function remove(Request $request)
    {

        $cartItem = cart::where('product_id', $request->product_id)->where('user_id', $request->user_id)->delete();

        if ($cartItem) {
            // $cartItem->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
     
}
