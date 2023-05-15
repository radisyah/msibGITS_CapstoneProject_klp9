<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


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

    public function allData_makanan()
    {
      
        return DB::table('products')
        ->join('categories', 'categories.id','=','products.category_id')
        ->select(
        'products.id as id_product',
        'product_code',
        'name',
        'categories.category_name',
        'purchase_price',
        'selling_price',
        'stock',
        'image',)
        ->where('categories.category_name','Makanan')
        ->get();
    }

    public function allData_minuman()
    {
      
        return DB::table('products')
        ->join('categories', 'categories.id','=','products.category_id')
        ->select(
        'products.id as id_product',
        'product_code',
        'name',
        'categories.category_name',
        'purchase_price',
        'selling_price',
        'stock',
        'image',)
        ->where('categories.category_name','Minuman')
        ->get();
    }

      public function ambil_stok($id_product)
    {
        return DB::table('products')
             ->join('categories', 'categories.id','=','products.category_id')
            ->select(
            'products.id as id_product',
            'product_code',
            'name',
            'category_name',
            'purchase_price',
            'selling_price',
            'stock',
            'image',)
             ->where('products.id',$id_product)
             ->get()
             ->first();
    }

}
