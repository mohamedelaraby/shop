<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // fillable attributes
    protected $fillable = [
    	'name',
        'description',
       
    ];


     /**
     * Many product the Category has
     *
     * @var mix
     */
    public function products(){
    	return $this->belongsToMany(Product::class);
    }
}
