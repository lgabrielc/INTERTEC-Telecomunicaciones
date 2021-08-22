<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modalcrearservicio" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear Nuevo Servicio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Fecha de Inicio:</label>
                            <input type="date" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                wire:model="fechainicio">
                            @error('fechainicio') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Fecha de Vencimiento:</label>
                            <input type="date" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                wire:model="fechavencimiento">
                            @error('fechavencimiento') <span
                                class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Fecha de Corte:</label>
                            <input type="date" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                wire:model="fechacorte">
                            @error('fechacorte') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Condición de la
                                Antena:</label>
                            <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                wire:model.defer="EditarMac" placeholder="Ejm: Alquilada">
                            @error('EditarMac') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">MAC:</label>
                            <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                wire:model.defer="EditarIP" placeholder="Ejm: 80:2A:A8:B8:38:BC">
                            @error('EditarIP') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">IP:</label>
                            <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                wire:model.defer="EditarMac" placeholder="Ejm: 192.168.60.123">
                            @error('EditarMac') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Frecuencia:</label>
                            <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                wire:model.defer="EditarIP" placeholder="Ejm: 192.168.10.123">
                            @error('EditarIP') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Estado:</label>
                            <select class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                wire:model.defer="estado">
                                <option value="1">Activo</option>
                                @foreach ($totalestados as $estado)
                                    @if ($estado->nombre != 'Activo')
                                        <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('EditarMac') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Cliente:</label>
                            <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                wire:model.defer="EditarIP" placeholder="Ejm: 192.168.10.123">
                            @error('EditarIP') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Antena:</label>
                            <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                wire:model.defer="EditarMac" placeholder="Ejm: 80:2A:A8:B8:38:BC">
                            @error('EditarMac') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
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
