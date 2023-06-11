<?php

namespace App\Http\Controllers;

use App\Models\demanda;
use App\Models\bitacora;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class DemandaController extends Controller
{
    public function index()
    {
        $user = demanda::all();

        return view('demanda.DemandaRegister', compact('user'));
    }

    public function crearDemanda()
    {
        return view('demanda.crearDemanda');
    }

    public function storedDemanda(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'caso_id' => 'required',
            'file' => 'required|mimes:pdf,doc,docx|max:2048', // Adjust allowed file types and maximum file size as needed
        ]);

        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $filePath = $file->storeAs('', $filename,'demandas');

            demanda::create([
                'titulo' => $request->titulo,
                'file_path' => $filePath,
                'caso_id' => $request->caso_id,
            ]);

            $bitacora = new bitacora();
            $bitacora->descripcion = 'Se agregó una demanda';
            $bitacora->user_name = auth()->user()->name;
            $bitacora->ip = $request->ip();
            $bitacora->save();

            return redirect()->route('demanda.index');
        }

        return redirect()->back()->with('error', 'Error uploading document.');
    }

    public function showDemanda($filename)
    {
        $filePath = storage_path('app/demandas/' . $filename);

        if (file_exists($filePath)) {
            return response()->file($filePath);
        }

        abort(404, 'File not found.');
    }

    public function destroyDemanda(Request $request, $id){
        $user = demanda::find($id);
        
        $file = $user->file_path;

        if (Storage::exists('demandas/' . $file)) {
            Storage::delete('demandas/' . $file);
        } 

        $bitacora = new bitacora();
        $bitacora->descripcion = 'Se eliminó el demanda: ' . $user->titulo;
        $bitacora->user_name = auth()->user()->name;
        $bitacora->ip = $request->ip();
        $bitacora->save();

        $user->delete();

        return redirect()->route('demanda.index');
    }

    public function editDemanda($id){
        $user = demanda::find($id);
        return view('demanda.editarDemanda',compact('user'));
    }

    public function updateDemanda(Request $request, $id){
       
        $user = demanda::find($id);
        $user->titulo = $request->titulo;
        $user->caso_id = $request->caso_id;

        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $filePath = $file->storeAs('', $filename,'demandas');

            $user->file_path = $filePath;     
        }

        $user->save();
        $bitacora = new bitacora();
        $bitacora->descripcion = 'Se editó los datos de la demanda ' . $id;
        $bitacora->user_name = auth()->user()->name;
        $bitacora->ip = $request->ip();
        $bitacora->save();

        return redirect()->route('demanda.index');
    }
}
