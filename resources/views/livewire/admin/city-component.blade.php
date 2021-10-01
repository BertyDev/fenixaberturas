<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
            {{ __('Match') }}: {{ $city->name }}
        </h2>
    </x-slot>
    <div class=" container py-12">
        {{-- agregar Partidos --}}
        <x-jet-form-section submit="save" class="mb-6">

            <x-slot name="title">
                {{ __('Add') }} {{ __('Location') }}
            </x-slot>
            <x-slot name="description">
                complete la información necesaria para poder agregar {{ __('Location') }}
            </x-slot>
            <x-slot name="form">
                <div class=" col-span-6 sm:col-span-5">
                    <x-jet-label>
                        {{ __('Name') }}
                    </x-jet-label>
                    <x-jet-input type="text" wire:model.defer='createForm.name' class="w-full" />
                    <x-jet-input-error for="createForm.name" />
                </div>
            </x-slot>
            <x-slot name="actions">
                <x-jet-action-message class="mr-3 text-green-500 font-medium" on="saved">
                    {{ __('Location') }} {{ __('Created.') }}
                </x-jet-action-message>
                <x-jet-button class="bg-blue-600 hover:bg-blue-500">
                    {{ __('Add') }}
                </x-jet-button>
            </x-slot>
        </x-jet-form-section>
        {{-- Mostrar Provincia --}}
        <x-jet-action-section>
            <x-slot name="title">
                Listado de {{ __('Locations') }}
            </x-slot>
            <x-slot name="description">
                Aquí encontrara todas las {{ __('Locations') }} agregadas
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
                        @foreach ($districts as $district)
                            <tr>
                                <td class="py-2">

                                    <a 
                                        class=" uppercase">{{ $district->name }}</a>
                                </td>
                                <td class="py-2">
                                    <div class="flex divide-x divide-gray-300 font-semibold"
                                        wire:key='{{ 'district-' . $district->id }}'>
                                        <a class="pr-2 hover:text-blue-600 cursor-pointer" wire:loading.attr='disabled'
                                            wire:target="edit('{{ $district->id }}')"
                                            wire:click="edit('{{ $district->id }}')">{{ __('Edit') }}</a>

                                        <a wire:click="confirdistrictDelete('{{ $district->id }}')"
                                            wire:loading.attr='disabled'
                                            wire:target="confirdistrictDelete('{{ $district->id }}')"
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
                {{ __('Edit') }} {{ __('Location') }}
            </x-slot>
            <x-slot name="content">
                <div class="space-y-3">
                    <div>
                        <x-jet-label>
                            {{ __('Name') }}
                        </x-jet-label>
                        <x-jet-input wire:model.defer='editForm.name' type="text" class="w-full" />
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
        {{-- Modal eliminar --}}
        <x-jet-confirmation-modal wire:model="open_confir" maxWidth="md">
            <x-slot name="title">
                Eliminar {{ __('Location') }}
            </x-slot>
            <x-slot name="content">
                <h2 class="text-base">¿Esta seguro de realizar esta accion?</h2>
                <p class="text-sm text-center">no se puede revertir!!!</p>

            </x-slot>
            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$set('open_confir',false)">
                    Cancelar
                </x-jet-secondary-button>
                <x-jet-danger-button wire:click="delete" wire:loading.attr='disabled' wire:target="delete">
                    eliminar
                </x-jet-danger-button>
            </x-slot>
        </x-jet-confirmation-modal>
    </div>
</div>
