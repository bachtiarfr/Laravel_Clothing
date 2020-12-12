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
}
