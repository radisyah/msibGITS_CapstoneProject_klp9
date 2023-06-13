<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\User;
use App\Models\Products;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\Session;
// use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{

    
    public function __construct()
    {
        $this->Transaksi = new Transaksi();
    }

    public function index()
    {
        $today = Carbon::today();

        $transaksisPerhari = Transaksi::where('status','Done')->whereDate('created_at',$today)->get();
        $transaksisPerbulan = Transaksi::where('status','Done')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->get();
        $transaksisPertahun = Transaksi::where('status','Done')->whereYear('created_at', Carbon::now()->year)->get();

        // Untung PerHari
        $u_hari_ini = 0;
        foreach ($transaksisPerhari as $transaksi) {
            foreach ($transaksi->detailTransaksi as $detail_transaksis) {
                $u_hari_ini += ($detail_transaksis->product_price - $detail_transaksis->products->purchase_price) * $detail_transaksis->qty;
            }
        }

        // Untung Perbulan
        $u_bulan_ini = 0;
        foreach ($transaksisPerbulan as $transaksi) {
            foreach ($transaksi->detailTransaksi as $detail_transaksis) {
                $u_bulan_ini += ($detail_transaksis->product_price - $detail_transaksis->products->purchase_price) * $detail_transaksis->qty;
            }
        }

         // Untung Pertahun
        $u_tahun_ini = 0;
        foreach ($transaksisPertahun as $transaksi) {
            foreach ($transaksi->detailTransaksi as $detail_transaksis) {
             $u_tahun_ini += ($detail_transaksis->product_price - $detail_transaksis->products->purchase_price) * $detail_transaksis->qty;
            }
        }
       
        $data = array(
            'title' => 'Halaman Dashboard',
            'menu'=>'dashboard',
            'sub_menu'=>'',
            'judul'=>'Dashboard',
            'sub_judul'=>'',
            'product' => Products::count(),
            'category' => Categories::count(),
            'p_hari_ini' => Transaksi::where('status', 'Done')->whereDate('created_at',$today)->sum('total_price'),
            'u_hari_ini' => $u_hari_ini,
			'p_bulan_ini' => Transaksi::where('status', 'Done')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->sum('total_price'),
            'u_bulan_ini' => $u_bulan_ini,
			'p_tahun_ini' => Transaksi::where('status', 'Done')->whereYear('created_at',Carbon::now()->year)->sum('total_price'),
            'u_tahun_ini' => $u_tahun_ini,
            'user' => User::count(),
            
            
            'transaksi' => Transaksi::where('status', 'Done')->count()
        );

    

  $data_transaksi = DB::table('transaksis')
    ->join('detail_transaksis', 'detail_transaksis.transaksi_id', '=', 'transaksis.id')
    ->join('products', 'detail_transaksis.product_id', '=', 'products.id')
    ->where('transaksis.status', 'Done')
    ->whereMonth('transaksis.created_at', date('m'))
    ->whereYear('transaksis.created_at', date('Y')) 
    ->groupBy(DB::raw('DATE_FORMAT(transaksis.created_at, "%Y-%m-%d")'))
    ->select(
        DB::raw('DATE_FORMAT(transaksis.created_at, "%Y-%m-%d") AS transactionDate'),
        DB::raw('SUM((detail_transaksis.product_price - products.purchase_price) * detail_transaksis.qty) AS totalProfit'),
        DB::raw('SUM(detail_transaksis.qty * detail_transaksis.product_price) AS totalRevenue')
    )
    ->orderBy(DB::raw('DATE_FORMAT(transaksis.created_at, "%Y-%m-%d")'))
    ->get();


    $labels = [];
    $totalProfitData = [];
    $totalRevenueData = [];

    foreach ($data_transaksi as $item) {
        $labels[] = Carbon::parse($item->transactionDate)->format('d M Y');
        $totalProfitData[] = $item->totalProfit;
        $totalRevenueData[] = $item->totalRevenue;
    }
    
    

    return view('dashboard',$data, compact('labels','totalProfitData','totalRevenueData'));
    }

   


   
}
