<div class="">
    <a wire:click="activarmodaleditarplan" class="btn2 btn-blue mx-2 py-2">
        <i class="fas fa-edit"></i>
    </a>
</div>

<x-jet-dialog-modal wire:model='vermodaleditarplan'>
    <x-slot name="title">
        Editar Plan
    </x-slot>
    <x-slot name="content">
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Plan de Internet
            </label>
            <select class="border rounded-lg block mt-1 w-full px-6 border-secondary" wire:model='plan'
                wire:change="changeplanselect" required>
                <option value="" select>-Escoja una Plan de Internet-</option>
                @foreach ($totaldeplanes as $plan)
                <option value="{{ $plan->id }}">
                    {{ $plan->nombre }}&nbsp{{ $plan->descarga }}&nbsp&nbspS./{{$plan->precio}} </option>
                @endforeach
            </select>
            @error('plan')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Nombre *
            </label>
            <x-jet-input type="text" class="block mt-1 w-full px-6" placeholder="Ejm: Plan Premium" wire:model="nombre"
                disabled={{$disabled2}} />
            @error('nombre')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Velocidad de Descarga *
            </label>
            <x-jet-input type="text" class="block mt-1 w-full px-6" placeholder="Ejm: 10MB" wire:model="descarga"
                disabled={{$disabled2}} />
            @error('descarga')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Velocidad de Subida *
            </label>
            <x-jet-input type="text" class="block mt-1 w-full px-6" placeholder="Ejm: 10MB" wire:model="subida"
                disabled={{$disabled2}} />
            @error('subida')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Precio *
            </label>
            <x-jet-input type="text" class="block mt-1 w-full px-6" placeholder="Ejm: 60.00" wire:model="precio"
                disabled={{$disabled2}} />
            @error('precio')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        @if (isset($planid))
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Este plan esta en uso por {{$planusado}}&nbsppersonas:
            </label>
        </div>
        @endif

        @if ($planusado != 0)
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Estado
            </label>
            <select class="border rounded-lg block mt-1 w-full px-6 border-secondary" wire:model="estado"
              disabled>
                @foreach ($totalestados as $estados)
                <option value={{$estados->id}} selected >{{$estados->nombre}}</option>
                @endforeach
            </select>
            @error('estado')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        @else
        <div class="mb-4">
            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                Estado
            </label>
            <select class="border rounded-lg block mt-1 w-full px-6 border-secondary" wire:model="estado"
                {{$isDisabled}}>
                @foreach ($totalestados as $estados)
                <option value={{$estados->id}} selected >{{$estados->nombre}}</option>
                @endforeach
            </select>
            @error('estado')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        @endif

    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('vermodaleditarplan',false)" wire:loading.attr="disabled"
            class="float-left">
            {{ __('Cancel') }}
        </x-jet-secondary-button>
        <x-jet-danger-button wire:click="updateplan" wire:loading.attr="disabled">
            {{ __('Guardar Cambios') }}
        </x-jet-danger-button>
    </x-slot>
</x-jet-dialog-modal>