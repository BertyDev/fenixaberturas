<div>


    @if (Cart::count())
        <x-table-responsive>
            <div class=" bg-white px-6 py-4 text-trueGray-700">
                <h1 class="text-lg font-semibold uppercase">Carrito de Compras</h1>
            </div>

            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 divide-y divide-gray-200">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('Name') }}
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('Price') }}
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('validation.attributes.quantity') }}
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('total') }}
                        </th>

                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">

                    @foreach (Cart::content() as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flexh h-12 w-12">
                                        <img class="h-12 w-12 rounded-xl object-cover object-center"
                                            src="{{ $item->options->image }}" alt="">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $item->name }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            @if ($item->options->color)
                                                <span>
                                                    Color: {{ __($item->options->color) }}
                                                </span>
                                            @endif
                                            @if ($item->options->size)
                                                <br>
                                                <span>
                                                    Medida: {{ __($item->options->size) }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-700"><span>${{ $item->price }}</span>
                                    <button wire:click.prevent="delete('{{ $item->rowId }}')"
                                        onclick="confirm('{{ __('Are you sure you want to run this action?') }}') || event.stopImmediatePropagation()"
                                        wire:loading.class="text-red-600 opacity-25"
                                        wire:target="delete('{{ $item->rowId }}')"
                                        class="ml-4 cursor-pointer hover:text-red-600">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex justify-center text-sm text-gray-700">
                                    @if ($item->options->size)
                                        @livewire('update-cart-item-size',['rowId'=>
                                        $item->rowId],key($item->rowId))

                                    @elseif($item->options->color)
                                        @livewire('update-cart-item-color',['rowId'=>
                                        $item->rowId],key($item->rowId))

                                    @else
                                        @livewire('update-cart-item',['rowId'=> $item->rowId],key($item->rowId))
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                ${{ $item->price * $item->qty }}
                            </td>
                        </tr>

                    @endforeach
                </tbody>

            </table>

            <div class=" px-6 py-4 text-trueGray-700">
                <a wire:click="destroy" class="hover:text-red-600 text-xs cursor-pointer hover:underline inline-block">
                    <i class="fas fa-trash hover:text-red-600 text-lg"></i>
                    Borrar Carrito de Compras
                </a>
            </div>

        @else
            <div class="flex flex-col items-center py-8">
                <x-cart color="600" size="4xl" />
                <p class=" text-lg text-trueGray-700 mt-4"> El carrito es vacio</p>

                <x-button class="mt-4 px-16">
                    <a href="/" class="w-full h-full">
                        Ir al inicio
                    </a>
                </x-button>

            </div>
    @endif
    </x-table-responsive>

    @if (Cart::count())
        <div class="container">
            <div class=" bg-white rounded-lg shadow-lg px-6 py-4  ">
                <div class="flex justify-between items-center">
                    <div>
                        <p class=" text-trueGray-700">
                            <span class="font-bold text-lg">Total:</span>
                            $ {{ Cart::subTotal() }}
                        </p>
                    </div>
                    <div>
                        <x-button class=" bg-blue-600 hover:bg-blue-500">
                            <a href="{{ route('orders.create') }}" class="w-full h-full">
                                Continuar
                            </a>
                        </x-button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
