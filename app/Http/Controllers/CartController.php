<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = [];
        if (Auth::check()) {
            $user = Auth::user();
            $cart = Cart::where('user_id', $user->id)->get();
        }
        // $cart = Cart::all();

        return response()->json($cart);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            return response()->json($cart);
        } else {
            return redirect('/login');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $total = Cart::where('user_id', Auth::user()->id)->selectRaw('SUM((price * qty)) AS total')->first();

        return view('cart', compact('cart', 'total'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::find($id)->delete();
    }
}
