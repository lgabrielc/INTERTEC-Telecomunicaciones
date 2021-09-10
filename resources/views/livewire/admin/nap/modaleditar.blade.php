<div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Caja Nap</h5>
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
                {{-- OLT POR DEFECTO DEL ID SELECCIONADO --}}
                @if ($datacenterselect == null && isset($objprueba))
                <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Olt</label>
                    <select wire:model='oltide' class="block text-sm py-3 px-4 rounded w-full border outline-none">
                        <option value="{{ $oltide }}">{{ $oltnombre }}</option>
                    </select>
                    @error('oltide') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                @endif
                {{-- OLTS A ESCOJER SI SE DECIDE EDITAR --}}
                @if ($datacenterselect != null)
                <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Olt</label>
                    <select class="block text-sm py-3 px-4 rounded w-full border outline-none" wire:model="oltidnuevo">
                        <option value="">Escoja una Olt</option>
                        @foreach ($datacenterselect->olts as $oltt)
                        <option value="{{ $oltt->id }}">{{ $oltt->nombre }}</option>
                        @endforeach
                    </select>
                    @error('oltidnuevo') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                @endif
                {{-- TARJETA POR DEFECTO --}}
                @if ($datacenterselect == null && isset($objprueba))
                <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Tarjeta</label>
                    <select class="block text-sm py-3 px-4 rounded w-full border outline-none">
                        <option value="{{ $tarjetaide }}">{{ $tarjetanombre }}</option>
                    </select>
                    {{-- @error('oltid') <span class="text-danger error">{{ $message }}</span>@enderror --}}
                </div>
                @endif
                {{-- NUEVA TARJETA --}}
                @if (is_numeric($oltidnuevo))
                <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Tarjeta</label>
                    <select class="block text-sm py-3 px-4 rounded w-full border outline-none"
                        wire:model="tarjetaidnuevo" wire:change='tarjetagponrelacion'>
                        <option value="">-Escoja una Tarjeta-</option>
                        @foreach ($olttarjetarelacionado->tarjetas as $tarjeta)
                        <option value="{{ $tarjeta->id }}">{{ $tarjeta->nombre }}&nbsp,&nbsp
                            Slots:{{ $tarjeta->slots }}</option>
                        @endforeach
                    </select>
                    @error('tarjetaidnuevo') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                @endif
                {{-- GPON POR DEFECTO --}}
                @if ($datacenterselect == null && isset($objprueba))
                <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Gpon</label>
                    <select class="block text-sm py-3 px-4 rounded w-full border outline-none">
                        <option value="{{ $gponide }}">{{ $gponnombre }}</option>
                    </select>
                    {{-- @error('oltid') <span class="text-danger error">{{ $message }}</span>@enderror --}}
                </div>
                {{ $tarjetaid }}
                @endif
                {{-- Gpon a escojer si se quiere actualizar uno nuevo --}}
                @if (is_numeric($tarjetaidnuevo) && is_numeric($oltidnuevo))
                <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Gpon</label>
                    <select class="block text-sm py-3 px-4 rounded w-full border outline-none"
                        wire:model="gponidnuevo" wire:change='gponnaprelacion'>
                        <option value="">-Escoja un Gpon-</option>
                        @foreach ($tarjetagponrelacionado->gpons as $gpon)
                        <option value="{{ $gpon->id }}">{{ $gpon->nombre }}&nbsp,&nbsp
                            Slots:{{ $gpon->slots }}</option>
                        @endforeach
                    </select>
                    @error('gponidnuevo') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                @endif

                @if ($gponidnuevo && is_numeric($tarjetaidnuevo) && is_numeric($oltidnuevo))
                <div class="form-group">
                    <label class="block text-sm py-3 px-4 rounded w-full border outline-none">
                        Cajas Nap Registradas:
                        @foreach ($gponnaprelacionado->naps as $nap)
                        {{ $nap->nombre }};
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
            <button type="button" wire:click.prevent="update" class="btn btn-danger close-modal rounded-pill">Guardar
                Cambios
            </button>
        </div>
    </div>
</div>
</div>