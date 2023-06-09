<?php

namespace App\Http\Controllers;

use App\Models\NomorMeja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

class NomorMejaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
			'menu' => 'master',
			'sub_menu' => 'Nomor Meja',
			'title' => 'Manajemen Nomor Meja',
			'judul' => 'Master Data',
			'sub_judul' => 'Manajemen Nomor Meja',
            'sub_menu' => 'nomor_meja',
            'nomor_meja' => NomorMeja::all()
      );

      return view('nomor_meja.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array(
			'menu' => 'master',
			'sub_menu' => 'nomor_meja',
			'title' => 'Manajemen Nomor Meja',
			'judul' => 'Master Data',
			'sub_judul' => 'Manajemen Nomor Meja / Tambah Nomor Meja',
      );
        return view('nomor_meja.add',$data);
    }


    public function store(Request $request)
    {
        $pesan = [
            'required' => 'Data Nomor Meja Tidak Boleh Kosong !!',
            'unique' => 'Data Nomor Meja sudah ada',
            'qr' => ':attribute Harus Gambar !!'
        ];

        $request->validate([
            'nomor_meja' => 'required|unique:nomor_mejas',
            'qr' => [File::types(['png', 'jpeg', 'jpg'])->max(2 * 1024),]
        ],$pesan);


        $qr = $request['qr'];
        $originalName = $qr->getClientOriginalName();
        $qrPath = $qr->storeAs('qrs', $originalName, '');

        NomorMeja::create([
            'nomor_meja' => $request['nomor_meja'],
            'nomor_meja'=>$request['nomor_meja'],
            'qr' => $qrPath
        ]);
        return redirect()->route('nomor_meja')->with('success','Data Nomor Meja Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $data = array(
			'menu' => 'master',
			'sub_menu' => 'Nomor',
			'title' => 'Manajemen Nomor Meja',
			'judul' => 'Master Data',
            'sub_menu' => 'nomor_meja',
			'sub_judul' => 'Manajemen Nomor Meja / Ubah Nomor Meja',
      );
        $nomor_meja = NomorMeja::where('id',$id)->first();

        return view('nomor_meja.edit',['nomor_meja'=>$nomor_meja],$data);
    }


    public function update(Request $request, $id)
    {
        $pesan = [
            'required' => 'Data Nomor Meja Tidak Boleh Kosong !!',
            'unique' => 'Data Nomor Meja sudah ada'
        ];

        $request->validate([
            'nomor_meja' => 'required',
            'qr' => [File::types(['jpeg', 'jpg', 'png'])->max(2 * 1024),]
        ],$pesan);

        

        $data = NomorMeja::find($id);
        $data->nomor_meja = $request->nomor_meja;

        if($request->file('qr')){
            if($data->qr && Storage::exists($data->qr)){
                Storage::delete($data->qr);
            }
        $data->qr = Storage::putFile('qrs', $request['qr']);
        }
        $data->save();

        return redirect()->route('nomor_meja')->with('success','Data Nomor Meja Berhasil Diubah');
    }


    public function destroy($id)
    {
        NomorMeja::find($id)->delete();

        return redirect()->route('nomor_meja')->with('success','Data Nomor Meja Berhasil Dihapus');
    }
}
