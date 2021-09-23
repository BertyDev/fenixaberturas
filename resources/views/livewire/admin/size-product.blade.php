<div>
    <div class="my-12 bg-gray-50 shadow-xl rounded-lg p-6">
        <div>
            <x-jet-label>
                Medida
            </x-jet-label>
            <x-jet-input wire:model='name' class="w-full" type="text" placeholder="Ingrese una medida" />
            <x-jet-input-error for="name" />
        </div>
        <div class="flex justify-end items-center mt-4">
            <x-jet-button wire:click='save' wire:loading.attr='disabled' wire:target='save'
                class="bg-blue-600 hover:bg-blue-500">
                añadir
            </x-jet-button>
        </div>
    </div>
    <ul class="space-y-4 w-full">
        @foreach ($sizes as $size)
            <li class="bg-gray-50 shadow-lg rounded-lg py-2 px-6" wire:key='size-{{ $size->id }}'>
                <div class="flex items-center ">
                    <span class="text-lg font-medium">{{ $size->name }}</span>
                    <div class="ml-auto">
                        <x-jet-button wire:click="edit({{ $size->id }})" wire:loading.attr='disabled'
                            wire:target='edit({{ $size->id }})'>
                            <i class="fas fa-edit"></i>
                        </x-jet-button>
                        <x-jet-danger-button wire:click="confirSizeDelete({{ $size->id }})"
                            wire:loading.attr='disabled'
                            wire:target='confirSizeDelete({{ $size->id }})'>
                            <i class="fas fa-trash"></i>
                        </x-jet-danger-button>
                    </div>
                </div>
                @livewire('admin.color-size', ['size' => $size], key('color-size'.$size->id))
            </li>
        @endforeach
    </ul>

    <x-jet-dialog-modal wire:model='open' maxWidth="md">
        <x-slot name="title">
            Editar medida
        </x-slot>
        <x-slot name="content">
            <x-jet-label>
                Medida
            </x-jet-label>
            <x-jet-input type="text" wire:model='name_edit' class="w-full" />
            <x-jet-input-error for="name_edit" />
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open', false)">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-button wire:click="update" wire:loading.attr='disabled' wire:target='update'>
                Actualizar
            </x-jet-button>
        </x-slot>

    </x-jet-dialog-modal>

    <x-jet-confirmation-modal wire:model="open_confir" maxWidth="md">
        <x-slot name="title">
            Eliminar la medida 
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
