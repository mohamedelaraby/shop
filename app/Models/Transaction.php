<?php

namespace App\Models;

use App\Models\Buyer;
use App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable =[
    	'quantity',
    	'buyer_id',
    	'product_id',
    ];


 	/**
     * Transaction belongs to buyer
     *
     * @var mix
     */
    public function buyer(){
    	return $this->belongsTo(Buyer::class);
    }

    /**
     * Transaction belongs to product
     *
     * @var mix
     */
    public function product(){
    	return $this->belongsTo(Product::class);
    }





}
