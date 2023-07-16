<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use WangID\Scanner\Scanner;
use App\Models\documento;
use App\Models\bitacora;
use App\Models\abogado;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Models\apelacion;
use App\Models\vista;
use App\Models\demanda;
use App\Models\caso;
use App\Models\cliente;
use App\Models\detallecaso;
use App\Models\expediente;
use App\Models\juece;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;



class ApiController extends Controller
{
    //


    public function apiindex()
    {
        $user = documento::all();
       // return json_encode( $user );
        return response( [ 'documento'=>$user  ]);

      //  return view('documento.DocumentoRegister', compact('user'));

    }

        /*Guarda los datos del Usuario */
        public function storedUsuario(){
            $this->validate(request(),['carnet'=>'required','name'=>'required','email'=>'required|email','password'=>'required|confirmed',]);
            $user = User::create(request(['carnet','name','email','password']));
            $user->role='admin';
    
            $user->save();
    
            $bitacora = new bitacora();
            $bitacora->descripcion = 'Se registró un usuario Mediante APP movil';
            $bitacora->user_name = 'app movil';
            $bitacora->ip = '127.0.0.8';
            $bitacora->save();
    
            return response( [ 'user'=>$user ,'token'=>$user->createtoken('secret')->plainTextToken  ]);
            //return redirect()->route('admin.registrarusuario');
        }

        public function login(Request $request){
            $user = $request->validate(['email'=>'required|email',
                                        'password'=>'required',
                                       ]);
            //$user = User::all();
            
            if(!Auth::attempt($user))
            {
              return  response([ 'mensaje' =>'credenciales invalidos'],404);

            }

           
            $bitacora = new bitacora();
            $bitacora->descripcion = 'Se Logueo un usuario Mediante APP movil';
            $bitacora->user_name = 'app movil';
            $bitacora->ip = '127.0.0.8';
            $bitacora->save();

            return response( ['user'=>auth()->user()  ,
                            'token'=>Auth()->user()->createtoken('secret')->plainTextToken
                            ],200);
            //return redirect()->route('admin.registrarusuario');
        }

        public function logout(){
            
            $bitacora = new bitacora();
            $bitacora->descripcion = 'Se salio un usuario Mediante APP movil';
            $bitacora->user_name = 'app movil';
            $bitacora->ip = '127.0.0.8';
            $bitacora->save();

            auth()->user()->tokens()->delete();    // error al crear el token sera corregido posteriormente
            return response( [ 'mensaje'=>'logout success',
                             ],200);
            //return redirect()->route('admin.registrarusuario');
        }

        public function user()
        { 
            return response([ 
                'user'=>auth()->user()
            ],200);

        }

        public function destroyUsuario($id){
            $user = User::find($id);
    
            $user->delete();

            return  response([ 'message' =>'usuario eliminado'],200);
            //  return redirect()->route('admin.registrarusuario');
        }

        public function updateUsuario(Request $request, $id){
            $user = User::find($id);
            $user->carnet = $request->carnet;
            $user->name = $request->name;
            $user->role = $request->role;
            $user->email = $request->email;
            $user->save();
            return  response([ 'message' =>'usuario editado'],200);
          //  return redirect()->route('admin.registrarusuario');
    
        }
  /*Guarda los datos del Nuevo Usuario creado */
  public function createUsuario(){
    $this->validate(request(),['carnet'=>'required','name'=>'required','email'=>'required|email','password'=>'required|confirmed',]);
    $user = User::create(request(['carnet','name','email','password']));
    $user->role='admin';

    $user->save();

    $bitacora = new bitacora();
    $bitacora->descripcion = 'Se creo un usuario Mediante APP movil';
    $bitacora->user_name = 'app movil';
    $bitacora->ip = '127.0.0.8';
    $bitacora->save();

    return response( [ 'message' =>'usuario creado' ],200);
    //return redirect()->route('admin.registrarusuario');
}


