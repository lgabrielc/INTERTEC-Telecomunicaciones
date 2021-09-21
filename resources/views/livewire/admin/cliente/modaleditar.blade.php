<div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="form-group">
                        <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Nombre * </label>
                        <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                             wire:model.defer="EditarNombre">
                        @error('EditarNombre') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Apellido * </label>
                        <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                            wire:model.defer="EditarApellido" >
                        @error('EditarApellido') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">DNI * </label>
                        <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                            wire:model.defer="EditarDNI" >
                        @error('EditarDNI') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Direccion * </label>
                        <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                            wire:model.defer="EditarDireccion">
                        @error('EditarDireccion') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Telefono * </label>
                        <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                            wire:model.defer="EditarTelefono">
                        @error('EditarTelefono') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Correo (Opcional)</label>
                        <input type="email" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                            wire:model.defer="EditarCorreo" placeholder="Ejm: CastielC@hotmail.com">
                        @error('EditarCorreo') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-modal rounded-pill"
                    data-dismiss="modal">Cancelar</button>
                <button type="button" wire:click.prevent="update"
                    class="btn btn-danger close-modal rounded-pill">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>
