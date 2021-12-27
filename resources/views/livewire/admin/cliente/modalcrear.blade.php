<a wire:click="activarmodalcrearcliente" class="bg-gradient-to-r from-green-200 via-green-400 to-green-500 btn2 btn-green mx-2 py-2">
    <i class="fas fa-plus"></i>
</a>

<x-jet-dialog-modal wire:model='vermodalcrearcliente'>
    <x-slot name="title">
        Agregar nuevo Cliente
    </x-slot>
    <x-slot name="content">
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Nombre *
            </label>
            <x-jet-input type="text" class="block w-full px-6 border py-1" placeholder="Ejm: Castiel Luis"
                wire:model.defer="nombre" />
            @error('nombre')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Apellido *
            </label>
            <x-jet-input type="text" class="block w-full px-6 border py-1" placeholder="Ejm: Torres Castro" wire:model.defer="apellido" />
            @error('apellido')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                DNI *
            </label>
            <x-jet-input type="text" class="block w-full px-6 border py-1" placeholder="Ejm: 1597532" wire:model.defer="dni" />
            @error('dni')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Direccion *
            </label>
            <x-jet-input type="text" class="block w-full px-6 border py-1" placeholder="Ejm: Noveno Gr.1 Lt.10" wire:model.defer="direccion" />
            @error('direccion')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Telefono *
            </label>
            <x-jet-input type="text" class="block w-full px-6 border py-1" placeholder="Ejm: 985652369" wire:model.defer="telefono" />
            @error('telefono')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Correo (Opcional)
            </label>
            <x-jet-input type="text" class="block w-full px-6 border py-1" placeholder="Ejm: CastielC@hotmail.com" wire:model.defer="correo" />
            @error('correo')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('vermodalcrearcliente',false)" wire:loading.attr="disabled"
            class="float-left">
            {{ __('Cancel') }}
        </x-jet-secondary-button>
        <x-jet-danger-button wire:click="save" wire:loading.attr="disabled">
            {{ __('Guardar Cambios') }}
        </x-jet-danger-button>
    </x-slot>
</x-jet-dialog-modal>