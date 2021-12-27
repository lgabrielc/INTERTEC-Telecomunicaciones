<div class="">
    <a wire:click="activarmodalcrearplan" class="bg-gradient-to-r from-green-200 via-green-400 to-green-500 btn2 btn-green mx-2 py-2">
        <i class="fas fa-plus"></i>
    </a>
</div>

<x-jet-dialog-modal wire:model='vermodalcrearplan'>
    <x-slot name="title">
        Agregar nuevo Plan
    </x-slot>
    <x-slot name="content">
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Nombre del Plan*
            </label>
            <x-jet-input type="text" class="block w-full px-6 border py-1" placeholder="Ejm: Plan Básico"
                wire:model.defer="nombre" />
            @error('nombre')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Velocidad de Descarga *
            </label>
            <x-jet-input type="text" class="block w-full px-6 border py-1" placeholder="Ejm: 10MB"
                wire:model.defer="descarga" />
            @error('descarga')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Velocidad de Subida *
            </label>
            <x-jet-input type="text" class="block w-full px-6 border py-1" placeholder="Ejm: 10MB" 
            wire:model.defer="subida"  />
            @error('subida')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Precio *
            </label>
            <x-jet-input type="text" class="block w-full px-6 border py-1" placeholder="Ejm: 60.00"
                wire:model.defer="precio" />
            @error('precio')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('vermodalcrearplan',false)" wire:loading.attr="disabled"
            class="float-left">
            {{ __('Cancel') }}
        </x-jet-secondary-button>
        <x-jet-danger-button wire:click="saveplan" wire:loading.attr="disabled">
            {{ __('Guardar Cambios') }}
        </x-jet-danger-button>
    </x-slot>
</x-jet-dialog-modal>