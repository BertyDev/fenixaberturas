<div class="container py-8 grid grid-cols-1  lg:grid-cols-5 gap-6">
    <div class=" lg:col-span-3 order-last lg:order-first">
        <p class="mt-6 mb-3 text-lg text-trueGray-700 font-semibold">Contácto</p>
        <div class=" bg-white rounded-lg shadow-lg p-6 ">
            <div class="mb-4">
                <x-jet-label value="Nombre" />
                <x-jet-input wire:model.defer="contact" 
                type="text" 
                placerholder="Ingrese el nombre de las persona que recibirá el envío"
                    class="w-full" />
                    <x-jet-input-error for="contact" />
            </div>
            <div>
                <x-jet-label value="Teléfono" />
                <x-jet-input 
                wire:model.defer="phone" 
                type="text" 
                placerholder="Ingrese el teléfono de contácto" class="w-full" />
                <x-jet-input-error for="phone" />
            </div>
        </div>
        <div x-data="{ envio_type: @entangle('envio_type') }">
            <p class="mt-6 mb-3 text-lg text-trueGray-700 font-semibold">Envíos</p>
            <label class="bg-white rounded-lg shadow-lg px-6 py-4 flex items-center  mb-4 ">
                <input x-model="envio_type" type="radio" value="1" name="envio_type" class="text-gray-600">
                <span class="ml-2 text-trueGray-700">
                    Retiro En Local (Direccion Local)
                </span>
                <span class=" font-medium text-trueGray-700 ml-auto">
                    Gratis
                </span>
            </label>
            <div class="bg-white rounded-lg shadow-lg">
                <label class=" px-6 py-4 flex items-center  ">
                    <input x-model="envio_type" type="radio" value="2" name="envio_type" class="text-gray-600">
                    <span class="ml-2 text-trueGray-700">
                        Envío a domicilio
                    </span>
                </label>
                <div class="px-6 pb-6 grid grid-cols-2 gap-6 " :class="{'hidden': envio_type != 2}" >
                    {{-- Department --}}
                    <div>
                        <x-jet-label value="Departamentos" class="  text-trueGray-700 font-semibold" />
                        <select class="form-control w-full" wire:model.debounse.500ms="department_id">
                            <option value="" selected disabled>Seleccione un Departamento</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="department_id" />
                    </div>
                    {{-- Cities --}}
                    <div>
                        <x-jet-label value="Ciudad" class="  text-trueGray-700 font-semibold" />
                        <select class="form-control w-full" wire:model.debounse.500ms="city_id">
                            <option value="" selected disabled>Seleccione una ciudad</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="city_id" />
                    </div>
                    {{-- District --}}
                    <div>
                        <x-jet-label value="Distrito" class="  text-trueGray-700 font-semibold" />
                        <select class="form-control w-full" wire:model.debounse.500ms="district_id">
                            <option value="" selected disabled>Seleccione un Distrito</option>
                            @foreach ($districts as $district)
                                <option value="{{ $district->id }}">{{ $district->name }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="district_id" />
                    </div>
                    <div>
                        <x-jet-label value="Direccion" class=" text-trueGray-700 font-semibold" />
                        <x-jet-input class="w-full mb-3" wire:model.defer="adress" type="text" />
                        <x-jet-input-error for="adress" />
                    </div>
                    <div class=" col-span-2">
                        <x-jet-label value="Referencia (Quien recibe el pedido)" class="  text-trueGray-700 font-semibold" />
                        <x-jet-input class="w-full mb-3" wire:model.defer="references" type="text" />
                        <x-jet-input-error for="references" />
                    </div>
                </div>
            </div>
        </div>
        <div>
            <x-jet-button wire:click="create_order"
            wire:loading.attr="disabled"
            wire:target="create_order"
             class="mt-6 mb-4 w-full justify-center bg-blue-700 hover:bg-blue-600">
                Continuar con la compra
            </x-jet-button>
            <hr>
            <p class=" text-sm text-trueGray-700 mt-2 text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing
                elit. Omnis vero, eum sequi similique incidunt suscipit iure aperiam ex dignissimos, asperiores aliquam
                natus doloremque voluptatibus explicabo, sint atque quasi quos ipsa.</p>
            <a href="" class=" font-semibold text-blue-500">
                Políticas de Privacidad
            </a>
        </div>
    </div>
    <div class=" lg:col-span-2">
        <p class="mt-6 mb-3 text-lg text-trueGray-700 font-semibold">Detalle Compra</p>

        <div class=" bg-white rounded-lg shadow-lg p-6">
            <ul>
                @forelse (Cart::content() as $item)
                    <li class="flex px-2 py-1 border-b-2 border-trueGray-100 ">
                        <img class="h-15 w-20 object-cover mr-4" src="{{ $item->options->image }}" alt="">
                        <article class="flex-1">
                            <h1 class=" font-bold">{{ $item->name }}</h1>

                            <div class="flex">
                                <p>Cant: {{ $item->qty }}</p>
                                @isset($item->options['color'])
                                    <p class="mx-2"> | Color: {{ __($item->options->color) }}</p>
                                @endisset
                                @isset($item->options['size'])
                                    <p>| {{ __($item->options->size) }}</p>
                                @endisset

                            </div>
                            <p>$ {{ $item->price }}</p>
                        </article>
                    </li>

                @empty
                    <li class="py-6 px-4">
                        <p class=" text-center text-gray-700">
                            No tiene agregado ningún item en el Carrito...
                        </p>
                    </li>
                @endforelse
            </ul>
            <div class=" text-trueGray-700 mt-4">
                <p class=" flex justify-between items-center">
                    SubTotal:
                    <span class=" font-semibold"> ${{ Cart::subTotal() }}</span>
                </p>
                <p class=" flex justify-between items-center">
                    Envío:
                    <span class=" font-semibold">
                        @if ($envio_type == 1 || $shipping_cost == 0)
                            Gratis
                        @else
                          ${{ $shipping_cost }}
                        @endif
                    </span>
                </p>
                <hr class="mt-4 mb-3">
                <p class=" flex justify-between items-center font-semibold">
                    <span class=" text-lg">Total:</span>
                    @if ($envio_type == 1 || $shipping_cost == 0)
                    ${{ Cart::subTotal() }}
                    @else
                    ${{ Cart::subTotal() + $shipping_cost }}
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>
