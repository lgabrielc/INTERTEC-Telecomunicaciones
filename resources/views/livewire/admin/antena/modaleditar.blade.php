<div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Torre</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Nombre:</label>
                    <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                        placeholder="Ejm: Arapa_Noveno_Eng" wire:model.defer="EditarNombre">
                    @error('EditarNombre') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">IP:</label>
                            <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                wire:model.defer="EditarIP" placeholder="Ejm: 192.168.10.123">
                            @error('EditarIP') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">MAC:</label>
                            <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                wire:model.defer="EditarMac" placeholder="Ejm: 80:2A:A8:B8:38:BC">
                            @error('EditarMac') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Frecuencia:</label>
                            <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                wire:model.defer="EditarFrecuencia" placeholder="Ejm: 5.8 GHZ">
                            @error('EditarFrecuencia') <span
                                class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Canal:</label>
                            <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                wire:model.defer="EditarCanal" placeholder="Ejm: 4920">
                            @error('EditarCanal') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Marca:</label>
                            <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                wire:model.defer="EditarMarca" placeholder="Ejm: Nanoloco M5">
                            @error('EditarMarca') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-lg-6">

                        <div class="form-group">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Torre:</label>
                            <select class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                wire:model.defer="EditarTorreID">
                                {{-- <option value={{ $EditarTorreID }}>{{ $EditarTorre }}&nbsp:&nbspActual</option> --}}
                                @foreach ($torres as $torre)
                                    <option value={{ $torre->id }}>{{ $torre->nombre }}</option>
                                @endforeach
                            </select>
                            @error('EditarTorre') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Servidor</label>
                            <select class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                wire:model.defer='EditarServidorID'>
                                {{-- <option value={{ $EditarServidorID }}>{{ $EditarServidor }}&nbsp:&nbspActual --}}
                                </option>
                                @foreach ($servidores as $servidor)
                                    <option value={{ $servidor->id }}>{{ $servidor->nombre }}</option>
                                @endforeach
                            </select>
                            @error('EditarServidor') <span
                                class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="block text-gray-500 font-bold  mb-1 md:mb-0 pr-4">Tipo de Antena:</label>
                            <select class="block text-sm py-3 px-4 rounded w-full border outline-none"
                                wire:model.defer='EditarTipoAntenaID'>
                                {{-- <option value={{ $EditarTipoAntenaID }}>{{ $EditarTipoAntena }}&nbsp:&nbspActual --}}
                                </option>
                                @foreach ($tipoantenas as $tipoantena)
                                    <option value={{ $tipoantena->id }}>{{ $tipoantena->nombre }}</option>
                                @endforeach
                            </select>
                            @error('EditarTipoAntena') <span
                                class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-modal rounded-pill"
                    data-dismiss="modal">Cancelar</button>
                <button type="button" wire:click.prevent="update"
                    class="btn btn-danger close-modal rounded-pill">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>
