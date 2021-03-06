<div x-data>
    <p class=" text-xl text-trueGray-700">color:</p>

    <select wire:model.debounce.500ms="color_id" class="form-control w-full">
        <option value="" selected disabled>Selecionar un color</option>
        @foreach ($colors as $color)
            <option value="{{ $color->id }}">{{ __($color->name) }}</option>
        @endforeach
    </select>

    <p class=" text-trueGray-700 my-4">

        <span class="font-semibold text-lg">Stock disponible: </span>
        @if ($quantity)
        {{ $quantity }}
        @else
        {{ $product->stock }}
        @endif
    </p>

    <div class="flex mt-4">
        <div>
            <x-jet-secondary-button {{-- x-bind:class="{'bg-gray-300':$wire.qty <= 1}" --}} x-bind:disabled="$wire.qty <= 1" wire:loading.attr="disabled"
                wire:loading.class="bg-gray-300" wire:target="decrement" wire:click="decrement">
                -
            </x-jet-secondary-button>
            <span class="mx-2 text-trueGray-700">
                {{ $qty }}
            </span>
            <x-jet-secondary-button {{-- x-bind:class="{'bg-gray-300':$wire.qty >= $wire.quantity}" --}} x-bind:disabled="$wire.qty >= $wire.quantity"
                wire:loading.attr="disabled" wire:loading.class="bg-gray-300" wire:target="increment"
                wire:click="increment">
                +
            </x-jet-secondary-button>
        </div>
        <div class="flex-1 ml-4">
            <x-button x-bind:disabled="$wire.qty > $wire.quantity" x-bind:disabled="!$wire.quantity" color="blue"
                wire:click="addItem" wire:loading.attr="disabled" wire.target="addItem" class="w-full">
                agregar al carrito
            </x-button>

        </div>
    </div>

</div>
