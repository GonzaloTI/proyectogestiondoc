<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\bitacora;


class SessionsController extends Controller{
    public function create(){

        return view('auth.login');
    }

    public function store(Request $request){
        if(auth()->attempt(request(['email','password']))==false){
            return back()->withErrors(['message'=> 'the email or password is incorrect, please try again']);
        }else{
            $bitacora = new bitacora();
            $bitacora->descripcion = 'Entró un usuario';
            $bitacora->user_name = auth()->user()->name;
            $bitacora->ip = $request->ip();
            $bitacora->save();

            if(auth()->user()->role == 'admin'){
                return redirect()->route('admin.index');
            }else{
                if(auth()->user()->role == 'abogado'){
                    return redirect()->route('abogado.index');
                }else{
                    if(auth()->user()->role == 'juez'){
                        return redirect()->route('juece.index');
                    }
                    
                }
            }
        }
        
    }

    public function destroy(Request $request){
    
        $bitacora = new bitacora();
        $bitacora->descripcion = 'Salió un usuario';
        $bitacora->user_name = auth()->user()->name;
        $bitacora->ip = $request->ip();
        $bitacora->save();

        auth()->logout();
        return redirect()->to('/');
    }


    
}
