<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\bitacora;



use App\Models\juece;





class JueceController extends Controller
{
    

    /*////// Crear al juez /////*/

    /*Manda al view AbogadoRegister */
    public function ListarJ(){
        $user = juece::all();
        return view('juece.JueceRegister', compact('user'));
        
    }


    /*Manda al view crear Juez */
    public function createJuece(){
        return view('juece.crearJuece');
    }



    /*Guarda los datos del juez */
    public function storedJuece(){
        $this->validate(request(),['ci'=>'required',
                                                   'nombre'=>'required',
                                                   'a_paterno'=>'required',
                                                   'a_materno'=>'required',
                                                   'sexo'=>'required',
                                                   'telefono'=>'required',
                                                   'direccion'=>'required',
                                                    'user_id']);


        $user = juece::create(request(['ci','nombre','a_paterno','a_materno','sexo','telefono','direccion','user_id']));
        $user->estado='h';
       
        
        $user->save();

        $bitacora = new bitacora();
        $bitacora->descripcion = 'Se agregó juez';
        $bitacora->user_name = auth()->user()->name;
        $bitacora->save();

        return redirect()->route('admin.listarjuece');     
    }

    /*////// Elimina a un juez //// */

    public function destroyJuece($id){
        $user = juece::find($id);
        $user->delete();

        $bitacora = new bitacora();
        $bitacora->descripcion = 'Se eliminó juez';
        $bitacora->user_name = auth()->user()->name;
        $bitacora->save();

        return redirect()->route('admin.listarjuece');
    }

    /*///// Edita un juez////// */

    public function editJuece($id){
        $user = juece::find($id);
        return view('juece.editarJuece',compact('user'));
    }

    /* cambia los datos al editar presionando el button */
    public function updateJuece(Request $request, $id){
        $user = juece::find($id);
        $user->ci = $request->ci;
        $user->nombre = $request->nombre;
        $user->a_paterno = $request->a_paterno;
        $user->a_materno = $request->a_materno;
        $user->sexo = $request->sexo;
        $user->telefono = $request->telefono;
        $user->direccion = $request->direccion;
        $user->estado = $request->estado;
        $user->user_id = $request->user_id;

        $user->save();

        $bitacora = new bitacora();
        $bitacora->descripcion = 'Se editó los datos del juez';
        $bitacora->user_name = auth()->user()->name;
        $bitacora->save();

        return redirect()->route('admin.listarjuece');

    }

    public function index(){
        $user = juece::all();
        return view("AQUI SE PONDRAN TODAS LAS FUNCIONES DE UN JUEZ , CREAR CLIENTES , SUBIR DOCUMENTOS", compact('user'));
        
    }

}
