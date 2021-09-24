<div class="my-4">
    <div class=" bg-gray-100 shadow-lg rounded-lg p-6 ">

        {{-- Color Producto --}}
        <div class="mb-4 ">
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
        <div class="mb-4 ">
            <x-jet-label>
                {{ __('Amount') }}
            </x-jet-label>

            <x-jet-input class="w-full" placeholder="Ingrese una cantidad" wire:model.lazy="quantity"
                type="number" />
            <x-jet-input-error for="quantity" />
        </div>
        <div class="flex justify-end items-center">
            <x-jet-action-message class=" mr-2 text-green-500 font-medium" on="saved">
                {{ __('Added.') }}
            </x-jet-action-message>
            <x-jet-button class=" bg-blue-600 hover:bg-blue-500 " wire:click='save' wire:loading.attr='disabled'
                wire:target='save'>
                {{ __('Add') }}
            </x-jet-button>
        </div>
    </div>
    @if ($size_colors->count())
        <div class=" mt-4 px-6">
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
                    @foreach ($size_colors as $size_color)
                        <tr wire:key='size_color-{{ $size_color->pivot->id }}'>
                            <td class=" capitalize px-2 py-1 ">
                                {{ __($colors->find($size_color->pivot->color_id)->name) }}
                            </td>
                            <td class=" capitalize px-2 py-1 ">
                                {{ $size_color->pivot->quantity }} unid.
                            </td>
                            <td class="py-1 flex w-full">

                                <x-jet-danger-button class="ml-auto"
                                    wire:click="confirColorDelete({{ $size_color->pivot->id }})"
                                    wire:loading.attr='disabled'
                                    wire:target='confirColorDelete({{ $size_color->pivot->id }})'>
                                    eliminar
                                </x-jet-danger-button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    <x-jet-confirmation-modal wire:model="open_confir" maxWidth="md">
        <x-slot name="title">
            Eliminar Color asociado a la talla
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
