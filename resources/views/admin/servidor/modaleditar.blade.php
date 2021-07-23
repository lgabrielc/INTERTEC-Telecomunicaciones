<div class="modal fade" id="ModalEditar{{ $servidor->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Servidor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formeditar" action="{{ route('servidor.update', $servidor->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nombre del Servidor:</label>
                        <input type="text" class="form-control" id="nombre" value="{{ $servidor->nombre }}"
                            name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Ip de Entrada:</label>
                        <input type="text" class="form-control" id="ipEntrada" value="{{ $servidor->ipEntrada }}"
                            name="ipEntrada" required>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Ip de Salida:</label>
                        <input type="text" class="form-control" id="ipSalida" value="{{ $servidor->ipSalida }}"
                            name="ipSalida" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>
