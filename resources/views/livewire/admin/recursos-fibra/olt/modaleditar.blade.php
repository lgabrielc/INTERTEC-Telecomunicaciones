<x-jet-dialog-modal wire:model='vermodaleditar'>
    <x-slot name="title">
        Crearaa nuevo Servidor
    </x-slot>
    <x-slot name="content">
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                DataCenter
            </label>
            <select class="border rounded-lg block mt-1 w-full px-6 border-secondary" wire:model="datacenteride"
                wire:change='dataoltrelacionado'>
                @foreach ($totaldatacenters as $datacenter)
                <option value="{{ $datacenter->id }}">{{ $datacenter->nombre }}</option>
                @endforeach
            </select>
            @error('datacenteride')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        @if ($dataoltrelacionado)
         <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Olts registrados:
                @foreach ($dataoltrelacionado->olts as $oltocupado)
                    {{ $oltocupado->nombre }}
                @endforeach
            </label>
        </div>           
        @endif

        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Nombre
            </label>
            <x-jet-input type="text" class="block w-full px-6 border py-1 mt-1" placeholder="Ejm: Olt 2"
                wire:model.defer="nombre" />
            @error('nombre')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Slots
            </label>
            <x-jet-input type="text" class="block w-full px-6 border py-1 mt-1" wire:model.defer="slots"
                placeholder="Ejm: 7" />
            @error('slots')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Marca
            </label>
            <x-jet-input type="text" class="block w-full px-6 border py-1 mt-1" wire:model.defer="marca"
                placeholder="Ejm: Huawei" />
            @error('marca')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Modelo
            </label>
            <x-jet-input type="text" class="block w-full px-6 border py-1 mt-1" wire:model.defer="modelo"
                placeholder="Ejm: MA5800X7" />
            @error('modelo')
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
        <x-jet-secondary-button wire:click="$set('vermodaleditar',false)" wire:loading.attr="disabled"
            class="float-left">
            {{ __('Cancel') }}
        </x-jet-secondary-button>
        <x-jet-danger-button wire:click="update" wire:loading.attr="disabled">
            {{ __('Guardar Cambios') }}
        </x-jet-danger-button>
    </x-slot>
</x-jet-dialog-modal>