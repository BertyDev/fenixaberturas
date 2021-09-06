<div wire:init="loadaposts">
    @if (count($products))
    <div class="glider-contain">
        <ul class="glider-{{ $category->id }}">
            @foreach ($products as $product)
                <li class=" bg-white rounded-lg shadow  {{ $loop->last ? '' : 'sm:mr-4' }} ">
                    <article>
                        <figure>
                            <img class=" h-48 w-full md:h-36 md:w-56 rounded-t-lg object-cover object-center"
                                src="{{ Storage::url($product->images->first()->url) }}" alt="">
                        </figure>
                        <div class=" py-4 px-6">
                            <h1 class=" text-base font-semibold truncate">
                                <a href="{{ route('products.show',$product) }}">
                                    {{ $product->name }}
                                </a>
                            </h1>
                            <p class=" text-sm font-bold text-trueGray-700">
                                ${{ $product->price }}
                            </p>
                        </div>
                    </article>
                </li>
                
            @endforeach
        </ul>
        <button aria-label="Previous" class="glider-prev">«</button>
        <button aria-label="Next" class="glider-next">»</button>
        <div role="tablist" class="dots"></div>
    </div>
    @else
    <div class="mb-4 h-48 flex justify-center items-center bg-white shadow-xl border border-gray-100 rounded-lg">
        <div class="rounded-full animate-spin ease duration-75 w-20 h-20 border-b-2 border-blue-500"></div>
        {{-- <div class="animate-spin rounded-full ease duration-75 h-14 w-14 border-b-2 border-blue-500"></div> --}}

   </div>	
    @endif
</div>
