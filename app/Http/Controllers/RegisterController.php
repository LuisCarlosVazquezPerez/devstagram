<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

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
        // dd($request->get('username'));

        //*MODIFICAR EL REQUEST (HACERLO LO MENOS POSIBLE)
        $request->request->add(['username' => Str::slug($request->username)]);

        //VALIDACION
        $this->validate($request, [
        'name' => 'required|max:30',
        'username' => 'required|unique:users|min:3|max:20',
        'email'=> 'required|unique:users|email|max:60',
        'password'=>'required|confirmed|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password
        ]);

        //*AUTENTICAR UN USUARIO
        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password,
        // ]);

        //?OTRA FORMA DE AUTENTICAR
        auth()->attempt($request->only('email','password'));

        //*REDIRECCIONAR
        return redirect()->route('posts.index',$request->username);
    }
}
