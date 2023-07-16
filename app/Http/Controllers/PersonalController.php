<?php

namespace App\Http\Controllers;
use App\Models\bitacora;
use Illuminate\Http\Request;
use App\Models\personal;

class PersonalController extends Controller
{
    
    /*////// Crear al personal /////*/

    /*Manda al view clienteRegister */
    public function ListarP(){
        $user = personal::all();
        return view('personal.PersonalRegister', compact('user'));
        
    }


    /*Manda al view crearCliente */
    public function createPersonal(){
        return view('personal.crearPersonal');
    }



    /*Guarda los datos del cliente */
    public function storedPersonal(Request $request){
        $this->validate(request(),['ci'=>'required',
                                                   'nombre'=>'required',
                                                   'a_paterno'=>'required',
                                                   'a_materno'=>'required',
                                                   'sexo'=>'required',
                                                   'telefono'=>'required',
                                                   'direccion'=>'required',
                                                    'user_id']);


        $user = personal::create(request(['ci','nombre','a_paterno','a_materno','sexo','telefono','direccion','user_id']));
        $user->estado='h';
       
        
        $user->save();

        $bitacora = new bitacora();
        $bitacora->descripcion = 'Se agregó personal';
        $bitacora->user_name = auth()->user()->name;
        $bitacora->ip = $request->ip;
        $bitacora->save();

        return redirect()->route('admin.listarpersonal');     
    }

    /*////// Elimina a un cliente //// */

    public function destroyPersonal(Request $request,$id){
        $user = personal::find($id);
        $user->delete();

        $bitacora = new bitacora();
        $bitacora->descripcion = 'Se eliminó personal';
        $bitacora->user_name = auth()->user()->name;
        $bitacora->ip = $request->ip;
        $bitacora->save();

        return redirect()->route('admin.listarpersonal');
    }

    /*///// Edita un cliente////// */

    public function editPersonal($id){
        $user = personal::find($id);
        return view('personal.editarPersonal',compact('user'));
    }

    /* cambia los datos al editar presionando el button */
    public function updatePersonal(Request $request, $id){
        $user = personal::find($id);
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
        $bitacora->descripcion = 'Se editó los datos del personal';
        $bitacora->user_name = auth()->user()->name;
        $bitacora->ip = $request->ip;
        $bitacora->save();

        return redirect()->route('admin.listarpersonal');

    }






}
