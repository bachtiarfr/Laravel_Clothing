<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sale;
use App\SaleItems;

class TController extends Controller
{
    function index()
    {
        $sale = Sale::all();
        return view('Dashboard.Transaction', compact('sale'));
    }
}
