<div class="py-12 container ">
    {{-- formulario crear marcas --}}
    <x-jet-form-section submit="save" class="mb-6">
        <x-slot name="title">
            Agregar nueva marca
        </x-slot>
        <x-slot name="description">
            En esta sección podrá agregar nuevas marcas
        </x-slot>
        <x-slot name="form">
            <div class=" col-span-6 sm:col-span-5">
                <x-jet-label>
                    Nombre
                </x-jet-label>
                <x-jet-input type="text" wire:model.debounce.500ms='createForm.name' class="w-full" />
                <x-jet-input-error for="createForm.name" />
            </div>
        </x-slot>
        <x-slot name="actions">
            <x-jet-button class="bg-blue-600 hover:bg-blue-500">
                agregar
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>
    {{-- lista de marcas --}}
    <x-jet-action-section>
        <x-slot name="title">
            Listado de {{ __('Brands') }}
        </x-slot>
        <x-slot name="description">
            Aquí encontrara todas las marcas agregadas
        </x-slot>
        <x-slot name="content">
            <table class="text-trueGray-700">
                <thead class=" border-b border-trueGray-200">
                    <tr class="">
                    <th class=" py-2 w-full text-left">Nombre</th>
                        <th class="py-2 text-center">Accion</th>
                    </tr>
                </thead>
                <tbody class=" divide-y divide-gray-200 border-b border-trueGray-200">
                    @foreach ($brands as $brand)
                        <tr>
                            <td class="py-2">
                                <span class="uppercase">{{ $brand->name }}</span>
                            </td>
                            <td class="py-2">
                                <div class="flex divide-x divide-gray-200 font-semibold"
                                    wire:key='{{ 'brand-' . $brand->id }}'>
                                    <a class="pr-2 hover:text-blue-600 cursor-pointer" wire:loading.attr='disabled'
                                        wire:target="edit('{{ $brand->id }}')"
                                        wire:click="edit('{{ $brand->id }}')">{{ __('Edit') }}</a>

                                    <a wire:click="confirBrandDelete" wire:loading.attr='disabled'
                                        wire:target='confirBrandDelete'
                                        class="pl-2 hover:text-red-600 cursor-pointer">{{ __('Delete') }}</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="  pt-4">
                {{ $brands->links() }}
            </div>
           
        </x-slot>
    </x-jet-action-section>
    {{-- modal editar marca --}}
    <x-jet-dialog-modal wire:model='editForm.open' maxWidth="md">
        <x-slot name="title">
            {{ __('Edit') }} {{ __('Brand') }}
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
            Eliminar {{ __('Brand') }}
        </x-slot>
        <x-slot name="content">
            <h2 class="text-base">¿Esta seguro de realizar esta accion?</h2>
            <p class="text-sm text-center">no se puede revertir!!!</p>

        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open_confir',false)">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="delete('{{ $brand->id }}')" wire:loading.attr='disabled'
                wire:target="delete('{{ $brand->id }}')">
                eliminar
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>
