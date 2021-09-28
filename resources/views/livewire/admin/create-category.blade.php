<div>
    <x-jet-form-section submit="save" class="mb-6">
        <x-slot name="title">
            Crear nueva {{ __('Category') }}
        </x-slot>
        <x-slot name="description">
            Complete la informacion necesaria para poder creae una categoría
        </x-slot>
        <x-slot name="form">
            <div class=" col-span-6 sm:col-span-4">
                <x-jet-label>
                    {{ __('Name') }}
                </x-jet-label>
                <x-jet-input wire:model.debounce.500ms='createForm.name' type="text" class="w-full" />
                <x-jet-input-error for="createForm.name" />
            </div>
            <div class=" col-span-6 sm:col-span-4">
                <x-jet-label>
                    {{ __('Slug') }}
                </x-jet-label>
                <x-jet-input disabled wire:model.debounce.500ms='createForm.slug' type="text"
                    class="w-full bg-gray-100" />
                <x-jet-input-error for="createForm.slug" />
            </div>
            <div class=" col-span-6 sm:col-span-4">
                <x-jet-label>
                    {{ __('Ícono') }}
                </x-jet-label>
                <x-jet-input wire:model.defer='createForm.icon' type="text" class="w-full" />
                <x-jet-input-error for="createForm.icon" />
            </div>
            <div class=" col-span-6 sm:col-span-4">
                <x-jet-label>
                    {{ __('Brands') }}
                </x-jet-label>
                <div class="grid grid-cols-4">
                    @foreach ($brands as $brand)
                        <x-jet-label>
                            <x-jet-checkbox wire:model.defer='createForm.brands' name="brands[]"
                                value="{{ $brand->id }}" />
                            {{ $brand->name }}
                        </x-jet-label>
                    @endforeach
                </div>
                <x-jet-input-error for="createForm.brands" />
            </div>
            <div class=" col-span-6 sm:col-span-4">
                <x-jet-label>
                    {{ __('Image') }}
                </x-jet-label>
                <x-jet-input wire:model='createForm.image' accept="image/*" type="file" id="{{ $rand }}" />
                <x-jet-input-error for="createForm.image" />
            </div>
        </x-slot>
        <x-slot name="actions">
            <x-jet-action-message class="mr-3 text-green-500 font-medium" on="saved">
                {{ __('Created.') }}
            </x-jet-action-message>
            <x-jet-button class="bg-blue-600 hover:bg-blue-500">
                agregar
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>

    <x-jet-action-section>
        <x-slot name="title">
            Listado de Categorias
        </x-slot>
        <x-slot name="description">
            Aquí encontrara todas las categorías agregadas
        </x-slot>
        <x-slot name="content">
            <table class="text-trueGray-700">
                <thead class=" border-b border-trueGray-300">
                    <tr class="">
                        <th class=" py-2 w-full text-left">Nombre</th>
                        <th class="py-2 text-center">Accion</th>
                    </tr>

                </thead>
                <tbody class=" divide-y divide-gray-300">
                    @foreach ($categories as $category)
                        <tr>
                            <td class="py-2">
                                <span
                                    class=" inline-block w-8 text-center mr-2 text-blue-500">{!! $category->icon !!}</span>
                                <a class=" underline hover:text-blue-600 uppercase" 
                                href="{{ route('admin.categories.show', $category) }}">{{ $category->name }}</a>
                            </td>
                            <td class="py-2">
                                <div class="flex divide-x divide-gray-300 font-semibold"
                                    wire:key='{{ 'category-' . $category->id }}'>
                                    <a class="pr-2 hover:text-blue-600 cursor-pointer" wire:loading.attr='disabled'
                                        wire:target="edit('{{ $category->slug }}')"
                                        wire:click="edit('{{ $category->slug }}')">{{ __('Edit') }}</a>

                                    <a wire:click="confirCategorytDelete('{{ $category->slug }}')"
                                        wire:loading.attr='disabled'
                                        wire:target="confirCategorytDelete('{{ $category->slug }}')"
                                        class="pl-2 hover:text-red-600 cursor-pointer">{{ __('Delete') }}</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-jet-action-section>

    <x-jet-dialog-modal wire:model='editForm.open'>
        <x-slot name="title">
            {{ __('Edit') }} {{ __('Category') }}
        </x-slot>

        <x-slot name="content">
            <div class="space-y-3">
                <div>
                    @if ($editImage)
                        <img class="w-full h-64 object-cover object-center" src="{{ $editImage->temporaryUrl() }}"
                            alt="{{ $editForm['name'] }}">
                    @else
                        <img class="w-full h-64 object-cover object-center"
                            src="{{ Storage::url($editForm['image']) }}" alt="{{ $editForm['name'] }}">
                    @endif

                </div>

                <div>
                    <x-jet-label>
                        {{ __('Name') }}
                    </x-jet-label>
                    <x-jet-input wire:model='editForm.name' type="text" class="w-full" />
                    <x-jet-input-error for="editForm.name" />
                </div>
                <div>
                    <x-jet-label>
                        {{ __('Slug') }}
                    </x-jet-label>
                    <x-jet-input disabled wire:model='editForm.slug' type="text"
                        class="w-full bg-gray-100" />
                    <x-jet-input-error for="editForm.slug" />
                </div>
                <div>
                    <x-jet-label>
                        {{ __('Ícono') }}
                    </x-jet-label>
                    <x-jet-input wire:model.defer='editForm.icon' type="text" class="w-full" />
                    <x-jet-input-error for="editForm.icon" />
                </div>
                <div>
                    <x-jet-label>
                        {{ __('Brands') }}
                    </x-jet-label>
                    <div class="grid grid-cols-4">
                        @foreach ($brands as $key => $brand)
                            <x-jet-label>
                                <x-jet-checkbox wire:key='brands_id-{{ $brand->id }}'
                                    wire:model.defer='editForm.brands.{{ $key }}' value="{{ $brand->id }}"
                                    name="brands[]"  />
                                {{ $brand->name }}
                            </x-jet-label>
                        @endforeach
                    </div>
                    <x-jet-input-error for="editForm.brands" />
                </div>
                <div>
                    <x-jet-label>
                        {{ __('Image') }}
                    </x-jet-label>
                    <x-jet-input wire:model='editImage' accept="image/*" type="file" id="{{ $rand }}" />
                    <x-jet-input-error for="editImage" />
                </div>

            </div>

        </x-slot>
        <x-slot name="footer">
            <x-jet-danger-button wire:click="update" wire:loading.attr='disabled' wire:target='editImage,update'>
                actualizar
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-confirmation-modal wire:model="open_confir" maxWidth="md">
        <x-slot name="title">
            Eliminar {{ __('Category') }}
        </x-slot>
        <x-slot name="content">
            <h2 class="text-base">¿Esta seguro de realizar esta accion?</h2>
            <p class="text-sm text-center">no se puede revertir!!!</p>

        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open_confir',false)">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click='delete' wire:loading.attr='disabled' wire:target='delete'>
                eliminar
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>

</div>
