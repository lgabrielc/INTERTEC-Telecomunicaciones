<button type="button" class="btn btn-success rounded-pill" data-toggle="modal" data-target="#exampleModal">
    Crear Nuevo
</button>

<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear nuevo Servidor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Nombre</label>
                    <input type="text"
                        class="block text-sm py-3 px-4 rounded w-full border outline-none"
                        placeholder="Ejm: Servidor Arapa" wire:model.defer="nombre">
                    @error('nombre') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">IP Entrada</label>
                    <input type="text"
                        class="block text-sm py-3 px-4 rounded w-full border outline-none"
                        wire:model.defer="ipEntrada" placeholder="Ejm: 192.168.1.1">
                    @error('ipEntrada') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">IP Salida</label>
                    <input type="text"
                        class="block text-sm py-3 px-4 rounded w-full border outline-none"
                        wire:model.defer="ipSalida" placeholder="Ejm: 192.168.1.20">
                    @error('ipSalida') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Estado:</label>
                    <select class="block text-sm py-3 px-4 rounded w-full border outline-none"
                        wire:model="estado">
                        <option value="">-Seleccione el estado-</option>
                        @foreach ($totalestados as $estado)
                        @if ($estado->nombre == 'Activo')
                        <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                        @elseif ($estado->nombre != 'Activo')
                        <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                        @endif
                        @endforeach
                    </select>
                    @error('estado') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info close-btn rounded-pill" data-dismiss="modal">Cancelar</button>
                <button type="button" wire:click.prevent="save" wire:loading.attr="disabled" class="btn btn-danger close-modal rounded-pill">Guardar
                    Cambios</button>
            </div>
        </div>
    </div>
</div>
