<div>
    @php
        // SDK de Mercado Pago
        require base_path('/vendor/autoload.php');
        // Agrega credenciales
        MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));
        
        // Crea un objeto de preferencia
        $preference = new MercadoPago\Preference();
        
        $shipments = new MercadoPago\Shipments();
        
        $shipments->cost = $order->shipping_cost;
        $shipments->mode = 'not_specified';
        
        $preference->shipments = $shipments;
        
        // Crea un ítem en la preferencia
        foreach ($items as $product) {
            $item = new MercadoPago\Item();
            $item->title = $product->name;
            $item->quantity = $product->qty;
            $item->unit_price = $product->price;
        
            $products[] = $item;
        }
        
        $preference->back_urls = [
            'success' => route('orders.pay', $order),
            'failure' => 'http://www.tu-sitio/failure',
            'pending' => 'http://www.tu-sitio/pending',
        ];
        $preference->auto_return = 'approved';
        // ...
        
        $preference->items = $products;
        $preference->save();
        
    @endphp
    <div class="container py-8">
        <div class="px-6 py-4 mb-6 bg-white rounded-lg shadow-lg ">
            <p class="text-gray-700 uppercase">
                <span class="font-bold ">
                    Numero de orden:
                </span>
                Orden-{{ $order->id }}
            </p>
        </div>
        <div class="p-6 mb-6 bg-white rounded-lg shadow-lg ">
            <div class="grid grid-cols-1 gap-6 text-gray-700 md:grid-cols-2 md:divide-x-2 md:divide-gray-300 md:divide-dotted">
                <div>
                    <p class="text-lg font-semibold uppercase ">Envío</p>
                    @if ($order->envio_type == 1)
                        <p class="text-sm "> Los productos deben ser recogidos en el Local</p>
                        <p class="text-sm ">Calle del Local</p>
                    @else
                        <p class="text-sm ">Los productos serán enviados:</p>
                        <p class="text-sm ">{{ $envio->adress }}</p>
                        <p>{{ $envio->department }} - {{ $envio->city }} -
                            {{ $envio->district }}</p>
                    @endif
                </div>
                <div class="md:pl-2">
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
        <div class="flex items-center justify-between p-6 mb-6 text-gray-700 bg-white rounded-lg shadow-lg">
            <img class="h-8" src="{{ asset('img/PAGOS_EN_LINEA.png') }}" alt="">
            <div>
                <p class="pb-1 text-xs font-semibold">
                    SubTotal: ${{ $order->total - $order->shipping_cost }}
                </p>
                @if ($order->shipping_cost > 0)
                    <p class="pb-1 text-xs font-semibold">
                        Envio: ${{ $order->shipping_cost }}
                    </p>
                @endif
                <p class="text-lg font-semibold uppercase ">
                    Total: ${{ $order->total }}
                </p>
                <div class="w-full cho-container">

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
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
    @endpush

</div>
