@extends('layouts.app')
@section('title','Detalle del caso')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
            
                <div class="card shadow mb-4">
                    <div class="card-header"><h1 class="text-3xl text-center font-bold">Información del Caso {{$id}}</h1></div>

                    <div class="card-body">
                        <h1 class="text-2xl py-3">Detalles del caso</h1>
                        <p><strong>Número del caso:</strong> {{ $numero }}</p>
                        <p><strong>Título:</strong> {{ $titulo }}</p>
                        <p><strong>Tipo:</strong> {{ $tipo }}</p>
                        <p><strong>Corte:</strong> {{ $corte }}</p>
                        <p><strong>Juez:</strong> {{ $juez }}</p>
                        <p><strong>Estado del caso:</strong> {{ $estado }}</p>
                        <hr>
                        <h4 class="font-bold py-2">Partes</h4>
                        @foreach($partes as $row)
                        <p><strong>{{$row->rol}}: </strong>{{$row->vista->nombre}}  {{$row->vista->a_paterno}}  {{$row->vista->a_materno}}</p>
                        
                        <p><strong>Abogado del {{$row->rol}}: </strong> {{$row->abogado->nombre}}  {{$row->abogado->a_paterno}}  {{$row->abogado->a_materno}}</p>
                        @endforeach
@auth
                        <div class="py-2 d-flex flex-row-reverse">
                            @if($tipo == 'Asistencia familiar')
                                <a href="{{ route('admin.editAsistencia', $id )}}"  class="btn btn-success btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-pen"></i>
                                </span>
                                <span class="text">Editar</span>
                                </a>
                            @else
                                <a href="{{ route('admin.editDivorcio', $id )}}"  class="btn btn-success btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-pen"></i>
                                </span>
                                <span class="text">Editar</span>
                                </a>
                            @endif
                        </div>
@endauth
                        <hr>


                        <h1 class="text-2xl py-3">Documentos</h1>
                        
                        <div class="btn-group" role="group">
                            <a href="{{route('expediente.caso', $id )}}" type="button" class="btn btn-outline-primary">Expediente</a>
                            <a href="{{route('apelacion.caso', $id )}}" type="button" class="btn btn-outline-primary">Apelación</a>
                            <a href="{{route('demanda.caso', $id )}}" type="button" class="btn btn-outline-primary">Demanda</a>
                            <a href="{{route('sentencia.caso', $id )}}" type="button" class="btn btn-outline-primary">Sentencia</a>
                            <a href="{{route('documento.caso', $id )}}" type="button" class="btn btn-outline-primary">Otros documentos</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
