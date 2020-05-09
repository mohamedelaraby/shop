<?php

namespace App\Models;

use App\Models\Transaction;
class Buyer extends User
{
    /**
     * Many Transaction the buyer have
     *
     * @var mix
     */
    public function transactions(){
    	return $this->hasMany(Transaction::class);
    }
}
