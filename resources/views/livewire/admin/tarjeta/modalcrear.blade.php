<button wire:click='resetcampos' type="button" class="btn btn-success rounded-pill" data-toggle="modal" data-target="#modalcrear">
    Crear Nuevo
</button>

<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modalcrear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear nueva Tarjeta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Nombre</label>
                    <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                        placeholder="Ejm: Tarjeta 2 Olt 1 Villa" wire:model.defer="nombre">
                    @error('nombre') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Slots</label>
                    <input type="numeric" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                        wire:model.defer="slots" placeholder="Ejm: 15">
                    @error('slots') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Olt</label>
                    <select class="block text-sm py-3 px-4 rounded w-full border outline-none"
                        wire:model.defer="oltid">
                        <option value="">-Escoja una DataCenter-</option>
                        @foreach ($totalolts as $olt)
                            <option value="{{ $olt->id }}">{{ $olt->nombre }}</option>
                        @endforeach
                    </select>
                    @error('oltid') <span class="text-danger error">{{ $message }}</span>@enderror
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
