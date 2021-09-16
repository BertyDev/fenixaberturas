<div class="container grid grid-cols-1 gap-6 py-8 lg:grid-cols-5">
    <div class="order-last lg:col-span-3 lg:order-first">
        <p class="mt-6 mb-3 text-lg font-semibold text-trueGray-700">Contácto</p>
        <div class="p-6 bg-white rounded-lg shadow-lg ">
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
            <p class="mt-6 mb-3 text-lg font-semibold text-trueGray-700">Envíos</p>
            <label class="flex items-center px-6 py-4 mb-4 bg-white rounded-lg shadow-lg ">
                <input x-model="envio_type" type="radio" value="1" name="envio_type" class="text-gray-600">
                <span class="ml-2 text-trueGray-700">
                    Retiro En Local (Direccion Local)
                </span>
                <span class="ml-auto font-medium text-trueGray-700">
                    Gratis
                </span>
            </label>
            <div class="bg-white rounded-lg shadow-lg">
                <label class="flex items-center px-6 py-4 ">
                    <input x-model="envio_type" type="radio" value="2" name="envio_type" class="text-gray-600">
                    <span class="ml-2 text-trueGray-700">
                        Envío a domicilio
                    </span>
                </label>
                <div class="grid grid-cols-2 gap-6 px-6 pb-6 " :class="{'hidden': envio_type != 2}" >
                    {{-- Department --}}
                    <div>
                        <x-jet-label value="Departamentos" class="font-semibold text-trueGray-700" />
                        <select class="w-full form-control" wire:model.debounse.500ms="department_id">
                            <option value="" selected disabled>Seleccione un Departamento</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="department_id" />
                    </div>
                    {{-- Cities --}}
                    <div>
                        <x-jet-label value="Ciudad" class="font-semibold text-trueGray-700" />
                        <select class="w-full form-control" wire:model.debounse.500ms="city_id">
                            <option value="" selected disabled>Seleccione una ciudad</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="city_id" />
                    </div>
                    {{-- District --}}
                    <div>
                        <x-jet-label value="Distrito" class="font-semibold text-trueGray-700" />
                        <select class="w-full form-control" wire:model.debounse.500ms="district_id">
                            <option value="" selected disabled>Seleccione un Distrito</option>
                            @foreach ($districts as $district)
                                <option value="{{ $district->id }}">{{ $district->name }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="district_id" />
                    </div>
                    <div>
                        <x-jet-label value="Direccion" class="font-semibold text-trueGray-700" />
                        <x-jet-input class="w-full mb-3" wire:model.defer="adress" type="text" />
                        <x-jet-input-error for="adress" />
                    </div>
                    <div class="col-span-2 ">
                        <x-jet-label value="Referencia (Quien recibe el pedido)" class="font-semibold text-trueGray-700" />
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
             class="justify-center w-full mt-6 mb-4 bg-blue-700 hover:bg-blue-600">
                Continuar con la compra
            </x-jet-button>
            <hr>
            <p class="mt-2 text-sm text-justify text-trueGray-700">Lorem ipsum dolor sit amet, consectetur adipisicing
                elit. Omnis vero, eum sequi similique incidunt suscipit iure aperiam ex dignissimos, asperiores aliquam
                natus doloremque voluptatibus explicabo, sint atque quasi quos ipsa.</p>
            <a href="" class="font-semibold text-blue-500 ">
                Políticas de Privacidad
            </a>
        </div>
    </div>
    <div class=" lg:col-span-2">
        <p class="mt-6 mb-3 text-lg font-semibold text-trueGray-700">Detalle Compra</p>

        <div class="p-6 bg-white rounded-lg shadow-lg ">
            <ul>
                @forelse (Cart::content() as $item)
                    <li  class="flex px-2 py-1 border-b-2 border-trueGray-300">
                        <img class="object-cover w-20 mr-4 rounded-md h-15" src="{{ $item->options->image }}" alt="">
                        <article class="flex-1">
                            <h1 class="font-bold ">{{ $item->name }}</h1>

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
                    <li class="px-4 py-6">
                        <p class="text-center text-gray-700 ">
                            No tiene agregado ningún item en el Carrito...
                        </p>
                    </li>
                @endforelse
            </ul>
            <div class="mt-4 text-trueGray-700">
                <p class="flex items-center justify-between ">
                    SubTotal:
                    <span class="font-semibold "> ${{ Cart::subTotal() }}</span>
                </p>
                <p class="flex items-center justify-between ">
                    Envío:
                    <span class="font-semibold ">
                        @if ($envio_type == 1 || $shipping_cost == 0)
                            Gratis
                        @else
                          ${{ $shipping_cost }}
                        @endif
                    </span>
                </p>
                <hr class="mt-4 mb-3">
                <p class="flex items-center justify-between font-semibold ">
                    <span class="text-lg ">Total:</span>
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
