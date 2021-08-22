<div class="text-right">
    <button type="button" class="btn btn-success rounded-pill text-right" data-toggle="modal"
        data-target="#modalcreartipoantena">
        Crear Nuevo
    </button>
</div>

<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modalcreartipoantena" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear Nuevo Tipo de Antena</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Nombre</label>
                    <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                        placeholder="Ejm: Base_Receptor" wire:model.defer="crearnuevotipoantena">
                    @error('crearnuevotipoantena') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="modal-footer flex">
                <div class="text-left">
                    <button type="button" class="btn btn-info close-btn rounded-pill "
                        data-dismiss="modal">Cancelar</button>
                </div>
                <div class="text-right">
                    <button type="button" wire:click.prevent="savetipoantena" wire:loading.attr="disabled"
                        class="btn btn-danger close-modal rounded-pill">Guardar
                        Cambios</button>
                </div>

            </div>
        </div>
    </div>
</div>
