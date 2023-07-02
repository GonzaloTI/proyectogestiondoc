<?php


namespace App\Http\Controllers;
use App\Models\bitacora;
use Illuminate\Http\Request;

use App\Models\abogado;




class AbogadoController extends Controller
{
    //


    /*////// Crear al abogado /////*/

    /*Manda al view AbogadoRegister */
    public function ListarA(){
        $user = abogado::all();
        return view('abogado.AbogadoRegister', compact('user'));
        
    }


    /*Manda al view crearAbogado */
    public function createAbogado(){
        return view('abogado.crearAbogado');
    }



    /*Guarda los datos del Abogado */
    public function storedAbogado(Request $request){
        $this->validate(request(),['ci'=>'required',
                                    'nombre'=>'required',
                                    'a_paterno'=>'required',
                                    'a_materno'=>'required',
                                    'sexo'=>'required',
                                    'telefono'=>'required',
                                    'direccion'=>'required',
                                    'user_id']);


        $user = abogado::create(request(['ci','nombre','a_paterno','a_materno','sexo','telefono','direccion','user_id']));
        $user->estado='h';
       
        
        $user->save();

        $bitacora = new bitacora();
        $bitacora->descripcion = 'Se agregó abogado';
        $bitacora->user_name = auth()->user()->name;
        $bitacora->ip = $request->ip();
        $bitacora->save();

        return redirect()->route('admin.listarabogado');     
    }

    /*////// Elimina a un Abogado //// */

    public function destroyAbogado(Request $request, $id){
        $user = abogado::find($id);
        $user->delete();

        $bitacora = new bitacora();
        $bitacora->descripcion = 'Se eliminó Abogado';
        $bitacora->user_name = auth()->user()->name;
        $bitacora->ip = $request->ip();
        $bitacora->save();

        return redirect()->route('admin.listarabogado');
    }

    /*///// Edita un abogado////// */

    public function editAbogado($id){
        $user = abogado::find($id);
        return view('abogado.editarAbogado',compact('user'));
    }

    /* cambia los datos al editar presionando el button */
    public function updateAbogado(Request $request, $id){
        $user = abogado::find($id);
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
        $bitacora->descripcion = 'Se editó los datos del abogado';
        $bitacora->user_name = auth()->user()->name;
        $bitacora->ip = $request->ip();
        $bitacora->save();

        return redirect()->route('admin.listarabogado');

    }




    public function index(){
        $user = abogado::all();
        return view("AQUI SE PONDRAN TODAS LAS FUNCIONES DE UN ABOGADO , CREAR CLIENTES , SUBIR DOCUMENTOS", compact('user'));
        
    }


}
