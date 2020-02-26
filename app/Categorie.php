<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $fillable = ['name', 'status'];
    public function product()
    {
        return $this->hasMany("App\Product");
    }
}
