<a wire:click="activarmodalcrear" class="btn2 btn-green mx-2 py-2">
    <i class="fas fa-plus"></i>
</a>

<x-jet-dialog-modal wire:model='vermodalcrear'>
    <x-slot name="title">
        Crear nuevo Gpon
    </x-slot>
    <x-slot name="content">
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                DataCenter
            </label>
            <select class="border rounded-lg block mt-1 w-full px-6 border-secondary" wire:model="datacenterid"
                wire:change='generarolts'>
                <option value="">-Escoja una DataCenter-</option>
                @foreach ($totaldatacenters as $datacenter)
                <option value="{{ $datacenter->id }}">{{ $datacenter->nombre }}</option>
                @endforeach
            </select>
            @error('datacenterid')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        @if (is_numeric($datacenterid) && isset($datacenterselect))
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Olt
            </label>
            <select class="border rounded-lg block mt-1 w-full px-6 border-secondary" wire:model="oltid"
                wire:change='olttarjetarelacion'>
                <option value="">-Escoja una Olt-</option>
                @foreach ($datacenterselect->olts as $olt)
                <option value="{{ $olt->id }}">{{ $olt->nombre }}</option>
                @endforeach
            </select>
            @error('oltid')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        @endif

        @if ($olttarjetarelacionado && is_numeric($oltid))
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Tarjeta
            </label>
            <select class="border rounded-lg block mt-1 w-full px-6 border-secondary" wire:model="tarjetaid"
                wire:change='tarjetagponrelacion'>
                <option value="">-Escoja una Tarjeta-</option>
                @foreach ($olttarjetarelacionado->tarjetas as $tarjeta)
                <option value="{{ $tarjeta->id }}">{{ $tarjeta->nombre }}&nbsp,&nbsp
                    Slots:{{ $tarjeta->slots }}</option>
                @endforeach
            </select>
            @error('tarjetaid')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        @endif
        @if (is_numeric($tarjetaid) && is_numeric($oltid) && is_numeric($datacenterid) && $datacenterselect)
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Gpons registrados:
                @foreach ($tarjetagponrelacionado->gpons as $gponocupado)
                {{ $gponocupado->nombre }}
                @endforeach
            </label>
        </div>
        @endif
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Nombre
            </label>
            <x-jet-input type="text" class="block w-full px-6 border py-1 mt-1" placeholder="Ejm: Gpon 0"
                wire:model.defer="nombre" />
            @error('nombre')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Slots
            </label>
            <x-jet-input type="text" class="block w-full px-6 border py-1 mt-1" wire:model.defer="slots" placeholder="Ejm: 15" />
            @error('slots')
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
            {{ __('Cancelar') }}
        </x-jet-secondary-button>
        <x-jet-danger-button wire:click="save" wire:loading.attr="disabled">
            {{ __('Guardar Cambios') }}
        </x-jet-danger-button>
    </x-slot>
</x-jet-dialog-modal>