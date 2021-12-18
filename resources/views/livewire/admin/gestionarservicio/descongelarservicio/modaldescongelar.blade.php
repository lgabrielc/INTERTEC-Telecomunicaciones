<x-jet-dialog-modal wire:model='vermodaldescongelar'>
    <x-slot name="title">
        Congelar Servicio
    </x-slot>
    <x-slot name="content">
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Cliente
            </label>
            <x-jet-input type="text" class="block mt-1 w-full px-6" value={{$nombrecompleto}} disabled />
            @error('nombre')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Fecha de Pago
            </label>
            <x-jet-input type="date" class="block mt-1 w-full px-6" wire:model.defer="fechavencimiento" disabled />
            @error('fechavencimiento')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Fecha de Corte
            </label>
            <x-jet-input type="date" class="block mt-1 w-full px-6" wire:model.defer="fechacorte" disabled />
            @error('fechacorte')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Estado
            </label>
            <x-jet-input type="text" class="block mt-1 w-full px-6" wire:model.defer="estado" disabled />
            @error('estado')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Mensualidad
            </label>
            <x-jet-input type="text" class="block mt-1 w-full px-6" wire:model.defer="mensualidad" disabled />
            @error('mensualidad')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Saldo en dias
            </label>
            <x-jet-input type="text" class="block mt-1 w-full px-6" wire:model.defer="saldoendias" disabled />
            @error('saldoendias')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Fecha de congelacion
            </label>
            <x-jet-input type="date" class="block mt-1 w-full px-6" wire:model.defer="fechacongelacion" />
            @error('fechacongelacion')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('vermodaldescongelar',false)" wire:loading.attr="disabled"
            class="float-left">
            {{ __('Cancel') }}
        </x-jet-secondary-button>
        <x-jet-danger-button wire:click="vermodaldescongelar" wire:loading.attr="disabled">
            {{ __('Guardar Cambios') }}
        </x-jet-danger-button>
    </x-slot>
</x-jet-dialog-modal>