  /*Manda al view UsuarioRegister */
  public function usersall(){
    $user = User::all();

    return response([ 
      'user'=>$user
  ],200);
    //return view('admin.UsuarioRegister', compact('user'));
}


//##################################################################################################
//##################################################################################################
//                                FUNCIONES DEL ADMINISTRAR ABOGADO
//##################################################################################################
//##################################################################################################

  /*Manda al view UsuarioRegister */
  public function Abogadosall(){
    $user = abogado::all();
    return response([ 
      'abogado'=>$user
  ],200);
}
  /*Guarda los datos del Nuevo Usuario creado */
  public function createAbogado(){
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
    $bitacora->descripcion = 'Se creo un abogado Mediante APP movil';
    $bitacora->user_name = 'app movil';
    $bitacora->ip = '127.0.0.8';
    $bitacora->save();

    return response( [ 'message' =>'abogado creado' ]);
    //return redirect()->route('admin.registrarusuario');
}

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
  return  response([ 'message' =>'Abogado editado'],200);
//  return redirect()->route('admin.registrarusuario');

}

//destroy abogado
public function destroyAbogado($id){
  $user = abogado::find($id);

  $user->delete();

  return  response([ 'message' =>'abogado eliminado'],200);
  //  return redirect()->route('admin.registrarusuario');
}


//##################################################################################################
//##################################################################################################
//                                FUNCIONES DEL ADMINISTRAR JUECES
//##################################################################################################
//##################################################################################################

  /*Manda al view UsuarioRegister */
  public function Juecesall(){
    $user = juece::all();
    return response([ 
      'juece'=>$user
  ],200);
}

  /*Guarda los datos del Nuevo juece creado */
  public function createJuece(){
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
    $bitacora->descripcion = 'Se creo un juez Mediante APP movil';
    $bitacora->user_name = 'app movil';
    $bitacora->ip = '127.0.0.8';
    $bitacora->save();

    return response( [ 'message' =>'juez creado' ]);
    //return redirect()->route('admin.registrarusuario');
}


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

  return  response([ 'message' =>'juez editado'],200);
//  return redirect()->route('admin.registrarusuario');

}

//destroy juece
public function destroyJuece($id){
  $user = juece::find($id);

  $user->delete();

  return  response([ 'message' =>'juece eliminado'],200);
  //  return redirect()->route('admin.registrarusuario');
}

//##################################################################################################
//##################################################################################################
//                                FUNCIONES DEL ADMINISTRAR CLIENTE
//##################################################################################################
//##################################################################################################

 /*Manda TODOS LOS CLIENTES */
 public function Clientesall(){
  $user = vista::all();
  return response([ 
    'cliente'=>$user
],200);
}


  /*Guarda los datos del Nuevo cliente creado */
  public function createCliente(){
    $this->validate(request(),['ci'=>'required',
    'nombre'=>'required',
    'a_paterno'=>'required',
    'a_materno'=>'required',
    'sexo'=>'required',
    'telefono'=>'required',
    'direccion'=>'required']);


$user = vista::create(request(['ci','nombre','a_paterno','a_materno','sexo','telefono','direccion']));
$user->estado='h';


$user->save();

    $bitacora = new bitacora();
    $bitacora->descripcion = 'Se creo un cliente Mediante APP movil';
    $bitacora->user_name = 'app movil';
    $bitacora->ip = '127.0.0.8';
    $bitacora->save();

    return response( [ 'message' =>'cliente creado' ]);
    //return redirect()->route('admin.registrarusuario');
}


public function updateCliente(Request $request, $id){
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
    $bitacora->descripcion = 'Se edito un cliente Mediante APP movil ';
    $bitacora->user_name = 'app movil';
    $bitacora->ip = '127.0.0.8';
    $bitacora->save();

  return  response([ 'message' =>'cliente editado'],200);
//  return redirect()->route('admin.registrarusuario');

}


