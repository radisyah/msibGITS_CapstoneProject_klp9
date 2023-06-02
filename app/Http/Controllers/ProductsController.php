<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ProductsController extends Controller
{
    public function index()
    {

      $data1 = array(
			'menu' => 'master',
			'sub_menu' => 'produk',
			'title' => 'Manajemen Produk',
			'judul' => 'Master Data',
			'sub_judul' => 'Manajemen Produk'

      );
        $products = Products::all();
        // dd($products);
      return view('products.index',['data'=>$products],$data1);
    }

    public function create()
    {
        $data = array(
			'menu' => 'master',
			'sub_menu' => 'produk',
			'title' => 'Tambah Produk',
			'judul' => 'Master Data',
			'sub_judul' => 'Manajemen Produk / Tambah Produk',
            'categories' => Categories::all()
      );
        return view('products.add',$data);
    }

    public function store(Request $request)
    {
        $pesan = [
            'required' => ':attribute Tidak Boleh Kosong !!',
            'numeric' => ':attribute Harus Diisi Angka !!',
            'image' => ':attribute Harus Gambar !!',
            'mimes' => ':attribute Harus Beformat jpeg,png,jpg !!',
            'max' => 'Ukuran :attribute Max 5mb !!',
            'unique' => 'Data Produk sudah ada'
        ];
        
         $request->validate([
            'product_code' => 'required|unique:products',
            'name' => 'required|unique:products',
            'purchase_price' => 'required',
            'selling_price' => 'required',
            'stock' => 'required',
            // 'image' => 'required|image|mimes:jpeg,png,jpg|max:5047',
            'category_id' => 'required',
            'image' => [File::types(['jpeg', 'jpg', 'png'])->max(2 * 1024),]
        ],$pesan);
        
        Products::create([
            'product_code'=>$request->input('product_code'),
            'name'=>$request->input('name'),
            'purchase_price' => str_replace(",","", $request->input('purchase_price')),
            'selling_price' =>  str_replace(",","", $request->input('selling_price')),
            'stock' => str_replace(",","", $request->input('stock')),
            'category_id'=>$request->input('category_id'),
            'image' => Storage::putFile('products', $request['image'])
        ]);
    
        return redirect()->route('products')->with('success','Data Produk Berhasil Ditambahkan');
    }


    public function edit($id)
    {
        $data = array(
			'menu' => 'master',
			'sub_menu' => 'produk',
			'title' => 'Edit Produk',
			'judul' => 'Master Data',
			'sub_judul' => 'Manajemen Produk / Edit Produk'

      );
        $products['products'] = Products::where('id',$id)->first();
        $data['categories'] = Categories::all();
        return view('products.edit',$products,$data);
    }

    public function update(Request $request, $id)
    {
        $pesan = [
            'required' => ':attribute Tidak Boleh Kosong !!',
            'numeric' => ':attribute Harus Diisi Angka !!',
        ];
        
         $validated = $request->validate([
            'product_code' => 'required',
            'name' => 'required',
            'purchase_price' => 'required',
            'selling_price' => 'required',
            'stock' => 'required',
            'category_id' => 'required',
            'image' => [File::types(['jpeg', 'jpg', 'png'])->max(2 * 1024),]
        ],$pesan);

        $produk = Products::find($id);
        $produk->product_code = $validated['product_code'];
        $produk->name = $validated['name'];
        $produk->purchase_price = str_replace(",", "", $validated['purchase_price']);
        $produk->selling_price = str_replace(",", "", $validated['selling_price']);
        $produk->stock = str_replace(",", "", $validated['stock']);
        $produk->category_id = $validated['category_id'];

        if($request->file('image')){
                if($produk->image && Storage::exists($produk->image)){
                    Storage::delete($produk->image);
                }
            $produk->image = Storage::putFile('products', $validated['image']);
        }
        $produk->save();

        return redirect()->route('products')->with('success','Data Produk Berhasil Diubah');
    }

   
    public function destroy($id)
    {
        $produk = Products::find($id);
        Storage::delete($produk->image);
        $produk->delete();

        return redirect()->route('products')->with('success','Data Produk Berhasil Dihapus');
    }

    public function eksport_pdf()
    {
        $data = Products::all();

        $html = view('products.eksport_pdf', compact('data'))->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $dompdf->stream('products.pdf');
    }

    public function eksport_excel()
    {
        $products = Products::all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Merge dan set judul "Data Produk"
        $sheet->mergeCells('A1:G1');
        $sheet->setCellValue('A1', 'Data Produk');
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A2:G2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A:G')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Set judul kolom
        $sheet->setCellValue('A2', 'No');
        $sheet->setCellValue('B2', 'Kode Produk');
        $sheet->setCellValue('C2', 'Nama Produk');
        $sheet->setCellValue('D2', 'Kategori');
        $sheet->setCellValue('E2', 'Harga Beli');
        $sheet->setCellValue('F2', 'Harga Jual');
        $sheet->setCellValue('G2', 'Stok');
        $sheet->getStyle('A2:G2')->getFont()->setBold(true);

        // Set data produk
        $row = 3;
        foreach ($products as $key => $product) {
            $sheet->setCellValue('A' . $row, $key + 1);
            $sheet->setCellValue('B' . $row, $product->product_code);
            $sheet->setCellValue('C' . $row, $product->name);
            $sheet->setCellValue('D' . $row, $product->categories->category_name);
            $sheet->setCellValue('E' . $row, 'Rp. ' . number_format($product->purchase_price,0) );
            $sheet->setCellValue('F' . $row, 'Rp. ' . number_format($product->selling_price,0) );
            $sheet->setCellValue('G' . $row,  number_format($product->stock,0) );
            $row++;
        }

        // Buat file Excel
        $writer = new Xlsx($spreadsheet);
        $filename = 'products.xlsx';
        $writer->save($filename);

        // Mengirimkan file Excel ke browser
        return response()->download($filename)->deleteFileAfterSend();
    }

}
