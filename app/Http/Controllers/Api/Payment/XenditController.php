<?php

namespace App\Http\Controllers\Api\Payment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Xendit\Xendit;

class XenditController extends Controller
{
    private $token = 'xnd_development_zA9sUzc3TEoEX3QyRz0SM72iq5KZ0MEvrebPOfUa7OdXoWve2quwjbxAY90z';

    public function getListVirtualAccounts() {

        Xendit::setApiKey($this->token);
        $getVABanks = \Xendit\VirtualAccounts::getVABanks();

        return response()->json([
            'data' => $getVABanks
        ])->setStatusCode(200);
    }

    public function createVirtualAccount(Request $request) {
        Xendit::setApiKey($this->token);

        $params = ["external_id" => \uniqid(),
            "bank_code" => "MANDIRI",
            "name" => "Bachtiar"
        ];

        // dd($params);
        $createVA = \Xendit\VirtualAccounts::create($params);

        return response()->json([
            'data' => $createVA
        ])->setStatusCode(200);
        
    }
}
