@extends('adminlte::page')

@section('title', 'Administración')

@section('content_header')
    <h1>Panel de Administración de Torres</h1>
@stop

@section('content')
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalCrear">Crear Nuevo</button>
    <!-- Modal -->
    @include('admin.torre.modalcrear')
    <p>Bienvenido a la gestión de Torres</p>
    <div class="card">
        <div class="card-body">
            <table id="myTable" class="table table-striped dt-responsive nowrap" style="width:100%">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Direccion</th>
                        <th scope="col">Dueño del Local</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Pago</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody class="body-table">
                    @foreach ($torres as $torre)
                        <tr class="idraw">
                            <td>{{ $torre->id }}</td>
                            <td>{{ $torre->nombreTorre }}</td>
                            <td>{{ $torre->direccion }}</td>
                            <td>{{ $torre->dueñoLocal }}</td>
                            <td>{{ $torre->telefono }}</td>
                            <td>{{ $torre->pago }}</td>
                            <td><button type="button" class="mx-4 btn btn-info modal-editar" data-toggle="modal"
                                    data-target="#ModalEditar" data-action="editar">Editar</button>
                            <button class="btn btn-danger" data-action="eliminar">Eliminar</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('admin.torre.modaleditar')
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
                responsive: true,
                autoWidth: false
            });
        });
    </script>
    <script>
        const body_table = document.querySelector('.body-table');
        const formulario = document.querySelector('.form-edit');

        body_table.addEventListener('click', e => {

            const button = e.target;

            if (button.dataset.action == 'editar') {
                const padre = button.parentNode.parentNode;
                const datos = [...padre.querySelectorAll('td')].slice(1, -2);
                datos.forEach((el, index) => {
                    formulario[index + 1].value = el.innerText;
                })
            }
        })
    </script>

@stop
