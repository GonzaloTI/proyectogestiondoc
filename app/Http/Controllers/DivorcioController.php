<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\bitacora;
use App\Models\caso;
use App\Models\juece;
use App\Models\vista;
use App\Models\abogado;
use App\Models\detallecaso;

class DivorcioController extends Controller
{
    public function ListarD(){
        $user = caso::where('tipo', 'Divorcio')->get();
        return view('divorcio.DivorcioRegister', [
            'user' => $user
        ]);        
    }

    public function createDivorcio(){
        $jueces = juece::all();
        $vistas = vista::all();
        $abogados = abogado::all();

        return view('divorcio.crearDivorcio',compact('jueces', 'vistas', 'abogados'));
    }

    public function storedDivorcio(Request $request){
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
            'tipo' => 'Divorcio'
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
        $bitacora->descripcion = 'Se agregó un caso de divorcio';
        $bitacora->user_name = auth()->user()->name;
        $bitacora->ip = $request->ip();
        $bitacora->save();

        return redirect()->route('admin.listarDivorcio');     
    }

    public function verDetalle($id){
        $user = detallecaso::where("caso_id", "=", $id)->get();
        return view('divorcio.verDetalle', compact('user'));
    }

    public function destroyDivorcio($id, Request $request){
        $detalle = detallecaso::where('caso_id',$id)->delete();
        $user = caso::find($id);
        $user->delete();
        $bitacora = new bitacora();
        $bitacora->descripcion = 'Se eliminó un caso de divorcio';
        $bitacora->user_name = auth()->user()->name;
        $bitacora->ip = $request->ip();
        $bitacora->save();
        return redirect()->route('admin.listarDivorcio');
    }

    public function editDivorcio($id){
        $user = caso::find($id);
        $jueces = juece::all();
        $vistas = vista::all();
        $abogados = abogado::all();
        $partes = detallecaso::where('caso_id',$id)->get();

        return view('divorcio.editarDivorcio',compact('user','jueces', 'vistas', 'abogados', 'partes'));
    }

    public function updateDivorcio(Request $request, $id){
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


        return redirect()->route('admin.listarDivorcio');
    }

    public function show($id)
    {
        $divorceCase = caso::find($id);
        $detalle = detallecaso::where("caso_id", "=", $id)->get();
        
        $data = [
            'caseNumber' => $divorceCase->caseNumber,
            'parties' => $detalle,
            'caseStatus' => $divorceCase->estado,
            'caseDescription' => $divorceCase->caseDescription,
            'timeline' => $divorceCase->timeline,
        ];
        // Render the view with the provided data
        return view('divorce-case', $data);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $results = caso::where('numero', $search)->get();
        return view('divorcio.verDetalle', compact('user'));
    }


}
