<?php
 
namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\User;
use App\Models\Products;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
 
class TransactionController extends Controller
{

  public function __construct()
  {
    $this->Transaksi = new Transaksi();
  }

  public function index()
  {

    $data = array(
      'title' => 'Halaman Order',
      'products_makanan' => $this->Transaksi->allData_makanan(),
      'products_minuman' => $this->Transaksi->allData_minuman(),
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
      'id' => $request->id_product,
      'name' => $request-> name, 
      'price' => $request->selling_price, 
      'weight' => 0, 
      'qty' => 1,
      'options' => [
        'image' =>$request->image,
        'category_name' =>$request->category_name,
        
      ]
    ]);



    return redirect('transaction')->with('success','Menu Berhasil Ditambahkan');

    
  }

   public function view_cart()
  {

    $data = array(
      'title' => 'Halaman Lihat Order ',
      
      // 'products' => $this->Transaksi->allData(),
      // 'invoice' => $this->Transaksis->inVoice(),
      'cart' => Cart::content(),
      'grand_total' => Cart::subtotal()
    );
    // dd(Cart::content());

    return view('transaction.view_cart',$data);

    
    // dd($this->Transaksi->inVoice());
  }

   public function remove_item($rowId){
    Cart::remove($rowId);
    return redirect('transaction/view_cart')->with('success','Jumlah Menu Berhasil Dihapus');;
  }

  public function update_cart(Request $request){

    $i=1;
    
    foreach (Cart::content() as $key => $value) {
    Cart::update($value->rowId, ['qty' => $request->input('qty'.$i++)]);
    }

    return redirect('transaction/view_cart')->with('success','Jumlah Menu Berhasil Diperbarui');;

  }

  public function save_transaction(Request $request){
    $produk = Cart::subtotal();
    $invoice = $this->Transaksi->inVoice();
    $customer_name = $request->input('customer_name');
    $customer_phone = $request->input('customer_phone');
    $user_id = $request->input('user_id');
    $total_price = str_replace(",","",$request->input('grand_total'));
    $transaksi_id = 1;
    $status = 'Order';

    if ( $produk==0 ) {
     return redirect('transaction')->with('danger','Data Keranjang Kosong');
    } else {
          $item = Cart::content();
          $no_urut = 0;

          $query = DB::table('transaksis')
            ->select('id')
            ->get();
          
          foreach($query as $no){
              $no_urut = $no->id;
          }
          if($no_urut == null){
              $no_urut = 1;
          } else {
              $no_urut = $no_urut+1;
          }

          // dd($no_urut);

          $data = [
            'invoice' => $invoice,
            'user_id' => $user_id,
            'customer_name' => $customer_name,
            'customer_phone' => $customer_phone,
            'total_price' => $total_price,
            'status' => $status,
          ];
          Transaksi::create($data);
          
          foreach ($item as $key => $value) {
            $data = [
              'transaksi_id' => $no_urut,
              'product_id' => $value->id,
              'qty' =>  $value->qty,
            ];
            DetailTransaksi::create($data);
          }

          Cart::destroy();

          return redirect('transaction')->with('success','Transaksi Berhasil Disimpan');
    }
  }

  public function list_order()
  {

    
    $data1 = array(
      'menu' => 'list_order',
      'sub_menu' => '',
      'title' => 'Daftar Order',
      'judul' => 'Daftar Order',
      'sub_judul' => '',
      // 'data_listtransaction' => $this->Transaksi->allDataTransaksi()->where('status', '=', 'Order'),

      );

      // for ($i=1; $i < ; $i++) { 
      //   # code...
      // }

      // $transaksi = Transaksi::with('detailTransaksi.products')
      // ->where('status','order')
      // ->latest('id')
      // ->first();

      $orders = Transaksi::with(['detailTransaksi.products'])->where('status','order')->whereHas('detailTransaksi')->get();
     
      //  $dataId = $this->Transaksi->allDetailTransaksi($query);

      // $data2= array(
      //   'data_detailtransaction' =>$this->Transaksi->allDetailTransaksi()->where(1, '=', $query),
      // );
      // dd($transactionDetails);
    return view('list_transaction.list_order',compact('orders'),$data1);
  }

  public function status_proses($id)
    {
        $data = Transaksi::find($id);
        $data->status = 'Proses';

        $data->save();
        return back()->with('success','Transaksi Berhasil Diproses');
    }
  
    public function list_proses()
  {
  
    $data1 = array(
      'menu' => 'list_proses',
      'sub_menu' => '',
      'title' => 'Daftar Order',
      'judul' => 'Daftar Order',
      'sub_judul' => '',
      // 'data_listtransaction' => $this->Transaksi->allDataTransaksi()->where('status', '=', 'Proses'),
      // 'data_detailtransaction' =>$this->Transaksi->allDetailTransaksi(),

      );

      $orders = Transaksi::with(['detailTransaksi.products'])->where('status','Proses')->whereHas('detailTransaksi')->get();

    return view('list_transaction.list_proses',compact('orders'),$data1);
  }

  public function status_serve($id)
    {
        $data = Transaksi::find($id);
        $data->status = 'Serve';

        $data->save();
        return back()->with('success','Transaksi Berhasil Dihidang');
    }
  
    public function list_payment()
    {
    
      $data1 = array(
        'menu' => 'list_payment',
        'sub_menu' => '',
        'title' => 'Daftar Order',
        'grand_total' => Cart::subtotal(),
        'judul' => 'Daftar Order',
        'sub_judul' => '',
        // 'data_listtransaction' => $this->Transaksi->allDataTransaksi()->where('status', '=', 'Serve'),
        // 'data_detailtransaction' =>$this->Transaksi->allDetailTransaksi(),
  
        );
        $orders = Transaksi::with(['detailTransaksi.products'])->where('status','Serve')->whereHas('detailTransaksi')->get();

        return view('list_transaction.list_payment',compact('orders'),$data1);
    }
  
    public function status_done(Request $request,$id)
      {
          $data = Transaksi::find($id);
          $data->status = 'Done';
          $data->payment = str_replace(",","",$request->input('dibayar'));
          $data->change = str_replace(",","",$request->input('kembalian'));
  
          $data->save();
          return back()->with('success','Transaksi Berhasil Disimpan');
      }
    
      public function list_transaksi()
      {
        $data1 = array(
          'menu' => 'list_transaction',
          'sub_menu' => '',
          'title' => 'Riwayat Transaksi',
          'judul' => 'Riwayat Transaksi',
          'sub_judul' => '',
          'data_listtransaction' => $this->Transaksi->allDataTransaksi()->where('status', '=', 'Done'),
          'data_detailtransaction' =>$this->Transaksi->allDetailTransaksi(),
    
          );
        return view('list_transaction.index',$data1);
      }

    public function detail($id){
    $data = array(
      'menu' => 'list_transaction',
      'sub_menu' => '',
      'title' => 'Halaman Detail Transaksi',
      'judul' => 'Detail Transaksi',
      'sub_judul' => '',
      'details2' => $this->Transaksi->payment($id)
      );
    $data2['details'] = $this->Transaksi->alldetailTransaksis($id);
    // $data3['cash'] = $this->Transaksi->payment($id);

      // dd($this->Transaksi->payment($id));

    return view('list_transaction.list_detail', $data, $data2);
  }

  public function print_list_transaction($id){
    $data = array(
     'details2' => $this->Transaksi->payment($id)
     );
    $data2['details'] = $this->Transaksi->alldetailTransaksis($id);
     return view('list_transaction.print_list_transaction',$data, $data2);
 }

}