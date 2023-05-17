<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\bitacora;
use PDF;

class BitacoraController extends Controller
{
    public function ListarB(){
        $user = bitacora::all();
        return view('bitacora.BitacoraRegister', compact('user'));
    }

    public function Pdf(){
        $user = bitacora::all();
        $pdf = PDF::loadView('bitacora.pdfBitacora',['user'=>$user]);

        return $pdf->stream();
        //return $pdf->download('bitacora.pdf'); 
    }
}
