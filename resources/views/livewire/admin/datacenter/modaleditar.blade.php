<div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar DataCenter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" wire:model="user_id">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Nombre</label>
                    <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                        wire:model.defer="nombre">
                    @error('nombre') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Ubicacion</label>
                    <input type="email" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                        wire:model.defer="ubicacion">
                    @error('ubicacion') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Direccion</label>
                    <input type="email" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                        wire:model.defer="direccion">
                    @error('direccion') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Encargado</label>
                    <input type="email" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                        wire:model.defer="encargado">
                    @error('encargado') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-modal rounded-pill"
                    data-dismiss="modal">Cancelar</button>
                <button type="button" wire:click.prevent="update"
                    class="btn btn-danger close-modal rounded-pill">Guardar Cambios
                </button>
            </div>
        </div>
    </div>
</div>
