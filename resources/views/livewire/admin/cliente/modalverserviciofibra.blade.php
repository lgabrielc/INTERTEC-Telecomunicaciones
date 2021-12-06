<x-jet-dialog-modal wire:model='vermodalfibra'>
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
                <x-jet-input type="text" class="block w-full px-6" value="{{$nombre}} {{$apellido}}" disabled />
            </div>
            <div class="w-full p-2 ">
                <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                    Tipo de Servicio
                </label>
                <x-jet-input type="text" class="block w-full px-6" value="{{$tiposervicio}}" disabled />
                @error('tiposervicio')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

        </div>
        <div class="flex flex-col w-full md:flex-row">
            <div class="w-full p-2 ">
                <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                    DataCenter
                </label>
                <select class="border rounded-lg block mt-1 w-full px-6 border-secondary" wire:model="datacenterid"
                    wire:change='generarolts' {{$isDisabled}}>
                    @foreach ($totaldatacenters as $datacenter)
                    <option value="{{ $datacenter->id }}">{{ $datacenter->nombre }}</option>
                    @endforeach
                </select>
                @error('datacenterid')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="w-full p-2 ">
                <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                    Olt
                </label>
                @if (!$datacenterselect)
                <x-jet-input type="text" class="block w-full px-6" value="{{$oltnombre}}" disabled />
                @else
                <select class="border rounded-lg block mt-1 w-full px-6 border-secondary" wire:model="oltid"
                    wire:change="olttarjetarelacion" {{$isDisabled}}>
                    <option value="" selected>-Escoja una Olt-</option>
                    @foreach ($datacenterselect->olts as $olt)
                    <option value="{{ $olt->id }}">{{ $olt->nombre }}</option>
                    @endforeach
                </select>
                @error('oltid')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
                @endif
            </div>


        </div>
        <div class="flex flex-col w-full md:flex-row">
            <div class="w-full p-2 ">
                <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                    Tarjeta
                </label>
                @if (!$olttarjetarelacionado)
                <x-jet-input type="text" class="block w-full px-6" value="{{$tarjetanombre}}" disabled />
                @else
                <select class="border rounded-lg block mt-1 w-full px-6 border-secondary" wire:model="tarjetaid"
                    wire:change='tarjetagponrelacion' {{$isDisabled}}>
                    <option value="" selected>-Escoja una Tarjeta-</option>
                    @foreach ($olttarjetarelacionado->tarjetas as $tarjeta)
                    <option value="{{ $tarjeta->id }}">{{ $tarjeta->nombre }}&nbsp,&nbsp
                        Slots:{{ $tarjeta->slots }}</option>
                    @endforeach
                </select>
                @error('tarjetaid')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
                @endif
            </div>
            <div class="w-full p-2 ">
                <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                    Gpon
                </label>
                @if (!$tarjetagponrelacionado)
                <x-jet-input type="text" class="block w-full px-6" value="{{$gponnombre}}" disabled />
                @else
                <select class="border rounded-lg block mt-1 w-full px-6 border-secondary" wire:model="gponid"
                    wire:change='gponnaprelacion' {{$isDisabled}}>
                    <option value="" selected>-Escoja un Gpon-</option>

                    @foreach ($tarjetagponrelacionado->gpons as $gpon)
                    <option value="{{ $gpon->id }}">{{ $gpon->nombre }}&nbsp,&nbsp
                        Slots:{{ $gpon->slots }}</option>
                    @endforeach
                </select>
                @error('gponid')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
                @endif
            </div>


        </div>
        <div class="flex flex-col w-full md:flex-row">
            <div class="w-full p-2 ">
                <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                    Nap
                </label>
                @if (!$gponnaprelacionado)
                <x-jet-input type="text" class="block w-full px-6" value="{{$napnombre}}" disabled />
                @else
                <select class="border rounded-lg block mt-1 w-full px-6 border-secondary" wire:model="napid"
                    {{$isDisabled}}>
                    <option value="" selected>-Escoja una Caja Nap-</option>
                    @foreach ($gponnaprelacionado->naps as $nap)
                    <option value="{{ $nap->id }}">{{ $nap->nombre }}&nbsp,&nbsp
                        Slots:{{ $nap->slots }}</option>
                    @endforeach
                </select>
                @error('napid')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
                @endif
            </div>
            <div class="w-full p-2 ">
                <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                    Numero del Cliente
                </label>
                <x-jet-input type="text" class="block w-full px-6" placeholder="Ejm: 1001"
                    wire:model.defer='clientegpon' disabled={{$disabled2}} />
                @error('clientegpon')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="flex flex-col w-full md:flex-row">
            <div class="w-full p-2 ">
                <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                    Plan
                </label>
                <select class="border rounded-lg block mt-1 w-full px-6 border-secondary" wire:model.defer="planid"
                    {{$isDisabled}}>
                    @foreach ($totalplanes as $plan)
                    <option value="{{ $plan->id }}">
                        {{ $plan->nombre }}&nbsp{{ $plan->descarga }} </option>
                    @endforeach
                </select>
                @error('planid')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="w-full p-2 ">
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
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('vermodalfibra',false)" wire:loading.attr="disabled"
            class="float-left">
            {{ __('Volver Atras') }}
        </x-jet-secondary-button>
        <x-jet-danger-button wire:click="updateserviciofibra" wire:loading.attr="disabled">
            {{ __('Guardar Cambios') }}
        </x-jet-danger-button>
    </x-slot>
</x-jet-dialog-modal>