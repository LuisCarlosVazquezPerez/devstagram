<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    //
    public function store(User $user){
        //!EL USER ES EL PERFIL QUE ESTAMOS VISITANDO
        
        $user->followers()->attach(auth()->user()->id); 
        //? ATTACH ES MUY UTIL CUANDO TENGAS MUCHO A MUCHOS
        return back();
    }

    public function destroy(User $user){
        $user->followers()->detach(auth()->user()->id); 
        return back();
    }


}
