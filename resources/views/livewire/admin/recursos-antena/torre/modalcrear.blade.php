<a wire:click="activarmodalcrear" class="btn2 btn-green mx-2 py-2">
    <i class="fas fa-plus"></i>
</a>

<x-jet-dialog-modal wire:model='vermodalcrear'>
    <x-slot name="title">
        Crear nueva Torre
    </x-slot>
    <x-slot name="content">
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Nombre
            </label>
            <x-jet-input type="text" class="block w-full px-6 border py-1 mt-1" placeholder="Ejm: Torre Oasis"
                wire:model.defer="nombre" />
            @error('nombre')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Dueño
            </label>
            <x-jet-input type="text" class="block w-full px-6 border py-1 mt-1" wire:model.defer="dueño"
                placeholder="Ejm: Sr. Gomez Castro" />
            @error('dueño')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Direccion
            </label>
            <x-jet-input type="text" class="block w-full px-6 border py-1 mt-1" wire:model.defer="direccion"
                placeholder="Ejm: Calle Oasis ST.10, GR.4, MZ.P, LT 4" />
            @error('direccion')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Telefono fijo o Celular
            </label>
            <x-jet-input type="text" class="block w-full px-6 border py-1 mt-1" wire:model.defer="telefono"
                placeholder="Ejm: 990054887" />
            @error('telefono')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Mensualidad
            </label>
            <x-jet-input type="text" class="block w-full px-6 border py-1 mt-1" wire:model.defer="mensualidad"
                placeholder="Ejm: 50.0" />
            @error('mensualidad')
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
        <x-jet-secondary-button wire:click="$set('vermodalcrear',false)" wire:loading.attr="disabled"
            class="float-left">
            {{ __('Cancel') }}
        </x-jet-secondary-button>
        <x-jet-danger-button wire:click="save" wire:loading.attr="disabled">
            {{ __('Guardar Cambios') }}
        </x-jet-danger-button>
    </x-slot>
</x-jet-dialog-modal>