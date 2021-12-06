<x-jet-dialog-modal wire:model='vermodalantena'>
    <x-slot name="title">
        Servicio del Cliente
        <input type="checkbox" wire:click="disablear" wire:model='checkbx' class="form-checkbox rounded" />
    </x-slot>
    <x-slot name="content">
        <div class="flex flex-col w-full md:flex-row">
            <div class="w-full p-2 ">
                <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                    Nombre
                </label>
                <x-jet-input type="text" class="block w-full px-6" wire:model.defer="nombre" disabled />
            </div>
            <div class="w-full p-2 ">
                <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                    Apellidos
                </label>
                <x-jet-input type="text" class="block w-full px-6" wire:model.defer="apellido" disabled />
            </div>
        </div>
        <div class="flex flex-col w-full md:flex-row">
            <div class="w-full p-2 ">
                <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                    Tipo de Servicio
                </label>
                <x-jet-input type="text" class="block w-full px-6" wire:model.defer="tiposervicio" disabled />
            </div>
            <div class="w-full p-2 ">
                <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                    Condicion Antena
                </label>
                <select class="border rounded-lg block mt-1 w-full px-6 border-secondary" wire:model="condicionantena"
                    {{$isDisabled}}>
                    <option value="Propia">Propia</option>
                    <option value="Alquilada">Alquilada</option>
                </select>
                @error('condicionantena')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="flex flex-col w-full md:flex-row">
            <div class="w-full p-2 ">
                <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                    Mac
                </label>
                <x-jet-input type="text" class="block w-full px-6" wire:model.defer="mac" disabled={{$disabled2}} />
                @error('mac')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="w-full p-2 ">
                <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                    IP
                </label>
                <x-jet-input type="text" class="block w-full px-6" wire:model.defer="ip" disabled={{$disabled2}} />
                @error('ip')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="flex flex-col w-full md:flex-row">
            <div class="w-full p-2 ">
                <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                    Frecuencia
                </label>
                <x-jet-input type="text" class="block w-full px-6" wire:model="frecuencia" disabled={{$disabled2}} />
                @error('frecuencia')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="w-full p-2 ">
                <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                    Antena
                </label>
                <select class="border rounded-lg block mt-1 w-full px-6 border-secondary" wire:model.defer="antena"
                    {{$isDisabled}}>
                    @foreach ($totalantenas as $antena)
                    <option value="{{ $antena->id }}" selected>{{ $antena->nombre }}</option>
                    @endforeach
                </select>
                @error('antena')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="flex flex-col w-full md:flex-row">
            <div class="w-full p-2 ">
                <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                    Plan
                </label>
                <select class="border rounded-lg block mt-1 w-full px-6 border-secondary" wire:model.defer="plan"
                    {{$isDisabled}}>
                    @foreach ($totalplanes as $plan)
                    <option value="{{ $plan->id }}">
                        {{ $plan->nombre }}&nbsp{{ $plan->descarga }} </option>
                    @endforeach
                </select>
            </div>
            <div class="w-full p-2 ">
                <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                    Estado
                </label>
                <select class="border rounded-lg block mt-1 w-full px-6 border-secondary" wire:model.defer="estado"
                    {{$isDisabled}}>
                    @foreach ($totalestados as $estados)
                    <option value={{$estados->id}} selected >{{$estados->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('vermodalantena',false)" wire:loading.attr="disabled"
            class="float-left">
            {{ __('Volver Atras') }}
        </x-jet-secondary-button>
        <x-jet-danger-button wire:click="updateservicioantena" wire:loading.attr="disabled">
            {{ __('Guardar Cambios') }}
        </x-jet-danger-button>
    </x-slot>
</x-jet-dialog-modal>