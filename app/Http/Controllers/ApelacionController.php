<?php

namespace App\Http\Controllers;

use App\Models\apelacion;
use App\Models\bitacora;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ApelacionController extends Controller
{
    public function index()
    {
        $user = apelacion::all();
        return view('apelacion.ApelacionRegister', compact('user'));
    }

    public function caso($id)
    {
        $user = apelacion::where('caso_id',$id)->get();
        return view('apelacion.ApelacionRegister', compact('user'));
    }

    public function crearApelacion()
    {
        return view('apelacion.crearApelacion');
    }

    public function storedApelacion(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'caso_id' => 'required',
            'file' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $filePath = $file->storeAs('', $filename,'apelacions');

            apelacion::create([
                'titulo' => $request->titulo,
                'caso_id' => $request->caso_id,
                'file_path' => $filePath,
            ]);

            $bitacora = new bitacora();
            $bitacora->descripcion = 'Se agregó una apelación';
            $bitacora->user_name = auth()->user()->name;
            $bitacora->ip = $request->ip();
            $bitacora->save();

            return redirect()->route('apelacion.index');
        }

        return redirect()->back()->with('error', 'Error uploading document.');
    }

    public function showApelacion($filename)
    {
        $filePath = storage_path('app/apelacions/' . $filename);

        if (file_exists($filePath)) {
            return response()->file($filePath);
        }

        abort(404, 'File not found.');
    }

    public function destroyApelacion(Request $request, $id){
        $user = apelacion::find($id);
        
        $file = $user->file_path;

        if (Storage::exists('apelacions/' . $file)) {
            Storage::delete('apelacions/' . $file);
        } 

        $bitacora = new bitacora();
        $bitacora->descripcion = 'Se eliminó la apelación: ' . $user->titulo;
        $bitacora->user_name = auth()->user()->name;
        $bitacora->ip = $request->ip();
        $bitacora->save();

        $user->delete();

        return redirect()->route('apelacion.index');
    }

    /*///// Edita un apelacion////// */

    public function editApelacion($id){
        $user = apelacion::find($id);
        return view('apelacion.editarApelacion',compact('user'));
    }

    public function updateApelacion(Request $request, $id){
       
        $user = apelacion::find($id);
        $user->titulo = $request->titulo;
        $user->caso_id = $request->caso_id;

        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $filePath = $file->storeAs('', $filename,'apelacions');

            $user->file_path = $filePath;     
        }

        $user->save();
        $bitacora = new bitacora();
        $bitacora->descripcion = 'Se editó los datos de la apelación ' . $id;
        $bitacora->user_name = auth()->user()->name;
        $bitacora->ip = $request->ip();
        $bitacora->save();

        return redirect()->route('apelacion.index');
    }
}
