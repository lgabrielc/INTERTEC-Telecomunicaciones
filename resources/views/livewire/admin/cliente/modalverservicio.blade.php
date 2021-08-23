<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modalverservicio" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Información del Servicio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Nombre del Cliente:</label>
                    <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                        disabled="{{ $isDisabled }}"
                        value="{{ $NombreClienteServicio }}&nbsp;{{ $ApellidoClienteServicio }}" disabled>
                    @error('EditarNombre') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Fecha de Inicio:</label>
                            <input type="date" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                wire:model.defer="fechaInicioV" value="{{$fechaInicioV}}">
                            @error('fechaInicioV') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Fecha de Vencimiento:</label>
                            <input type="date" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                wire:model.defer='fechaVencimientoV'>
                            @error('fechaVencimientoV')
                            <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Fecha de Corte:</label>
                            <input type="date" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                wire:model.defer="fechaCorteV">
                            @error('fechaCorteV') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                @if ($tiposervicio == 'Antena')
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Condición de la
                                    Antena:</label>
                                <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                    wire:model.defer="condicionantena" placeholder="Ejm: Alquilada">
                                @error('condicionantena') <span
                                    class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="">
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
                                <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">IP:</label>
                                <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                    wire:model.defer="ip" placeholder="Ejm: 192.168.60.123">
                                @error('ip') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="">
                                <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Frecuencia:</label>
                                <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                    wire:model.defer="frecuencia" placeholder="Ejm: 5.8 GHZ">
                                @error('frecuencia') <span
                                    class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Antena:</label>
                                <select class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                    wire:model.defer="antenarelacionada">
                                    <option value="">-Escoja una Antena-</option>
                                    @foreach ($totalantenas as $antena)
                                        <option value="{{ $antena->id }}">{{ $antena->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('antenarelacionada') <span
                                    class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                @elseif ($tiposervicio == 'Fibra')
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">GPON:</label>
                                <select class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                    wire:model.defer="gponrelacionado">
                                    <option value="1">-Seleccione GPON</option>
                                    <option value="1">-GPON 1</option>
                                    <option value="1">-GPON 2</option>
                                    <option value="1">-GPON 2</option>
                                </select>
                                @error('gponrelacionado') <span
                                    class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="">
                                <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Cliente de GPON
                                    n°:</label>
                                <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                    wire:model.defer="clientegpon" placeholder="Ejm: 192.168.10.123">
                                @error('clientegpon') <span
                                    class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                @endif
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
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Plan nuevo:</label>
                            <select name="" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                wire:model.defer='plannuevo'>
                                <option value="">--Escoja un plan--</option>
                                @foreach ($totalplanes as $plan)
                                    <option value="{{ $plan->id }}">{{ $plan->nombre }}</option>
                                @endforeach
                            </select>
                            @error('plannuevo') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info close-btn rounded-pill" data-dismiss="modal">Cancelar</button>
                @if ($tiposervicio == 'Antena')
                    <button type="button" wire:click.prevent="saveservicioantena" wire:loading.attr="disabled"
                        class="btn btn-danger close-modal rounded-pill">Guardar
                        Cambios</button>
                @elseif ($tiposervicio == 'Fibra')
                    <button type="button" wire:click.prevent="saveserviciofibra" wire:loading.attr="disabled"
                        class="btn btn-danger close-modal rounded-pill">Guardar
                        Cambios</button>
                @endif

            </div>
        </div>
    </div>
</div>
