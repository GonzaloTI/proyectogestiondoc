<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\expediente;
use App\Models\bitacora;
use Illuminate\Support\Facades\Storage;

class ExpedienteController extends Controller
{
    public function index()
    {
        $user = expediente::all();
        return view('expediente.ExpedienteRegister', compact('user'));
    }

    public function crearExpediente()
    {
        return view('expediente.crearExpediente');
    }

    public function storedExpediente(Request $request)
    {
        $request->validate([
            'asunto' => 'required',
            'caso_id' => 'required',
            'file' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $filePath = $file->storeAs('', $filename,'expedients');

            expediente::create([
                'asunto' => $request->asunto,
                'caso_id' => $request->caso_id,
                'file_path' => $filePath,
            ]);

            $bitacora = new bitacora();
            $bitacora->descripcion = 'Se agregó un expediente';
            $bitacora->user_name = auth()->user()->name;
            $bitacora->ip = $request->ip();
            $bitacora->save();

            return redirect()->route('expediente.index');
        }

        return redirect()->back()->with('error', 'Error uploading document.');
    }

    public function showExpediente($filename)
    {
        $filePath = storage_path('app/expedients/' . $filename);

        if (file_exists($filePath)) {
            return response()->file($filePath);
        }

        abort(404, 'File not found.');
    }

    public function destroyExpediente(Request $request, $id){
        $user = expediente::find($id);
        
        $file = $user->file_path;

        if (Storage::exists('expedients/' . $file)) {
            Storage::delete('expedients/' . $file);
        } 

        $bitacora = new bitacora();
        $bitacora->descripcion = 'Se eliminó el expediente: ' . $user->asunto;
        $bitacora->user_name = auth()->user()->name;
        $bitacora->ip = $request->ip();
        $bitacora->save();

        $user->delete();

        return redirect()->route('expediente.index');
    }

    /*///// Edita un expediente////// */

    public function editExpediente($id){
        $user = expediente::find($id);
        return view('expediente.editarExpediente',compact('user'));
    }

    public function updateExpediente(Request $request, $id){
       
        $user = expediente::find($id);
        $user->asunto = $request->asunto;
        $user->caso_id = $request->caso_id;

        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $filePath = $file->storeAs('', $filename,'expedients');

            $user->file_path = $filePath;     
        }

        $user->save();
        $bitacora = new bitacora();
        $bitacora->descripcion = 'Se editó los datos del expediente ' . $id;
        $bitacora->user_name = auth()->user()->name;
        $bitacora->ip = $request->ip();
        $bitacora->save();

        return redirect()->route('expediente.index');
    }
}
