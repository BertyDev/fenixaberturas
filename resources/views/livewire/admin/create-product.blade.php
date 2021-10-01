<div class=" py-12 max-w-4xl mx-auto">
    <h1 class="text-xl lg:text-3xl text-center font-semibold mb-8">Complete la información para crear un Producto
    </h1>
    <div class=" rounded-lg shadow-xl   text-trueGray-700 bg-gray-50 p-6">
        
        <div class="grid grid-cols-2 gap-6 mb-4">
        {{-- Categoría --}}
            <div>
                <x-jet-label value="{{ __('Category') }}" />
                <select class="form-control w-full" wire:model.debounce.250ms="category_id">
                    <option value="" selected disabled>Selecione Categoria</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="category_id" />
            </div>
        {{-- SubCategoría --}}
            <div>
                <x-jet-label value="{{ __('Subcategory') }}" />
                <select class="form-control w-full" wire:model.debounce.250ms="subcategory_id">
                    <option value="" selected disabled>Selecione SubCategoria</option>
                    @foreach ($subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="subcategory_id" />
            </div>
        </div>
        {{-- Nombre --}}
        <div class="mb-4">
            <x-jet-label value="{{ __('Name') }}" />
            <x-jet-input type="text" class="w-full" wire:model.debounce.500ms='name'
                placeholder="ingrese el nombre del producto" />
            <x-jet-input-error for="name" />
        </div>
        {{-- Slug --}}
        <div class="mb-4">
            <x-jet-label value="{{ __('Slug') }}" />
            <x-jet-input type="text" disabled class="w-full bg-gray-100" wire:model.debounce.500ms='slug'
                placeholder="Visualice la URL del Producto" />
            <x-jet-input-error for="slug" />
        </div>
        {{-- Description --}}
        <div class="mb-4" >
            <div wire:ignore>
                <x-jet-label value="{{ __('Description') }}" />
                <textarea wire:model='description' class="w-full form-control" cols="30" rows="4" x-data x-init=" ClassicEditor
            .create( $refs.editor )
            .then(function(mieditor){
                mieditor.model.document.on('change:data', () =>{
                    @this.set('description',mieditor.getData())
                })
            })
            .catch( error => {
                console.error( error );
            } );" x-ref="editor"></textarea>
            </div>
            <x-jet-input-error for="description" />
        </div>
        <div class="grid grid-cols-2 gap-6 mb-4">
        {{-- Brand --}}
            <div>
                <x-jet-label value="{{ __('Brand') }}" />
                <select class="form-control w-full" wire:model.debounce.250ms="brand_id">
                    <option value="" selected disabled>Selecione Marca</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="brand_id" />
            </div>
        {{-- Price --}}
            <div>
                <x-jet-label value="{{ __('Price') }}" />
                <x-jet-input type="number" step=".01" class="w-full" wire:model.debounce.500ms='price'
                    placeholder="ingrese el precio del producto" />
                    <x-jet-input-error for="price" />
            </div>
        </div>
        {{-- Cantidad --}}
        @if ($subcategory_id)
            @if (!$this->subcategory->color && !$this->subcategory->size)
                <div class="mb-4">
                    <x-jet-label value="{{ __('Amount') }}" />
                    <x-jet-input type="number" class="w-full" wire:model.debounce.500ms='quantity'
                        placeholder="ingrese el stock del producto" />
                        <x-jet-input-error for="quantity" />
                </div>
            @endif
        @endif
        {{-- Boton Crear  --}}
        <div class="flex justify-end items-center">
            <x-jet-action-message class="mr-3 text-green-500 font-medium" on="saved">
                {{ __('Created.') }}
            </x-jet-action-message>

            <x-jet-button class=" bg-blue-600 hover:bg-blue-500" 
            wire:click='save'
            wire:loading.attr='disabled'
            wire:target='save'>
                Crear Producto
            </x-jet-button>
        </div>
    </div>
</div>
