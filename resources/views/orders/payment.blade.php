<x-app-layout>
    @php
        // SDK de Mercado Pago
        require base_path('/vendor/autoload.php');
        // Agrega credenciales
        MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));
        
        // Crea un objeto de preferencia
        $preference = new MercadoPago\Preference();
        
        // Crea un ítem en la preferencia
        foreach ($items as $product) {
            $item = new MercadoPago\Item();
            $item->title = $product->name;
            $item->quantity = $product->qty;
            $item->unit_price = $product->price;
        
            $products[] = $item;
        }
        
        $preference = new MercadoPago\Preference();
        //...
        $preference->back_urls = [
            'success' => 'https://www.http://fenixaberturas.test/orders' ,
            'failure' => 'http://www.tu-sitio/failure',
            'pending' => 'http://www.tu-sitio/pending',
        ];
        $preference->auto_return = 'approved';
        // ...
        
        $preference->items = $products;
        $preference->save();
        
    @endphp
    <div class="container py-8">
        <div class=" bg-white rounded-lg shadow-lg px-6 py-4 mb-6">
            <p class="text-gray-700 uppercase">
                <span class=" font-bold">
                    Numero de orden:
                </span>
                Orden-{{ $order->id }}
            </p>
        </div>
        <div class=" bg-white rounded-lg shadow-lg p-6 mb-6">
            <div
                class="grid grid-cols-1 lg:grid-cols-2 gap-6 text-gray-700 lg:divide-x-2 lg:divide-gray-300 lg:divide-dotted">
                <div>
                    <p class=" text-lg font-semibold uppercase">Envío</p>
                    @if ($order->envio_type == 1)
                        <p class=" text-sm"> Los productos deben ser recogidos en el Local</p>
                        <p class=" text-sm">Calle del Local</p>
                    @else
                        <p class=" text-sm">Los productos serán enviados:</p>
                        <p class=" text-sm">{{ $order->addres }}</p>
                        <p>{{ $order->department->name }} - {{ $order->city->name }} -
                            {{ $order->district->name }}</p>
                    @endif
                </div>
                <div class="lg:pl-2">
                    <p class=" text-lg font-semibold uppercase">Contácto</p>
                    <p class=" text-sm">Persona que recibirá el Producto: {{ $order->contact }}</p>
                    <p class=" text-sm">Teléfono de Contacto: {{ $order->phone }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6 text-gray-700">
            <p class=" text-xl font-semibold mb-4">Resumen</p>
            <table class=" table-auto w-full">
                <thead>
                    <tr>
                        <th></th>
                        <th>Precio</th>
                        <th>Cant</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody class=" divide-y-2 divide-gray-200">
                    <tr>
                        @foreach ($items as $item)
                            <td>
                                <div class="flex">
                                    <img class="h-15 w-20 object-cover mr-4" src="{{ $item->options->image }}" alt="">
                                    <article>
                                        <h1 class=" font-bold">{{ $item->name }}</h1>
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
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6 text-gray-700 flex items-center justify-between">
            <img class="h-8" src="{{ asset('img/PAGOS_EN_LINEA.png') }}" alt="">
            <div>
                <p class="font-semibold  text-xs pb-1">
                    SubTotal: ${{ $order->total - $order->shipping_cost }}
                </p>
                @if ($order->shipping_cost > 0)
                    <p class="font-semibold  text-xs pb-1">
                        Envio: ${{ $order->shipping_cost }}
                    </p>
                @endif
                <p class=" text-lg font-semibold uppercase">
                    Total: ${{ $order->total }}
                </p>
                <div class="cho-container">

                </div>
            </div>
        </div>
    </div>


    {{-- SDK MercadoPago.js V2 --}}
    <script src="https://sdk.mercadopago.com/js/v2"></script>

    <script>
        // Agrega credenciales de SDK
        const mp = new MercadoPago("{{ config('services.mercadopago.key') }}", {
            locale: 'es-AR'
        });

        // Inicializa el checkout
        mp.checkout({
            preference: {
                id: '{{ $preference->id }}'
            },
            render: {
                container: '.cho-container', // Indica el nombre de la clase donde se mostrará el botón de pago
                label: 'Pagar', // Cambia el texto del botón de pago (opcional)
            }
        });
    </script>

</x-app-layout>
