<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VarianceReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'store_id',
        'start_date',
        'end_date',
        'physical_stock',
        'system_stock',
        'stock_difference',
        'physical_sales',
        'system_sales',
        'sales_difference',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function store(){
        return $this->belongsTo(Stores_Outlets::class, 'store_id');
    }
}
