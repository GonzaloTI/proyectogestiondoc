@extends('layouts.app')
@section('title','Detalle de caso de Divorcio')
@section('content')


<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      <a href="{{ route('reporte.generateDivorcio')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
              class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div>

  <!-- Content Row -->


    <a href="{{route('admin.listarDivorcio')}}" class="btn btn-primary">Atras</a>

  <h1 class="text-3xl text-center font-bold">Detalle del Caso {{$user->first()->id}}</h1>
<div class="container-fluid">


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Datos</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="table-warning">
                            <th>ID</th>
                            <th>Caso</th>
                            <th>Rol</th>
                            <th>Nombre</th>
                            <th>Abogado</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr class="table-warning">
                            <th>ID</th>
                            <th>Caso</th>
                            <th>Rol</th>
                            <th>Nombre</th>
                            <th>Abogado</th>
                        </tr>
                    </tfoot>
                    <tbody>

        <!--###################################################-->

        @foreach($user as $row)

        <tr>
            <td class="py-3 px-7">{{$row->id}}</td>
            <td class="p-3 text-center">{{$row->caso_id}}</td>
            <td class="p-3 text-center">{{$row->rol}}</td>
            <td class="p-3 text-center">{{$row->vista->nombre}}  {{$row->vista->a_paterno}}  {{$row->vista->a_materno}}</td>
            <td class="p-3 text-center">{{$row->abogado->nombre}}  {{$row->abogado->a_paterno}}  {{$row->abogado->a_materno}}</td>
        </tr>

        @endforeach

          <!--################################3#######-->
                    </tbody>
                </table>
            </div>

            <h1 class="pb-3 font-bold">Ver documentos del caso: </h1>
            <div class="btn-group" role="group">
                <a href="{{route('expediente.caso', $user->first()->caso_id )}}" type="button" class="btn btn-outline-primary">Expediente</a>
                <a href="{{route('apelacion.caso', $user->first()->caso_id )}}" type="button" class="btn btn-outline-primary">Apelación</a>
                <a href="{{route('demanda.caso', $user->first()->caso_id )}}" type="button" class="btn btn-outline-primary">Demanda</a>
                <a href="{{route('sentencia.caso', $user->first()->caso_id )}}" type="button" class="btn btn-outline-primary">Sentencia</a>
                <a href="{{route('documento.caso', $user->first()->caso_id )}}" type="button" class="btn btn-outline-primary">Otros documentos</a>
            </div>

        </div>
    </div>


</div>
<!-- /.container-fluid -->


@endsection