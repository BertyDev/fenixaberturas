<x-app-layout>
    <div class="container py-8">
    <ul >
        @forelse ($products as $product)
           <x-product-list :product="$product"/>

        @empty
        <li class=" bg-white rounded-lg shadow-2xl">
            <div class="p-4 justify-center items-center text-center">
                <i class="fas fa-exclamation-triangle text-yellow-400 text-9xl pb-8"></i>
                <p class=" text-lg font-semibold text-gray-700">
                    Ningún producto coincide con la busqueda...
                </p>
            </div>
        </li>

        @endforelse
    </ul>

    @if ($products->count())
    <div class=" text-xs mt-4">
        <small>{{ $products->links() }}</small>
    </div>
@endif
</div>
</x-app-layout>