<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NomorMeja extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_meja',
        'qr'
    ];

     public function Transaksi(){
        return $this->hasMany(Transaksi::class,'mejas_id');
    }
}
