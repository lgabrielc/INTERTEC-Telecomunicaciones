@extends('adminlte::page')

@section('title', 'Administración')

@section('content_header')
    <h1>Inicio</h1>
@stop

@section('content')
<p>Bienvenido a la gestión de Antenas</p>
<table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">First</th>
        <th scope="col">Last</th>
        <th scope="col">Handle</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
      </tr>
      <tr>
        <th scope="row">2</th>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>@fat</td>
      </tr>
      <tr>
        <th scope="row">3</th>
        <td>Larry</td>
        <td>the Bird</td>
        <td>@twitter</td>
      </tr>
    </tbody>
  </table>
   
@stop

@section('css')
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop