@extends('layouts.app')

@section('title','Crear Cliente')

@section('content')
<nav class="bg-blue-500 py-6">
    <a href="{{route('admin.roles')}}" class="text-white mx-16 font-semibold border-2 border-white py-3 px-5 pt-1 h-10 rounded-md hover:bg-white hover:text-blue-700">Atras</a>
</nav>

<div class="block mx-auto my-12 p-8 bg-white w-1/3 borderr border-gray-200 rounded-lg shadow-lg">
<h1 class="text-3xl text-center font-bold">Crear Rol</h1>

<form class="mt-4" method="POST" action="{{route('admin.storedRoles')}}">
    @csrf

    <input type="text" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white" placeholder="descripción" id="descripcion" name="descripcion">

    @error('descripcion')
     <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">{{ $message }}</p>
    @enderror


    <button type="sudmit" class="rounded-md bg-blue-500 w-full text-lg text-white font-semibold p-2 my-3 hover:bg-blue-600">Crear</button>

</form>


</div>
@endsection