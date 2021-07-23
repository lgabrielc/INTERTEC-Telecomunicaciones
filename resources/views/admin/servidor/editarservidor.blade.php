@extends('adminlte::page')

@section('title', 'Administración')

@section('content_header')
    <h1>Inicio</h1>
@stop

@section('content')
    <p>Bienvenido al panel de Administración</p>
@stop

@section('css')
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop