<div>
    <body>
        <div class="grid grid-cols-2">
            <div class="div">

            </div>
            <div class="div">

            </div>
        </div>
        <div class="md:grid md:grid-cols-2 xl:flex xl:h-full xl:flex-col justify-center px-4 py-12 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <img class="mx-auto h-64 w-auto" src="{{asset('images/logoAV.jpg')}}"
                    alt="Your Company">
                <h2 class="hidden md:hidden mt-10 text-center text-xl font-semibold leading-9 tracking-tight text-gray-900">
                    Inicio de Sesion</h2>
            </div>
            <div class="mt-5 sm:mx-auto sm:w-full sm:max-w-sm">
                <h2 class=" mt-2 text-center text-xl font-semibold leading-9 tracking-tight text-gray-900">
                    Inicio de Sesion</h2>
                <form wire:submit.prevent="getDataSignIn" class="space-y-6" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- E-mail --}}
                    <div>
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">
                            Correo Electronico</label>
                        <div class="mt-2">
                            <input wire:model = "email" id="email" name="email" type="email" autocomplete="email"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        @error('email')
                        <span class="text-gray-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- Password --}}
                    <div>
                        <div class="flex items-center justify-between">
                            <label for="password"
                                class="block text-sm font-medium leading-6 text-gray-900">Contraseña</label>
                        </div>
                        <div class="mt-2">
                            <input wire:model = "password" id="password" name="password" type="password" autocomplete="current-password"

                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        @error('password')
                                <span class="text-gray-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <button type="submit"
                            class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Iniciar Sesion
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </body>
    {{-- ll --}}
</div>
{{-- src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" --}}
