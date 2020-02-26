<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Cart;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::all();
        return response($cart);
    }
    public function store(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $product = $request->input("id");
            $cart = Cart::where("product_id", $product)->where("user_id", $user->id)->first();

            if ($cart) {
                $cart->qty = $cart->qty + 1;
                $cart->save();
            } else {
                $qty = 1;
                $products = Product::find($product);

                $cart = new Cart;
                $cart->user_id = $user->id;
                $cart->product_id = $product;
                $cart->product_name = $products->name;
                $cart->price = $products->price;
                $cart->qty = $qty;
                $cart->save();
            }
            return response($cart);
        }
    }
}
