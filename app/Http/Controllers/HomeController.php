<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reward;
use App\Voucher;
use Illuminate\Support\Facades\Auth;


use App\Courier;
use App\City;
use App\Province;
use Kavist\RajaOngkir\Facades\RajaOngkir;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $reward_list = Voucher::all();
        if (Auth::check()) {
            $reward = Reward::where('user_id', Auth::user()->id)->get();
        }
        return view('home', compact('reward', 'reward_list'));
    }

    public function getData() {
        $couriers = Courier::pluck('title','code');
        $provinces = Province::pluck('title','provinces_id');
        return view('check_ongkir', compact('couriers', 'provinces'));
    }

    public function getCities($id) {
        $city = City::where('provinces_id', $id)->pluck('title', 'city_id');
        return json_encode($city);
    }

    public function submit(Request $request) {
        // dd($request->all());
        $data = RajaOngkir::ongkosKirim([
            'origin' => $request->city_origin,
            'destination' => $request->city_destination,
            'weight' => $request->weight,
            'courier' => $request->courier
        ])->get();
        // dd($data[0]['name']);
        foreach ($data[0]['costs'] as $data_row) {
            $i[] = [
                'name' => $data[0]['name'],
                'service' => $data_row['service'],
                'description' => $data_row['description'],
                'cost' => $data_row['cost']
            ];
        }
        // dd($i);
       return $i;
    }
}
