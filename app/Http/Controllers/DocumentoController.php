<?php

// DocumentController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use WangID\Scanner\Scanner;
use App\Models\documento;
use App\Models\bitacora;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;

use App\Models\User;

class DocumentoController extends Controller
{
    public function index()
    {
        $user = documento::all();

        return view('documento.DocumentoRegister', compact('user'));
    }


    public function crearDocumento()
    {
        return view('documento.crearDocumento');
    }

    public function storedDocumento(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'caso_id' => 'required',
            'file' => 'required|mimes:pdf,doc,docx|max:2048', // Adjust allowed file types and maximum file size as needed
        ]);

        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $filePath = $file->storeAs('', $filename,'documents');

            documento::create([
                'titulo' => $request->titulo,
                'file_path' => $filePath,
                'caso_id' => $request->caso_id,
            ]);

            $bitacora = new bitacora();
            $bitacora->descripcion = 'Se agregó un documento';
            $bitacora->user_name = auth()->user()->name;
            $bitacora->ip = $request->ip();
            $bitacora->save();

            return redirect()->route('documento.index');
        }

        return redirect()->back()->with('error', 'Error uploading document.');
    }

    public function showDocumento($filename)
    {
        $filePath = storage_path('app/documents/' . $filename);

        if (file_exists($filePath)) {
            return response()->file($filePath);
        }

        abort(404, 'File not found.');
    }

    public function destroyDocumento(Request $request, $id){
        $user = documento::find($id);
        
        $file = $user->file_path;

        if (Storage::exists('documents/' . $file)) {
            Storage::delete('documents/' . $file);
        } 

        $bitacora = new bitacora();
        $bitacora->descripcion = 'Se eliminó el documento: ' . $user->titulo;
        $bitacora->user_name = auth()->user()->name;
        $bitacora->ip = $request->ip();
        $bitacora->save();

        $user->delete();

        return redirect()->route('documento.index');
    }

    /*///// Edita un documento////// */

    public function editDocumento($id){
        $user = documento::find($id);
        return view('documento.editarDocumento',compact('user'));
    }

    public function updateDocumento(Request $request, $id){
       
        $user = documento::find($id);
        $user->titulo = $request->titulo;
        $user->caso_id = $request->caso_id;

        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $filePath = $file->storeAs('', $filename,'documents');

            $user->file_path = $filePath;     
        }

        $user->save();
        $bitacora = new bitacora();
        $bitacora->descripcion = 'Se editó los datos del documento ' . $user->id;
        $bitacora->user_name = auth()->user()->name;
        $bitacora->ip = $request->ip();
        $bitacora->save();

        return redirect()->route('documento.index');
    }
}
