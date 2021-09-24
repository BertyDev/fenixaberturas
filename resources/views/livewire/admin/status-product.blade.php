<div>
    <div class="rounded-lg shadow-xl text-trueGray-700 bg-gray-50 p-6 mb-4">
        <p class="text-2xl text-center font-semibold mb-2">Estado del Producto</p>
        <div class="flex ">
            <label class="mr-4">
                <input wire:model.defer='status' type="radio" name="status" value="1">
                BORRADOR
            </label>
            <label>
                <input wire:model.defer='status' type="radio" name="status" value="2">
                PUBLICADO
            </label>
        </div>
        <div class="flex justify-end items-center">
            <x-jet-action-message class="mr-3 text-green-500 font-medium" on="saved">
                {{ __('Updated') }}
            </x-jet-action-message>
            <x-jet-button wire:click='save' wire:loading.attr='disabled' wire:target='save'
                class="bg-blue-600 hover:bg-blue-500">
                {{ __('Update') }}
            </x-jet-button>
        </div>
    </div>
</div>
