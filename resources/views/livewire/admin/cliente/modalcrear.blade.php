<button type="button" class="btn btn-success rounded-pill" data-toggle="modal" data-target="#exampleModal">
    Crear Nuevo
</button>

<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear nuevo Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Nombre * </label>
                    <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                        placeholder="Ejm: Castiel Luis" wire:model.defer="nombre">
                    @error('nombre') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Apellido * </label>
                    <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                        wire:model.defer="apellido" placeholder="Ejm: Torres Castro">
                    @error('apellido') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">DNI * </label>
                    <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                        wire:model.defer="dni" placeholder="Ejm: 1597532">
                    @error('dni') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Direccion * </label>
                    <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                        wire:model.defer="direccion" placeholder="Ejm: Noveno Gr.1 Lt.10">
                    @error('direccion') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Telefono * </label>
                    <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                        wire:model.defer="telefono" placeholder="Ejm: 985652369">
                    @error('telefono') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Correo (Opcional)</label>
                    <input type="email" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                        wire:model.defer="correo" placeholder="Ejm: CastielC@hotmail.com">
                    @error('correo') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info close-btn rounded-pill" data-dismiss="modal">Cancelar</button>
                <button type="button" wire:click.prevent="save" wire:loading.attr="disabled"
                    class="btn btn-danger close-modal rounded-pill">Guardar
                    Cambios</button>
            </div>
        </div>
    </div>
</div>
