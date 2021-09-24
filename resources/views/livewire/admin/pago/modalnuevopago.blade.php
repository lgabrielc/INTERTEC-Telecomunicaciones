<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modalnuevopago" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar primer Pago</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Nombre del Cliente:</label>
                    <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                        value="{{ $nombre }}&nbsp;{{ $apellido }}" disabled>
                </div>
                <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Fecha de Inicio:</label>
                    <input type="date" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                        wire:model="fechainicio" wire:change="actualizarfechas($event.target.value)"
                        value="{{ date('Y-m-d') }}">
                    @error('fechainicio') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Fecha de Vencimiento:</label>
                    <input type="date" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                        value="{{ date('Y-m-d', strtotime(date('Y-m-d') . '+ 1 month')) }}"
                        wire:model='fechavencimiento' wire:change='actualizarfechas2($event.target.value)'>
                    @error('fechavencimiento')
                    <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Fecha de Corte:</label>
                    <input type="date" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                        wire:model="fechacorte">
                    @error('fechacorte') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div x-data>
                    <div class="form-group" x-on:dblclick="$wire.doubleClick()">
                        <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Monto:</label>
                        <input disabled='false' type="text"
                            class="block text-sm py-3 px-4 rounded w-full border outline-none" value="{{$monto}}" disabled>
                    </div>
                </div>
            </div>
            <div class="modal-footer flex">
                <div class="text-left">
                    <button type="button" class="btn btn-info close-btn rounded-pill "
                        data-dismiss="modal">Cancelar</button>
                </div>
                <div class="text-right">
                    <button type="button" wire:click.prevent="savepago" wire:loading.attr="disabled"
                        class="btn btn-danger close-modal rounded-pill">Guardar
                        Cambios</button>
                </div>
            </div>
        </div>
    </div>
</div>