<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reward;
use App\Voucher;
use Illuminate\Support\Facades\Auth;

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
}
