<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modalverservicioantena" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Información del Servicio de Antena</h5>
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
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Condicion de Antena:</label>
                            <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                disabled="{{ $isDisabled }}" value="{{ $condicionAntena }}" disabled>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">MAC:</label>
                            <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                disabled="{{ $isDisabled }}" value="{{ $mac }}" disabled>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">IP:</label>
                            <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                disabled="{{ $isDisabled }}" value="{{ $ip }}" disabled>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Frecuencia:</label>
                            <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                disabled="{{ $isDisabled }}" value="{{ $frecuencia }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Antena:</label>
                    <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                        disabled="{{ $isDisabled }}" value="{{ $antenaid }}" disabled>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Estado:</label>
                            <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                disabled="{{ $isDisabled }}" value="{{ $estado_id }}" disabled>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Plan asignado:</label>
                            <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                disabled="{{ $isDisabled }}" value="{{ $planid }}" disabled>
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