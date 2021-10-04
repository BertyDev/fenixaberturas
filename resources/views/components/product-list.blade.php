@props(['product'])

<li class=" bg-white rounded-lg shadow mb-4 ">
    <article class="md:flex">
        <figure>
            <img class="h-48 w-full md:w-48 max-w-none rounded-t-lg md:rounded-l-lg object-cover object-center"
                src="{{ Storage::url($product->images->first()->url) }}" alt="">
        </figure>
        <div class=" py-4 px-6 flex-1 flex flex-col">
            <div class="lg:flex justify-between">
                <div>
                    <h1 class=" text-lg font-semibold text-gray-700 truncate">
                        <a href="{{ route('products.show',$product) }}">
                            {{ $product->name }}
                        </a>
                    </h1>
                    <p class=" text-sm font-bold text-trueGray-700">
                        ${{ $product->price }}
                    </p>

                </div>
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
            </div>
            <div class=" ml-auto md:ml-0 md:mt-auto md:mb-4">
                <x-jet-danger-button>
                    <a href="{{ route('products.show', $product) }}">
                        Detalle
                    </a>
                </x-jet-danger-button>
            </div>

        </div>
    </article>
</li>
