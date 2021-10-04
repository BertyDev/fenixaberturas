<div>
    <div class=" bg-white rounded-lg shadow-md mb-6">
        <div class="px-6 py-2 flex justify-between items-center">
            <h1 class=" font-semibold text-gray-700 uppercase">
                {{ $category->name }}
            </h1>
            <div class="hidden  md:grid grid-cols-2 border   border-gray-200 divide-x divide-gray-200 text-gray-500">
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

            <h2 class="bg-blue-700 rounded-lg shadow-md  text-white font-semibold text-center mb-2 px-2 py-1 ">
                SubCategorias</h2>
            <ul class="text-center bg-white rounded-lg shadow-lg  divide-y divide-gray-200">
                @foreach ($category->subcategories as $subcategory)
                    <li class="py-2 text-sm ">
                        <a wire:click="$set('subcategoryh','{{ $subcategory->slug }}')"
                            class=" cursor-pointer hover:text-blue-500 capitalize 
                        {{ $subcategoryh == $subcategory->slug ? 'text-blue-500 font-semibold' : '' }}">
                            {{ $subcategory->name }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <h2 class="bg-blue-700 rounded-lg shadow-md  text-white font-semibold text-center mb-2 px-2 py-1 mt-4 ">
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
            <x-jet-button wire:click="resetFilter" class="mt-4 w-full justify-center bg-red-700 hover:bg-red-500">
                Eliminar Filtros
            </x-jet-button>
        </aside>
        <div class=" md:col-span-2 lg:col-span-4">
            @if ($view == 'grid')
                <ul class=" grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($products as $product)
                        <x-product-grid :product="$product" />
                    @empty
                        <li class=" col-span-1 md:col-span-2 lg:col-span-4">
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative col-span-4"
                                role="alert">
                                <strong class="font-bold">{{ __('No Results Found.') }}</strong>
                                <span class="block sm:inline">No existen productos con los parametros
                                    seleccionados</span>
                                <span class="absolute top-0 bottom-0 right-0 px-4 py-3" wire:click='resetFilter'>
                                    <svg class="fill-current h-6 w-6 text-red-500" role="button"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <title>{{ __('Close') }}</title>
                                        <path
                                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                                    </svg>
                                </span>
                            </div>
                        </li>
                    @endforelse
                </ul>
            @else
                <ul>
                    @forelse ($products as $product)
                        <x-product-list :product="$product" />
                    @empty
                        <li>
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative "
                                role="alert">
                                <strong class="font-bold">{{ __('No Results Found.') }}</strong>
                                <span class="block sm:inline">No existen productos con los parametros
                                    seleccionados</span>
                                <span class="absolute top-0 bottom-0 right-0 px-4 py-3" wire:click='resetFilter'>
                                    <svg class="fill-current h-6 w-6 text-red-500" role="button"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <title>{{ __('Close') }}</title>
                                        <path
                                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                                    </svg>
                                </span>
                            </div>
                        </li>
                    @endforelse
                </ul>
            @endif
            <div class="py-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
