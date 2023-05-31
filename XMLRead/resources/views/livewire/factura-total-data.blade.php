<div>

    <head>
        @include('base.nav-bar')
    </head>

    <body class="antialiased font-sans bg-gray-200">
        <div class="container mx-auto px-4 sm:px-8">
            <div class="py-8">
                <div>
                    <h2 class="text-2xl font-bold leading-tight">Facturas</h2>
                </div>
                {{-- Vista sin generar factura muestra solo el boton --}}
                @if ($generarFactura == false)
                    <div class="py-4 grid grid-cols-2 gap-4">
                        <div>
                            <button wire:click="generarFacturaShow()" type="button"
                                class="text-white bg-gradient-to-r mt-4 from-blue-500 via-blue-600 to-blue-700 w-1/4 text-lg
                                    hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg
                                    shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg px-5 py-2.5 text-center mr-2 mb-2 justify-center">Generar
                            </button>
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
                    <div class="grid grid-cols-2 gap-8">
                        <div>
                            <form action="" method="POST" enctype="multipart/form-data"
                                class="border border-sky-500 divide-y divide-slate-200
                                     bg-slate-200 rounded-lg">
                                @csrf
                                <div class="grid grid-cols-2 gap-4 my-4 w-full">


                                    <div class="p-4">
                                        <label class="font-semibold text-lg" for="folio">Folio</label>
                                        <input id="folio" placeholder="#" wire:model="folioAlfa"
                                            class="appearance-none rounded-r rounded-l
                                sm:rounded-l-none border border-gray-400 border-b block
                                pl-8 pr-6 py-2 w-3/4 bg-white text-sm placeholder-gray-400
                                text-gray-700 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" />
                                        @error('folioAlfa')
                                            <span class="text-gray-500 text-sm">{{ $message }}</span>
                                        @enderror

                                    </div>
                                    <div class="p-4">
                                        @if ($folioAlfa != null)
                                            <div class="text-2xl font-bold">
                                                Cantidad Factura: {{ $cantidadTotalAlfaNueva }} Kg
                                            </div>
                                        @endif


                                    </div>
                                </div>
                                <div class="flex flex-row justify-end mb-6 mr-6">
                                    @if ($hideCancelar == false)
                                        <button wire:click="generarFacturaClose()" type="button"
                                            class="text-white bg-gradient-to-r mt-4 from-red-500 via-red-600 to-red-700 w-1/4 text-lg
                                hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg
                                shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg px-5 py-2.5 text-center mr-2 mb-2">Cancelar
                                        </button>
                                        <button wire:click="generateFactura()" type="button"
                                        class="ml-8 text-white bg-gradient-to-r mt-4 from-blue-500 via-blue-600 to-blue-700 w-1/4 text-lg
                                hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg
                                shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg px-5 py-2.5 text-center mr-2 mb-2">Generar
                                    </button>
                                    @endif
                                    @if ($hideCancelar == true)
                                    <button wire:click="generateFactura()" type="button"
                                    class="ml-8 text-white bg-gradient-to-r mt-4 from-blue-500 via-blue-600 to-blue-700 w-1/4 text-lg
                            hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg
                            shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg px-5 py-2.5 text-center mr-2 mb-2">Actualizar
                                </button>
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

                {{-- Vista seleccionar derivas para factura alfa --}}
                @if ($generarFactura == true && $folioAlfa != null)
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
                                                                    <span wire:click="sinUsar({{ $deriva->id }})"
                                                                        class="pointerGG relative">{{ $deriva->estado }}</span>
                                                                </span>
                                                            </p>
                                                        @elseif($deriva->estado == 'Sin usar')
                                                            <span
                                                                class="relative inline-block px-3 py-1 font-semibold text-orange-900 leading-tight">
                                                                <span aria-hidden
                                                                    class="absolute inset-0 bg-orange-200 opacity-50 rounded-full"></span>
                                                                <span wire:click="usado({{ $deriva->id }})"
                                                                    class="pointerGG relative">{{ $deriva->estado }}</span>
                                                            </span>
                                                        @endif
                                                    </td>
                                                @endif
                                                {{-- ELIMINAR REGISTROS --}}
                                                {{-- <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <button
                                                        class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                                        <span aria-hidden
                                                            class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                                        <span wire:click="destroy({{ $factura->id }})"
                                                            class="pointerGG relative">Eliminar</span>
                                                    </button>
                                                </td> --}}
                                            </tr>
                                        @endforeach
                                        {{ $derivas->links() }}
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
                                                                    <span wire:click="sinUsar({{ $busqueda->id }})"
                                                                        class="pointerGG relative">{{ $busqueda->estado }}</span>
                                                                </span>
                                                            </p>
                                                        @elseif($busqueda->estado == 'Sin usar')
                                                            <span
                                                                class="relative inline-block px-3 py-1 font-semibold text-orange-900 leading-tight">
                                                                <span aria-hidden
                                                                    class="absolute inset-0 bg-orange-200 opacity-50 rounded-full"></span>
                                                                <span wire:click="usado({{ $busqueda->id }})"
                                                                    class="pointerGG relative">{{ $busqueda->estado }}</span>
                                                            </span>
                                                        @endif

                                                    </td>
                                                @endif
                                                {{-- <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <span
                                                        class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                                        <span aria-hidden
                                                            class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                                        <span wire:click="destroy({{ $busqueda->id }})"
                                                            class="pointerGG relative">Eliminar</span>
                                                    </span>
                                                </td> --}}
                                            </tr>
                                        @endforeach
                                        {{ $busquedas->links() }}
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>

                @endif



                {{-- 555555555555555555555555555555555555555555555555555555555555555555555555555 --}}
                {{-- Vista de facturas generadas --}}
                @if ($generarFactura == false)
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
