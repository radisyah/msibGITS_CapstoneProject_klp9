<?php
 
namespace App\Http\Controllers;


use App\Models\Categories;
use App\Models\User;
use App\Models\Products;
use App\Models\Transaksis;
use App\Models\DetailTransaksi;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

 
class TransactionController extends Controller
{

  public function __construct()
  {
    $this->Transaksi = new Transaksis();
  }

  public function index()
  {

    $data = array(
      'title' => 'Halaman Order',
      
      // 'products' => $this->Transaksi->allData(),
      // 'invoice' => $this->Transaksis->inVoice(),
      // 'cart' => Cart::content(),
      // 'grand_total' => Cart::subtotal()
    );
    return view('transaction.index',$data);
    
    // dd($this->Transaksi->inVoice());
  }

   public function view_cart()
  {

    $data = array(
      'title' => 'Halaman Lihat Order ',
      
      // 'products' => $this->Transaksi->allData(),
      // 'invoice' => $this->Transaksis->inVoice(),
      // 'cart' => Cart::content(),
      // 'grand_total' => Cart::subtotal()
    );
    return view('transaction.view_cart',$data);
    
    // dd($this->Transaksi->inVoice());
  }

  

}