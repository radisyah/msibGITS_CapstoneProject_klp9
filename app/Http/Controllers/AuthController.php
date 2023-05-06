<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public  function index()
    {
        $data = array(
            'title' => 'Halaman Login'
        );
        return view('auth.login',$data);
    }

    public function login(Request $request){
        //validate data
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        //login code
        if(\Auth::attempt($request->only('email','password'))){
            return redirect('dashboard');
        }

        return redirect('login')->withError('Login details are not valid');

    }

    public function register_view()
    { 
        $data = array(
            'title' => 'Halaman Registrasi'
        );
        return view('auth.register',$data);
    }

    public function register(Request $request){
        //validate data
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|confirmed'
        ]);

        // save in users tabl
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> \Hash::make($request->password)
        ]);

        // login user here 

        if(\Auth::attempt($request->only('email','password'))){
            return redirect('login');
        }

        return redirect('register')->withError('Error');
    
    }

    public function home(){
        return view('dashboard');
    }

    public function logout(){
        \Session::flush();
        \Auth::logout();
        return redirect('');
    }

}
