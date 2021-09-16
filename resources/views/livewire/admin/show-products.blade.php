<div>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class=" font-semibold text-lg text-trueGray-500 leading-tight">
                Lista de Productos
            </h2>
            <x-button class="ml-auto bg-green-600 hover:bg-green-400">
                <a href="{{ route('admin.products.create') }}" class="w-full h-full">
                    Agregar Producto
                </a>
            </x-button>
        </div>
    </x-slot>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <x-table-responsive>
        <div class="px-6 py-4 ">
            <x-jet-input wire:model.debounce.1s='search' class="form-control w-full" type="text"
                placeholder="Ingrese el nombre del producto que desea buscar" />
        </div>
        @if ($products->count())
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('Name') }}
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('Category') }}
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('Status') }}
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('Price') }}
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">{{ __('Edit') }}</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($products as $product)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-lg object-cover"
                                            src="{{ Storage::url($product->images->first()->url) }}"
                                            alt="imagen del producto {{ $product->name }}">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $product->name }}
                                        </div>
                                        {{-- <div class="text-sm text-gray-500">
                                    jane.cooper@example.com
                                </div> --}}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $product->subcategory->category->name }}
                                </div>
                                {{-- <div class="text-sm text-gray-500">Optimization</div> --}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($product->status == 2)
                                    <span
                                        class="px-2 inline-flex -ml-2 text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ __('Published') }}
                                    </span>
                                @else
                                    <span
                                        class="px-2 inline-flex -ml-2 text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        {{ __('Draft') }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                ${{ $product->price }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.products.edit', $product) }}"
                                    class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            </td>
                        </tr>
                    @endforeach


                    <!-- More people... -->
                </tbody>
            </table>
        @else
            <div class="px-6 py-4">
                No hay nungún registro coincidente
            </div>
        @endif

        @if ($products->hasPages())
            <div class="px-6 py-4">
                {{ $products->links() }}
            </div>
        @endif
    </x-table-responsive>
</div>
