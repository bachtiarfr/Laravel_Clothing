<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventorie extends Model
{
    public function voucher()
    {
        return $this->hasMany('App\Voucher');
    }
}
