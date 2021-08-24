@extends('adminlte::page')
@section('title', 'Modulo Gpon')
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
@section('css')
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@stop
@section('content_header')
    @livewireStyles

@stop
@section('content')

    @livewire('admin.gpon.gpon-show')

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
