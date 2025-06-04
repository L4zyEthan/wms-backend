<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    protected $fillable = [
        'store_id',
        'transaction_type_id',
        'total_transaction_price',
        'note',
    ];

    public function store()
    {
        return $this->belongsTo(Stores_Outlets::class, 'store_id');
    }

    public function transactionType()
    {
        return $this->belongsTo(Transaction_Type::class, 'transaction_type_id');
    }
}
