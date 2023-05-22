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
			'title' => 'Manajemen nomor_meja',
			'judul' => 'Master Data',
			'sub_judul' => 'Manajemen nomor_meja',
      );
        return view('nomor_meja.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

        // dd($request['nomor_meja'], $request['qr'] );

        NomorMeja::create([
            'nomor_meja'=>$request['nomor_meja'],
            'qr' => Storage::putFile('qrs', $request['qr'])
        ]);
        return redirect()->route('nomor_meja')->with('success','Data Nomor Meja Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = array(
			'menu' => 'master',
			'sub_menu' => 'Nomor',
			'title' => 'Manajemen Nomor',
			'judul' => 'Master Data',
			'sub_judul' => 'Manajemen Nomor',
      );
        $nomor_meja = NomorMeja::where('id',$id)->first();

        return view('nomor_meja.edit',['nomor_meja'=>$nomor_meja],$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        $data->qr = $request->qr;

        if($request->file('qr')){
            if($data->qr && Storage::exists($data->qr)){
                Storage::delete($data->qr);
            }
        $data->qr = Storage::putFile('qrs', $request['qr']);
        }
        $data->save();

        return redirect()->route('nomor_meja')->with('success','Data Nomor Meja Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        NomorMeja::find($id)->delete();

        return redirect()->route('nomor_meja')->with('success','Data Nomor Meja Berhasil Dihapus');
    }
}
