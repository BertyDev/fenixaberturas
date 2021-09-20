<div>
    <div class="my-12 bg-gray-50 shadow-xl rounded-lg p-6">

        {{-- Color Producto --}}
        <div class="mb-4">
            <x-jet-label value="{{ __('Colour') }}" />
            <div class="grid grid-cols-6 gap-6">
                @foreach ($colors as $color)
                    <label class="flex">
                        <input wire:model.lazy="color_id" type="radio" name="color_id" value="{{ $color->id }}">
                        <span class="ml-1 text-trueGray-700 capitalize">
                            {{ __($color->name) }}
                        </span>
                    </label>
                @endforeach
            </div>
            <x-jet-input-error for="color_id" />
        </div>

        {{-- Cantidad --}}
        <div class="mb-4">
            <x-jet-label>
                {{ __('Amount') }}
            </x-jet-label>

            <x-jet-input class="w-full" placeholder="Ingrese una cantidad" wire:model.lazy="quantity"
                type="number" />
            <x-jet-input-error for="quantity" />
        </div>
        <div class="flex justify-end items-center">

            <x-jet-action-message class="mr-3 text-green-500 font-medium" on="saved">
                {{ __('Added.') }}
            </x-jet-action-message>

            <x-jet-button class=" bg-blue-600 hover:bg-blue-500" wire:click='save' wire:loading.attr='disabled'
                wire:target='save'>
                {{ __('Add') }}
            </x-jet-button>
        </div>
    </div>

    @if ($product->colors->count())
    <div class=" bg-gray-50 shadow-xl rounded-lg p-6">
        <table class=" w-full text-left">
            <thead>
                <tr>
                    <th class="px-4 py-2  w-1/3">
                        color
                    </th>
                    <th class="px-4 py-2  w-1/3">
                        cantidad
                    </th>
                    <th class="px-4 py-2  w-1/3">
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product->colors as $product_color)
                    <tr wire:key='product_color-{{ $product_color->pivot->id }}'>
                        <td class=" capitalize px-4 py-2 ">
                            {{ __($colors->find($product_color->pivot->color_id)->name) }}
                        </td>
                        <td class=" capitalize px-4 py-2 ">
                            {{ $product_color->pivot->quantity }} unid.
                        </td>
                        <td class="py-2 flex w-full">
                            <x-jet-secondary-button wire:click="edit({{ $product_color->pivot->id }})"
                                wire:loading.attr='disabled' wire:target='edit({{ $product_color->pivot->id }})'
                                class="ml-auto mr-2">
                                actualizar
                            </x-jet-secondary-button>
                            <x-jet-danger-button wire:click="confirUserDelete({{ $product_color->pivot->id }})"
                                wire:loading.attr='disabled'
                                wire:target='confirUserDelete({{ $product_color->pivot->id }})'>
                                eliminar
                            </x-jet-danger-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Editar Colores
        </x-slot>
        <x-slot name="content">
            <div class=" mb-4">
                <x-jet-label>
                    Color
                </x-jet-label>
                <select class="form-control w-full" wire:model="pivot_color_id">
                    <option value="" selected disabled>Seleccione Color</option>
                    @foreach ($colors as $color)
                        <option value="{{ $color->id }}">{{ __($color->name) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <x-jet-label>
                    Cantidad
                </x-jet-label>
                <x-jet-input wire:model="pivot_quantity" class="w-full" type="number"
                    placeholder="Ingrese una cantidad" />
            </div>

        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open',false)">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-button class="bg-blue-600 hover:bg-blue-500" wire:click='update' wire:loading.attr='disabled'
                wire:target='update'>
                Actualizar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-confirmation-modal wire:model="open_confir" maxWidth="md">
        <x-slot name="title">
            Eliminar Color
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
