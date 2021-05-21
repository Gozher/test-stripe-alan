<div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Creacion de suscripción
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class=" flex flex-justify-center items-center m-4">
                    <div class="w-3/6  m-4 ">
                        <h2 class="font-semibold text-xl text-gray-800 text-center">
                            Datos del usuario
                        </h2>
                        <div class="ml-10">
                            <p>Nombre: <span class="text-indigo-500">{{$User->name}}</span> </p>
                            <p>Email: <span class="text-indigo-500">{{$User->email}}</span> </p>
                        </div>

                        <div class="mt-10">
                          <h2 class="font-semibold text-xl text-gray-800 text-center">
                              Seleciona un plan
                          </h2>
                          <div class="ml-10 w-10/12 mx-auto">

                            <select wire:model="PlanSelect" class="mt-2 bg-gray-100 form-select text-sm w-full text-gray-700 py-2 px-3 rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 border-none">
                                <option value="" hidden>selecciona un intervalo</option>
                                @foreach ($allproducts as $key => $value)
                                  <option value="{{$value->id}}">Producto: {{$value->name_product}} -- Costo : ${{$value->price}} </option>
                                @endforeach
                            </select>

                            <!-- var : {{$PlanSelect}} -->

                          </div>

                        </div>
                    </div>

                    <div class="flex flex-col items-center justify-center shadow-lg w-3/6 m-4">

                        <div class="flex flex-col justify-center items-center my-1  w-6/12">
                            <div class="">
                                <label for="">numero de tarjeta</label>
                            </div>
                            <div class="">
                                <input wire:model="cardNumber" type="text" name=""
                                  class="mt-2 bg-gray-100 form-input text-sm w-full py-2 px-3 rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 border-none text-gray-700">
                                @error("cardNumber") <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="flex flex-col justify-center items-center my-1  w-6/12">
                            <div class="">
                                <label for="">mes / año </label>
                            </div>

                            <div class="flex">
                                <input wire:model="month" type="text" name="" value=""
                                  class="mx-2 mt-2 bg-gray-100 form-input text-sm w-full py-2 px-3 rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 border-none text-gray-700">
                                <input wire:model="year" type="text" name="" value=""
                                  class="mx-2 mt-2 bg-gray-100 form-input text-sm w-full py-2 px-3 rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 border-none text-gray-700">
                            </div>
                            @error("month") <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                            @error("year") <span class="text-red-400 text-xs">{{ $message }}</span> @enderror

                        </div>

                        <div class="flex flex-col justify-center items-center my-1  w-6/12">
                            <div class="">
                                <label for="">CVC</label>
                            </div>
                            <div class="">
                                <input wire:model="cvc" type="text" name="" class="mt-2 bg-gray-100 form-input text-sm w-full py-2 px-3 rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 border-none text-gray-700">
                                @error("cvc") <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                            </div>

                        </div>

                        <div class="my-1 text-center w-full my-4">
                          @if($PlanSelect != null)
                            <button wire:click="newSubscription" name="button" class="bg-indigo-500 px-2 py-1 text-white w-4/12">contratar</button>
                          @endif
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

</div>
