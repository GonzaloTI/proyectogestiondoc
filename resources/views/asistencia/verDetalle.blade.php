@extends('layouts.app')
@section('title','Detalle de caso de Asistencia familiar')
@section('content')


<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      <a href="{{ route('reporte.generateAsistencia')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
              class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div>

  <!-- Content Row -->


    <a href="{{route('admin.listarAsistencia')}}" class="btn btn-primary">Atras</a>

  <h1 class="text-3xl text-center font-bold">Detalle de Caso de Asistencia Familiar </h1>
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
                            <th>Partes ID</th>
                            <th>Abogado ID</th>
                        </tr>
                    </thead>



                    <tfoot>
                        <tr class="table-warning">
                            <th>ID</th>
                            <th>Caso</th>
                            <th>Rol</th>
                            <th>Partes ID</th>
                            <th>Abogado ID</th>
                        </tr>
                    </tfoot>
                    <tbody>

        <!--###################################################-->

        @foreach($user as $row)

        <tr>
                <td class="py-3 px-7">{{$row->id}}</td>
                <td class="p-3 text-center">{{$row->caso_id}}</td>
                <td class="p-3 text-center">{{$row->rol}}</td>
                <td class="p-3 text-center">{{$row->vista_id}}</td>
                <td class="p-3 text-center">{{$row->abogado_id}}</td>
                
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