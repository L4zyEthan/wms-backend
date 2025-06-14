<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'contact_number',
         'image',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
