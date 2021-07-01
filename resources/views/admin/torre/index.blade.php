@extends('adminlte::page')

@section('title', 'Administración')

@section('content_header')
    <h1>Inicio</h1>
@stop

@section('content')
<p>Bienvenido a la gestión de Torres</p>
    <div class="card">
        <div class="card-body">
            <table id="myTable" class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Direccion</th>
                    <th scope="col">Dueño del Local</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Pago</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($torre as $torreind)
                  <tr>
                    <td>{{$torreind->id}}</td>
                    <td>{{$torreind->nombreTorre}}</td>
                    <td>{{$torreind->direccion}}</td>
                    <td>{{$torreind->dueñoLocal}}</td>
                    <td>{{$torreind->telefono}}</td>
                    <td>{{$torreind->pago}}</td>
                  </tr>            
                    @endforeach
            
                </tbody>
              </table>
        </div>
       
    </div>

 
@stop

@section('css')
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
@stop

@section('js')
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script> console.log('Hi!'); </script>
    <script>
        $(document).ready( function () {
        $('#myTable').DataTable();
    } );
    </script>
    
@stop
