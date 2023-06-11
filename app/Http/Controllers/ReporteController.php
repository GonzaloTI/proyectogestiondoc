<?php

namespace App\Http\Controllers;
use App\Models\cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PdfReport;
use ExcelReport;
use Illuminate\Support\Facades\Schema;
use App\Models\documento;
use App\Models\abogado;
use App\Models\bitacora;
use App\Models\juece;
use App\Models\personal;
use App\Models\User;
use App\Models\rol;
use App\Models\expediente;
use App\Models\apelacion;
use App\Models\demanda;

class ReporteController extends Controller
{
    public function generateCliente()
    {   
        return view('reporte.reporteCliente');
    }

    public function exportCliente(Request $request)
    {
        $title = 'Lista de clientes';
        
        $columns = $request->input('columns', []);
        /* $columns = [];
        foreach($datos as $dato){
            $columns[ucfirst($dato)] = $dato;
        } */
        
        $console = 'console.log(' . json_encode($columns) . ');';
        $console = sprintf('<script>%s</script>', $console);
        echo $console;

        $criteria = $request->input('criteria', []);
        $criteria = array_filter($criteria);
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        $orderBy = $request->input('order_by');
        $sortBy = $request->input('sortby');
        
        $format = $request->input('format');

        $meta = [ // For displaying filters description on header
            'Ordenado Por' => $orderBy,
            'de forma' => $sortBy
        ];
    
        /*$user = cliente::select($columns)
                        ->where($criteria)
                        ->orderBy($orderBy, $sortBy);
        */
        if(empty($fromDate)){
            if(empty($toDate)){
                $queryBuilder = cliente::where($criteria)
                ->orderBy($orderBy, $sortBy)
                ->get(); 
            }else{
                $queryBuilder = cliente::where($criteria)->whereDate('created_at','<=',$toDate)
                ->orderBy($orderBy, $sortBy)
                ->get(); 
            }
            
        }else{
            if(empty($toDate)){
                $queryBuilder = cliente::where($criteria)->whereDate('created_at','>=',$fromDate)
                ->orderBy($orderBy, $sortBy)
                ->get(); 
            }else{
                $queryBuilder = cliente::where($criteria)->whereBetween('created_at', [$fromDate, $toDate])
                ->orderBy($orderBy, $sortBy)
                ->get(); 
            }
        }
        
        //return view('cliente.pdfCliente', compact('user'), compact('columns'));
        
        if($format == 'excel'){
            return ExcelReport::of($title, $meta, $queryBuilder, $columns)
            ->download($title);
        }elseif($format == 'pdf'){
            return PdfReport::of($title, $meta, $queryBuilder, $columns)
            ->showMeta(false)        
            ->stream(); 
        }else{
            return ExcelReport::of($title, $meta, $queryBuilder, $columns)
            ->downloadHTML($title);
        }
    }

    public function generateAbogado()
    {   
        return view('reporte.reporteAbogado');
    }

    public function exportAbogado(Request $request)
    {
        $title = 'Lista de abogados';
        
        $columns = $request->input('columns', []);

        $console = 'console.log(' . json_encode($columns) . ');';
        $console = sprintf('<script>%s</script>', $console);
        echo $console;

        $criteria = $request->input('criteria', []);
        $criteria = array_filter($criteria);
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        $orderBy = $request->input('order_by');
        $sortBy = $request->input('sortby');
        
        $format = $request->input('format');

        $meta = [
            'Ordenado Por' => $orderBy,
            'de forma' => $sortBy
        ];
    
        if(empty($fromDate)){
            if(empty($toDate)){
                $queryBuilder = abogado::where($criteria)
                ->orderBy($orderBy, $sortBy)
                ->get(); 
            }else{
                $queryBuilder = abogado::where($criteria)->whereDate('created_at','<=',$toDate)
                ->orderBy($orderBy, $sortBy)
                ->get(); 
            }
            
        }else{
            if(empty($toDate)){
                $queryBuilder = abogado::where($criteria)->whereDate('created_at','>=',$fromDate)
                ->orderBy($orderBy, $sortBy)
                ->get(); 
            }else{
                $queryBuilder = abogado::where($criteria)->whereBetween('created_at', [$fromDate, $toDate])
                ->orderBy($orderBy, $sortBy)
                ->get(); 
            }
        }
        
        if($format == 'excel'){
            return ExcelReport::of($title, $meta, $queryBuilder, $columns)
            ->download($title);
        }elseif($format == 'pdf'){
            return PdfReport::of($title, $meta, $queryBuilder, $columns)
            ->stream(); 
        }else{
            return ExcelReport::of($title, $meta, $queryBuilder, $columns)
            ->downloadHTML($title);
        }
    }

    public function generateBitacora()
    {   
        return view('reporte.reporteBitacora');
    }

    public function exportBitacora(Request $request)
    {
        $title = 'Bitacora';
        
        $columns = $request->input('columns', []);

        $console = 'console.log(' . json_encode($columns) . ');';
        $console = sprintf('<script>%s</script>', $console);
        echo $console;

        $criteria = $request->input('criteria', []);
        $criteria = array_filter($criteria);
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        $orderBy = $request->input('order_by');
        $sortBy = $request->input('sortby');
        
        $format = $request->input('format');

        $meta = [
            'Ordenado Por' => $orderBy,
            'de forma' => $sortBy
        ];
    
        if(empty($fromDate)){
            if(empty($toDate)){
                $queryBuilder = bitacora::where($criteria)
                ->orderBy($orderBy, $sortBy)
                ->get(); 
            }else{
                $queryBuilder = bitacora::where($criteria)->whereDate('created_at','<=',$toDate)
                ->orderBy($orderBy, $sortBy)
                ->get(); 
            }
            
        }else{
            if(empty($toDate)){
                $queryBuilder = bitacora::where($criteria)->whereDate('created_at','>=',$fromDate)
                ->orderBy($orderBy, $sortBy)
                ->get(); 
            }else{
                $queryBuilder = bitacora::where($criteria)->whereBetween('created_at', [$fromDate, $toDate])
                ->orderBy($orderBy, $sortBy)
                ->get(); 
            }
        }
        
        if($format == 'excel'){
            return ExcelReport::of($title, $meta, $queryBuilder, $columns)
            ->download($title);
        }elseif($format == 'pdf'){
            return PdfReport::of($title, $meta, $queryBuilder, $columns)
            ->stream(); 
        }else{
            return ExcelReport::of($title, $meta, $queryBuilder, $columns)
            ->downloadHTML($title);
        }
    }


    public function generateJuez()
    {   
        return view('reporte.reporteJuez');
    }

    public function exportJuez(Request $request)
    {
        $title = 'Lista de Jueces';
        
        $columns = $request->input('columns', []);

        $console = 'console.log(' . json_encode($columns) . ');';
        $console = sprintf('<script>%s</script>', $console);
        echo $console;

        $criteria = $request->input('criteria', []);
        $criteria = array_filter($criteria);
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        $orderBy = $request->input('order_by');
        $sortBy = $request->input('sortby');
        
        $format = $request->input('format');

        $meta = [
            'Ordenado Por' => $orderBy,
            'de forma' => $sortBy
        ];
    
        if(empty($fromDate)){
            if(empty($toDate)){
                $queryBuilder = juece::where($criteria)
                ->orderBy($orderBy, $sortBy)
                ->get(); 
            }else{
                $queryBuilder = juece::where($criteria)->whereDate('created_at','<=',$toDate)
                ->orderBy($orderBy, $sortBy)
                ->get(); 
            }
            
        }else{
            if(empty($toDate)){
                $queryBuilder = juece::where($criteria)->whereDate('created_at','>=',$fromDate)
                ->orderBy($orderBy, $sortBy)
                ->get(); 
            }else{
                $queryBuilder = juece::where($criteria)->whereBetween('created_at', [$fromDate, $toDate])
                ->orderBy($orderBy, $sortBy)
                ->get(); 
            }
        }
        
        if($format == 'excel'){
            return ExcelReport::of($title, $meta, $queryBuilder, $columns)
            ->download($title);
        }elseif($format == 'pdf'){
            return PdfReport::of($title, $meta, $queryBuilder, $columns)
            ->stream(); 
        }else{
            return ExcelReport::of($title, $meta, $queryBuilder, $columns)
            ->downloadHTML($title);
        }
    }

    public function generatePersonal()
    {   
        return view('reporte.reportePersonal');
    }

    public function exportPersonal(Request $request)
    {
        $title = 'Lista del Personal';
        
        $columns = $request->input('columns', []);

        $console = 'console.log(' . json_encode($columns) . ');';
        $console = sprintf('<script>%s</script>', $console);
        echo $console;

        $criteria = $request->input('criteria', []);
        $criteria = array_filter($criteria);
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        $orderBy = $request->input('order_by');
        $sortBy = $request->input('sortby');
        
        $format = $request->input('format');

        $meta = [
            'Ordenado Por' => $orderBy,
            'de forma' => $sortBy
        ];
    
        if(empty($fromDate)){
            if(empty($toDate)){
                $queryBuilder = personal::where($criteria)
                ->orderBy($orderBy, $sortBy)
                ->get(); 
            }else{
                $queryBuilder = personal::where($criteria)->whereDate('created_at','<=',$toDate)
                ->orderBy($orderBy, $sortBy)
                ->get(); 
            }
            
        }else{
            if(empty($toDate)){
                $queryBuilder = personal::where($criteria)->whereDate('created_at','>=',$fromDate)
                ->orderBy($orderBy, $sortBy)
                ->get(); 
            }else{
                $queryBuilder = personal::where($criteria)->whereBetween('created_at', [$fromDate, $toDate])
                ->orderBy($orderBy, $sortBy)
                ->get(); 
            }
        }
        
        if($format == 'excel'){
            return ExcelReport::of($title, $meta, $queryBuilder, $columns)
            ->download($title);
        }elseif($format == 'pdf'){
            return PdfReport::of($title, $meta, $queryBuilder, $columns)
            ->stream(); 
        }else{
            return ExcelReport::of($title, $meta, $queryBuilder, $columns)
            ->downloadHTML($title);
        }
    }

    public function generateDocumento()
    {   
        return view('reporte.reporteDocumento');
    }

    public function exportDocumento(Request $request)
    {
        $title = 'Lista de documentos';
        
        $columns = $request->input('columns', []);

        $console = 'console.log(' . json_encode($columns) . ');';
        $console = sprintf('<script>%s</script>', $console);
        echo $console;

        $criteria = $request->input('criteria', []);
        $criteria = array_filter($criteria);
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        $orderBy = $request->input('order_by');
        $sortBy = $request->input('sortby');
        
        $format = $request->input('format');

        $meta = [
            'Ordenado Por' => $orderBy,
            'de forma' => $sortBy
        ];
    
        if(empty($fromDate)){
            if(empty($toDate)){
                $queryBuilder = documento::where($criteria)
                ->orderBy($orderBy, $sortBy)
                ->get(); 
            }else{
                $queryBuilder = documento::where($criteria)->whereDate('created_at','<=',$toDate)
                ->orderBy($orderBy, $sortBy)
                ->get(); 
            }
            
        }else{
            if(empty($toDate)){
                $queryBuilder = documento::where($criteria)->whereDate('created_at','>=',$fromDate)
                ->orderBy($orderBy, $sortBy)
                ->get(); 
            }else{
                $queryBuilder = documento::where($criteria)->whereBetween('created_at', [$fromDate, $toDate])
                ->orderBy($orderBy, $sortBy)
                ->get(); 
            }
        }
        
        if($format == 'excel'){
            return ExcelReport::of($title, $meta, $queryBuilder, $columns)
            ->download($title);
        }elseif($format == 'pdf'){
            return PdfReport::of($title, $meta, $queryBuilder, $columns)
            ->stream(); 
        }else{
            return ExcelReport::of($title, $meta, $queryBuilder, $columns)
            ->downloadHTML($title);
        }
    }

    public function generateExpediente()
    {   
        return view('reporte.reporteExpediente');
    }

    public function exportExpediente(Request $request)
    {
        $title = 'Lista de expedientes';
        
        $columns = $request->input('columns', []);

        $console = 'console.log(' . json_encode($columns) . ');';
        $console = sprintf('<script>%s</script>', $console);
        echo $console;

        $criteria = $request->input('criteria', []);
        $criteria = array_filter($criteria);
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        $orderBy = $request->input('order_by');
        $sortBy = $request->input('sortby');
        
        $format = $request->input('format');

        $meta = [
            'Ordenado Por' => $orderBy,
            'de forma' => $sortBy
        ];
    
        if(empty($fromDate)){
            if(empty($toDate)){
                $queryBuilder = expediente::where($criteria)
                ->orderBy($orderBy, $sortBy)
                ->get(); 
            }else{
                $queryBuilder = expediente::where($criteria)->whereDate('created_at','<=',$toDate)
                ->orderBy($orderBy, $sortBy)
                ->get(); 
            }
            
        }else{
            if(empty($toDate)){
                $queryBuilder = expediente::where($criteria)->whereDate('created_at','>=',$fromDate)
                ->orderBy($orderBy, $sortBy)
                ->get(); 
            }else{
                $queryBuilder = expediente::where($criteria)->whereBetween('created_at', [$fromDate, $toDate])
                ->orderBy($orderBy, $sortBy)
                ->get(); 
            }
        }
        
        if($format == 'excel'){
            return ExcelReport::of($title, $meta, $queryBuilder, $columns)
            ->download($title);
        }elseif($format == 'pdf'){
            return PdfReport::of($title, $meta, $queryBuilder, $columns)
            ->stream(); 
        }else{
            return ExcelReport::of($title, $meta, $queryBuilder, $columns)
            ->downloadHTML($title);
        }
    }
    
