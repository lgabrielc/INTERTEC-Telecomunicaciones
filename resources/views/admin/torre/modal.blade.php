<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Agregar Nueva Torre</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <div class="modal-body">
            <form action={{ route('torre.store') }} method="POST">
                @csrf
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Nombre:</label>
                  <input type="text" class="form-control" name="nombreTorre" required>
                </div>
                <div class="form-group">
                  <label for="message-text" class="col-form-label">Direccion:</label>
                  <input type="text" class="form-control" name="direccion" required>
                </div>
                <div class="form-group">
                  <label for="message-text" class="col-form-label">Dueño del Local:</label>
                  <input type="text"class="form-control" name="dueñoLocal" required>
                </div>
                <div class="form-group">
                  <label for="message-text" class="col-form-label">Telefono:</label>
                  <input type="number" class="form-control" name="telefono" required>
                </div>
                <div class="form-group">
                  <label for="message-text" class="col-form-label">Pago:</label>
                  <input type="number" class="form-control" name="pago" required>
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