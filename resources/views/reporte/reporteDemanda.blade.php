@extends('layouts.app')

@section('title','Generar Reporte')

@section('content')
<nav class="">
    <a href="{{route('demanda.index')}}" class=" btn btn-primary m-3">Atras</a>
</nav>

<div class="block mx-auto my-12 p-8 bg-white w-1/2 borderr border-gray-200 rounded-lg shadow-lg">
<h1 class="text-3xl text-center font-bold">Generar Reporte</h1>

<form action="{{route('reporte.exportDemanda')}}" method="POST">
    @csrf

    <div class="form-group">
        <label >Seleccionar Columnas:</label>
        <div class="row py-1">
        <input type="checkbox" class="btn-check form-control col-sm-2" id="id" name="columns[ID]" value="id" checked>
        <label class="col-sm-4" for="id">ID</label>
        <input type="checkbox" class="btn-check form-control col-sm-2" id="titulo" name="columns[Título]" value="titulo" checked>
        <label class="col-sm-4" for="titulo">Título</label>
        </div>
        <div class="row py-1">
        <input type="checkbox" class="btn-check form-control col-sm-2" id="caso_id" name="columns[Caso ID]" value="caso_id" checked> 
        <label class="col-sm-4" for="caso_id">Caso ID</label>
        <input type="checkbox" class="btn-check form-control col-sm-2" id="file_path" name="columns[Nombre del archivo]" value="file_path" checked> 
        <label class="col-sm-4" for="file_path">Nombre del archivo</label>
        </div>
        <div class="row py-1">
        <input type="checkbox" class="btn-check form-control col-sm-2" id="created_at" name="columns[Fecha de Registro]" value="created_at" checked> 
        <label class="col-sm-4" for="created_at">Fecha de Registro</label>
        </div>
    </div>

    <div class="form-group">
        <label for="criteria">Selección del Criterio:</label> <br>
        <input class="m-1" id ="criteria" type="text" name="criteria[id]" placeholder="ID" class="form-control">
        <input class="m-1" type="text" name="criteria[titulo]" placeholder="Título" class="form-control">
        <input class="m-1" type="text" name="criteria[caso_id]" placeholder="Caso ID" class="form-control">
        <input class="m-1" type="text" name="criteria[file_path]" placeholder="Nombre del archivo" class="form-control">
        
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
            <option value="titulo">Título</option>
            <option value="caso_id">Caso ID</option>
            <option value="file_path">Nombre del archivo</option>
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