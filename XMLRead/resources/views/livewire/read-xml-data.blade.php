<div>

    <head>
        @include('livewire.nav-bar')
    </head>

    <body>
        <form action="" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 sm:grid-cols-3 gap-6 my-4 mx-4 p-12">
            @csrf
            <div class="rounded-lg border border-sky-500 divide-y divide-slate-200 w-full">
                <div class="mx-8 my-6">
                    <label class="font-bold text-xl my-5" for="formFile">Adjuntar XML</label>
                    <input wire:model="xml"
                        class="form-control
                        my-4
                        block
                        w-full
                        px-3
                        py-1.5
                        text-base
                        font-normal
                        text-gray-700
                        bg-white bg-clip-padding
                        border border-solid border-gray-300
                        rounded
                        transition
                        ease-in-out
                        m-0
                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        type="file" id="formFile">
                    <div class="mb-2">
                        @error('xml')
                            <span class="text-gray-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex flex-row justify-center mb-4">
                    <button wire:click="readXml()" type="button"
                        class="text-white bg-gradient-to-r mt-4 from-blue-500 via-blue-600 to-blue-700 w-3/4 text-lg
                                hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg
                                shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg px-5 py-2.5 text-center mr-2 mb-2 justify-center">Leer
                    </button>
                </div>
                @if ($showData)
                    <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
                        <p class="font-bold">Los datos del archivo XML se han cargado con exito</p>
                        <p class="text-sm">Favor de verificar la informacion extraida.</p>
                    </div>
                @endif
                @if ($noDataYet)
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                        role="alert">
                        <strong class="font-bold">Ups!, ha ocurrido un error</strong>
                        <span class="block sm:inline">No has cargado el XML, favor de verificar!</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg wire:click="closeNoDataYet()" class="fill-current h-6 w-6 text-red-500" role="button"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <title>Close</title>
                                <path
                                    d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                            </svg>
                        </span>
                    </div>
                @endif
                @if ($repeatUuidAlert)
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                        role="alert">
                        <strong class="font-bold">Ups!, ha ocurrido un error</strong>
                        <span class="block sm:inline">Este CFDI ya se ha registrado</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg wire:click="closeRepeatUuidAlert()" class="fill-current h-6 w-6 text-red-500"
                                role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <title>Close</title>
                                <path
                                    d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                            </svg>
                        </span>
                    </div>
                @endif
                @if ($claveProductoAlert)
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                        role="alert">
                        <strong class="font-bold">Ups!, ha ocurrido un error</strong>
                        <span class="block sm:inline">La clave producto no es igual a "10101802"</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg wire:click="closeClaveProductoAlert()" class="fill-current h-6 w-6 text-red-500"
                                role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <title>Close</title>
                                <path
                                    d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                            </svg>
                        </span>
                    </div>
                @endif
            </div>
            <div>
                {{-- AGREGAR GIF LOADING --}}
                <div wire:loading.delay.longer>
                    <img class="scale-50" src="{{ asset('images/pacman.gif') }}" alt="">
                </div>
            </div>
            <div>
                @if ($showData)
                    <div class="rounded-lg border border-sky-500 divide-y divide-slate-200 p-4 grid grid-cols-1 gap-4">
                        <form action="">
                        <div class="flex flex-row">
                            <label class="font-bold text-xl">Verificacion de datos</label>
                        </div>
                        <div class="ml-6">
                            <div class="flex flex-row">
                                <label class="font-semibold text-lg" for="">Fecha:&nbsp</label>
                                <div>{{ $fecha }}</div>
                            </div>
                            <div class="flex flex-row">
                                <label class="font-semibold text-lg" for="">Nombre:&nbsp</label>
                                <div>{{ $nombre }}</div>
                            </div>
                            <div class="flex flex-row">
                                <label class="font-semibold text-lg" for="">RFC:&nbsp</label>
                                <div>{{ $rfc }}</div>
                            </div>
                            <div class="flex flex-row">
                                <label class="font-semibold text-lg" for="">UUID:&nbsp</label>
                                <div>{{ $uuid }}</div>
                            </div>
                            <div class="flex flex-row">
                                <label class="font-semibold text-lg" for="">Cantidad:&nbsp</label>
                                <div>{{ number_format($cantidad, 2, '.', '') }} Kg</div>
                            </div>
                            <div class="flex flex-row">
                                <label class="font-semibold text-lg" for="">Precio Unitario:&nbsp</label>
                                <div>${{ number_format($precioUnitario, 2, '.', '') }}</div>
                            </div>
                            <div class="flex flex-row">
                                <label class="font-semibold text-lg" for="">Total:&nbsp</label>
                                <div>${{ number_format($total, 2, '.', '') }}</div>
                            </div>
                            <div class="flex flex-row">
                                <label class="font-semibold text-lg" for="">Clave Producto:&nbsp</label>
                                <div>{{ $claveProducto }}</div>
                            </div>
                            <div class="flex flex-row">
                                <label class="font-semibold text-lg" for="arribo">Arribo:&nbsp</label>
                                <input id="arribo" placeholder="#" wire:model="arribo"
                                    class="appearance-none rounded-r rounded-l
                                sm:rounded-l-none border border-gray-400 border-b block
                                pl-8 pr-6 py-2 w-1/2 bg-white text-sm placeholder-gray-400
                                text-gray-700 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" />
                                @error('arribo')
                                    <span class="text-gray-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class=" flex flex-row justify-end">
                            <button wire:click="storeData()" type="button"
                                class="text-white bg-gradient-to-r mt-6 from-blue-500 via-blue-600 to-blue-700
                                    hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg
                                    shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 justify-end">Guardar
                            </button>
                        </div>
                    </div>
            </div>
            @endif
        </form>
    </body>
</div>
