@extends('layouts.app')

@section('title','Crear Vista')

@section('content')

<a href="{{route('admin.listarvista')}}" class="btn btn-primary m-4">Atras</a>


<div class="block mx-auto my-12 p-8 bg-white w-1/3 borderr border-gray-200 rounded-lg shadow-lg">
<h1 class="text-3xl text-center font-bold">Crear </h1>

<form class="mt-4" method="POST" action="{{route('admin.storedVista')}}" enctype="multipart/form-data">
    @csrf

    <input type="text" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white" placeholder="ci" id="ci" name="ci">

    @error('ci')
    <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">{{ $message }}</p>
    @enderror

    <input type="text" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white" placeholder="nombre" id="nombre" name="nombre">

    @error('nombre')
    <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">{{ $message }}</p>
    @enderror


    <input type="text" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white" placeholder="a_paterno" id="a_paterno" name="a_paterno">

    @error('a_paterno')
    <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">{{ $message }}</p>
    @enderror


    <input type="text" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white" placeholder="a_materno" id="a_materno" name="a_materno">

    @error('a_materno')
    <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">{{ $message }}</p>
    @enderror

    <input type="text" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white" placeholder="sexo" id="sexo" name="sexo">

    @error('sexo')
    <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">{{ $message }}</p>
    @enderror

    <input type="text" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white" placeholder="telefono" id="telefono" name="telefono">

    @error('telefono')
    <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">{{ $message }}</p>
    @enderror

    <input type="text" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white" placeholder="direccion" id="direccion" name="direccion">

    @error('direccion')
    <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">{{ $message }}</p>
    @enderror

    <input type="text" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white" placeholder="user_id" id="user_id" name="user_id">


    <button type="sudmit" class="rounded-md bg-blue-500 w-full text-lg text-white font-semibold p-2 my-3 hover:bg-blue-600">Crear</button>

</form>


</div>
@endsection