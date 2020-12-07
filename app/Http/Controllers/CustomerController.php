<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Auth;
use App\Cart;
use App\Sale;
use App\SaleItems;
use App\Reward;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Voucher;
use App\Inventorie;



use App\Courier;
use App\City;
use App\Province;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class CustomerController extends Controller
{
    public function index()
    {

        $reward_list = Voucher::all();
        if (Auth::check()) {
            $reward = Reward::where('user_id', Auth::user()->id)->get();
        }
        return view('home', compact('reward_list'));
    }

    public function get_labeled_image() {
        $path = 'E:\WEB DEVELOPMENT\Laravel_Clothing\public/labeled_images/Bachtiar/1.jpg';
        return response()->file($path);

    }

    public function get_labeled_image2() {
        $path = 'E:\WEB DEVELOPMENT\Laravel_Clothing\public/labeled_images/Bachtiar/2.jpg';
        return response()->file($path);

    }
    

    public function get_labeled_fajar() {
        $path = 'E:\WEB DEVELOPMENT\Laravel_Clothing\public/labeled_images/Fajar/1.jpg';
        return response()->file($path);

    }

    public function get_labeled_fajar2() {
        $path = 'E:\WEB DEVELOPMENT\Laravel_Clothing\public/labeled_images/Fajar/2.jpg';
        return response()->file($path);

    }

    public function get_labeled_bayu() {
        $path = 'E:\WEB DEVELOPMENT\Laravel_Clothing\public/labeled_images/Bayu/1.jpg';
        return response()->file($path);

    }

    public function get_labeled_bayu2() {
        $path = 'E:\WEB DEVELOPMENT\Laravel_Clothing\public/labeled_images/Bayu/2.jpg';
        return response()->file($path);

    }

    public function product()
    {
        $products = Product::all();
        return view('product', compact('products'));
    }

    public function checkout()
    {
        $cart = [];
        if (Auth::check()) {
            $user = Auth::user();
            $cart = Cart::where('user_id', $user->id)->get();
        }
        $total = Cart::where('user_id', Auth::user()->id)->selectRaw('SUM((price * qty)) AS total')->first();

        
        $couriers = Courier::pluck('title','code');
        $provinces = Province::pluck('title','provinces_id');

        return view('checkout', compact('cart', 'total','couriers', 'provinces'));
    }

    public function transaction(Request $request)
    {
        $cart = $request->input("id");
        $user = Auth::user();

        //input data from cart to sales
        $sales = new Sale();
        $sales->user_id = $user->id;
        $sales->nama = $request->input('name');
        $sales->email = $request->input('email');
        $sales->phone = $request->input('phone');
        $sales->alamat = $request->input('address');
        $sales->save();

        $products = Cart::all();

        $sale_items = new SaleItems();
        $sale_items->sale_id = $sales->id;
        $sale_items->product_id = $products[0]->id;
        $sale_items->qty = $products[0]->qty;
        $sale_items->price = $products[0]->price;
        $sale_items->save();


        Session::flash("success", "berhasil Menambah Product");
        DB::table('carts')->where('user_id', $user->id)->delete();
        return redirect('/products');
    }

    public function myVoucher()
    {
        $reward_list = Inventorie::all();
        if (Auth::check()) {
            $reward = Reward::where('user_id', Auth::user()->id)->get();
        }
        return view('myvoucher', compact('reward', 'reward_list'));
    }
 
    public function addVoucher(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $voucher = Voucher::where('id', $request->id)->first();
            
            $invent = new Inventorie();
            $invent->user_id = $user->id;
            $invent->vourcher_id = $request->input('id');
            $invent->save();
            
            $reward = Reward::where('user_id', Auth::user()->id)->first();
            $reward->point = $reward->point - $voucher->point;
            $reward->save();

            return response()->json($invent);
        } else {
            return redirect('/login');
        }
    }
}
