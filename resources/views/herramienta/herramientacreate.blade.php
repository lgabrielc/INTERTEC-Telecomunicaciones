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

<form method="POST" action="{{route("herramienta.store")}}">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1">Nombre</label>
        <input type="text" name="nombre" class="form-control" placeholder="Ejm: Cable UTP">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Descripción</label>
        <input type="text" name="descripcion" class="form-control" id="exampleInputPassword1"
            placeholder="Ejm: Categoria 6">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Stock</label>
        <input type="number" name="stock" class="form-control" id="exampleInputPassword1" placeholder="5">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Precio</label>
        <input type="number" name="precio" class="form-control" id="exampleInputPassword1" placeholder="20.00">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@if ($message)
{{$message}}
@endif
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