@extends('adminlte::page')

@section('title', 'Administración')

@section('content_header')
    <h1>Panel de Administración de Torres</h1>
@stop

@section('content')
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalCrear">Crear Nuevo</button>
    <!-- Modal -->
    @include('admin.servidor.modalcrear')
    <p>Bienvenido a la gestión de Torres</p>

    <div class="card">
        <div class="card-body">
            <table id="myTable" class="table table-striped dt-responsive nowrap" style="width:100%">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Ip de Entrada</th>
                        <th scope="col">Ip de Salida</th>
                        <th scope="col">Editar</th>
                        <th width="280px" scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($servidores as $servidor)
                        <tr>
                            <td>{{ $servidor->id }}</td>
                            <td>{{ $servidor->nombre }}</td>
                            <td>{{ $servidor->ipEntrada }}</td>
                            <td>{{ $servidor->ipSalida }}</td>
                            <td>
                                <a href="" class="btn btn-info" data-toggle="modal"
                                data-target="#ModalEditar{{ $servidor->id }}">Editar</a>
                                @include('admin.servidor.modaleditar')
                            <td>
                                <form action="{{route('servidor.destroy',$servidor->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                <button class="btn btn-danger">Eliminar</button>
                            </form>
                            </td>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
        console.log('Hi!');
    </script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                "order": [[ 0, "desc" ]],
                responsive: true,
                autoWidth: false,
                language:{
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
                }
            });
        });
    </script>
@stop