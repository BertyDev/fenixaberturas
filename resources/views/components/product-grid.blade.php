@props(['product'])

<li class=" bg-white rounded-lg shadow ">
    <article>
        <figure>
            <img class=" h-48 w-full rounded-t-lg object-cover object-center"
                src="{{ Storage::url($product->images->first()->url) }}" alt="">
        </figure>
        <div class="w-full py-4 px-6">
            <h1 class=" text-base font-semibold truncate">
                <a href="{{ route('products.show',$product) }}">
                    {{ $product->name }}
                </a>
            </h1>
            <p class=" text-sm font-bold text-trueGray-700">
                ${{ $product->price }}
            </p>
            <div class="flex items-center">
                <ul class="flex text-sm">
                    <li><i class="fas fa-star text-yellow-400 mr-1"></i></li>
                    <li><i class="fas fa-star text-yellow-400 mr-1"></i></li>
                    <li><i class="fas fa-star text-yellow-400 mr-1"></i></li>
                    <li><i class="fas fa-star text-yellow-400 mr-1"></i></li>
                    <li><i class="fas fa-star text-yellow-400 mr-1"></i></li>
                </ul>
                <span class=" text-gray-700 text-sm">(24)</span>
            </div>
            <div class=" mt-4 text-right md:text-left">
                <x-jet-danger-button >
                    <a href="{{ route('products.show', $product) }}">
                        Detalle
                    </a>
                </x-jet-danger-button>
            </div>
        </div>
        
    </article>
</li>