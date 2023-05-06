<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\User;
use App\Models\Products;
// use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{

    
    public function __construct()
    {
        // $this->Transaksi = new Transaksi();
    }

    public function index()
    {
        $data = array(
            'title' => 'Halaman Dashboard',
            'menu'=>'dashboard',
            'sub_menu'=>'',
            'judul'=>'Dashboard',
            'sub_judul'=>'',
            'product' => Products::count(),
            'category' => Categories::count(),
            // 'p_hari_ini' => $this->Transaksi->PendapatanHariIni(),
			// 'p_bulan_ini' => $this->Transaksi->PendapatanBulanIni(),
			// 'p_tahun_ini' => $this->Transaksi->PendapatanTahunIni(),
            'user' => User::count(),
            // 'transaksi' => Transaksi::count()
        );

        return view('dashboard',$data);
        // dd($this->Transaksi->PendapatanHariIni());
    }
}
