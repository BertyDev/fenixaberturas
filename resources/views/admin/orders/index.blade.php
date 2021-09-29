<x-admin-layout>
    <div class="container py-12 ">
        <section class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 lg:gap-6 text-white">

            {{-- <a href="{{ route('admin.orders.index') . '?status=1' }}"
                class="bg-gray-500 rounded-lg bg-opacity-75 px-4 lg:px-12 pt-8 pb-4 shadow-md ">
                <p class="text-center text-lg lg:text-2xl">
                    {{ $pendiente }}
                </p>
                <p class="text-center uppercase ">Pendiente</p>
                <p class="text-center text-lg lg:text-2xl mt-2">
                    <i class="fas fa-business-time"></i>
                </p>
            </a> --}}
            <a href="{{ route('admin.orders.index') . '?status=2' }}"
                class="bg-yellow-500 rounded-lg bg-opacity-75 px-4 lg:px-12 pt-8 pb-4 shadow-md">
                <p class="text-center text-2xl">
                    {{ $recibido }}
                </p>
                <p class="text-center uppercase ">Recibido</p>
                <p class="text-center text-lg lg:text-2xl mt-2">
                    <i class="fas fa-credit-card"></i>
                </p>
            </a>
            <a href="{{ route('admin.orders.index') . '?status=3' }}"
                class="bg-pink-500 rounded-lg bg-opacity-75 px-4 lg:px-12 pt-8 pb-4 shadow-md">
                <p class="text-center text-lg lg:text-2xl">
                    {{ $enviado }}
                </p>
                <p class="text-center uppercase ">Enviado</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-truck"></i>
                </p>
            </a>
            <a href="{{ route('admin.orders.index') . '?status=4' }}"
                class="bg-green-500 rounded-lg bg-opacity-75 px-4 lg:px-12 pt-8 pb-4 shadow-md">
                <p class="text-center text-lg lg:text-2xl">
                    {{ $entregado }}
                </p>
                <p class="text-center uppercase ">Entregado</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-check-circle"></i>
                </p>
            </a>
            <a href="{{ route('admin.orders.index') . '?status=5' }}"
                class="bg-red-500 rounded-lg bg-opacity-75 px-4 lg:px-12 pt-8 pb-4 shadow-md">
                <p class="text-center text-2xl">
                    {{ $anulado }}
                </p>
                <p class="text-center uppercase ">Anulado</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-times-circle"></i>
                </p>
            </a>

        </section>
        @if ($orders->count())
            <section class="bg-white rounded-lg shadow-lg py-8 px-12 mt-12   text-trueGray-700">
                <h1 class=" text-2xl mb-4 border-b border-gray-200">Pedidos recientes</h1>
                <ul>
                    @foreach ($orders as $order)
                        <li class="border-b border-gray-100 hover:border-gray-50 items-center ">
                            <a href="{{ route('admin.orders.show', $order) }}"
                                class="flex rounded-lg items-center py-2 px-4 hover:bg-gray-100 ">
                                <span class="w-12 text-center">
                                    @switch($order->status)
                                        @case(2)
                                            <i class="fas fa-credit-card text-yellow-500 opacity-50"></i>
                                        @break
                                        @case(3)
                                            <i class="fas fa-truck text-pink-500 opacity-50"></i>
                                        @break
                                        @case(4)
                                            <i class="fas fa-check-circle text-green-500 opacity-50"></i>
                                        @break
                                        @case(5)
                                            <i class="fas fa-times-circle text-red-500 opacity-50"></i>
                                        @break

                                        @default

                                    @endswitch
                                </span>
                                <span>
                                    Orden: {{ $order->id }}
                                    <br>
                                    {{ $order->created_at->format('d/m/Y') }}
                                </span>
                                <div class="ml-auto">
                                    <span class="font-bold">
                                        @switch($order->status)
                                            @case(2)
                                                Recibido
                                            @break
                                            @case(3)
                                                Enviado
                                            @break
                                            @case(4)
                                                Entregado
                                            @break
                                            @case(5)
                                                Anulado
                                            @break

                                            @default

                                        @endswitch
                                    </span>
                                    <br>
                                    <span class="text-sm">
                                        ${{ $order->total }}
                                    </span>
                                </div>
                                <span>
                                    <i class="fas fa-angle-right ml-4"></i>
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </section>
        @else
            <div class="bg-white rounded-lg shadow-lg py-8 px-12 mt-12  text-trueGray-700">
                <span class=" font-bold text-lg text-trueGray-600">
                    No existe registros de pedidos
                </span>
            </div>
        @endif

    </div>


</x-admin-layout>
