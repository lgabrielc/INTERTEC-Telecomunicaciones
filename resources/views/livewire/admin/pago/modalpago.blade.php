<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modalpago" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Pago</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                @if ($this->servicio)
                <div class="form-group">
                    <label class="block text-blue-400 font-bold mb-1 md:mb-0 pr-4">Nombre del Cliente:</label>
                    <input type="text" class="block text-sm py-2 px-4 rounded w-full border outline-none"
                        value="{{$nombre ." ". $apellido}}" disabled>
                </div>


                {{-- <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Nombre del Cliente:</label>
                    <input type="text" class="block text-sm py-2 px-4 rounded w-full border outline-none"
                        value="{{ $nombre }}&nbsp;{{ $apellido }}" disabled>
                </div> --}}
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-blue-400 font-bold mb-1 md:mb-0 pr-4">Fecha de Pago</label>
                            <input type="date" class="block text-sm py-2 px-4 rounded w-full border outline-none"
                                value="{{ $this->servicio->fechavencimiento }}" disabled>
                        </div>
                    </div>
                    {{-- <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Fecha de Pago</label>
                            <input type="date" class="block text-sm py-2 px-4 rounded w-full border outline-none"
                                value="{{ $fechapago }}" disabled>
                        </div>
                    </div> --}}
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-blue-400 font-bold mb-1 md:mb-0 pr-4">Fecha de Corte
                                Ejecutado</label>
                            <input type="date" class="block text-sm py-2 px-4 rounded w-full border outline-none"
                                value="{{ $this->servicio->fechacorteejecutado }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-blue-400 font-bold mb-1 md:mb-0 pr-4">Fecha de Corte</label>
                            <input type="date" class="block text-sm py-2 px-4 rounded w-full border outline-none"
                                value="{{ $this->servicio->fechacorte }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-blue-400 font-bold mb-1 md:mb-0 pr-4">Estado</label>
                            <input type="text"
                                class="block text-sm bg-success  py-2 px-4 rounded w-full border outline-none"
                                value="{{ $this->servicio->estado->nombre }}" disabled>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-blue-400 font-bold mb-1 md:mb-0 pr-4">Deuda</label>
                            <input type="text" class="block text-sm py-2 px-4 rounded w-full border outline-none"
                                value="{{ $this->servicio->deuda }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-blue-400 font-bold mb-1 md:mb-0 pr-4">Mensualidad</label>
                            <input type="text" class="block text-sm py-2 px-4 rounded w-full border outline-none"
                                value="{{ $this->servicio->plan->precio }}" disabled>
                        </div>
                    </div>
                    {{-- <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Fecha de Pago
                                Deuda</label>
                            <input type="text" class="block text-sm py-2 px-4 rounded w-full border outline-none"
                                value="{{ $nombre }}&nbsp;{{ $apellido }}" disabled>
                        </div>
                    </div> --}}
                </div>


                {{-- --------------------------------------------------------------------------------------- --}}
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-blue-400 font-bold mb-1 md:mb-0 pr-4">Dias de Retraso</label>
                            <input type="text" class="block text-sm py-2 px-4 rounded w-full border outline-none"
                                value="{{ $diasretraso }}" disabled>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-blue-400 font-bold mb-1 md:mb-0 pr-4">Dias en Corte</label>
                            <input type="text" class="block text-sm py-2 px-4 rounded w-full border outline-none"
                                value="{{ $diasencorte }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-blue-400 font-bold mb-1 md:mb-0 pr-4">Proximo Pago</label>
                            <input type="date" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                wire:model="fechaproxpago" wire:change="actualizarfechas3($event.target.value)"
                                value="{{ date('Y-m-d') }}">
                            @error('fechainicio') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-blue-400 font-bold mb-1 md:mb-0 pr-4">Proximo Corte</label>
                            <input type="date" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                wire:model="fechaproxcorte" disabled>
                            @error('fechainicio') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="block text-blue-400 font-bold mb-1 md:mb-0 pr-4">Periodo de Pago</label>
                    <input disabled='false' type="text"
                        class="block text-sm py-3 px-4 rounded w-full border outline-none"
                        value="{{$fechaproxpago;}}   al   {{$fechaproxcorte}}" disabled>
                </div>
                @endif
            </div>
            <div class="modal-footer flex">
                <div class="text-left">
                    <button type="button" class="btn btn-info close-btn rounded-pill "
                        data-dismiss="modal">Cancelar</button>
                </div>
                <div class="text-right">
                    <button type="button" wire:click.prevent="savepago2" wire:loading.attr="disabled"
                        class="btn btn-danger close-modal rounded-pill">Guardar
                        Cambios</button>
                </div>
            </div>
        </div>
    </div>
</div>