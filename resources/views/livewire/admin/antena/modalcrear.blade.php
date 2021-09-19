<button type="button" class="btn btn-success rounded-pill" data-toggle="modal" data-target="#exampleModal">
    Crear Nuevo
</button>

<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear nueva Antena</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Nombre:</label>
                    <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                        placeholder="Ejm: Arapa_Noveno_Eng" wire:model.defer="nombre">
                    @error('nombre') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">IP:</label>
                            <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                wire:model.defer="ip" placeholder="Ejm: 192.168.10.123">
                            @error('ip') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">MAC:</label>
                            <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                wire:model.defer="mac" placeholder="Ejm: 80:2A:A8:B8:38:BC">
                            @error('mac') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Frecuencia:</label>
                            <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                wire:model.defer="frecuencia" placeholder="Ejm: 5.8 GHZ">
                            @error('frecuencia') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Canal:</label>
                            <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                wire:model.defer="canal" placeholder="Ejm: 4920">
                            @error('canal') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Marca:</label>
                            <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                wire:model.defer="marca" placeholder="Ejm: Nanoloco M5">
                            @error('marca') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-lg-6">

                        <div class="form-group">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Torre:</label>
                            <select class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                wire:model.defer="torre">
                                <option value="">---Seleccione una opción---</option>
                                @foreach ($torres as $torre)
                                <option value="{{ $torre->id }}">{{ $torre->nombre }}</option>
                                @endforeach
                            </select>
                            @error('torre') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Servidor</label>
                            <select class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                wire:model.defer='servidor'>
                                <option value="">---Seleccione una opción---</option>
                                @foreach ($servidores as $servidor)
                                <option value="{{ $servidor->id }}">{{ $servidor->nombre }}</option>
                                @endforeach
                            </select>
                            @error('servidor') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-lg-6">

                        <div class="form-group">
                            <label class="block text-gray-500 font-bold  mb-1 md:mb-0 pr-4">Tipo de Antena:</label>
                            <select class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                wire:model.defer='tipoantena'>
                                <option value="">---Seleccione una opción---</option>
                                @foreach ($tipoantenas as $tipoantena)
                                <option value="{{ $tipoantena->id }}">{{ $tipoantena->nombre }}</option>
                                @endforeach
                            </select>
                            @error('tipoantena') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
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