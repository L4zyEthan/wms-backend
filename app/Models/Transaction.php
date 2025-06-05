<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Stores_Outlets;
use App\Models\Transaction_Type;
use App\Models\Product;
use App\Models\TransactionStatus;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes, HasFactory;
    
    protected $fillable = [
        'user_id','store_id','transaction_type_id','total_transaction_price', 'transaction_status_id', 'note',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function store(){
        return $this->belongsTo(Stores_Outlets::class);
    }
    public function transaction_type(){
        return $this->belongsTo(Transaction_Type::class);
    }
    public function transactionStatus()
    {
        return $this->belongsTo(TransactionStatus::class, 'status_id');
    }
    public function products(){
        return $this->belongsToMany(Product::class)->withPivot("quantity", "price", "flawed");
    }

}