//destroy juece
public function destroyCliente($id){
  $user = vista::find($id);

  $user->delete();

  return  response([ 'message' =>'cliente eliminado'],200);
  //  return redirect()->route('admin.registrarusuario');
}

//##################################################################################################
//##################################################################################################
//                                FUNCIONES DEL ADMINISTRAR DOCUMENTOS todos
//##################################################################################################
//##################################################################################################


public function Documentosall(){
  $user = documento::all();
  return response([ 
    'documentos'=>$user
],200);
}

public function Apelacionsall(){
  $user = apelacion::all();
  return response([ 
    'apelaciones'=>$user
],200);
}

public function Demandasall(){
  $user = demanda::all();
  return response([ 
    'demandas'=>$user
],200);
}

//bitacoras all

public function Bitacorasall(){
  $user = bitacora::all();
  return response([ 
    'bitacora'=>$user
],200);
}


//##################################################################################################
//##################################################################################################
//                                FUNCIONES DEL ADMINISTRAR Verdocumentos pdf
//##################################################################################################
//##################################################################################################

public function showDocumentoApi($filename)
{
    $filePath = storage_path('app/demandas/' . $filename);

    if (file_exists($filePath)) {
       
   return response()->file($filePath);

    }

    abort(404, 'File not found.');
}
public function showExpedienteApi($filename)
{
    $filePath = storage_path('app/expedients/' . $filename);

    if (file_exists($filePath)) {
       
   return response()->file($filePath);

    }

    abort(404, 'File not found.');
}
public function showApelacionApi($filename)
{
    $filePath = storage_path('app/apelacions/' . $filename);

    if (file_exists($filePath)) {
       
   return response()->file($filePath);

    }

    abort(404, 'File not found.');
}
public function showDocApi($filename)
{
    $filePath = storage_path('app/documents/' . $filename);

    if (file_exists($filePath)) {
       
   return response()->file($filePath);

    }

    abort(404, 'File not found.');
}
//##################################################################################################
//##################################################################################################
//                                FUNCIONES VER DEMANDAS POR CASO ID
//##################################################################################################
//##################################################################################################

public function ListarDemandasid($id){
  $user = demanda::where('caso_id', '=' , $id)->get();
  return response([ 
    'demanda'=>$user
],200);
}
public function ListarDocumentoid($id){
  $user = documento::where('caso_id', '=' , $id)->get();
  return response([ 
    'documento'=>$user
],200);
}
public function ListarExpedienteid($id){
  $user = expediente::where('caso_id', '=' , $id)->get(['id','asunto as titulo','file_path','created_at','updated_at']);
  return response([ 
    'expediente'=>$user
],200);
}
public function ListarApelacionid($id){
  $user = apelacion::where('caso_id', '=' , $id)->get(['id','motivo as titulo','file_path','created_at','updated_at']);
  return response([ 
    'apelacion'=>$user
],200);
}
//##################################################################################################
//##################################################################################################
//                                FUNCIONES DEL ADMINISTRAR VER CASOS
//##################################################################################################
//##################################################################################################
/*############################################################
 RUTAS PARA LOS DIVORSIOS  
#############################################################*/
public function ListarDApi(){
  $user = caso::where('tipo', 'Divorcio')->get();
  /*return view('divorcio.DivorcioRegister', [
      'user' => $user
  ]);  */      
  //$juez= juece::where( 'id', '=',1)->first();

  return response([ 
    'caso'=>$user
],200);
}

