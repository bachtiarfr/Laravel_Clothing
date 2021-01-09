<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Sale;
use App\Reward;
use Auth;
use App\SaleItems;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $user = Auth::user();

        //input data from cart to sales
        $sales = new Sale();
        $sales->user_id = $user->id;
        $sales->nama = $request->input('name');
        $sales->email = $request->input('email');
        $sales->phone = $request->input('phone');
        $sales->alamat = $request->input('address');
        $sales->save();

        $this->initPaymentGateway();
        $customerDetails = [
            'first_name' => $sales->nama, 
            'last_name' => $sales->nama,
            'email' => $sales->email,
            'phone' => $sales->phone, 
        ];

        $params = [
            'enable_payments' => \App\Payment::PAYMENT_CHANNELS,
            'transaction_details' => [
                'order_id' => $sales->id,
                'gross_amount' => 1000,
            ],
            'customer_destails' => $customerDetails,
            'expiry' => [
                'start_time' => date('Y-m-d H:i:s T'),
                'unit' => \App\Payment::EXPIRY_DURATION,
                'duration'  => \App\Payment::EXPIRY_UNIT
            ],

        ];
        
        $snap = \Midtrans\Snap::createTransaction($params);
        dd($snap);

        $products = Cart::all();

        $sale_items = new SaleItems();
        $sale_items->sale_id = $sales->id;
        $sale_items->product_id = $products[0]->id;
        $sale_items->qty = $products[0]->qty;
        $sale_items->price = $products[0]->price;
        $sale_items->save();


        $product = $request->input("id");
        $total = Cart::where("user_id", $user->id)->first();
        $reward = Reward::where("user_id", $user->id)->first();

        //if customer buy more then 5 products, they get B reward ($0 Point)
        if ($total->qty >= 3) {
            if ($reward) {
                $reward->user_id = $user->id;
                $reward->point = $reward->point + 40;
                $reward->save();
            } else {
                $point = 40;
                $reward = new Reward();
                $reward->user_id = $user->id;
                $reward->point = $point;
                $reward->save();
            }

            //if they just buy less than 3 products, they just get A Reward(20 Point)
        } elseif ($total->qty < 3) {
            if ($reward) {
                $reward->user_id = $user->id;
                $reward->point = $reward->point + 20;
                $reward->save();
            } else {
                $point = 20;
                $reward = new Reward();
                $reward->user_id = $user->id;
                $reward->point = $point;
                $reward->save();
            }
        }

        Session::flash("success", "berhasil Menambah Product");
        DB::table('carts')->where('user_id', $user->id)->delete();
        return redirect('/products');
    }

    
    public function _generatePaymentToken($sales) {
        $this->initPaymentGateway();
        $customerDetails = [
            'first_name' => $sales->nama, 
            'last_name' => $sales->nama,
            'email' => $sales->email,
            'phone' => $sales->phone, 
        ];

        $params = [
            'enable_payments' => \App\Payment::PAYMENT_CHANNELS,
            'transaction_details' => [
                'order_id' => $sales->id,
                'gross_amount' => 1000,
            ],
            'customer_destails' => $customerDetails,
            'expiry' => [
                'start_time' => date('Y-m-d H:i:s T'),
                'unit' => \App\Payment::EXPIRY_DURATION,
                'duration'  => \App\Payment::EXPIRY_UNIT
            ],

        ];
        dd($params);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

}
