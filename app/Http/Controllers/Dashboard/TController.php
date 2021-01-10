<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sale;
use App\SaleItems;
use PDF;

class TController extends Controller
{
    function index()
    {
        $sale = Sale::all();
        return view('Dashboard.Transaction', compact('sale'));
    }

    public function exportPDF() {
        $sale = Sale::all();        
        $pdf = PDF::loadview('Transaction_Export_Template',['sale'=>$sale]);
    	return $pdf->download('transaction-report-pdf');
    }
}
