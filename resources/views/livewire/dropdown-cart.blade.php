<div>
   <x-jet-dropdown width="96">
       <x-slot name="trigger">
        <span class=" relative inline-block cursor-pointer">
        <x-cart size="2xl" color="50"/>
        @if (Cart::count())
        <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">{{ Cart::count() }}</span>
        @else
        <span class="absolute top-0 right-0 inline-block w-2 h-2 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full"></span>
        @endif
        </span>
       </x-slot>
       <x-slot name="content">

        <ul>
            @forelse (Cart::content() as $item)
                <li class="flex px-2 py-1 border-b-2 border-trueGray-100 ">
                    <img class="h-15 w-20 object-cover mr-4" src="{{ $item->options->image }}" alt="">
                    <article class="flex-1">
                        <h1 class=" font-bold">{{ $item->name }}</h1>

                        <div class="flex">
                            <p>Cant: {{ $item->qty }}</p>
                            @isset ($item->options['color'])
                           <p class="mx-2"> | Color: {{ __($item->options->color)}}</p>
                            @endisset
                            @isset ($item->options['size'])
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
        @if (Cart::count())
            <div class="p-2 mt-1">
                <p class="text-lg text-trueGray-700"><span class="font-bold ">Total</span>: $ {{ Cart::subtotal() }}</p>
                <x-button color="blue" class="w-full mt-2">
                    <a class="w-full h-full" href="{{ route('shopping-cart') }}">
                    ir al carrito de comprar
                    </a>
                </x-button>
            </div>
        @endif
       </x-slot>
   </x-jet-dropdown>
</div>
