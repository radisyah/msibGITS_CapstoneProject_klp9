<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Roles;
use Illuminate\Http\Request;

class UserController extends Controller
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
			'sub_menu' => 'User',
			'title' => 'Manajemen User',
			'judul' => 'Master Data',
			'sub_judul' => 'Manajemen User',
            'user' => User::all()
      );

    //   dd($data);

      return view('user.index',$data);
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
			'sub_menu' => 'user',
			'title' => 'Manajemen user',
			'judul' => 'Master Data',
			'sub_judul' => 'Manajemen user/ Tambah user',
            'user' => User::all()
      );
        return view('user.add',$data);
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
            'required' => 'Data User Tidak Boleh Kosong !!',
            'unique' => 'Data User sudah ada'
        ];

        $validated = $request->validate([
            'name' => 'required|unique:users',
            'email'=> 'required',
            'role_id'=> 'required',
            'password'=> 'required'
        ],$pesan);



        User::create([
            'name'=>$validated['name'],
            'email'=>$validated['email'],
            'role_id'=>$validated['role_id'],
            'password'=> \Hash::make($validated['password'])
        ]);
      
        return redirect()->route('user')->with('success','Data User Berhasil Ditambahkan');
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
			'sub_menu' => 'user',
			'title' => 'Manajemen user',
			'judul' => 'Master Data',
			'sub_judul' => 'Manajemen user / Ubah user',
        );
        $user['user'] = User::where('id',$id)->first();
        $data['roles'] = Roles::all();
        // dd($user, $role);

        return view('user.edit',$user,$data);
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
            'required' => 'Data User Tidak Boleh Kosong !!',
            'unique' => 'Data User sudah ada'
        ];

        // dd($request);

        $validated = $request->validate([
            'name' => 'required',
            'email'=> 'required',
            'role_id'=> 'required'
        ],$pesan);



        $user = User::find($id);
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role_id = $validated['role_id'];

        $user->save();
      
        return redirect()->route('user')->with('success','Data User Berhasil dirubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('user')->with('success','Data User Berhasil Dihapus');
    }
}
