<?php

namespace App\Http\Controllers;

use WangID\Scanner\Scanner;
use App\Models\sentencia;
use App\Models\bitacora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;

use App\Models\User;

class SentenciaController extends Controller
{
    public function index()
    {
        $user = sentencia::all();

        return view('sentencia.SentenciaRegister', compact('user'));
    }

    public function caso($id)
    {
        $user = sentencia::where('caso_id',$id)->get();
        return view('sentencia.SentenciaRegister', compact('user'));
    }

    public function crearSentencia()
    {
        return view('sentencia.crearSentencia');
    }

    public function storedSentencia(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'caso_id' => 'required',
            'file' => 'required|mimes:pdf,doc,docx|max:2048', 
        ]);

        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $filePath = $file->storeAs('', $filename,'sentencias');

            sentencia::create([
                'titulo' => $request->titulo,
                'file_path' => $filePath,
                'caso_id' => $request->caso_id,
            ]);

            $bitacora = new bitacora();
            $bitacora->descripcion = 'Se agregó una sentencia';
            $bitacora->user_name = auth()->user()->name;
            $bitacora->ip = $request->ip();
            $bitacora->save();

            return redirect()->route('sentencia.index');
        }

        return redirect()->back()->with('error', 'Error uploading document.');
    }

    public function showSentencia($filename)
    {
        $filePath = storage_path('app/sentencias/' . $filename);

        if (file_exists($filePath)) {
            return response()->file($filePath);
        }

        abort(404, 'File not found.');
    }

    public function destroySentencia(Request $request, $id){
        $user = sentencia::find($id);
        
        $file = $user->file_path;

        if (Storage::exists('sentencias/' . $file)) {
            Storage::delete('sentencias/' . $file);
        } 

        $bitacora = new bitacora();
        $bitacora->descripcion = 'Se eliminó la sentencia: ' . $user->titulo;
        $bitacora->user_name = auth()->user()->name;
        $bitacora->ip = $request->ip();
        $bitacora->save();

        $user->delete();

        return redirect()->route('sentencia.index');
    }

    /*///// Edita un sentencia////// */

    public function editSentencia($id){
        $user = sentencia::find($id);
        return view('sentencia.editarSentencia',compact('user'));
    }

    public function updateSentencia(Request $request, $id){
       
        $user = sentencia::find($id);
        $user->titulo = $request->titulo;
        $user->caso_id = $request->caso_id;

        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $filePath = $file->storeAs('', $filename,'sentencias');

            $user->file_path = $filePath;     
        }

        $user->save();
        $bitacora = new bitacora();
        $bitacora->descripcion = 'Se editó los datos de la sentencia ' . $user->id;
        $bitacora->user_name = auth()->user()->name;
        $bitacora->ip = $request->ip();
        $bitacora->save();

        return redirect()->route('sentencia.index');
    }
}
