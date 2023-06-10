@extends('layouts.app')

@section('title','Generar Reporte')

@section('content')
<nav class="">
    <a href="{{route('admin.listarabogado')}}" class=" btn btn-primary m-3">Atras</a>
</nav>

<div class="block mx-auto my-12 p-8 bg-white w-1/2 borderr border-gray-200 rounded-lg shadow-lg">
<h1 class="text-3xl text-center font-bold">Generar Reporte</h1>

<form action="{{route('reporte.exportAbogado')}}" method="POST">
    @csrf

    <div class="form-group">
        <label >Seleccionar Columnas:</label>
        <div class="row py-1">
        <input type="checkbox" class="btn-check form-control col-sm-2" id="id" name="columns[ID]" value="id" checked>
        <label class="col-sm-4" for="id">ID</label>
        <input type="checkbox" class="btn-check form-control col-sm-2" id="ci" name="columns[CI]" value="ci" checked>
        <label class="col-sm-4" for="ci">CI</label>
    </div>
        <div class="row py-1">
        <input type="checkbox" class="btn-check form-control col-sm-2" id="nombre" name="columns[Nombre]" value="nombre" checked> 
        <label class="col-sm-4" for="nombre">Nombre</label>
        <input type="checkbox" class="btn-check form-control col-sm-2" id="a_paterno" name="columns[Apellido Paterno]" value="a_paterno" checked> 
        <label class="col-sm-4" for="a_paterno">Apellido Paterno</label>
        </div>
        <div class="row py-1">
        <input type="checkbox" class="btn-check form-control col-sm-2" id="a_materno" name="columns[Apellido Materno]" value="a_materno" checked>
        <label class="col-sm-4" for="a_materno"> Apellido Materno</label>
        <input type="checkbox" class="btn-check form-control col-sm-2" id="sexo" name="columns[Sexo]" value="sexo" checked> 
        <label class="col-sm-4" for="sexo">Sexo</label>
        </div>
        <div class="row py-1">
        <input type="checkbox" class="btn-check form-control col-sm-2" id="telefono" name="columns[Teléfono]" value="telefono" checked> 
        <label class="col-sm-4" for="telefono">Teléfono</label>
        <input type="checkbox" class="btn-check form-control col-sm-2" id="direccion" name="columns[Dirección]" value="direccion" checked> 
        <label class="col-sm-4" for="direccion">Dirección</label>
        </div>
        <div class="row py-1">
        <input type="checkbox" class="btn-check form-control col-sm-2" id="estado" name="columns[Estado]" value="estado" checked> 
        <label class="col-sm-4" for="estado">Estado</label>
        <input type="checkbox" class="btn-check form-control col-sm-2" id="user_id" name="columns[ID de usuario]" value="user_id" checked> 
        <label class="col-sm-4" for="user_id">ID de usuario</label>
        </div>
        <div class="row py-1">
        <input type="checkbox" class="btn-check form-control col-sm-2" id="created_at" name="columns[Fecha de Registro]" value="created_at" checked> 
        <label class="col-sm-4" for="created_at">Fecha de Registro</label>
        </div>
    </div>

    <div class="form-group">
        <label for="criteria">Selección del Criterio:</label> <br>
        <input class="m-1" id ="criteria" type="text" name="criteria[id]" placeholder="ID" class="form-control">
        <input class="m-1" type="text" name="criteria[ci]" placeholder="CI" class="form-control">
        <input class="m-1" type="text" name="criteria[nombre]" placeholder="Nombre" class="form-control">
        <input class="m-1" type="text" name="criteria[a_paterno]" placeholder="Apellido Paterno" class="form-control">
        <input class="m-1" type="text" name="criteria[a_materno]" placeholder="Apellido Materno" class="form-control">
        <input class="m-1" type="text" name="criteria[sexo]" placeholder="Sexo" class="form-control">
        <input class="m-1" type="text" name="criteria[telefono]" placeholder="Teléfono" class="form-control">
        <input class="m-1" type="text" name="criteria[direccion]" placeholder="Dirección" class="form-control">
        <input class="m-1" type="text" name="criteria[estado]" placeholder="Estado" class="form-control">
        <input class="m-1" type="text" name="criteria[user_id]" placeholder="ID de usuario" class="form-control">
        
    </div>

    <div class="form-group">
        <label for="fromDate">Fecha de Registro:</label><br>
        <input class="m-1" type="text" name="fromDate" placeholder="Desde" class="form-control">
        <input class="m-1" type="text" name="toDate" placeholder="Hasta" class="form-control">
    </div>

    <div class="form-group">
        <label for="order_by">Ordenar Por:</label>
        <select name="order_by" id="order_by" class="form-control">
            <option value="id">ID</option>
            <option value="ci">CI</option>
            <option value="nombre">Nombre</option>
            <option value="a_paterno">Apellido Paterno</option>
            <option value="a_materno">Apellido Materno</option>
            <option value="sexo">Sexo</option>
            <option value="telefono">Teléfono</option>
            <option value="direccion">Dirección</option>
            <option value="estado">Estado</option>
            <option value="user_id">ID de usuario</option>
            <option value="created_at">Fecha de Registro</option>
        </select>
        <select name="sortby" class="form-control my-1">
            <option value="asc">Ascendente</option>
            <option value="desc">Descendente</option>
        </select>
    </div>

    <div class="form-group">
        <label class="h3 mb-0 text-gray-800" for="format">Formato del Reporte:</label>
        <select name="format" id="format" class="form-control">
            <option value="pdf">PDF</option>
            <option value="html">HTML</option>
            <option value="excel">Excel</option>
        </select>
    </div>
    <button type="submit" class="rounded-md bg-blue-500 w-full text-lg text-white font-semibold p-2 my-3 hover:bg-blue-600">Generar Reporte</button>

</form>


</div>
@endsection