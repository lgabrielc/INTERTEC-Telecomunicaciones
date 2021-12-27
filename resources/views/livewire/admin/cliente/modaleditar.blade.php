<x-jet-dialog-modal wire:model='vermodaleditarcliente'>
    <x-slot name="title">
        Editar Cliente
    </x-slot>
    <x-slot name="content">
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Nombre *
            </label>
            <x-jet-input type="text" class="block w-full px-6 border py-1 mt-1" 
                wire:model.defer="nombre" />
            @error('nombre')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Apellido *
            </label>
            <x-jet-input type="text" class="block w-full px-6 border py-1 mt-1"  wire:model.defer="apellido" />
            @error('apellido')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                DNI *
            </label>
            <x-jet-input type="text" class="block w-full px-6 border py-1 mt-1"  wire:model.defer="dni" />
            @error('dni')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Direccion *
            </label>
            <x-jet-input type="text" class="block w-full px-6 border py-1 mt-1"  wire:model.defer="direccion" />
            @error('direccion')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Telefono *
            </label>
            <x-jet-input type="text" class="block w-full px-6 border py-1 mt-1" wire:model.defer="telefono" />
            @error('telefono')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Correo (Opcional)
            </label>
            <x-jet-input type="text" class="block w-full px-6 border py-1 mt-1" wire:model.defer="correo" />
            @error('correo')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('vermodaleditarcliente',false)" wire:loading.attr="disabled"
            class="float-left">
            {{ __('Cancel') }}
        </x-jet-secondary-button>
        <x-jet-danger-button wire:click="update" wire:loading.attr="disabled">
            {{ __('Guardar Cambios') }}
        </x-jet-danger-button>
    </x-slot>
</x-jet-dialog-modal>