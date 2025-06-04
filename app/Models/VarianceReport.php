<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VarianceReport extends Model
{
    protected $fillable = [
        'store_id',
        'start_date',
        'end_date',
        'physical_stock',
        'system_stock',
        'variance',
        'variance_amount',
        'description',
    ];

    public function store()
    {
        return $this->belongsTo(Stores_Outlets::class, 'store_id');
    }
}