public function verDetalleDApi($id){
  $user = detallecaso::where("caso_id", "=", $id)->get();
  //return view('divorcio.verDetalle', compact('user'));

  $idjuece = caso::where("id", "=", $id)->first();
  $estado = $idjuece->estado;

  $juez = juece::where("id", "=", $idjuece->juez_id)->first();
  $nombre= $juez->nombre . ' ' . $juez->a_paterno;

  $abogado = abogado::where('id','=',$user[0]->abogado_id)->first();
  $abogado = $abogado->nombre . ' ' . $abogado->a_paterno;

  $abogado2 = abogado::where('id','=',$user[1]->abogado_id)->first();
  $abogado2 = $abogado2->nombre . ' ' . $abogado2->a_paterno;

  $cliente = vista::where('id','=',$user[0]->vista_id)->first();
  $cliente = $cliente->nombre . ' ' . $cliente->a_paterno;

  $cliente2 = vista::where('id','=',$user[1]->vista_id)->first();
  $cliente2 = $cliente2->nombre . ' ' . $cliente2->a_paterno;

  return response([ 'caso'=>$idjuece, 'juece' => $nombre,'abogado'=>$abogado,'abogado2'=>$abogado2,'cliente'=>$cliente,'cliente2'=>$cliente2],200);

}

public function verDetalleDApiSearchNumeroCI(Request $request,$id){

  $cicliente = $request->ci;

  $idjuece = caso::where("numero", "=", $id)->first();
  $estado = $idjuece->estado;

  $user = detallecaso::where("caso_id", "=", $idjuece->id)->get();
  //return view('divorcio.verDetalle', compact('user'));

  $juez = juece::where("id", "=", $idjuece->juez_id)->first();
  $nombre= $juez->nombre . ' ' . $juez->a_paterno;

  $abogado = abogado::where('id','=',$user[0]->abogado_id)->first();
  $abogado = $abogado->nombre . ' ' . $abogado->a_paterno;

  $abogado2 = abogado::where('id','=',$user[1]->abogado_id)->first();
  $abogado2 = $abogado2->nombre . ' ' . $abogado2->a_paterno;

  $clientev = vista::where('id','=',$user[0]->vista_id)->first();
  $cliente = $clientev->nombre . ' ' . $clientev->a_paterno;

  $clientev2 = vista::where('id','=',$user[1]->vista_id)->first();
  $cliente2 = $clientev2->nombre . ' ' . $clientev2->a_paterno;


  if( (($clientev->ci) == (int)$cicliente) or (($clientev2->ci) == (int)$cicliente)  ){
 return response([ 'caso'=>$idjuece, 'juece' => $nombre,'abogado'=>$abogado,'abogado2'=>$abogado2,'cliente'=>$cliente,'cliente2'=>$cliente2],200);
  }
  else{
    abort(404, 'File not found.');
   
  }
 
}




/*############################################################
 RUTAS PARA LA ASISTENCIA FAMILIAR  
#############################################################*/
public function ListarAFApi(){
  $user = caso::where('tipo', 'Asistencia familiar')->get();
  /*return view('divorcio.DivorcioRegister', [
      'user' => $user
  ]);  */      
  return response([ 
    'caso'=>$user
],200);
}

public function verDetalleAFApi($id){
  $user = detallecaso::where("caso_id", "=", $id)->get();
  //return view('divorcio.verDetalle', compact('user'));

  $idjuece = caso::where("id", "=", $id)->first();
  $estado = $idjuece->estado;

  $juez = juece::where("id", "=", $idjuece->juez_id)->first();
  $nombre= $juez->nombre . ' ' . $juez->a_paterno;

  $abogado = abogado::where('id','=',$user[0]->abogado_id)->first();
  $abogado = $abogado->nombre . ' ' . $abogado->a_paterno;

  $abogado2 = abogado::where('id','=',$user[1]->abogado_id)->first();
  $abogado2 = $abogado2->nombre . ' ' . $abogado2->a_paterno;

  $cliente = vista::where('id','=',$user[0]->vista_id)->first();
  $cliente = $cliente->nombre . ' ' . $cliente->a_paterno;

  $cliente2 = vista::where('id','=',$user[1]->vista_id)->first();
  $cliente2 = $cliente2->nombre . ' ' . $cliente2->a_paterno;

  return response([ 'caso'=>$idjuece, 'juece' => $nombre,'abogado'=>$abogado,'abogado2'=>$abogado2,'cliente'=>$cliente,'cliente2'=>$cliente2],200);
}


}







