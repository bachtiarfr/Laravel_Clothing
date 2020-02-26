<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public function sale_item()
    {
        return $this->hasMany("App\SaleItems");
    }
}
