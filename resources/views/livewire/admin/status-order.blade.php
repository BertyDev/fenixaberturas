<div>
    <div class="max-w-5xl px-4 py-8 mx-auto sm:px-6 lg:px-8">

        <div class="flex items-center px-12 py-8 mb-6 bg-white rounded-lg shadow-lg">
            <div class="relative items-center justify-center">
                <div
                    class="{{ $order->status >= 2 && $order->status != 5 ? 'bg-blue-400' : 'bg-gray-400' }} flex items-center justify-center w-12 h-12 rounded-full ">
                    <i class="text-white fas fa-check"></i>

                </div>
                <div class="absolute -left-1.5 mt-0.5">
                    Recibido
                </div>
            </div>

            <div
                class="flex-1 h-1 mx-2 {{ $order->status >= 3 && $order->status != 5 ? 'bg-blue-400' : 'bg-gray-400' }}">

            </div>

            <div class="relative items-center">
                <div
                    class="flex items-center justify-center w-12 h-12 {{ $order->status >= 3 && $order->status != 5 ? 'bg-blue-400' : 'bg-gray-400' }} rounded-full">
                    <i class="text-white fas fa-shipping-fast"></i>
                </div>
                <div class="absolute -left-1 mt-0.5">
                    Enviado
                </div>
            </div>
            <div
                class="flex-1 h-1 mx-2 {{ $order->status >= 4 && $order->status != 5 ? 'bg-blue-400' : 'bg-gray-400' }}">
            </div>
            <div class="relative items-center">
                <div
                    class="flex items-center justify-center w-12 h-12 {{ $order->status >= 4 && $order->status != 5 ? 'bg-blue-400' : 'bg-gray-400' }} rounded-full">
                    <i class="text-white fas fa-people-carry"></i>
                </div>
                <div class="absolute -left-3 mt-0.5">
                    Entregado
                </div>
            </div>
        </div>



        <div class="px-6 py-4 mb-6 bg-white rounded-lg shadow-lg  ">
            <p class="text-gray-700 uppercase">
                <span class="font-bold ">
                    Numero de orden:
                </span>
                Orden-{{ $order->id }}
            </p>
            <form wire:submit.prevent='update' >
                <div class="flex space-x-3 mt-2">
                    <x-jet-label>
                        <input wire:model='status' type="radio" name="status" value="2" class=" mr-1">
                        RECIBIDO
                    </x-jet-label>
                    <x-jet-label>
                        <input wire:model='status' type="radio" name="status" value="3" class=" mr-1">
                        ENVIADO
                    </x-jet-label>
                    <x-jet-label>
                        <input wire:model='status' type="radio" name="status" value="4" class=" mr-1">
                        ENTREGADO
                    </x-jet-label>
                    <x-jet-label>
                        <input wire:model='status' type="radio" name="status" value="5" class=" mr-1">
                        ANULADO
                    </x-jet-label>
                </div>
                <div class=" flex mt-2">
                    <x-jet-button class="ml-auto bg-blue-600 hover:bg-blue-500">
                        actualizar
                    </x-jet-button>
                </div>
            </form>
           
        </div>
        <div class="p-6 mb-6 bg-white rounded-lg shadow-lg ">
            <div
                class="grid grid-cols-1 gap-6 text-gray-700 lg:grid-cols-2 lg:divide-x-2 lg:divide-gray-300 lg:divide-dotted">
                <div>
                    <p class="text-lg font-semibold uppercase ">Envío</p>
                    @if ($order->envio_type == 1)
                        <p class="text-sm "> Los productos deben ser recogidos en el Local</p>
                        <p class="text-sm ">Calle del Local</p>
                    @else
                        <p class="text-sm ">Los productos serán enviados:</p>
                        <p class="text-sm ">{{ $order->addres }}</p>
                        <p>{{ $order->department->name }} - {{ $order->city->name }} -
                            {{ $order->district->name }}</p>
                    @endif
                </div>
                <div class="lg:pl-2">
                    <p class="text-lg font-semibold uppercase ">Contácto</p>
                    <p class="text-sm ">Persona que recibirá el Producto: {{ $order->contact }}</p>
                    <p class="text-sm ">Teléfono de Contacto: {{ $order->phone }}</p>
                </div>
            </div>
        </div>
        <div class="p-6 mb-6 text-gray-700 bg-white rounded-lg shadow-lg">
            <p class="mb-4 text-xl font-semibold ">Resumen</p>
            <table class="w-full table-auto">
                <thead>
                    <tr>
                        <th></th>
                        <th>Precio</th>
                        <th>Cant</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>
                                <div class="flex my-1">
                                    <img class="object-cover w-20 mr-4 rounded-md h-15"
                                        src="{{ $item->options->image }}" alt="">
                                    <article>
                                        <h1 class="font-bold ">{{ $item->name }}</h1>
                                        <div class="flex text-xs">
                                            @isset($item->options->color)
                                                Color: {{ __($item->options->color) }}
                                            @endisset
                                            @isset($item->options->size)
                                                <br> Medida: {{ $item->options->size }}
                                            @endisset
                                        </div>
                                    </article>
                                </div>
                            </td>
                            <td class="text-center">
                                $ {{ $item->price }}
                            </td>
                            <td class="text-center">
                                {{ $item->qty }}
                            </td>
                            <td class="text-center">
                                $ {{ $item->price * $item->qty }}
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
