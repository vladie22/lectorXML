<div>
    <nav class="bg-gray-800">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
          <div class="relative flex h-20 items-center justify-between">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
              <button wire:click = "showMobileMenu()" type="button" class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"  aria-controls="mobile-menu" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
                <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>
            </div>
            <div class="flex flex-1 items-center ml:justify-start xl:justify-center sm:items-stretch justify-center">
              <div class="flex flex-shrink-0 items-center">
                <a href="{{route('readXmlData')}}">
                    <img class="block h-8 w-auto lg:hidden" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
                </a>
                <img class="hidden h-8 w-auto lg:block" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
              </div>
              <div class="hidden md:ml-6 md:block">
                <div class="flex space-x-2">
                    <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                    <a href="{{route('readXmlData')}}" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Registro Deriva</a>
                    <a href="{{route('showData')}}" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Derivas</a>
                    <a href="{{route('showQuantity')}}" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Cooperativas</a>
                    <a href="{{route('facturaTotalData')}}" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Factura Alfa</a>
                </div>
              </div>
            </div>



            <div class="invisible lg:visible  absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                <p class="text-gray-300  hover:text-white rounded-md px-3 py-2 text-sm font-medium">
                    Hola, {{Auth::user()->name}}
                </p>
            </div>
            <div class="invisible lg:visible absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                <button wire:click = "logoutUser()"  class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">
                    Cerrar Sesion
                </button>
            </div>
          </div>
          {{-- <div class="flex flex-row justify-end">
            <p class="text-gray-300 ml-6  xl:hidden md:visible hover:text-white rounded-md px-3 py-2 text-sm font-medium">
                Hola, {{Auth::user()->name}}
                </p>
            <button wire:click = "logoutUser()"  class="xl:hidden md:visible text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">
                Cerrar Sesion
            </button>
            </div> --}}


        </div>
        @if ($mobileMenu)
        <div  id="mobile-menu">
            <div class="space-y-1 px-2 pb-3 pt-2">
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                <a class="bg-gray-900 text-white block rounded-md px-3 py-2 text-base font-medium" aria-current="page">Hola, {{Auth::user()->name}}</a>
                <a href="{{route('readXmlData')}}" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Registro Deriva</a>
                <a href="{{route('showData')}}" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Derivas</a>
                <a href="{{route('showQuantity')}}" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Cooperativas</a>
                <a href="{{route('facturaTotalData')}}" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Factura Alfa</a>
                <a wire:click = "logoutUser()" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Cerrar Sesion</a>
            </div>
          </div>
        @endif

      </nav>

</div>
