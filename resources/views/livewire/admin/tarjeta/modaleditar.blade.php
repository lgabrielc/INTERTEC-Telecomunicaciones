<div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Tarjeta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Datacenter</label>
                    <select class="block text-sm py-3 px-4 rounded w-full border outline-none"
                        wire:model="datacenteride" wire:change='generarolts'>
                        @foreach ($totaldatacenters as $datacenter)
                        <option value="{{ $datacenter->id }}">{{ $datacenter->nombre }}</option>
                        @endforeach
                    </select>
                    @error('datacenterid') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                {{-- POR DEFECTO --}}
                @if ($datacenterselect==null)
                <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Olt</label>
                    <select class="block text-sm py-3 px-4 rounded w-full border outline-none">
                        <option value="{{ $oltide }}">{{ $oltnombre }}</option>
                    </select>
                </div>
                @endif
                @if ($datacenterselect != null)
                <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Olt</label>
                    <select class="block text-sm py-3 px-4 rounded w-full border outline-none" wire:model="oltidnuevo" wire:change="olttarjetarelacion">
                        <option value="">Escoja una Olt</option>
                        @foreach ($datacenterselect->olts as $oltt)
                        <option value="{{ $oltt->id }}">{{ $oltt->nombre }}</option>
                        @endforeach
                    </select>
                    @error('oltidnuevo') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                @endif

                @if (is_numeric($oltidnuevo) && is_numeric($datacenteride))
                <div class="form-group">
                    <label class="block text-sm py-3 px-4 rounded w-full border outline-none">
                        Tarjetas Registradas:
                        @foreach ($olttarjetarelacionado->tarjetas as $tarjetaocupada)
                        {{ $tarjetaocupada->nombre }};
                        @endforeach
                    </label>
                </div>
                @endif

                <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Nombre</label>
                    <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                        wire:model.defer="nombre">
                    @error('nombre') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Slots</label>
                    <input type="email" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                        wire:model.defer="slots">
                    @error('slots') <span class="text-danger">{{ $message }}</span>@enderror
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