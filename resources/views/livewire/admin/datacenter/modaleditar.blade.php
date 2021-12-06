{{-- <div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar DataCenter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" wire:model="user_id">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Nombre</label>
                    <input type="text" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                        wire:model.defer="nombre">
                    @error('nombre') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Ubicacion</label>
                    <input type="email" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                        wire:model.defer="ubicacion">
                    @error('ubicacion') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Direccion</label>
                    <input type="email" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                        wire:model.defer="direccion">
                    @error('direccion') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Encargado</label>
                    <input type="email" class="block text-sm py-3 px-4 rounded w-full border outline-none"
                        wire:model.defer="encargado">
                    @error('encargado') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">Estado</label>
                    <select class="block text-sm py-3 px-4 rounded w-full border outline-none" wire:model="estado_id">
                        @foreach ($totalestados as $estado)
                            @if ($estado->nombre == 'Activo' || $estado->nombre == 'Deshabilitado')
                                <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('estado_id') <span class="text-danger error">{{ $message }}</span>@enderror
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
</div> --}}

<x-jet-dialog-modal wire:model='vermodaleditar'>
    <x-slot name="title">
        Editar Datacenter
    </x-slot>
    <x-slot name="content">
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4" >
                Nombre
            </label>
            <x-jet-input type="text" class="block mt-1 w-full px-6"  wire:model.defer="nombre" />
            @error('nombre')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4" >
                Ubicacion
            </label>
            <x-jet-input type="text" class="block mt-1 w-full px-6"  wire:model.defer="ubicacion" />
            @error('ubicacion')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4" >
                Direccion
            </label>
            <x-jet-input type="text" class="block mt-1 w-full px-6"  wire:model.defer="direccion" />
            @error('direccion')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4" >
                Encargado
            </label>
            <x-jet-input type="text" class="block mt-1 w-full px-6"  wire:model.defer="encargado" />
            @error('encargado')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Estado
            </label>
            <select class="border rounded-lg block mt-1 w-full px-6 border-secondary" wire:model='estado' required>
                @foreach ($totalestados as $estados)
                <option value={{$estados->id}} selected >{{$estados->nombre}}</option>    
                @endforeach
            </select>
            @error('estado')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('vermodaleditar',false)" wire:loading.attr="disabled" class="float-left">
            {{ __('Cancel') }}
        </x-jet-secondary-button>
        <x-jet-danger-button wire:click="update" wire:loading.attr="disabled">
            {{ __('Guardar Cambios') }}
        </x-jet-danger-button>
    </x-slot>
</x-jet-dialog-modal>