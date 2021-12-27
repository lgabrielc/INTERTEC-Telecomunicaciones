@extends('adminlte::page')
@section('title', 'Modulo Data Center')
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
@livewireStyles
<script src="{{ mix('js/app.js') }}" defer></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
@section('content')

{{-- <form method="POST" action="{{route(" herramienta.update")}}">
    @csrf --}}
    <label for="">EDITAR HERRAMIENTA</label>
    <form method="POST" action="{{route("herramienta.update", [$herramienta->id])}}">
        @method("PUT")
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Nombre</label>
            <input type="text" name="nombre" value="{{$herramienta->nombre}}" class="form-control"
                placeholder="Ejm: Cable UTP">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Descripción</label>
            <input type="text" name="descripcion" value="{{$herramienta->descripcion}}" class="form-control"
                id="exampleInputPassword1" placeholder="Ejm: Categoria 6">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Stock</label>
            <input type="number" name="stock" value="{{$herramienta->stock}}" class="form-control"
                id="exampleInputPassword1" placeholder="5">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Precio</label>
            <input type="number" name="precio" value="{{$herramienta->precio}}" class="form-control"
                id="exampleInputPassword1" placeholder="20.00">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    @stop
    @livewireScripts

    @stack('modals')
    @stack('js')
    @section('js')

    @stop