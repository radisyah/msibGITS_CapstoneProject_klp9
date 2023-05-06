<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksis extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'user_id',
        'customer_name',
        'customer_phone',
        'invoice',
        'total_price',
        'payment',
        'change',
        'status'
    ];

     public function DetailTransaksis(){
        return $this->hasMany(DetailTransaksis::class);
    }

     public function users(){
        return $this->belongsTo(User::class);
    }

}
