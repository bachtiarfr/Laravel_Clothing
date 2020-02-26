<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['code', 'image', 'name', 'price', 'stock', 'categorie_id'];
    public function categorie()
    {
        return $this->belongsTo("App\Categorie");
    }
}
