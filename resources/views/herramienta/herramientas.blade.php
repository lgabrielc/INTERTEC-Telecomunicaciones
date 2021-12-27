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
{{-- @livewire('admin.datacenter.datacenter-show') --}}
<a href="{{route('herramienta.create')}}">
    <button type="button" class="btn btn-success mr-1 mt-2">Agregar producto</button>
</a>
@if (isset($message))
<div class="alert-danger mt-1">{{$message}} </div>
@endif
<div class="pt-2">
    <table class="table table-bordered w-full">
        <thead class="thead-dark">
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Stock</th>
                <th>Precio</th>
                <th class="w-25">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($herramientas as $herramienta)
            <tr>
                <td>{{$herramienta->nombre}}</td>
                <td>{{$herramienta->descripcion}}</td>
                <td>{{$herramienta->stock}}</td>
                <td>{{$herramienta->precio}}</td>
                <td class="d-flex flex-row">
                    <form action="{{ route('herramienta.destroy', [$herramienta->id] ) }}" method="POST">
                        <a class="btn btn-primary" href="{{ route('herramienta.edit',$herramienta->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop
@livewireScripts
<script>
    Livewire.on('alert', function(message) {
        Swal.fire(
            'Buen Trabajo!',
            message,
            'success'
        )
    })
</script>
@stack('modals')
@stack('js')
@section('js')

@stop