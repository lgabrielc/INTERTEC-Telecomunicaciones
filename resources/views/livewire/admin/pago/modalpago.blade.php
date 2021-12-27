<x-jet-dialog-modal wire:model='vermodalpago'>
    <x-slot name="title">
        Registrar Pago
    </x-slot>
    <x-slot name="content">
        <div class="flex flex-col w-full md:flex-row">
            <div class="w-full p-2 ">
                <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                    Cliente
                </label>
                <x-jet-input type="text" class="block w-full px-6 border py-1 py-1" value="{{$nombrecompleto}}" disabled />
            </div>
        </div>
        <div class="flex flex-col w-full md:flex-row">
            <div class="w-full p-2 ">
                <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                    Fecha de Pago
                </label>
                <x-jet-input type="date" class="block w-full px-6 border py-1" value="{{$fechapago}}" disabled />
            </div>
            <div class="w-full p-2 ">
                <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                    Fecha de Corte Ejecutado
                </label>
                <x-jet-input type="text" class="block w-full px-6 border py-1" value="{{$fechacorteejecutado}}" disabled />
            </div>
        </div>
        <div class="flex flex-col w-full md:flex-row">
            <div class="w-full p-2 ">
                <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                    Fecha de Corte
                </label>
                <x-jet-input type="date" class="block w-full px-6 border py-1" value="{{$fechacorte}}" disabled />

            </div>

            <div class="w-full p-2 ">
                <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                    Deuda
                </label>
                <x-jet-input type="text" class="block w-full px-6 border py-1" value="{{$deuda}}" disabled />
            </div>
        </div>
        <div class="flex flex-col w-full md:flex-row">
            <div class="w-full p-2 ">
                <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                    Estado
                </label>
                @if ($estado == 'Activo')
                <x-jet-input type="text" class="bg-gradient-to-tr from-green-300 to-green-600 block w-full px-6 border py-1 py-1 "
                    value="{{$estado}}" disabled />
                @elseif ($estado == 'Corte Sin Ejecutar')
                <x-jet-input type="text" class="bg-gradient-to-r from-yellow-400 to-yellow-700 block w-full px-6 py-1"
                    value="{{$estado}}" disabled />
                @elseif ($estado == 'Deuda Vencida')
                <x-jet-input type="text" class="bg-gradient-to-r from-yellow-200 to-yellow-300 block w-full px-6 py-1"
                    value="{{$estado}}" disabled />
                @elseif ($estado == 'Corte Ejecutado')
                <x-jet-input type="text" class="bg-gradient-to-r from-red-300 to-red-700 block w-full px-6 py-1"
                    value="{{$estado}}" disabled />
                @elseif ($estado == 'Retiro de Equipos')
                <x-jet-input type="text" class="bg-gradient-to-r from-red-300 to-red-700 block w-full px-6 py-1"
                    value="{{$estado}}" disabled />
                @endif
            </div>

            <div class="w-full p-2 ">
                <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                    Mensualidad
                </label>
                <x-jet-input type="text" class="block w-full px-6 border py-1" value="{{$mensualidad}}" disabled />
            </div>
        </div>

        <div class="flex flex-col w-full md:flex-row">
            <div class="w-full p-2 ">
                <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                    N° Dias de Retraso
                </label>
                <x-jet-input type="text" class="block w-full px-6 border py-1" value="{{$diasretraso}}" disabled />
            </div>
            <div class="w-full p-2 ">
                <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                    N° Dias en Corte
                </label>
                <x-jet-input type="text" class="block w-full px-6 border py-1" value="{{$diascorteejecutado}}" disabled />
            </div>
        </div>
        <div class="flex flex-col w-full md:flex-row">
            <div class="w-full p-2 ">
                <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                    Próxima fecha de Pago
                </label>
                <x-jet-input type="date" class="block w-full px-6 border py-1" wire:model="proximafechadepago"
                    wire:change="changedata" />
                @error('proximafechadepago')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="w-full p-2 ">
                <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                    Próxima fecha de Corte
                </label>
                <x-jet-input type="date" class="block w-full px-6 border py-1" wire:model="proximafechadecorte" />
                @error('proximafechadecorte')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="flex flex-col w-full md:flex-row">
            <div class="w-full p-1 ">
                <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                    Periodo
                </label>
                <x-jet-input type="text" class="block w-full px-6 border py-1" wire:model="periodo" disabled />
                @error('periodo')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="w-full p-2 ">
                <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                    Total
                </label>
                <x-jet-input type="text" class="block w-full px-6 border py-1 rounded-full" wire:model="monto" disabled />
                @error('monto')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('vermodalpago',false)" wire:loading.attr="disabled">
            {{ __('Cancelar') }}
        </x-jet-secondary-button>
        <x-jet-danger-button wire:click="savepago" wire:loading.attr="disabled">
            {{ __('Guardar Cambios') }}
        </x-jet-danger-button>
    </x-slot>
</x-jet-dialog-modal>