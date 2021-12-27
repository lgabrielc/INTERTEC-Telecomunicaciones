@extends('adminlte::page')
@section('title', 'Modulo Pagos')
<meta charset="UTF-8" />
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<script src="https://cdn.tailwindcss.com/" defer></script>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
@section('content')
@livewire('admin.pago.pago-show')
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