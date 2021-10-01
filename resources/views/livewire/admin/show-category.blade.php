<div class="container py-12">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
            {{ $category->name}}
        </h2>
    </x-slot>
    {{-- Formulario crear categoría --}}
    <x-jet-form-section submit="save" class="mb-6">
        <x-slot name="title">
            Crear nueva {{ __('Subcategory') }}
        </x-slot>
        <x-slot name="description">
            Complete la informacion necesaria para poder crear una subcategoría
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
                <div class="flex items-center">
                    <p>¿Esta subcategoría necesita especificar color?</p>
                    <div class="ml-auto">
                        <label>
                            <input wire:model.defer="createForm.color" type="radio" name="color" value="1">
                            SI
                        </label>
                        <label>
                            <input wire:model.defer="createForm.color" type="radio" name="color" value="0">
                            NO
                        </label>
                    </div>
                </div>
                <x-jet-input-error for="createForm.color" />
            </div>
            <div class=" col-span-6 sm:col-span-4">
                <div class="flex items-center">
                    <p>¿Esta subcategoría necesita especificar medida?</p>
                    <div class="ml-auto">
                        <label>
                            <input wire:model.defer="createForm.size" type="radio" name="size" value="1">
                            SI
                        </label>
                        <label>
                            <input wire:model.defer="createForm.size" type="radio" name="size" value="0">
                            NO
                        </label>
                    </div>
                </div>
                <x-jet-input-error for="createForm.size" />
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
    {{-- lista de categoría --}}
    <x-jet-action-section>
        <x-slot name="title">
            Listado de {{ __('Subcategory') }}
        </x-slot>
        <x-slot name="description">
            Aquí encontrara todas las subcategorías agregadas
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
                    @foreach ($subcategories as $subcategory)
                        <tr>
                            <td class="py-2">
                                <span class="  uppercase">{{ $subcategory->name }}</span>
                            </td>
                            <td class="py-2">
                                <div class="flex divide-x divide-gray-300 font-semibold"
                                    wire:key='{{ 'subcategory-' . $subcategory->id }}'>
                                    <a class="pr-2 hover:text-blue-600 cursor-pointer" wire:loading.attr='disabled'
                                        wire:target="edit('{{ $subcategory->id }}')"
                                        wire:click="edit('{{ $subcategory->id }}')">{{ __('Edit') }}</a>

                                    <a wire:click="confirsubcategorytDelete({{ $subcategory->id }})"
                                        wire:loading.attr='disabled'
                                        wire:target='confirsubcategorytDelete({{ $subcategory->id }})'
                                        class="pl-2 hover:text-red-600 cursor-pointer">{{ __('Delete') }}</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-jet-action-section>
    {{-- Modal editar --}}
    <x-jet-dialog-modal wire:model='editForm.open'>
        <x-slot name="title">
            {{ __('Edit') }} {{ __('Subcategory') }}
        </x-slot>

        <x-slot name="content">
            <div class="space-y-3">

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
                    <x-jet-input disabled wire:model='editForm.slug' type="text" class="w-full bg-gray-100" />
                    <x-jet-input-error for="editForm.slug" />
                </div>
                <div>
                    <div class="flex items-center">
                        <p>¿Esta subcategoría necesita especificar color?</p>
                        <div class="ml-auto">
                            <label>
                                <input wire:model.defer="editForm.color" type="radio" name="color" value="1">
                                SI
                            </label>
                            <label>
                                <input wire:model.defer="editForm.color" type="radio" name="color" value="0">
                                NO
                            </label>
                        </div>
                    </div>
                    <x-jet-input-error for="createForm.color" />
                </div>
                <div>
                    <div class="flex items-center">
                        <p>¿Esta subcategoría necesita especificar medida?</p>
                        <div class="ml-auto">
                            <label>
                                <input wire:model.defer="editForm.size" type="radio" name="size" value="1">
                                SI
                            </label>
                            <label>
                                <input wire:model.defer="editForm.size" type="radio" name="size" value="0">
                                NO
                            </label>
                        </div>
                    </div>
                    <x-jet-input-error for="createForm.size" />
                </div>

            </div>

        </x-slot>
        <x-slot name="footer">
            <x-jet-danger-button wire:click="update" wire:loading.attr='disabled' wire:target='update'>
                actualizar
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
    {{-- Modal confirmar eliminar --}}
    <x-jet-confirmation-modal wire:model="open_confir" maxWidth="md">
        <x-slot name="title">
            Eliminar {{ __('Subcategory') }}
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
