<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Transaksi extends Model
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

     public function DetailTransaksi(){
        return $this->hasMany(DetailTransaksi::class);
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

    public function inVoice()
    {
        $no_urut = 0;
        $query = DB::table('transaksis')
            ->select('id')
            ->get();
            
        // $no = $query;
       
        foreach($query as $no){
            $no_urut = $no->id;
        }
        if($no_urut == null){
            $no_urut = 1;
        } else {
            $no_urut = $no_urut+1;
        }
        $invoice = str('gits-').$no_urut;
        return $invoice;
    }

    public function allDataTransaksi()
    {
        return DB::table('transaksis')
             ->join('users', 'users.id','=','transaksis.user_id')
             ->select(
                'transaksis.id',
                'customer_name',
                'customer_phone',
                'invoice',
                'total_price',
                'status',
               )
             ->get();
    }

    public function allDetailTransaksi()
    {
      
        return DB::table('detail_transaksis')
            ->join('transaksis', 'transaksis.id','=','detail_transaksis.transaksi_id')
            ->join('products', 'products.id','=','detail_transaksis.product_id')
            ->select(
            'transaksis.id',
            'products.name',
            'qty',
            'price',
            )
            // ->where('transaksis.id', 'transaksi_id')
            ->get();
    }

}
