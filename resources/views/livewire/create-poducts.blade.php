<div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Creacion de suscripción
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex justify-center ">

                <div class="w-3/6 border">

                    <h1 class="text-xl text-center">Lista de productos</h1>
                  
                    @foreach ($allprices as $key => $value)
                    <div class="ml-10 my-4">
                      <p>product   : <span class="text-indigo-600">{{$value->name_product}}</span></p>
                      <p>precio    : <span class="text-indigo-600">$ {{$value->price}}</span></p>
                      <p>intervalo : <span class="text-indigo-600">{{$value->interval}}</span></p>
                    </div>
                    @endforeach

                </div>

                <div class="w-3/6">
                    <div class="flex flex-col justify-center items-center my-1">
                        <div class="">
                            <label for="">nombre del producto</label>
                        </div>
                        <div class="mx-auto w-6/12">
                            <input wire:model="productName" type="text" name="" class="mt-2 bg-gray-100 form-input text-sm w-full py-2 px-3 rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 border-none text-gray-700">
                            @error("productName") <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex flex-col justify-center items-center my-1">
                        <div class="">
                            <label for="">intervalo</label>
                        </div>
                        <div class="mx-auto w-6/12">

                            <select wire:model="interval" class="mt-2 bg-gray-100 form-select text-sm w-full text-gray-700 py-2 px-3 rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 border-none">
                                <option value="" hidden>selecciona un intervalo</option>
                                <option value="day">Dia</option>
                                <option value="week">Semana</option>
                                <option value="month">Mes</option>
                                <option value="year">Año</option>
                            </select>

                            @error("interval") <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex flex-col justify-center items-center my-1">
                        <div class="">
                            <label for="">precio</label>
                        </div>
                        <div class="mx-auto w-6/12">
                            <input wire:model="price" type="text" name="" class="mt-2 bg-gray-100 form-input text-sm w-full py-2 px-3 rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 border-none text-gray-700">
                            @error("price") <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="my-1 text-center w-full my-4">
                        <button wire:click="CreateProduct" name="button" class="bg-indigo-500 px-2 py-1 text-white w-3/12">Crear</button>
                    </div>

                </div>


            </div>
        </div>
    </div>

    <!-- preloader -->
    <div wire:loading.delay class="fixed z-10 inset-0 overflow-y-auto">

        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block  align-center transform transition-all">
                <img src="{{ asset('/img/loader.gif') }}" width="200" height="200">
            </div>
        </div>
    </div>

</div>
