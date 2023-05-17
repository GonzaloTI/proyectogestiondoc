@extends('layouts.app')

@section('title','Editar Rol')

@section('content')
<nav class="bg-blue-500 py-6">
    <a href="{{route('admin.roles')}}" class="text-white mx-16 font-semibold border-2 border-white py-3 px-5 pt-1 h-10 rounded-md hover:bg-white hover:text-blue-700">Atras</a>
</nav>

<div class="block mx-auto my-12 p-8 bg-white w-1/3 borderr border-gray-200 rounded-lg shadow-lg">
<h1 class="text-3xl text-center font-bold">Editar Rol {{$user->name}}</h1>

<form action="{{route('admin.updaterol',$user->id)}}" method="POST" >
    @csrf

    <h1 class="h3 mb-0 text-gray-800">Descripción</h1>
    <input type="text" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white" placeholder="descripción" id="descripcion" name="descripcion" value="{{$user->descripcion}}">

 
    <button type="sudmit" class="rounded-md bg-blue-500 w-full text-lg text-white font-semibold p-2 my-3 hover:bg-blue-600">Editar</button>

</form>





</div>
@endsection