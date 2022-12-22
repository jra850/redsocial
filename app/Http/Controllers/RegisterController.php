<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class RegisterController extends Controller
{
    //
    public function index() 
    {
        return view('auth.register');
    }

    public function store(Request $request) 
    {
       // dd($request);  
       //dd($request->get('username')); 

       //modificar el request
       $request->request->add(['username' => Str::slug($request->username)]);

       //validaciones
        $this->validate($request, [
            'name' => 'required|max:10',
            'username' => 'required|unique:users|min:3|max:10',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make( $request->password)
        ]);

        //autenticar usuario
        auth()->attempt([
            'email' => $request->email,
            'password' => $request->password

        ]);

        //otra forma autenticar usuario
        //auth()->attempt($request->only('email', 'password'));


        //redireccionar
        return redirect()->route('posts.index', auth()->user());

    }


    public function privacidad()
    {
        return view('politica-privacidad');
    }
}
