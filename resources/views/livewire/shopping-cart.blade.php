<div class="container py-8">
    <section class=" bg-white rounded-lg shadow-lg p-4 text-trueGray-700">
        <h1 class="text-lg font-semibold mb-6">Carro de Compras</h1>
        <x-jet-section-border/>
       @if (Cart::count())
       <table class="table-auto w-full">
        <thead>
            <tr>
                <th></th>
                <th>Precio</th>
                <th>Cant.</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>

            @foreach (Cart::content() as $item)
                <tr>
                    <td>
                        <div class="flex">
                            <img class="h-15 w-20 object-cover mr-4" src="{{ $item->options->image }}" alt="">
                            <div>
                                <p class="font-bold">{{ $item->name }}</p>
                                @if ($item->options->color)
                                    <span>
                                        Color: {{ __($item->options->color) }}
                                    </span>
                                @endif
                                @if ($item->options->size)
                                    <span class="mx-1">-</span>
                                    <span>
                                        Medida: {{ __($item->options->size) }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class=" text-center">
                        <span>${{ $item->price }}</span>
                        <button wire:click.prevent="delete('{{ $item->rowId }}')"
                            onclick="confirm('{{ __('Are you sure you want to run this action?') }}') || event.stopImmediatePropagation()"
                            wire:loading.class="text-red-600 opacity-25"
                            wire:target="delete('{{ $item->rowId }}')"
                            class="ml-4 cursor-pointer hover:text-red-600">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                    <td >
                      <div class="flex justify-center">
                        @if ($item->options->size)
                        @livewire('update-cart-item-size',['rowId'=> $item->rowId],key($item->rowId))

                    @elseif($item->options->color)
                        @livewire('update-cart-item-color',['rowId'=> $item->rowId],key($item->rowId))

                    @else
                        @livewire('update-cart-item',['rowId'=> $item->rowId],key($item->rowId))
                    @endif
                      </div>
                    </td>
                    <td class=" text-center">
                        ${{ $item->price * $item->qty}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <x-jet-section-border/>
    <a wire:click="destroy" class="hover:text-red-600 text-xs cursor-pointer hover:underline mt-6 inline-block">
        <i class="fas fa-trash hover:text-red-600 text-lg"></i>
        Borrar Carrito de Compras
    </a>
       @else
           <div class="flex flex-col items-center py-8">
               <x-cart color="600" size="4xl"/>
            <p class=" text-lg text-trueGray-700 mt-4"> El carrito es vacio</p>

            <x-button class="mt-4 px-16">
                <a href="/" class="w-full h-full">
                    Ir al inicio
                </a>
            </x-button>

           </div>
       @endif
    </section>

    @if (Cart::count())
        <div class=" bg-white rounded-lg shadow-lg px-6 py-4 mt-4">
            <div class="flex justify-between items-center">
                <div>
                    <p class=" text-trueGray-700">
                        <span class="font-bold text-lg">Total:</span>
                        $ {{ Cart::subTotal() }}
                    </p>
                </div>
                <div>
                    <x-button>
                        <a href="{{ route('orders.create') }}" class="w-full h-full">
                            Continuar
                        </a>
                    </x-button>
                </div>
            </div>

        </div>
    @endif
</div>
