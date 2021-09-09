<div>
    <div class=" bg-white rounded-lg shadow-md mb-6">
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

            <h2 class="bg-blue-700 rounded-lg shadow-md  text-white font-semibold text-center mb-2 px-2 py-1 ">
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
                <ul class=" grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @forelse ($products as $product)
                    <x-product-grid :product="$product"/>
                        @empty
                        <div class="bg-red-400 rounded-lg shadow-md mb-6 px-6 py-2 flex text-center justify-center items-center w-full md:col-span-2 lg:col-span-4">
                       <p class="font-semibold text-gray-100 uppercase"> El filtro no arrojo resultados</p>
                    </div>
                    @endforelse
                </ul>
            @else
                <ul>
                    @forelse ($products as $product)
                    <x-product-list :product="$product"/>
                        @empty
                        <div class="bg-red-400 rounded-lg shadow-md mb-6 px-6 py-2 flex text-center justify-center items-center w-full md:col-span-2 lg:col-span-4">
                       <p class="font-semibold text-gray-100 uppercase"> El filtro no arrojo resultados</p>
                    </div>
                    @endforelse
                </ul>


            @endif
            <div class="py-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
