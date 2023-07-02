@extends('layouts.app')

@section('title','Crear Divorcio')

@section('content')
<a href="{{route('admin.listarDivorcio')}}" class="btn btn-primary m-4">Atras</a>


<div class="block mx-auto my-12 p-8 bg-white w-1/3 borderr border-gray-200 rounded-lg shadow-lg">
<h1 class="text-3xl text-center font-bold">Crear Caso de Divorcio</h1>

<form class="mt-4" method="POST" action="{{route('admin.storedDivorcio')}}">
    @csrf

    <input type="text" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white" placeholder="titulo" id="titulo" name="titulo">

    @error('titulo')
     <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">{{ $message }}</p>
    @enderror

    <input type="text" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white" placeholder="numero" id="numero" name="numero">

    @error('numero')
     <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">{{ $message }}</p>
    @enderror
 

    <input type="text" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white" placeholder="corte" id="corte" name="corte">

    @error('corte')
     <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">{{ $message }}</p>
    @enderror

    <label for="juez_id">Juez</label>
    <select required class="form-control" name="juez_id" id="juez_id">
        @foreach($jueces as $juez)
            <option value="{{$juez->id}}">{{$juez->nombre}}  {{$juez->a_paterno}}  {{$juez->a_materno}}</option>
        @endforeach
    </select>

    @error('juez_id')
     <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">{{ $message }}</p>
    @enderror

    <input type="text" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white" placeholder="estado" id="estado" name="estado">

    @error('estado')
     <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">{{ $message }}</p>
    @enderror

    <label for="vista1_id">Demandante</label>
    <select required class="form-control" name="vista1_id" id="vista1_id">
        @foreach($vistas as $vista)
            <option value="{{$vista->id}}">{{$vista->nombre}}  {{$vista->a_paterno}}  {{$vista->a_materno}}</option>
        @endforeach
    </select>

    @error('vista1_id')
     <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">{{ $message }}</p>
    @enderror

    <label for="abogado1_id">Abogado del demandante</label>
    <select required class="form-control" name="abogado1_id" id="abogado1_id">
        @foreach($abogados as $abogado)
            <option value="{{$abogado->id}}">{{$abogado->nombre}}  {{$abogado->a_paterno}}  {{$abogado->a_materno}}</option>
        @endforeach
    </select>

    @error('abogado1_id')
     <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">{{ $message }}</p>
    @enderror

    <label for="vista2_id">Demandado</label>
    <select required class="form-control" name="vista2_id" id="vista2_id">
        @foreach($vistas as $vista)
            <option value="{{$vista->id}}">{{$vista->nombre}}  {{$vista->a_paterno}}  {{$vista->a_materno}}</option>
        @endforeach
    </select>

    @error('vista2_id')
     <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">{{ $message }}</p>
    @enderror

    <label for="abogado2_id">Abogado del demandado</label>
    <select required class="form-control" name="abogado2_id" id="abogado2_id">
        @foreach($abogados as $abogado)
            <option value="{{$abogado->id}}">{{$abogado->nombre}}  {{$abogado->a_paterno}}  {{$abogado->a_materno}}</option>
        @endforeach
    </select>

    @error('abogado2_id')
     <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">{{ $message }}</p>
    @enderror

    <button type="sudmit" class="rounded-md bg-blue-500 w-full text-lg text-white font-semibold p-2 my-3 hover:bg-blue-600">Crear</button>

</form>


</div>
@endsection