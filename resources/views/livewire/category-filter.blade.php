<div>
    <div class=" bg-white rounded-lg shadow-lg mb-6">
        <div class="px-6 py-2 flex justify-between items-center">
            <h1 class=" font-semibold text-gray-700 uppercase">
                {{ $category->name }}
            </h1>
            <div class="grid grid-cols-2 border border-gray-200 divide-x divide-gray-200 text-gray-500">
                <i wire:click="$set('view', 'grid')"
                    class="fas fa-border-all p-2 cursor-pointer
                {{ $view == 'grid' ? 'text-blue-500' : '' }}
                "></i>
                <i wire:click="$set('view', 'list')"
                    class="fas fa-th-list p-2 cursor-pointer
                {{ $view == 'list' ? 'text-blue-500' : '' }}
                "></i>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
        <aside>

            <h2 class="bg-blue-700 rounded-lg shadow-lg  text-white font-semibold text-center mb-2 px-2 py-1 ">
                SubCategorias</h2>
            <ul class="text-center bg-white rounded-lg shadow-lg  divide-y divide-gray-200">
                @foreach ($category->subcategories as $subcategory)
                    <li class="py-2 text-sm ">
                        <a wire:click="$set('subcategoryh','{{ $subcategory->name }}')"
                            class=" cursor-pointer hover:text-blue-500 capitalize 
                        {{ $subcategoryh == $subcategory->name ? 'text-blue-500 font-semibold' : '' }}">
                            {{ $subcategory->name }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <h2 class="bg-blue-700 rounded-lg shadow-lg  text-white font-semibold text-center mb-2 px-2 py-1 mt-4 ">
                Marcas</h2>
            <ul class="text-center bg-white rounded-lg shadow-lg  divide-y divide-gray-200">
                @foreach ($category->brands as $brand)
                    <li class="py-2 text-sm ">
                        <a wire:click="$set('brandh','{{ $brand->name }}')"
                            class=" cursor-pointer hover:text-blue-500 capitalize
                        {{ $brandh == $brand->name ? 'text-blue-500 font-semibold' : '' }}">
                            {{ $brand->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
            <x-jet-button wire:click="resetFilter" class="mt-4 w-full justify-center bg-red-800 hover:bg-red-600">
                Eliminar Filtros
            </x-jet-button>
        </aside>
        <div class=" md:col-span-2 lg:col-span-4">
            @if ($view == 'grid')
                <ul class=" grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($products as $product)
                        <li class=" bg-white rounded-lg shadow ">
                            <article>
                                <figure>
                                    <img class=" h-48 w-full rounded-t-lg object-cover object-center"
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
            @else
                <ul>
                    @foreach ($products as $product)
                        <li class=" bg-white rounded-lg shadow mb-4 ">
                            <article class="flex">
                                <figure>
                                    <img class="h-48 w-48 max-w-none rounded-l-lg object-cover object-center"
                                        src="{{ Storage::url($product->images->first()->url) }}" alt="">
                                </figure>
                                <div class=" py-4 px-6 flex-1 flex flex-col">
                                    <div class="flex justify-between">
                                        <div>
                                            <h1 class=" text-lg font-semibold text-gray-700 truncate">
                                                <a href="">
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
                                    <div class="mt-auto mb-4">
                                        <x-jet-danger-button>
                                            <a href="{{ route('products.show',$product) }}">
                                            Detalle
                                            </a>
                                        </x-jet-danger-button>
                                    </div>

                                </div>
                            </article>
                        </li>
                    @endforeach
                </ul>


            @endif
            <div class="py-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
