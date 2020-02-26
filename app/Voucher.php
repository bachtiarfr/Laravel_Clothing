<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    public function inventori()
    {
        return $this->belongsTo('App\Inventorie');
    }
}
