<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Seller;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

	// Status constants
	const AVAILABE_PRODUCT = 'available';
	const UNAVAILABLE_PRODUCT = 'unavailable';

	// Fillable attributes for mass assignments
    protected $fillable =[ 
    	'name',
    	'description',
    	'quantity',
    	'status',
    	'image',
    	'seller_id',

    ];

    /**
	* Return available status
	*  @return Bool
    */
    public function isAvailable(){
    	return $this->status == Product::AVAILABE_PRODUCT;
    }

    /**
	* Product belongs to many categorys
	*  @return mix
    */
    public function categories(){
    	return $this->belongsToMany(Category::class);
    }


    /**
	* Product belongs to one seller
	*  @return mix
    */
    public function seller(){
    	return $this->belongsTo(Seller::class);
    }

	/**
	* Product has many transactions
	*  @return mix
    */
    public function transactions(){
    	return $this->hasMany(Transaction::class);
    }













}
