<?php

namespace App\Http\Controllers;
use App\Models\bitacora;
use Illuminate\Http\Request;
use App\Models\caso;
use App\Models\juece;
use App\Models\vista;
use App\Models\abogado;
use App\Models\detallecaso;

class AsistenciaController extends Controller
{
    public function ListarA(){
        $user = caso::where('tipo', 'Asistencia familiar')->get();
        return view('asistencia.AsistenciaRegister', [
            'user' => $user
        ]);        
    }

    public function createAsistencia(){
        $jueces = juece::all();
        $vistas = vista::all();
        $abogados = abogado::all();

        return view('asistencia.crearAsistencia',compact('jueces', 'vistas', 'abogados'));
    }

    public function storedAsistencia(Request $request){
        $this->validate(request(),['titulo'=>'required',
                                    'numero'=>'required',
                                    'corte'=>'required',
                                    'juez_id'=>'required',
                                    'estado'=>'required',
                                    'vista1_id'=>'required',
                                    'abogado1_id'=>'required',
                                    'vista2_id'=>'required',
                                    'abogado2_id'=>'required'
                                ]);


        $user = caso::create([
            'titulo' => $request->titulo,
            'numero' => $request->numero,
            'corte' => $request->corte,
            'juez_id' => $request->juez_id,
            'estado' => $request->estado,
            'tipo' => 'Asistencia familiar'
        ]);

        $user->save();

        detallecaso::create([
            'caso_id' => $user->id,
            'rol' => 'Demandante',
            'vista_id' => $request->vista1_id,
            'abogado_id' => $request->abogado1_id,
        ]);

        detallecaso::create([
            'caso_id' => $user->id,
            'rol' => 'Demandado',
            'vista_id' => $request->vista2_id,
            'abogado_id' => $request->abogado2_id,
        ]);

        $bitacora = new bitacora();
        $bitacora->descripcion = 'Se agregó un caso de asistencia familiar';
        $bitacora->user_name = auth()->user()->name;
        $bitacora->ip = $request->ip();
        $bitacora->save();

        return redirect()->route('admin.listarAsistencia');     
    }

    public function verDetalle($id){
        $user = detallecaso::where("caso_id", "=", $id)->get();
        return view('asistencia.verDetalle', compact('user'));
    }

    public function destroyAsistencia($id, Request $request){
        $detalle = detallecaso::where('caso_id',$id)->delete();
        $user = caso::find($id);
        $user->delete();
        $bitacora = new bitacora();
        $bitacora->descripcion = 'Se eliminó un caso de asistencia familiar';
        $bitacora->user_name = auth()->user()->name;
        $bitacora->ip = $request->ip();
        $bitacora->save();
        return redirect()->route('admin.listarAsistencia');
    }

    public function editAsistencia($id){
        $user = caso::find($id);
        $jueces = juece::all();
        $vistas = vista::all();
        $abogados = abogado::all();
        $partes = detallecaso::where('caso_id',$id)->get();

        return view('asistencia.editarAsistencia',compact('user','jueces', 'vistas', 'abogados','partes'));
    }

    public function updateAsistencia(Request $request, $id){
        $user = caso::find($id);
        $user->titulo = $request->titulo;
        $user->numero = $request->numero;
        $user->corte = $request->corte;       
        $user->juez_id = $request->juez_id;
        $user->estado = $request->estado;
        $user->save();
         
        $detalles = detallecaso::where('caso_id',$id)->get();
        $detalles[0]->vista_id = $request->vista1_id;
        $detalles[0]->abogado_id = $request->abogado1_id;
        $detalles[0]->save();
        $detalles[1]->vista_id = $request->vista2_id;
        $detalles[1]->abogado_id = $request->abogado2_id;
        $detalles[1]->save();

        $bitacora = new bitacora();
        $bitacora->descripcion = 'Se editó los datos del caso' . $id;
        $bitacora->user_name = auth()->user()->name;
        $bitacora->ip = $request->ip();
        $bitacora->save();


        return redirect()->route('admin.listarAsistencia');
    }

}
