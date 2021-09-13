<div class="flex-1 relative z-40" x-data>
<form action="{{ route('search') }}" autocomplete="off">
    <x-jet-input name="name" wire:model.debounce.500ms="search" type="text" class="w-full mx-2 md:mx-0" placeholder="Buscar Producto" />
    <button class=" absolute top-0 right-0 w-12 h-full flex items-center justify-center">
        <x-search size="2xl" color="500" />
    </button>
</form>
    <div class="absolute w-full mt-1 hidden" :class="{'hidden' : !$wire.open}" @click.away="$wire.open = false">
        <div class=" bg-white rounded-lg shadow-lg ">
            <div class="px-4 py-3 items-center justify-center ">
                @forelse ($products as $product)
                    <a href="{{ route('products.show',$product) }}" class="flex border-b-2 border-trueGray-100 }} py-1">
                        <img class="w-16 h-12 object-cover" src="{{ Storage::url($product->images->first()->url) }}"
                            alt="">
                        <div class=" ml-4 text-trueGray-700 leading-5">
                            <p class="text-lg font-semibold">
                                {{ $product->name }}
                            </p>
                            <p>Categoria: {{ $product->subcategory->category->name }}</p>
                        </div>
                    </a>

                @empty
                    <p class="text-base font-medium leading-5">
                        No existe ningún registro con los parametros especificados...
                    </p>
                @endforelse
                @if (count($products))
                    <div class=" text-xs pt-4">
                        <small>{{ $products->links() }}</small>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
