<?php
 
namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use App\Models\Transaksi;
use App\Models\NomorMeja;
use App\Models\DetailTransaksi;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;
use App\Mail\OrdersEmail;
use App\Mail\DoneEmail;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Carbon\Carbon;
 
class TransactionController extends Controller
{

  public function __construct()
  {
    $this->Transaksi = new Transaksi();
  }


  public function index($nomor_meja)
  {
    // $no = DB::table('nomor_mejas')
    //       ->select('id')
    //       ->where('id', $id)
    //       ->get();

    $url = route('transaction',[$nomor_meja]);
    $pecah = explode("/", $url);
    $data_meja = $pecah['4'];
    
    $no_meja = $this->Transaksi->getNo_meja();
    // dd($meja, $no_meja);

    foreach ($no_meja as $row) {
      $a = $row->nomor_meja;
      // dd($a, $data_meja);
      if ($data_meja==$a) {
        return response()->json('Meja sudah dipesan, silahkan memilih meja yang lain', 401);
        // abort(404, "Meja sudah dipesan, silahkan memilih meja yang lain");
        // return redirect()->back()->with('danger','Meja sudah dipesan, silahkan memilih meja yang lain');
      }
    }


    $meja = NomorMeja::where('nomor_meja',$nomor_meja)->first();
    // dd($meja);

    if (!$meja) {
      abort(404, 'Meja Tidak Ditemukan');
    }
    
    $data = array(
      'title' => 'Bale Rasa | Good Food is Good Mood',
      'products_makanan' => $this->Transaksi->allData_makanan(),
      'nomor_meja' => $nomor_meja,
      'products_minuman' => $this->Transaksi->allData_minuman(),
      // 'meja2' =>NomorMeja::where('nomor_meja',$nomor_meja)->first(),
      // 'view_cart' => $this->view_cart($no_meja)
      // 'invoice' => $this->Transaksis->inVoice(),
      // 'cart' => Cart::content(),
      // 'grand_total' => Cart::subtotal()
    );

    // dd($data['no_meja']);

    // return $this->view_cart($no_meja);
    return view('transaction.index',$data, compact('meja'));
    
  }

  public function transaction_order()
  {
    $data = array(
    'title' => 'Halaman Transaksi Order',
    'menu'=>'transaction_order',
    'sub_menu'=>'',
    'judul'=>'Transaksi Order',
    'sub_judul'=>'',
    'nomor_meja' => NomorMeja::all()
    );
    return view('transaction.transaction_order',$data);
  } 

  public function live_report_ordering()
  {
    $orders = Transaksi::with('nomorMeja')
    ->where('status', '!=', 'done')
    ->get();

    $data = array(
      'title' => 'Halaman Live Report Ordering',
      'orders' => $orders
    );


    return view('live_report_ordering',$data);
  }

  public function add_cart($id_product, $nomor_meja,Request $request)
  {
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

    // $meja = NomorMeja::where('nomor_meja',$nomor_meja)->first();



    $cart =  Cart::add([
      'id' => $request->id_product,
      'name' => $request->name, 
      'price' => $request->selling_price, 
      'weight' => 0, 
      'qty' => 1,
      'options' => [
        'image' =>$request->image,
        'meja' => $request->nomor_meja,
        'category_name' =>$request->category_name,
      ]
    ]);




    return redirect()->back()->with('success','Menu Berhasil Ditambahkan');

    
  }

  public function view_cart($nomor_meja)
  {
    // return $no_meja;
    
    $meja = NomorMeja::where('nomor_meja',$nomor_meja)->first();
    
        // dd(Cart::content());
    

    if (!$meja) {
      abort(404, 'Meja Tidak Ditemukan');
    }

    $cart = Cart::content()->where('options.meja',$nomor_meja);
    $grand_total = 0;

    foreach ($cart as $item) {
      if ($item->options->meja == $nomor_meja) {
        $sub_total_price = $item->price * $item->qty;
        $grand_total += $sub_total_price;
      }
    }

  
    // $grand_total = Cart::subtotal(0)->where('options.meja',$nomor_meja);
    // dd($grand_total);
  
    // dd($nomor_meja);

    $data = array(
      'title' => 'Halaman Lihat Order ',
      // 'products' => $this->Transaksi->allData(),
      // 'invoice' => $this->Transaksis->inVoice(),
      'nomor_meja' => $nomor_meja,
      'cart' => $cart,
      'grand_total' => $grand_total
    );

    // dd($url);

    return view('transaction.view_cart',$data,compact('meja'));

    
    // dd($this->Transaksi->inVoice());
  }

