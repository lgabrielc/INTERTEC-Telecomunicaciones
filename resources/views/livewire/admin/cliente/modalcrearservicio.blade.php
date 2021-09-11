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
                <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Nombre del Cliente:</label>
                    <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                        disabled="{{ $isDisabled }}"
                        value="{{ $NombreClienteServicio }}&nbsp;{{ $ApellidoClienteServicio }}" disabled>
                    @error('EditarNombre') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Tipo de Servicio:</label>
                            <select name="" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                wire:model='tiposervicio' wire:change="resetearcampos($event.target.value)">
                                <option value="">-Escoja el Tipo de Servicio-</option>
                                <option value="Antena">Antena</option>
                                <option value="Fibra">Fibra Optica</option>
                            </select>
                            @error('EditarMac') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    @if ($tiposervicio == 'Fibra')
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">DataCenter</label>
                            <select class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                wire:model="datacenterid" wire:change='generarolts'>
                                <option value="">-Escoja una DataCenter-</option>
                                @foreach ($totaldatacenters as $datacenter)
                                <option value="{{ $datacenter->id }}">{{ $datacenter->nombre }}</option>
                                @endforeach
                            </select>
                            @error('datacenterid') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    @endif
                </div>
                <div class="row">
                    @if (is_numeric($datacenterid))
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Olt</label>
                            <select class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                wire:model="oltid" wire:change="olttarjetarelacion">
                                <option value="">-Escoja una Olt-</option>
                                @foreach ($datacenterselect->olts as $olt)
                                <option value="{{ $olt->id }}">{{ $olt->nombre }}</option>
                                @endforeach
                            </select>
                            @error('oltid') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    @endif
                    @if (is_numeric($oltid) && is_numeric($datacenterid))
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Tarjeta</label>
                            <select class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                wire:model="tarjetaid" wire:change='tarjetagponrelacion'>
                                <option value="">-Escoja una Tarjeta-</option>
                                @foreach ($olttarjetarelacionado->tarjetas as $tarjeta)
                                <option value="{{ $tarjeta->id }}">{{ $tarjeta->nombre }}&nbsp,&nbsp
                                    Slots:{{ $tarjeta->slots }}</option>
                                @endforeach
                            </select>
                            @error('tarjetaid') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    @endif  
                </div>
                <div class="row">
                    @if (is_numeric($tarjetaid) && is_numeric($oltid) && is_numeric($datacenterid))
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Gpon</label>
                            <select class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                wire:model="gponid" wire:change='gponnaprelacion'>
                                <option value="">-Escoja un Gpon-</option>
                                @foreach ($tarjetagponrelacionado->gpons as $gpon)
                                <option value="{{ $gpon->id }}">{{ $gpon->nombre }}&nbsp,&nbsp
                                    Slots:{{ $gpon->slots }}</option>
                                @endforeach
                            </select>
                            @error('gponid') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    @endif
                    @if (is_numeric($tarjetaid) && is_numeric($oltid) && is_numeric($datacenterid) &&
                    is_numeric($gponid))
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Caja Nap</label>
                            <select class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                wire:model="napid">
                                <option value="">-Escoja un Gpon-</option>
                                @foreach ($gponnaprelacionado->naps as $nap)
                                <option value="{{ $nap->id }}">{{ $nap->nombre }}&nbsp,&nbsp
                                    Slots:{{ $nap->slots }}</option>
                                @endforeach
                            </select>
                            @error('gponid') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    @endif
                </div>
                @if ($tiposervicio == 'Antena')
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Condición de la
                                Antena:</label>
                            <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                wire:model.defer="condicionantena" placeholder="Ejm: Alquilada">
                            @error('condicionantena') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="">
                            <label class=" block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                                MAC:</label>
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
                            <label class=" block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                                Frecuencia:</label>
                            <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                wire:model.defer="frecuencia" placeholder="Ejm: 5.8 GHZ">
                            @error('frecuencia') <span class="text-danger error">{{ $message }}</span>@enderror
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
                            @error('antenarelacionada') <span class="text-danger error">{{ $message }}</span>@enderror
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
                                <option value="{{ $plan->id }}">
                                    {{ $plan->nombre }}&nbsp{{ $plan->descarga }} </option>
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