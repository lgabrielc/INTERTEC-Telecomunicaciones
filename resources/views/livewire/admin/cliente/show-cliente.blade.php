<div>
    <div class="w-full mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-3 content-center">
            <div class="pt-4 px-4 mb-2">
                <div class="w-full bg-white rounded-xl overflow-hdden shadow-md p-4 undefined">
                    <div class="flex flex-wrap border-b border-gray-200 undefined">
                        <div
                            class="bg-gradient-to-br from-sky-400 to-sky-200 -mt-10 mb-4 rounded-xl text-white grid items-center w-24 h-24 py-4 px-4 justify-center shadow-lg-pink mb-0">
                            <span class="material-icons text-white text-3xl leading-none">check</span>
                        </div>
                        <div class="w-full pl-4 max-w-full flex-grow flex-1 mb-2 text-right undefined">
                            <h5 class="text-gray-500 font-light tracking-wide text-base mb-1">Numero de Clientes
                                registrados</h5>
                            <span class="text-3xl text-gray-900">
                                {{ $totalcontar }}
                            </span>
                        </div>
                    </div>
                    <div class="text-sm text-gray-700 pt-4 flex items-center undefined"><span
                            class="material-icons text-green-500 text-base leading-none">arrow_upward</span><span
                            class="text-green-500 ml-1 mr-2"></span><span class="font-light whitespace-nowrap">En
                            total</span></div>
                </div>
            </div>
            <div class="pt-4 px-4 mb-2">
                <div class="w-full bg-white rounded-xl overflow-hdden shadow-md p-4 undefined">
                    <div class="flex flex-wrap border-b border-gray-200 undefined">
                        <div
                            class="bg-gradient-to-r from-yellow-200 via-yellow-400 to-yellow-700 -mt-10 mb-4 rounded-xl text-white grid items-center w-24 h-24 py-4 px-4 justify-center shadow-lg-pink mb-0">
                            <span class="material-icons text-white text-3xl leading-none">folder_special</span>
                        </div>
                        <div class="w-full pl-4 max-w-full flex-grow flex-1 mb-2 text-right undefined">
                            <h5 class="text-gray-500 font-light tracking-wide text-base mb-1">Numero de Clientes con
                                Servicio</h5>
                            <span class="text-3xl text-gray-900">
                                {{ $totalcontarservicios }}
                            </span>
                        </div>
                    </div>
                    <div class="text-sm text-gray-700 pt-4 flex items-center undefined"><span
                            class="material-icons text-green-500 text-base leading-none">arrow_upward</span><span
                            class="text-green-500 ml-1 mr-2"></span><span class="font-light whitespace-nowrap">En
                            total</span></div>
                </div>
            </div>
            <div class="pt-4 px-4 mb-2">
                <div class="w-full bg-white rounded-xl overflow-hdden shadow-md p-4 undefined">
                    <div class="flex flex-wrap border-b border-gray-200 undefined">
                        <div
                            class="bg-gradient-to-r from-gray-200 via-gray-400 to-gray-600 -mt-10 mb-4 rounded-xl text-white grid items-center w-24 h-24 py-4 px-4 justify-center shadow-lg-pink mb-0">
                            <span class="material-icons text-white text-3xl leading-none">
                                library_add</span>
                        </div>
                        <div class="w-full pl-4 max-w-full flex-grow flex-1 mb-2  undefined">
                            <h5 class="text-gray-500 font-light tracking-wide text-base mb-1 text-right">Gestionar Nuevo
                                Plan de Internet
                            </h5>
                            <div class="flex justify-end">
                                <span class="">
                                    @include('livewire.admin.cliente.modalcrearplan')
                                </span>
                                <span class="">
                                    @include('livewire.admin.cliente.modaleditarplan')
                                </span>
                            </div>


                        </div>
                    </div>
                    <div class="text-sm text-gray-700 pt-4 flex items-center undefined"><span
                            class="material-icons text-green-500 text-base leading-none">arrow_upward</span><span
                            class="text-green-500 ml-1 mr-2"></span><span class="font-light whitespace-nowrap">En
                            total</span></div>
                </div>
            </div>
        </div>

    </div>
    {{-- TABLA SEARCH Y TABLA PARA MOSTRAR LOS DATOOS --}}
    <div class=" max-w-7x1 mx-auto px-4 sm:px-6 lg:px-8 ">
        <div class="w-full">
            <div class="bg-white  rounded-2xl px-10 py-8 shadow-lg hover:shadow-2xl transition duration-500 w-full">
                <div class="w-full">
                    <div class=w-full">
                        <h1 class="text-2xl font-semibold leading-tight mb-2">Gestionar Clientes</h1>
                        @include('livewire.admin.cliente.modalcrear')
                        <div class="my-2 flex sm:flex-row flex-col">
                            <div class="pr-2 flex flex-row mb-1 sm:mb-0 content-center justify-center">
                                <div class="flex relative content-center ">
                                    <span class="mt-2 mr-1">Mostrar</span>
                                    <select wire:model="cant"
                                        class="appearance-none h-full rounded-l border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                                <div class="relative">
                                    <div
                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="block relative">
                                <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                                    <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                                        <path
                                            d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                                        </path>
                                    </svg>
                                </span>
                                <input placeholder="Search" wire:model="search"
                                    class="flex-1 appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-8 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none"
                                    autofocus />
                            </div>
                        </div>
                        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-1 overflow-x-auto">
                            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                                @if (count($clientes))
                                <table class="min-w-full leading-normal">
                                    <thead>
                                        <tr>
                                            <th wire:click="order('id')"
                                                class="cursor-pointer pl-2 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                ID
                                                @if ($sort == 'id')
                                                @if ($direction == 'asc')
                                                {{-- SI ES ASCENDENTE PONER SU ICONO --}}
                                                <i class="fas fa-sort-numeric-up float-right"></i>
                                                {{-- SI ES DESCENDENTE PONER SU ICONO --}}
                                                @else
                                                {{-- SI ES DESCENDENTE PONER SU ICONO --}}
                                                <i class="fas fa-sort-numeric-up-alt float-right"></i>
                                                @endif
                                                @else
                                                {{-- SI ES CLICKEA POR PRIMERA VEZ EN ID PONER SU ICONO --}}
                                                <i class="fas fa-sort float-right"></i>
                                                @endif
                                            </th>
                                            <th wire:click="order('nombre')"
                                                class="cursor-pointer px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                Nombre
                                                <i class="fas fa-sort float-right mt-1"></i>
                                            </th>
                                            <th wire:click="order('apellido')"
                                                class="cursor-pointer px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                Apellido
                                                <i class="fas fa-sort float-right mt-1"></i>
                                            </th>
                                            <th wire:click="order('dni')"
                                                class="cursor-pointer px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                DNI
                                                <i class="fas fa-sort float-right mt-1"></i>
                                            </th>
                                            <th wire:click="order('direccion')"
                                                class="cursor-pointer px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                Direccion
                                                <i class="fas fa-sort float-right mt-1"></i>
                                            </th>
                                            <th wire:click="order('telefono')"
                                                class="cursor-pointer px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                Telefono
                                                <i class="fas fa-sort float-right mt-1"></i>
                                            </th>
                                            <th wire:click="order('correo')"
                                                class="cursor-pointer px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                Correo
                                                <i class="fas fa-sort float-right mt-1"></i>
                                            </th>
                                            <th
                                                class="cursor-pointer py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                Acciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($clientes as $cliente)
                                        <tr>
                                            <td class="py-4 border-b border-gray-200 bg-white text-sm text-center">
                                                <p class="text-gray-900">
                                                    {{ $cliente->id }}
                                                </p>
                                            </td>
                                            <td class="py-4 border-b border-gray-200 bg-white text-sm text-center">
                                                <p class="text-gray-900 whitespace-no-wrap ">
                                                    {{ $cliente->nombre }}
                                                </p>
                                            </td>
                                            <td class="py-1 border-b border-gray-200 bg-white text-sm text-center">

                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{ $cliente->apellido }}</p>

                                            </td>
                                            <td class="py-1 border-b border-gray-200 bg-white text-sm text-center">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{ $cliente->dni }}</p>
                                            </td>
                                            <td class="py-1 border-b border-gray-200 bg-white text-sm text-center">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{ $cliente->direccion }}</p>
                                            </td>
                                            <td class="py-1 border-b border-gray-200 bg-white text-sm text-center">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{ $cliente->telefono }}</p>
                                            </td>
                                            <td class="py-1 border-b border-gray-200 bg-white text-sm text-center">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{ $cliente->correo }}</p>
                                            </td>
                                            <td class="py-1 border-b border-gray-200 text-sm text-center">
                                                @if ($cliente->servicio)
                                                @if ($cliente->servicio['tiposervicio']=='Antena')
                                                <a wire:click="verservicioantena({{$cliente->id}})"
                                                    class="bg-gradient-to-r from-green-200 to-green-600 btn2 btn-green mb-1 py-2">
                                                    <i class="fas fa-broadcast-tower"></i>
                                                </a>
                                                @elseif ($cliente->servicio['tiposervicio']=='Fibra')
                                                <a wire:click="verserviciofibra({{$cliente->id}})"
                                                    class="bg-gradient-to-r from-yellow-200 to-yellow-600 btn2 btn-yellow mb-1 py-2">
                                                    <i class="fas fa-code-branch px-1"></i>
                                                </a>
                                                @endif
                                                <a wire:click="vermigracion({{$cliente->id}})"
                                                    class="bg-gradient-to-r from-purple-200 to-purple-600 btn2 btn-purple mb-1 py-2">
                                                    <i class="fas fa-exchange-alt"></i>
                                                </a>
                                                @else
                                                <a wire:click="activarmodalcrearservicio({{$cliente->id}})"
                                                    class="bg-gradient-to-r from-red-200 to-red-600 btn2 btn-red mb-1 py-2">
                                                    <i class="fas fa-plus-square"></i>
                                                </a>
                                                @endif
                                                <a wire:click="edit({{$cliente->id}})" class="bg-gradient-to-r from-blue-200 to-blue-600 btn2 btn-blue mb-1 py-2">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ($clientes->hasPages())
                                <div class="px-6 py-3">
                                    {{ $clientes->links() }}
                                </div>
                                @endif
                                @else
                                <div class="px-6 py-4">
                                    No existe ningún registro coincidente
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                </body>
            </div>
        </div>
    </div>
    @include('livewire.admin.cliente.modaleditar')
    @include('livewire.admin.cliente.modalcrearservicio')
    @include('livewire.admin.cliente.modalverserviciofibra')
    @include('livewire.admin.cliente.modalverservicioantena')
    @include('livewire.admin.cliente.modalmigracion')
    <script>
        livewire.on('deletthis', deletID => {
            Swal.fire({
                title: 'Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, bórralo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('delete', deletID)
                    Swal.fire(
                        'Deleted!',
                        'El Cli ha sido eliminado.',
                        'success'
                    )
                }
            })
        });
    </script>
</div>