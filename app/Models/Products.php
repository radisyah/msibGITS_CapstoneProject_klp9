<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_code',
        'name',
        'purchase_price',
        'selling_price',
        'stock',
        'image',
        'category_id'
    ];

    public function categories()
    {
       return $this->belongsTo(Categories::class,'category_id');
    }

    public function detail_transaksi(){
        return $this->hasMany(DetailTransaksi::class);
    }
    
}
