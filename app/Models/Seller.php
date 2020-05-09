<?php

namespace App\Models;

use App\Models\Product;
class Seller extends User
{
     /**
     * Seller has many products
     *
     * @var mix
     */
    public function products(){
    	return $this->hasMany(Product::class);
    }
}