  public function remove_item($rowId)
  {
    Cart::remove($rowId);
    return redirect()->back()->with('success','Jumlah Menu Berhasil Dihapus');;
  }

  public function update_cart(Request $request, $nomor_meja)
  {
    $meja = NomorMeja::where('nomor_meja', $nomor_meja)->first();
    $qtyArray = $request->input('qty');

    foreach ($qtyArray as $rowId => $qty) {
        Cart::update($rowId, ['qty' => $qty]);
    }

    return redirect()->back()->with('success','Jumlah Menu Berhasil Dihapus');;
  }

  public function save_transaction(Request $request,$nomor_meja)
  {
    $meja = NomorMeja::where('nomor_meja',$nomor_meja)->first();
    // $produk = Cart::subtotal();
    $invoice = $this->Transaksi->inVoice();
    $customer_name = $request->input('customer_name');
    $customer_email = $request->input('customer_email');
    $customer_phone = $request->input('customer_phone');
    $mejas_id = $request->input('nomor_meja');
    $total_price = str_replace(",","",$request->input('grand_total'));
    $transaksi_id = 1;
    $status = 'Order';
    // dd($mejas_id);
    

    if ( $total_price==0 ) {
     return redirect()->back()->with('danger','Data Keranjang Kosong');
    } else {
        $item = Cart::content()->where('options.meja',$nomor_meja);
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
          'customer_name' => $customer_name,
          'customer_email' => $customer_email,
          'customer_phone' => $customer_phone,
          'mejas_id' => $mejas_id,
          'total_price' => $total_price,
          'status' => $status,
        ];
        Transaksi::create($data);

        
        
        foreach ($item as $key => $value) {
          $data = [
            'transaksi_id' => $no_urut,
            'product_id' => $value->id,
            'qty' =>  $value->qty,
            'product_price' =>  $value->price,
          ];
          DetailTransaksi::create($data);
          if ($value->options->meja == $nomor_meja) {
            Cart::remove($value->rowId);
          }
        }

        // dd($itemsToDelete);
       
            // -------- Notif Email ---------

        // $orders = Transaksi::with(['detailTransaksi.products', 'nomorMeja'])
        // ->where('status', 'order')
        // ->whereHas('detailTransaksi')
        // ->where('invoice', $invoice) // Menambahkan kondisi nomor invoice
        // ->get();
        
        // Mail::to($customer_email)->send(new OrdersEmail($orders));

            // -------- Notif Email ---------
      
      
        return redirect()->back()->with('success','Transaksi Berhasil Disimpan');
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

    $orders = Transaksi::with(['detailTransaksi.products','nomorMeja'])->where('status','order')->whereHas('detailTransaksi')->get();
  
    //  $dataId = $this->Transaksi->allDetailTransaksi($query);

    // $data2= array(
    //   'data_detailtransaction' =>$this->Transaksi->allDetailTransaksi()->where(1, '=', $query),
    // );
    // dd($orders);
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
      'title' => 'Daftar Proses',
      'judul' => 'Daftar Proses',
      'sub_judul' => '',
      // 'data_listtransaction' => $this->Transaksi->allDataTransaksi()->where('status', '=', 'Proses'),
      // 'data_detailtransaction' =>$this->Transaksi->allDetailTransaksi(),

      );
    $orders = Transaksi::with(['detailTransaksi.products','nomorMeja'])->where('status','Proses')->whereHas('detailTransaksi')->get();
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
      'title' => 'Daftar Serve',
      'grand_total' => Cart::subtotal(0),
      'judul' => 'Daftar Serve',
      'sub_judul' => '',
      // 'data_listtransaction' => $this->Transaksi->allDataTransaksi()->where('status', '=', 'Serve'),
      // 'data_detailtransaction' =>$this->Transaksi->allDetailTransaksi(),

      );
    $orders = Transaksi::with(['detailTransaksi.products','nomorMeja'])->where('status','Serve')->whereHas('detailTransaksi')->get();
    return view('list_transaction.list_payment',compact('orders'),$data1);
  }
  
  public function status_done(Request $request,$id)
  {
    $data = Transaksi::find($id);
    $data->status = 'Done';
    $data->payment = str_replace(",","",$request->input('dibayar'));
    $data->change = str_replace(",","",$request->input('kembalian'));          
    $data->save();

        // -------- Notif Email ---------
    // $dones = Transaksi::with(['detailTransaksi.products', 'nomorMeja'])
    // ->where('status', 'Done')
    // ->whereHas('detailTransaksi')
    // ->where('id', $id) // Menambahkan kondisi nomor invoice
    // ->get();
  
    // Mail::to($data->customer_email)->send(new DoneEmail($dones));
        // -------- Notif Email ---------
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

  public function detail($id)
  {
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

  public function print_list_transaction($id)
  {
    $data = array(
     'details2' => $this->Transaksi->payment($id)
     );
    $data2['details'] = $this->Transaksi->alldetailTransaksis($id);
     return view('list_transaction.print_list_transaction',$data, $data2);
  }

  public function eksport_pdf()
  {
    $orders = Transaksi::with(['detailTransaksi.products','nomorMeja'])->where('status','Done')->whereHas('detailTransaksi')->get();

    $html = view('list_transaction.eksport_pdf', compact('orders'))->render();

    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    $dompdf->stream('riwayat_transaksi'.date('dmY').'.pdf');
  }

  public function eksport_excel()
  {
    $orders = Transaksi::with(['detailTransaksi.products','nomorMeja'])->where('status','Done')->whereHas('detailTransaksi')->get();

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Merge dan set judul "Data Produk"
    $sheet->mergeCells('A1:F1');
    $sheet->setCellValue('A1', 'Riwayat Transaksi');
    $sheet->getStyle('A1')->getFont()->setBold(true);
    $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('A2:F2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('A:F')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    // Set judul kolom
    $sheet->setCellValue('A2', 'No.');
    $sheet->setCellValue('B2', 'Invoice');
    $sheet->setCellValue('C2', 'Nomor Meja');
    $sheet->setCellValue('D2', 'Nama Customer');
    $sheet->setCellValue('E2', 'Daftar Pesanan');
    $sheet->setCellValue('F2', 'Total Pendapatan');
    $sheet->getStyle('A2:F2')->getFont()->setBold(true);

    // Set data pesanan
    $row = 3;
    foreach ($orders as $item) {
        $sheet->setCellValue('A' . $row, $row - 2);
        $sheet->setCellValue('B' . $row, $item->invoice);
        $sheet->setCellValue('C' . $row, $item->nomorMeja->nomor_meja);
        $sheet->setCellValue('D' . $row, $item->customer_name);

        $innerTable = '';
        foreach ($item->detailTransaksi as $item2) {
            $innerTable .= $item2->products->name . ' - ' . $item2->qty . 'x' . ' - Rp. ' . number_format($item2->product_price, 0) . ' = Rp. ' . number_format($item2->product_price * $item2->qty, 0) . "\n";
        }
        $sheet->setCellValue('E' . $row, $innerTable);

        $sheet->setCellValue('F' . $row, 'Rp. ' . number_format($item->total_price,0));
        $row++;
    }

    // Buat file Excel
    $writer = new Xlsx($spreadsheet);
    $filename = 'riwayat_transaksi'.date('dmY').'.xlsx';
    $writer->save($filename);

    // Mengirimkan file Excel ke browser
    return response()->download($filename)->deleteFileAfterSend();
  }

  public function laporan_harian()
  {
     $data = array(
    'title' => 'Halaman Laporan Harian',
    'menu'=>'laporan',
    'sub_menu'=>'l_harian',
    'judul'=>'Laporan Harian',
    'sub_judul'=>'Halaman Laporan Harian',
    );

    return view('laporan.v_laporan_harian',$data);
  }

  public function view_laporan_harian(Request $request)
  {
    $tgl = $request->input('tgl');

    $data = [
      'dataharian' => $this->Transaksi->DataHarian($tgl),
    ];  

    $response = [
      'data' => view('laporan.v_tabel_laporan_harian', $data)->render(),
    ];

    return response()->json($response);
  }

  public function eksport_pdf_laporan_harian($tgl)
  {
    // $tgl = $request->input('tgl');
    $dataharian =  $this->Transaksi->DataHarian($tgl);

    $html = view('laporan.eksport_pdf_harian', compact('dataharian','tgl'))->render();

    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    $dompdf->stream('laporan_penjualan_harian'.date('dmY').'.pdf');
  }

  public function eksport_excel_laporan_harian($tgl)
  {
    $dataharian =  $this->Transaksi->DataHarian($tgl);
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

     // Menambahkan judul laporan
    $sheet->setCellValue('A1', 'Laporan Penjualan Harian');
    
    // Menambahkan tanggal
    $tgl = date('d M y');
    $sheet->setCellValue('A2', 'Tanggal: '.$tgl);

    // Merge
    $sheet->mergeCells('A7:F7');

    $sheet->getStyle('A1')->getFont()->setBold(true);
    $sheet->getStyle('A7')->getFont()->setBold(true);
    $sheet->getStyle('A7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('A4:H4')->getFont()->setBold(true);
    
    // Menambahkan header kolom
    $sheet->setCellValue('A4', 'No');
    $sheet->setCellValue('B4', 'Kode Produk');
    $sheet->setCellValue('C4', 'Nama Produk');
    $sheet->setCellValue('D4', 'Modal');
    $sheet->setCellValue('E4', 'Harga Jual');
    $sheet->setCellValue('F4', 'Terjual');
    $sheet->setCellValue('G4', 'Total Pendapatan');
    $sheet->setCellValue('H4', 'Total Keuntungan');
    
    // Menambahkan data penjualan harian
    $row = 5;
    $no = 1;
    $grandtotal = 0;
    $granduntung = 0;
    
    foreach ($dataharian as $key => $item) {
        $sheet->setCellValue('A'.$row, $no);
        $sheet->setCellValue('B'.$row, $item->product_code);
        $sheet->setCellValue('C'.$row, $item->name);
        $sheet->setCellValue('D'.$row, 'Rp. '.number_format($item->purchase_price, 0));
        $sheet->setCellValue('E'.$row, 'Rp. '.number_format($item->product_price, 0));
        $sheet->setCellValue('F'.$row, $item->qty);
        $sheet->setCellValue('G'.$row, 'Rp. '.number_format($item->total_harga, 0));
        $sheet->setCellValue('H'.$row, 'Rp. '.number_format($item->untung, 0));
        
        $no++;
        $row++;
        $grandtotal += $item->total_harga;
        $granduntung += $item->untung;
    }
    
    // Menambahkan total keseluruhan
    $sheet->setCellValue('A7', 'Grand Total');
    $sheet->setCellValue('G'.$row, 'Rp. '.number_format($grandtotal, 0));
    $sheet->setCellValue('H'.$row, 'Rp. '.number_format($granduntung, 0));
    
    // Mengatur lebar kolom
    $sheet->getColumnDimension('A')->setWidth(5);
    $sheet->getColumnDimension('B')->setWidth(15);
    $sheet->getColumnDimension('C')->setWidth(25);
    $sheet->getColumnDimension('D')->setWidth(15);
    $sheet->getColumnDimension('E')->setWidth(15);
    $sheet->getColumnDimension('F')->setWidth(10);
    $sheet->getColumnDimension('G')->setWidth(15);
    $sheet->getColumnDimension('H')->setWidth(15);
    

    // Buat file Excel
    $writer = new Xlsx($spreadsheet);
    $filename = 'laporan_penjualan_harian'.date('dmY').'.xlsx';
    $writer->save($filename);

    // Mengirimkan file Excel ke browser
    return response()->download($filename)->deleteFileAfterSend();
  }

  public function laporan_bulanan()
  {
     $data = array(
    'title' => 'Halaman Laporan Bulanan',
    'menu'=>'laporan',
    'sub_menu'=>'l_bulanan',
    'judul'=>'Laporan Bulanan',
    'sub_judul'=>'Halaman Laporan Bulanan',
    );

    return view('laporan.v_laporan_bulanan',$data);
  }


  public function view_laporan_bulanan(Request $request)
  {
    $bulan = $request->input('bulan');
    $tahun = $request->input('tahun');
    // $bulan = 6;
    // $tahun = 2023;

    $data = [
      'databulanan' => $this->Transaksi->DataBulanan($bulan,$tahun),
    ];  

    // dd($data);

    $response = [
      'data' => view('laporan.v_tabel_laporan_bulanan', $data)->render(),
    ];

    return response()->json($response);
  }

  public function eksport_pdf_laporan_bulanan($bulan,$tahun)
  {
    // $tgl = $request->input('tgl');
    $databulanan =  $this->Transaksi->DataBulanan($bulan,$tahun);

    $html = view('laporan.eksport_pdf_bulanan', compact('databulanan','bulan','tahun'))->render();

    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    $dompdf->stream('laporan_penjualan_bulanan'.date('dmY').'.pdf');
  }

  public function eksport_excel_laporan_bulanan($bulan,$tahun)
  {
    $databulanan =  $this->Transaksi->DataBulanan($bulan,$tahun);
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    
    // Menambahkan judul laporan
    $sheet->setCellValue('A1', 'Laporan Penjualan Bulanan');

    // Menambahkan tanggal
    $tanggal = date('M', strtotime($bulan)) . ' ' . $tahun;
    $sheet->setCellValue('A2', 'Periode: ' . $tanggal);

    
    // Merge
    $sheet->mergeCells('A7:B7');

    $sheet->getStyle('A7')->getFont()->setBold(true);
    $sheet->getStyle('A7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('A1')->getFont()->setBold(true);
    $sheet->getStyle('A4:D4')->getFont()->setBold(true);

    // Menambahkan header kolom
    $sheet->setCellValue('A4', 'No');
    $sheet->setCellValue('B4', 'Tanggal');
    $sheet->setCellValue('C4', 'Total Pendapatan');
    $sheet->setCellValue('D4', 'Total Keuntungan');

    // Menambahkan data penjualan bulanan
    $row = 5;
    $no = 1;
    $grandtotal = 0;
    $granduntung = 0;

    foreach ($databulanan as $key => $item) {
        $sheet->setCellValue('A' . $row, $no);
        $sheet->setCellValue('B' . $row, $item->tanggal);
        $sheet->setCellValue('C' . $row, 'Rp. ' . number_format($item->total_harga, 0));
        $sheet->setCellValue('D' . $row, 'Rp. ' . number_format($item->untung, 0));

        $no++;
        $row++;
        $grandtotal += $item->total_harga;
        $granduntung += $item->untung;
    }

    // Menambahkan total keseluruhan
    $sheet->setCellValue('A7', 'Grand Total');
    $sheet->setCellValue('C' . $row, 'Rp. ' . number_format($grandtotal, 0));
    $sheet->setCellValue('D' . $row, 'Rp. ' . number_format($granduntung, 0));

    // Mengatur lebar kolom
    $sheet->getColumnDimension('A')->setWidth(5);
    $sheet->getColumnDimension('B')->setWidth(15);
    $sheet->getColumnDimension('C')->setWidth(15);
    $sheet->getColumnDimension('D')->setWidth(15);

    // Buat file Excel
    $writer = new Xlsx($spreadsheet);
    $filename = 'laporan_penjualan_bulanan'.date('dmY').'.xlsx';
    $writer->save($filename);

    // Mengirimkan file Excel ke browser
    return response()->download($filename)->deleteFileAfterSend();


  }

  public function laporan_tahunan()
  {
    $data = array(
    'title' => 'Halaman Laporan Tahunan',
    'menu'=>'laporan',
    'sub_menu'=>'l_tahunan',
    'judul'=>'Laporan Tahunan',
    'sub_judul'=>'Halaman Laporan Tahunan',
    );

    return view('laporan.v_laporan_tahunan',$data);
  }

  public function view_laporan_tahunan(Request $request)
  {
    $tahun = $request->input('tahun');
    // $bulan = 6;
    // $tahun = 2023;

    $data = [
      'datatahunan' => $this->Transaksi->DataTahunan($tahun),
    ];  

    // dd($data);

    $response = [
      'data' => view('laporan.v_tabel_laporan_tahunan', $data)->render(),
    ];

    return response()->json($response);
  }

  public function eksport_pdf_laporan_tahunan($tahun)
  {
    // $tgl = $request->input('tgl');
    $datatahunan =  $this->Transaksi->DataTahunan($tahun);

    $html = view('laporan.eksport_pdf_tahunan', compact('datatahunan','tahun'))->render();

    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    $dompdf->stream('laporan_penjualan_tahunan'.date('dmY').'.pdf');
  }

  public function eksport_excel_laporan_tahunan($tahun)
  {
    $datatahunan =  $this->Transaksi->DataTahunan($tahun);
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    
    // Menambahkan judul laporan
    $sheet->setCellValue('A1', 'Laporan Penjualan Tahunan');

    // Menambahkan tanggal
    $tanggal = $tahun;
    $sheet->setCellValue('A2', 'Periode: ' . $tanggal);

    
    // Merge
    $sheet->mergeCells('A7:B7');

    $sheet->getStyle('A7')->getFont()->setBold(true);
    $sheet->getStyle('A7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('A1')->getFont()->setBold(true);
    $sheet->getStyle('A4:D4')->getFont()->setBold(true);

    // Menambahkan header kolom
    $sheet->setCellValue('A4', 'No');
    $sheet->setCellValue('B4', 'Tanggal');
    $sheet->setCellValue('C4', 'Total Pendapatan');
    $sheet->setCellValue('D4', 'Total Keuntungan');

    // Menambahkan data penjualan bulanan
    $row = 5;
    $no = 1;
    $grandtotal = 0;
    $granduntung = 0;

    foreach ($datatahunan as $key => $item) {
        $sheet->setCellValue('A' . $row, $no);
        $sheet->setCellValue('B' . $row, $item->tanggal);
        $sheet->setCellValue('C' . $row, 'Rp. ' . number_format($item->total_harga, 0));
        $sheet->setCellValue('D' . $row, 'Rp. ' . number_format($item->untung, 0));

        $no++;
        $row++;
        $grandtotal += $item->total_harga;
        $granduntung += $item->untung;
    }

    // Menambahkan total keseluruhan
    $sheet->setCellValue('A7', 'Grand Total');
    $sheet->setCellValue('C' . $row, 'Rp. ' . number_format($grandtotal, 0));
    $sheet->setCellValue('D' . $row, 'Rp. ' . number_format($granduntung, 0));

    // Mengatur lebar kolom
    $sheet->getColumnDimension('A')->setWidth(5);
    $sheet->getColumnDimension('B')->setWidth(15);
    $sheet->getColumnDimension('C')->setWidth(15);
    $sheet->getColumnDimension('D')->setWidth(15);

    // Buat file Excel
    $writer = new Xlsx($spreadsheet);
    $filename = 'laporan_penjualan_tahunan'.date('dmY').'.xlsx';
    $writer->save($filename);

    // Mengirimkan file Excel ke browser
    return response()->download($filename)->deleteFileAfterSend();


  }




  


}