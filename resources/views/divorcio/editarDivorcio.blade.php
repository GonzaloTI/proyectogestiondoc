@extends('layouts.app')

@section('title','Editar Divorcio')

@section('content')
<nav class="bg-blue-500 py-6">
    <a href="{{route('admin.listarDivorcio')}}" class="text-white mx-16 font-semibold border-2 border-white py-3 px-5 pt-1 h-10 rounded-md hover:bg-white hover:text-blue-700">Atras</a>
</nav>

<div class="block mx-auto my-12 p-8 bg-white w-1/3 borderr border-gray-200 rounded-lg shadow-lg">
<h1 class="text-3xl text-center font-bold">Editar Caso de Divorcio {{$user->name}}</h1>

<form action="{{route('admin.updateDivorcio',$user->id)}}" method="POST" >
    @csrf

    <h3 class="h3 mb-0 text-gray-800">Título</h3>
    <input type="text" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white" placeholder="titulo" id="titulo" name="titulo" value="{{$user->titulo}}">

    <h3 class="h3 mb-0 text-gray-800">Número de caso</h3>
    <input type="text" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white" placeholder="numero" id="numero" name="numero" value="{{$user->numero}}">

 
    <h3 class="h3 mb-0 text-gray-800">Corte</h3>
    <input type="text" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white" placeholder="corte" id="corte" name="corte" value="{{$user->corte}}">

 
    <h3 class="h3 mb-0 text-gray-800">Juez</h3>
    <select required class="form-control" name="juez_id" id="juez_id">
        @foreach($jueces as $juez)
            @if($juez->id == $user->juez_id)
                <option value="{{$juez->id}}" selected>{{$juez->nombre}}  {{$juez->a_paterno}}  {{$juez->a_materno}}</option>
            @else
                <option value="{{$juez->id}}">{{$juez->nombre}}  {{$juez->a_paterno}}  {{$juez->a_materno}}</option>
            @endif
        @endforeach
    </select>

    <h3 class="h3 mb-0 text-gray-800">Estado</h3>
    <input type="text" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white" placeholder="estado" id="estado" name="estado" value="{{$user->estado}}">

    <h3 class="h3 mb-0 text-gray-800">Demandante</h3>
    <select required class="form-control" name="vista1_id" id="vista1_id">
        @foreach($vistas as $vista)
            @if($vista->id == $partes->first()->vista_id)
                <option value="{{$vista->id}}" selected>{{$vista->nombre}}  {{$vista->a_paterno}}  {{$vista->a_materno}}</option>
            @else
                <option value="{{$vista->id}}">{{$vista->nombre}}  {{$vista->a_paterno}}  {{$vista->a_materno}}</option>
            @endif
        @endforeach
    </select>

    @error('vista1_id')
     <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">{{ $message }}</p>
    @enderror

    <h3 class="h3 mb-0 text-gray-800">Abogado demandante</h3>
    <select required class="form-control" name="abogado1_id" id="abogado1_id">
        @foreach($abogados as $abogado)
            @if($abogado->id == $partes->first()->abogado_id)
                <option value="{{$abogado->id}}" selected>{{$abogado->nombre}}  {{$abogado->a_paterno}}  {{$abogado->a_materno}}</option>
            @else
                <option value="{{$abogado->id}}">{{$abogado->nombre}}  {{$abogado->a_paterno}}  {{$abogado->a_materno}}</option>
            @endif
        @endforeach
    </select>

    @error('abogado1_id')
     <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">{{ $message }}</p>
    @enderror

    <h3 class="h3 mb-0 text-gray-800">Demandado</h3>
    <select required class="form-control" name="vista2_id" id="vista2_id">
        @foreach($vistas as $vista)
            @if($vista->id == $partes->where('rol','Demandado')->first()->vista_id)
                <option value="{{$vista->id}}" selected>{{$vista->nombre}}  {{$vista->a_paterno}}  {{$vista->a_materno}}</option>
            @else
                <option value="{{$vista->id}}">{{$vista->nombre}}  {{$vista->a_paterno}}  {{$vista->a_materno}}</option>
            @endif
        @endforeach
    </select>

    @error('vista2_id')
     <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">{{ $message }}</p>
    @enderror

    <h3 class="h3 mb-0 text-gray-800">Abogado demandado</h3>
    <select required class="form-control" name="abogado2_id" id="abogado2_id">
        @foreach($abogados as $abogado)
            @if($abogado->id == $partes->where('rol','Demandado')->first()->abogado_id)
                <option value="{{$abogado->id}}" selected>{{$abogado->nombre}}  {{$abogado->a_paterno}}  {{$abogado->a_materno}}</option>
            @else
                <option value="{{$abogado->id}}">{{$abogado->nombre}}  {{$abogado->a_paterno}}  {{$abogado->a_materno}}</option>
            @endif
        @endforeach
    </select>

    @error('abogado2_id')
     <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">{{ $message }}</p>
    @enderror

    <button type="sudmit" class="rounded-md bg-blue-500 w-full text-lg text-white font-semibold p-2 my-3 hover:bg-blue-600">Editar</button>

</form>

</div>
@endsection