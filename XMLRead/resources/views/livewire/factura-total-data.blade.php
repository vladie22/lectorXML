<div>
    <head>
        @include('livewire.nav-bar')
    </head>
    <body class="antialiased font-sans bg-gray-200">
        <div class="container mx-auto px-4 sm:px-8">
            <div class="py-8">
                <div>
                    @if ($showEdit == false)
                        <h2 class="text-2xl font-bold leading-tight">Facturas</h2>
                    @endif
                    @if ($showEdit == true)
                        <h2 class="text-2xl font-bold leading-tight">Editar Factura {{ $folioAlfa }}</h2>
                    @endif

                </div>
                {{-- Vista sin generar factura muestra solo el boton --}}
                @if ($generarFactura == false)
                    <div class="py-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            @if ($showEdit == false)
                                <button wire:click="generarFacturaShow()" type="button"
                                    class="text-white bg-gradient-to-r mt-4 from-blue-500 via-blue-600 to-blue-700 w-full md:w-1/2 sm:w-1/4 text-lg
                                    hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg
                                    shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg px-5 py-2.5 text-center mr-2 mb-2 justify-center">Generar
                                    Factura
                                </button>
                            @endif
                            @if ($showEdit == true)
                                <div
                                    class="sm:p-8 border border-sky-500 rounded-lg
                            shadow shadow-slate-400">
                                    <div class="flex flex-row justify-center mt-4 sm:justify-start">
                                        <div class="text-2xl font-bold">
                                            Cantidad Factura: {{ $cantidadTotalAlfaNueva }} Kg
                                        </div>
                                    </div>
                                    <div class="p-4 sm:p-4 mt-2 sm:mt-8 grid grid-cols-2 gap-2">
                                        <div class="flex flex-row justify-center">
                                            <button wire:click="editFacturaClose()" type="button"
                                                class="text-white bg-gradient-to-r mt-4 from-red-500 via-red-600 to-red-700 xl:w-1/2 md:w-full sm:w-full text-lg
                                hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg
                                shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg px-5 py-2.5 text-center mr-2 mb-2">Cancelar
                                            </button>
                                        </div>
                                        <div class="flex flex-row justify-center">
                                            <button wire:click="updateFactura()" type="button"
                                                class="text-white bg-gradient-to-r mt-4 from-blue-500 via-blue-600 to-blue-700 xl:w-1/2 md:w-full sm:w-full text-lg
                                hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg
                                shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg px-5 py-2.5 text-center mr-2 mb-2">Actualizar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="flex flex-row justify-center items-center content-center ">
                            <div
                                class="
                                p-8 border border-sky-500 rounded-lg
                                shadow shadow-slate-400">

                                <div class="text-2xl font-bold">
                                    Disponibles: {{ $cantidadTotalFacturas }} Kg
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- Vista para generar factura --}}
                @if ($generarFactura == true)
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                        <div>
                            <form action="" method="POST" enctype="multipart/form-data"
                                class="border border-sky-500 divide-y divide-slate-200
                                     bg-slate-200 rounded-lg">
                                @csrf
                                <div class="grid grid-cols-2 gap-4 my-4 w-full">
                                    <div class="p-4">
                                        <label class="font-semibold text-lg" for="folioAlfa">Folio</label>
                                        <input id="folioAlfa" placeholder="#" wire:model="folioAlfa"
                                            class="appearance-none rounded-r rounded-l
                                sm:rounded-l-none border border-gray-400 border-b block
                                pl-8 pr-6 py-2 w-full sm:w-3/4 bg-white text-sm placeholder-gray-400
                                text-gray-700 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" />
                                        @error('folioAlfa')
                                            <span class="text-gray-500 text-sm">{{ $message }}</span>
                                        @enderror

                                    </div>
                                    <div class="p-4">
                                        @if ($folioAlfa != null)
                                            <div class="mt-4 md:text-lg xl:text-2xl font-bold">
                                                Cantidad Factura: {{ $cantidadTotalAlfaNueva }} Kg
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex flex-row justify-center md:justify-center xl:justify-end p-4  mb-2 ">
                                    @if ($folioAlfaExist == false)
                                        <button wire:click="generarFacturaClose()" type="button"
                                            class="text-white ml-2 mr-2 bg-gradient-to-r mt-4 from-red-500 via-red-600 to-red-700 md:w-full xl:w-1/4 text-lg
                                hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg
                                shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg px-5 py-2.5 text-center sm:mr-2 mb-2">Cancelar
                                        </button>
                                        <button wire:click="generateFactura()" type="button"
                                            class="ml-2 md:ml-2 xl:ml-8 text-white bg-gradient-to-r mt-4 from-blue-500 via-blue-600 to-blue-700 md:w-full xl:w-1/4 text-lg
                                hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg
                                shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg px-5 py-2.5 text-center mb-2">Generar
                                        </button>
                                    @endif
                                    @if ($folioAlfaExist == true)
                                        <div class="font-bold text-base">Este folio ya existe!</div>
                                    @endif
                                </div>
                            </form>
                        </div>
                        <div class="flex flex-row justify-center items-center content-center">
                            <div
                                class="
                                p-8 border border-sky-500 rounded-lg
                                shadow shadow-slate-400">

                                <div class="text-2xl font-bold">
                                    Disponibles: {{ $cantidadTotalFacturas }} Kg
                                </div>
                            </div>

                        </div>
                    </div>
                @endif
                {{-- Vista seleccionar derivas para factura alfa NUEVA --}}
                @if (($generarFactura == true && $folioAlfa != null && $folioAlfaExist == false) || $showEdit == true)
                    <div class="my-2 flex sm:flex-row flex-col">
                        <div class="flex flex-row mb-1 sm:mb-0">
                            <div class="relative">
                                <select wire:model='limit'
                                    class="appearance-none h-full rounded-l border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                    <option value=5>5</option>
                                    <option value=10>10</option>
                                    <option value=20>20</option>
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="relative">
                                <select wire:model='searchOptionsData'
                                    class="appearance-none h-full rounded-r border-t sm:rounded-r-none sm:border-r-0 border-r border-b block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:border-l focus:border-r focus:bg-white focus:border-gray-500">
                                    <option value="uuid">UUID</option>
                                    <option value="rfc">RFC</option>
                                    <option value="cantidad">Kilogramos</option>
                                    <option value="nombre">Nombre</option>
                                </select>
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
                            <input placeholder="Buscar" wire:model="searchData"
                                class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
                        </div>
                    </div>
                    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                        <div wire:loading.class="opacity-50"
                            class="border border-sky-500  inline-block min-w-full shadow rounded-lg overflow-hidden">
                            <table class="min-w-full leading-normal">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-base font-semibold text-gray-600 uppercase tracking-wider">
                                            Fecha
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-base font-semibold text-gray-600 uppercase tracking-wider">
                                            RFC
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-base font-semibold text-gray-600 uppercase tracking-wider">
                                            NOMBRE
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-base font-semibold text-gray-600 uppercase tracking-wider">
                                            UUID
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-base font-semibold text-gray-600 uppercase tracking-wider">
                                            Cantidad (Kg)
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-base font-semibold text-gray-600 uppercase tracking-wider">
                                            Monto ($)
                                        </th>
                                        @if ($folioAlfa != null)
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-base font-semibold text-gray-600 uppercase tracking-wider">
                                                Estado
                                            </th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$searchData)
                                        @foreach ($derivas as $deriva)
                                            <tr>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        {{ substr($deriva->fecha, 0, -9) }}
                                                    </p>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        {{ $deriva->rfc }}
                                                    </p>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        {{ $deriva->nombre }}
                                                    </p>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        {{ $deriva->uuid }}
                                                    </p>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        {{ $deriva->cantidad }}
                                                    </p>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        ${{ number_format($deriva->total, 2, '.', ',') }}
                                                    </p>
                                                </td>
                                                @if ($folioAlfa != null)
                                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                        @if ($deriva->estado == 'Usado')
                                                            <p class="text-gray-900 whitespace-no-wrap">
                                                                <span
                                                                    class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                                                    <span aria-hidden
                                                                        class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                                    <button wire:click="sinUsar({{ $deriva->id }})"
                                                                        class="pointerGG relative">{{ $deriva->estado }}</button>
                                                                </span>
                                                            </p>
                                                        @elseif($deriva->estado == 'Sin usar')
                                                            <span
                                                                class="relative inline-block px-3 py-1 font-semibold text-orange-900 leading-tight">
                                                                <span aria-hidden
                                                                    class="absolute inset-0 bg-orange-200 opacity-50 rounded-full"></span>
                                                                <button wire:click="usado({{ $deriva->id }})"
                                                                    class="pointerGG relative">{{ $deriva->estado }}</button>
                                                            </span>
                                                        @endif
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                        <div>
                                            {{ $derivas->links() }}
                                        </div>

                                    @endif
                                    @if ($searchData)
                                        @foreach ($busquedas as $busqueda)
                                            <tr>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        {{ substr($busqueda->fecha, 0, -9) }}
                                                    </p>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        {{ $busqueda->rfc }}
                                                    </p>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        {{ $busqueda->nombre }}
                                                    </p>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        {{ $busqueda->uuid }}
                                                    </p>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        {{ $busqueda->cantidad }}
                                                    </p>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        ${{ number_format($busqueda->total, 2, '.', ',') }}
                                                    </p>
                                                </td>
                                                @if ($folioAlfa != null)
                                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                        @if ($busqueda->estado == 'Usado')
                                                            <p class="text-gray-900 whitespace-no-wrap">
                                                                <span
                                                                    class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                                                    <span aria-hidden
                                                                        class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                                    <button wire:click="sinUsar({{ $busqueda->id }})"
                                                                        class="pointerGG relative">{{ $busqueda->estado }}</button>
                                                                </span>
                                                            </p>
                                                        @elseif($busqueda->estado == 'Sin usar')
                                                            <span
                                                                class="relative inline-block px-3 py-1 font-semibold text-orange-900 leading-tight">
                                                                <span aria-hidden
                                                                    class="absolute inset-0 bg-orange-200 opacity-50 rounded-full"></span>
                                                                <button wire:click="usado({{ $busqueda->id }})"
                                                                    class="pointerGG relative">{{ $busqueda->estado }}</button>
                                                            </span>
                                                        @endif
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                        <div>
                                            {{ $busquedas->links() }}
                                        </div>

                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
                {{-- Vista de facturas generadas --}}
                @if ($generarFactura == false && $showEdit == false)
                    <div class="my-8 flex sm:flex-row flex-col">
                        <div class="flex flex-row mb-1 sm:mb-0">
                            <div class="relative">
                                <select wire:model='limit'
                                    class="appearance-none h-full rounded-l border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                    <option value=5>5</option>
                                    <option value=10>10</option>
                                    <option value=20>20</option>
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="relative">
                                <select wire:model='searchOptions'
                                    class="appearance-none h-full rounded-r border-t sm:rounded-r-none sm:border-r-0 border-r border-b block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:border-l focus:border-r focus:bg-white focus:border-gray-500">
                                    <option value="folio">Folio</option>
                                    <option value="cantidad">Cantidad</option>

                                </select>
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
                            <input placeholder="Buscar" wire:model="search"
                                class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
                        </div>
                    </div>
                    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                        <div wire:loading.class="opacity-50"
                            class="border border-sky-500  inline-block min-w-full shadow rounded-lg overflow-hidden">
                            <table class="min-w-full leading-normal">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-base font-semibold text-gray-600 uppercase tracking-wider">
                                            FOLIO
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-base font-semibold text-gray-600 uppercase tracking-wider">
                                            CANTIDAD TOTAL (Kg)
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-base font-semibold text-gray-600 uppercase tracking-wider">
                                            MONTO TOTAL ($)
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-base font-semibold text-gray-600 uppercase tracking-wider">
                                            DESCRIPCION
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-base font-semibold text-gray-600 uppercase tracking-wider">
                                            EDITAR
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$search)
                                        @foreach ($facturas as $factura)
                                            <tr>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        {{ $factura->folio }}
                                                    </p>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        {{ $factura->cantidad }}
                                                    </p>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        ${{ number_format($factura->total, 2, '.', ',') }}
                                                    </p>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <button wire:click="showDescripcion({{ $factura->id }})"
                                                        class="font-medium text-lg text-gray-900 hover:text-blue-600  hover:underline">
                                                        Mostrar
                                                    </button>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <div class='flex items-center justify-start h-8'>
                                                        <div class="m-5">
                                                            <button wire:click="edit({{ $factura->folio }})"
                                                                class="flex p-2.5 bg-blue-500 rounded-xl hover:rounded-3xl hover:bg-blue-600 transition-all duration-300 text-white">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    class="h-6 w-6" fill="none"
                                                                    viewBox="0 0 24 24" stroke="currentColor"
                                                                    stroke-width="2">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <div>
                                            {{ $facturas->links() }}
                                        </div>
                                    @endif
                                    @if ($search)
                                        @foreach ($searchFacturas as $searchFactura)
                                            <tr>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        {{ $searchFactura->folio }}
                                                    </p>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        {{ $searchFactura->cantidad }}
                                                    </p>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        ${{ number_format($searchFactura->total, 2, '.', ',') }}
                                                    </p>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <button wire:click="showDescripcion({{ $searchFactura->id }})"
                                                        class="font-medium text-lg text-gray-900 hover:text-blue-600  hover:underline">
                                                        Mostrar
                                                    </button>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <div class='flex items-center justify-start h-8'>
                                                        <div class="m-5">
                                                            <button wire:click="edit({{ $searchFactura->folio }})"
                                                                class="flex p-2.5 bg-blue-500 rounded-xl hover:rounded-3xl hover:bg-blue-600 transition-all duration-300 text-white">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    class="h-6 w-6" fill="none"
                                                                    viewBox="0 0 24 24" stroke="currentColor"
                                                                    stroke-width="2">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <div>
                                            {{ $searchFacturas->links() }}
                                        </div>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </body>
</div>
