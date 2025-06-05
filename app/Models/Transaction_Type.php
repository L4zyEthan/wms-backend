<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;

class Transaction_Type extends Model
{
    protected $fillable = [
        'name'
    ];

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }

    public function productOrders(){
        return $this->hasMany(ProductOrder::class, 'transaction_type_id');
    }

    public function varianceReports(){
        return $this->hasMany(VarianceReport::class, 'transaction_type_id');
    }
}