    public function generateApelacion()
    {   
        return view('reporte.reporteApelacion');
    }

    public function exportApelacion(Request $request)
    {
        $title = 'Lista de apelaciones';
        
        $columns = $request->input('columns', []);

        $console = 'console.log(' . json_encode($columns) . ');';
        $console = sprintf('<script>%s</script>', $console);
        echo $console;

        $criteria = $request->input('criteria', []);
        $criteria = array_filter($criteria);
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        $orderBy = $request->input('order_by');
        $sortBy = $request->input('sortby');
        
        $format = $request->input('format');

        $meta = [
            'Ordenado Por' => $orderBy,
            'de forma' => $sortBy
        ];
    
        if(empty($fromDate)){
            if(empty($toDate)){
                $queryBuilder = apelacion::where($criteria)
                ->orderBy($orderBy, $sortBy)
                ->get(); 
            }else{
                $queryBuilder = apelacion::where($criteria)->whereDate('created_at','<=',$toDate)
                ->orderBy($orderBy, $sortBy)
                ->get(); 
            }
            
        }else{
            if(empty($toDate)){
                $queryBuilder = apelacion::where($criteria)->whereDate('created_at','>=',$fromDate)
                ->orderBy($orderBy, $sortBy)
                ->get(); 
            }else{
                $queryBuilder = apelacion::where($criteria)->whereBetween('created_at', [$fromDate, $toDate])
                ->orderBy($orderBy, $sortBy)
                ->get(); 
            }
        }
        
        if($format == 'excel'){
            return ExcelReport::of($title, $meta, $queryBuilder, $columns)
            ->download($title);
        }elseif($format == 'pdf'){
            return PdfReport::of($title, $meta, $queryBuilder, $columns)
            ->stream(); 
        }else{
            return ExcelReport::of($title, $meta, $queryBuilder, $columns)
            ->downloadHTML($title);
        }
    }
    
    public function generateDemanda()
    {   
        return view('reporte.reporteDemanda');
    }

    public function exportDemanda(Request $request)
    {
        $title = 'Lista de demandas';
        
        $columns = $request->input('columns', []);

        $console = 'console.log(' . json_encode($columns) . ');';
        $console = sprintf('<script>%s</script>', $console);
        echo $console;

        $criteria = $request->input('criteria', []);
        $criteria = array_filter($criteria);
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        $orderBy = $request->input('order_by');
        $sortBy = $request->input('sortby');
        
        $format = $request->input('format');

        $meta = [
            'Ordenado Por' => $orderBy,
            'de forma' => $sortBy
        ];
    
        if(empty($fromDate)){
            if(empty($toDate)){
                $queryBuilder = demanda::where($criteria)
                ->orderBy($orderBy, $sortBy)
                ->get(); 
            }else{
                $queryBuilder = demanda::where($criteria)->whereDate('created_at','<=',$toDate)
                ->orderBy($orderBy, $sortBy)
                ->get(); 
            }
            
        }else{
            if(empty($toDate)){
                $queryBuilder = demanda::where($criteria)->whereDate('created_at','>=',$fromDate)
                ->orderBy($orderBy, $sortBy)
                ->get(); 
            }else{
                $queryBuilder = demanda::where($criteria)->whereBetween('created_at', [$fromDate, $toDate])
                ->orderBy($orderBy, $sortBy)
                ->get(); 
            }
        }
        
        if($format == 'excel'){
            return ExcelReport::of($title, $meta, $queryBuilder, $columns)
            ->download($title);
        }elseif($format == 'pdf'){
            return PdfReport::of($title, $meta, $queryBuilder, $columns)
            ->stream(); 
        }else{
            return ExcelReport::of($title, $meta, $queryBuilder, $columns)
            ->downloadHTML($title);
        }
    }
}
