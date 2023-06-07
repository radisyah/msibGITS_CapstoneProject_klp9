<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use function PHPUnit\Framework\isNull;

class Transaksi extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'mejas_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'invoice',
        'total_price',
        'payment',
        'change',
        'status',
        'created_at'
    ];

     public function DetailTransaksi(){
        return $this->hasMany(DetailTransaksi::class,'transaksi_id');
    }

    public function NomorMeja(){
        return $this->belongsTo(NomorMeja::class,'mejas_id');
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
            )
            // ->where('transaksis.id', 'transaksi_id')
            ->get();
    }

  
    public function alldetailTransaksis($id)
    {
        return DB::table('transaksis')
             ->join('detail_transaksis', 'detail_transaksis.transaksi_id','=','transaksis.id')
             ->join('products', 'detail_transaksis.product_id','=','products.id')
             ->select(
                'customer_name',
                'customer_phone',
                'selling_price',
                'invoice',
                'status',
                'total_price',
                'status',
                'payment',
                'change',
                'product_code',
                'name',
                'qty',
                'transaksis.created_at'
               )
             ->where('transaksi_id', $id)
             ->get();
    }

    
    public function payment($id)
    {
        return DB::table('detail_transaksis')
             ->join('transaksis', 'transaksis.id','=','detail_transaksis.transaksi_id')
             ->join('products', 'detail_transaksis.product_id','=','products.id')
             ->select(
                'customer_name',
                'customer_phone',
                'products.selling_price',
                'invoice',
                'status',
                'total_price',
                'payment',
                'change',
                'transaksis.id',
                'transaksis.created_at'
               )
             ->where('transaksi_id', $id)
             ->get()
             ->first();
    }

    public function getNo_meja()
    {
        return DB::table(function ($query) {
            $query->select('nomor_mejas.id as meja_id','nomor_mejas.nomor_meja', 'transaksis.status')
                ->from('transaksis')
                ->rightJoin('nomor_mejas', 'nomor_mejas.id', '=', 'transaksis.mejas_id');
        }, 'A')
            ->where('A.status','=', 'Order')
            ->orwhere('A.status','=', 'Proses')
            // ->orWhereNull('A.status')
            ->get();
        
    }

    public function DataHarian($tgl)
    {
        return DB::table('transaksis')
            ->join('detail_transaksis', 'detail_transaksis.transaksi_id', '=', 'transaksis.id')
            ->join('products', 'detail_transaksis.product_id', '=', 'products.id')
            ->where('transaksis.status', 'Done')
            ->whereDate('transaksis.created_at', $tgl)
            ->select(
                'products.product_code',
                'products.name',
                'products.purchase_price',
                'products.selling_price',
                DB::raw('SUM(detail_transaksis.qty) AS qty'),
                DB::raw('SUM((products.selling_price - products.purchase_price) * detail_transaksis.qty) AS untung'),
                DB::raw('SUM(detail_transaksis.qty * products.selling_price) AS total_harga')
            )
            ->groupBy('products.product_code', 'products.name', 'products.purchase_price', 'products.selling_price')
            ->get();
    }

    public function DataBulanan($bulan, $tahun)
    {
        $startDate = $tahun . '-' . $bulan . '-01';
        $endDate = date('Y-m-t', strtotime($startDate));

        return DB::table('transaksis')
            ->join('detail_transaksis', 'detail_transaksis.transaksi_id', '=', 'transaksis.id')
            ->join('products', 'detail_transaksis.product_id', '=', 'products.id')
            ->where('transaksis.status', 'Done')
            ->whereBetween('transaksis.created_at', [$startDate, $endDate])
            ->select(
                DB::raw('DATE(transaksis.created_at) AS tanggal'),
                DB::raw('SUM((products.selling_price - products.purchase_price) * detail_transaksis.qty) AS untung'),
                DB::raw('SUM(detail_transaksis.qty * products.selling_price) AS total_harga')
            )
            ->groupBy('tanggal')
            ->get();
    }

    public function DataTahunan($tahun)
    {
        $startDate = $tahun . '-01-01';
        $endDate = $tahun . '-12-31';

        return DB::table('transaksis')
            ->join('detail_transaksis', 'detail_transaksis.transaksi_id', '=', 'transaksis.id')
            ->join('products', 'detail_transaksis.product_id', '=', 'products.id')
            ->where('transaksis.status', 'Done')
            ->whereBetween('transaksis.created_at', [$startDate, $endDate])
            ->select(
                DB::raw('DATE(transaksis.created_at) AS tanggal'),
                DB::raw('SUM((products.selling_price - products.purchase_price) * detail_transaksis.qty) AS untung'),
                DB::raw('SUM(detail_transaksis.qty * products.selling_price) AS total_harga')
            )
            ->groupBy('tanggal')
            ->get();
    }

   

}
