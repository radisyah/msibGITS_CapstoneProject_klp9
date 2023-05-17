<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

      protected $fillable = [
        'transaksi_id',
        'product_id',
        'qty',
        'price'
    ];

     public function products(){
        return $this->belongsTo(Products::class);
    }

     public function transaksi(){
        return $this->belongsTo(Transaksi::class);
    }

}
