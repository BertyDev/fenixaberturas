<div x-data>

    <p class=" text-trueGray-700 mb-4">
        
    <span class="font-semibold text-lg">Stock disponible: </span>{{ $quantity }}
    
    </p>
    <div class="flex">
        <div>
            <x-jet-secondary-button 
            {{-- x-bind:class="{'bg-gray-300':$wire.qty <= 1}" --}}
            x-bind:disabled="$wire.qty <= 1"
            wire:loading.attr="disabled"
            wire:loading.class="bg-gray-300"
            wire:target="decrement"
            wire:click="decrement">
                -
            </x-jet-secondary-button>
            <span class="mx-2 text-trueGray-700">
                {{ $qty }}
            </span>
            <x-jet-secondary-button 
            {{-- x-bind:class="{'bg-gray-300':$wire.qty >= $wire.quantity}" --}}
            x-bind:disabled="$wire.qty >= $wire.quantity"
            wire:loading.attr="disabled"
            wire:loading.class="bg-gray-300"
            wire:target="increment"
            wire:click="increment">
                +
            </x-jet-secondary-button>
        </div>
        <div class="flex-1 ml-4">
            <x-jet-button class="w-full justify-center bg-blue-700 hover:bg-blue-500">
                agregar al carrito
            </x-jet-button>

        </div>
    </div>
</div>
