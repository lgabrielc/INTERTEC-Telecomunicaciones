@extends('adminlte::page')
@section('title', 'Modulo Pagos')
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
<script src="https://cdn.tailwindcss.com/" defer></script>

@livewireStyles
<script src="{{ mix('js/app.js') }}" defer></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
@section('content')
@livewire('admin.gestionar-reportes.reportepagos.showreportepagos')
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