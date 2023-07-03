<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\bitacora;
use App\Models\vista;

class VistaController extends Controller
{
    public function ListarV(){
        $user = vista::all();
        return view('vista.VistaRegister', compact('user'));
        
    }

    public function createVista(){
        return view('vista.crearVista');
    }

    public function storedVista(Request $request){
        $this->validate(request(),['ci'=>'required',
                                    'nombre'=>'required',
                                    'a_paterno'=>'required',
                                    'a_materno'=>'required',
                                    'sexo'=>'required',
                                    'telefono'=>'required',
                                    'direccion'=>'required'
                                    ]);


        $user = vista::create(request(['ci','nombre','a_paterno','a_materno','sexo','telefono','direccion']));
        $user->estado='h';     
        
        $user->save();

        $bitacora = new bitacora();
        $bitacora->descripcion = 'Se agregó un Demandate o demandado';
        $bitacora->user_name = auth()->user()->name;
        $bitacora->ip = $request->ip();
        $bitacora->save();

        return redirect()->route('admin.listarvista');     
    }

    public function destroyVista(Request $request, $id){
        $user = vista::find($id);
        $user->delete();

        $bitacora = new bitacora();
        $bitacora->descripcion = 'Se eliminó un Demandate o demandado';
        $bitacora->user_name = auth()->user()->name;
        $bitacora->ip = $request->ip();
        $bitacora->save();

        return redirect()->route('admin.listarvista');
    }

    public function editVista($id){
        $user = vista::find($id);
        return view('vista.editarVista',compact('user'));
    }

    /* cambia los datos al editar presionando el button */
    public function updateVista(Request $request, $id){
        $user = vista::find($id);
        $user->ci = $request->ci;
        $user->nombre = $request->nombre;
        $user->a_paterno = $request->a_paterno;
        $user->a_materno = $request->a_materno;
        $user->sexo = $request->sexo;
        $user->telefono = $request->telefono;
        $user->direccion = $request->direccion;
        $user->estado = $request->estado;
       

        $user->save();

        $bitacora = new bitacora();
        $bitacora->descripcion = 'Se editó los datos de Demandate o demandado';
        $bitacora->user_name = auth()->user()->name;
        $bitacora->ip = $request->ip();
        $bitacora->save();

        return redirect()->route('admin.listarvista');
    }

    public function index(){
        $user = vista::all();
        return view("AQUI SE PONDRAN TODAS LAS FUNCIONES DE UNA VISTA SUBIR Y VER DOCUMENTOS(que le pertenescan)", compact('user'));
        
    }
}
