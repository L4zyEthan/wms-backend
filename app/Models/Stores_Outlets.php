<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;
use App\Models\VarianceReport;

class Stores_Outlets extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'address', 'contact_number'
    ];

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }

    public function productOrders()
    {
        return $this->hasMany(ProductOrder::class, 'store_id');
    }

    public function varianceReports()
    {
        return $this->hasMany(VarianceReport::class, 'store_id');
    }
}
