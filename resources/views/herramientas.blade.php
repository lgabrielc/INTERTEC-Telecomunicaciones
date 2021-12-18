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
<div class="pt-2">
    <table class="table table-bordered w-75">
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
                    <button type="button" class="btn btn-success m-1">Agregar producto</button>
                    <button type="button" class="btn btn-success m-1">Agregar producto</button>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{-- {{dd($herramientas)}} --}}
<button type="button" class="btn btn-success m-2">Agregar producto</button>



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