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
      'products' => $this->Transaksi->allData(),
      // 'invoice' => $this->Transaksis->inVoice(),
      // 'cart' => Cart::content(),
      // 'grand_total' => Cart::subtotal()
    );
    return view('transaction.index',$data);
    
    // dd($this->Transaksi->inVoice());
  }

  public function add_cart($id_product, Request $request){


    // $ambilDataProduk = $this->Transaksi->ambil_stok($id_product);

    // $stokProduk = $ambilDataProduk->stock;

    // if ($qty>intval($stokProduk)) {
    //     return redirect('transaction')->with('danger','Stok Tidak Mencukupi');
    // } else {
    //   $cart =  Cart::add([
    //   'id' => $request->id_product,
    //   'name' => $request->name, 
    //   'price' => $request->selling_price, 
    //   'weight' => 0, 
    //   'qty' =>  $request->qty, 
    //   'options' => [
    //     'product_code' => $request->product_code,
    //     'category_name' => $request->category_name,
    //     'selling_price' => $request->purchase_price,
    //   ]
    // ]);

    

    //  return redirect('transaction');
    // }

     $cart =  Cart::add([
      'id' => 'id_product',
      'name' => $request-> name, 
      'price' => 22, 
      'weight' => 0, 
      'qty' => 1,
      'options' => [
        'product_code' => 'sa',
        
      ]
    ]);

    dd(Cart::content());

    return redirect('transaction');

    
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