@extends('layouts.app')
@section('title','Lista de Casos de Asistencia Familiar')
@section('content')


<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      <a href="{{ route('reporte.generateAsistencia')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
              class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div>

  <!-- Content Row -->


    <a href="{{route('admin.crearAsistencia')}}" class="btn btn-primary">Crear</a>

  <h1 class="text-3xl text-center font-bold">Lista de Casos de Asistencia Familiar</h1>
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
                            <th>Título</th>
                            <th>Número de caso</th>
                            <th>Corte</th>
                            <th>Juez ID</th>
                            <th>Estado</th>
                            <th>F_Registro</th>
                            <th>Actions</th>
                        </tr>
                    </thead>



                    <tfoot>
                        <tr class="table-warning">
                            <th>ID</th>
                            <th>Título</th>
                            <th>Número de caso</th>
                            <th>Corte</th>
                            <th>Juez ID</th>
                            <th>Estado</th>
                            <th>F_Registro</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>

        <!--###################################################-->

        @foreach($user as $row)

        <tr>
                <td class="py-3 px-7">{{$row->id}}</td>
                <td class="p-3 text-center">{{$row->titulo}}</td>
                <td class="p-3 text-center">{{$row->numero}}</td>
                <td class="p-3 text-center">{{$row->corte}}</td>
                <td class="p-3 text-center">{{$row->juez_id}}</td>
                <td class="p-3 text-center">{{$row->estado}}</td>
                <td class="p-3 text-center">{{$row->created_at}}</td>
                

                <td class="p-3">

                    <a href="{{ route('admin.detalleAsistencia', $row->id )}}" class="btn btn-info btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-user"></i>
                        </span>
                        <span class="text">Ver Partes</span>
                    </a>

                    <a href="{{ route('admin.destroyAsistencia', $row->id )}}" class="btn btn-danger btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-trash"></i>
                        </span>
                        <span class="text">Borrar</span>
                    </a>


                    <a href="{{ route('admin.editAsistencia', $row->id )}}"  class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-pen"></i>
                        </span>
                        <span class="text">Editar</span>
                    </a>

                  </td>
              </tr>

      @endforeach

          <!--################################3#######-->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->


@endsection