<x-app-layout>
    <div class="container py-8">
        <div class="grid grid-cols-1 gap-0 md:grid-cols-2 md:gap-6">
            {{-- Inicio Slider Imagenes --}}
            <div>
                <div class="shadow-lg flexslider">
                    <ul class="slides">
                        @foreach ($product->images as $image)
                            <li data-thumb="{{ Storage::url($image->url) }}">
                                <img src="{{ Storage::url($image->url) }}" />
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="-mt-5 text-trueGray-700">
                    <h2 class="text-lg font-bold ">{{ __('Description') }}:</h2>
                    {!! $product->description !!}
                </div>
                @can('review', $product)
                    <div class="mt-4 text-gray-700">
                        <h2 class="text-lg font-bold">Dejar reserva</h2>
                        <form action="{{ route('reviews.store', $product) }}" method="post">
                            @csrf
                            <textarea name="coment" id="editor"></textarea>
                            <x-jet-input-error for="coment" />
                            <div class="flex items-center mt-2" x-data="{rating: 1}">
                                <p class="mr-3 font-semibold">Puntaje: </p>
                                <ul class="flex space-x-2">
                                    <li x-bind:class="rating >= 1 ? 'text-yellow-500' : ''">
                                        <button type="button" class=" focus:outline-none" x-on:click="rating = 1">
                                            <i class="fas fa-star"></i>
                                        </button>
                                    </li>
                                    <li x-bind:class="rating >= 2 ? 'text-yellow-500' : ''">
                                        <button type="button" class=" focus:outline-none" x-on:click="rating = 2">
                                            <i class="fas fa-star"></i>
                                        </button>
                                    </li>
                                    <li x-bind:class="rating >= 3 ? 'text-yellow-500' : ''">
                                        <button type="button" class=" focus:outline-none" x-on:click="rating = 3">
                                            <i class="fas fa-star"></i>
                                        </button>
                                    </li>
                                    <li x-bind:class="rating >= 4 ? 'text-yellow-500' : ''">
                                        <button type="button" class=" focus:outline-none" x-on:click="rating = 4">
                                            <i class="fas fa-star"></i>
                                        </button>
                                    </li>
                                    <li x-bind:class="rating >= 5 ? 'text-yellow-500' : ''">
                                        <button type="button" class=" focus:outline-none" x-on:click="rating = 5">
                                            <i class="fas fa-star"></i>
                                        </button>
                                    </li>
                                </ul>
                                <input class="hidden" type="number" name="rating" x-model="rating">

                                <x-jet-button class="ml-auto">
                                    agregar reseña
                                </x-jet-button>
                            </div>
                        </form>
                    </div>
                @endcan
                @if ($product->reviews->isNotEmpty())
                    <div class="mt-6 text-gray-700">
                        <h2 class="font-bold text-lg">Reseñas</h2>

                        <div class="mt-2">
                            @foreach ($product->reviews as $review)

                            @endforeach
                            <div class="flex">

                                <div class=" flex-shrink-0">
                                    <img class="w-10 h-10 rounded-full mr-4 object-cover" src="{{ $review->user->profile_photo_url }}" alt="{{$review->user->name}}">
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-semibold">{{ $review->user->name }}</p>
                                    <p class="text-xs">{!! $review->created_at->diffForHumans() !!}</p>
                                    <div>
                                        {!! $review->coment !!}
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold">{{ $review->rating }}
                                    <i class=" fas fa-star text-yellow-500"></i>
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                @endif

            </div>

            {{-- Fin Slider Imagenes --}}
            <div class="py-6">
                <h1 class="pb-2 text-2xl font-bold text-trueGray-700">
                    {{ $product->name }}
                </h1>
                <div class="flex">
                    <p class=" text-trueGray-700 flex-1">Marca: <a class="underline capitalize hover:text-blue-500"
                            href="">{{ $product->brand->name }}</a> </p>
                    <p class="mx-4 text-trueGray-700"> {{round($product->reviews->avg('rating'),2)}} <i class="text-xs text-yellow-400 fas fa-star"></i></p>
                    <p class="text-gray-600  capitalize " >{{$product->reviews->count()}} reseñas</p>
                </div>
                <p class="my-4 text-2xl font-semibold text-trueGray-700">$ {{ $product->price }}</p>
                <div class="mb-6 bg-white rounded-lg shadow-lg ">
                    <div class="flex items-center p-4">
                        <span class="flex items-center justify-center w-10 h-10 rounded-full bg-greenLime-600">
                            <i class="text-sm text-white fas fa-truck"></i>
                        </span>
                        <div class="ml-4">
                            <p class="text-lg font-semibold text-greenLime-600">Se hace envios a todo buenos aires</p>
                            <p class="text-sm ">Recibelo el:
                                {{ Date::now()->locale('es')->addDay(7)->format('l j F') }}</p>
                        </div>
                    </div>
                </div>
                @if ($product->subcategory->size)
                    @livewire('add-cart-item-size',['product' => $product])
                @elseif($product->subcategory->color)
                    @livewire('add-cart-item-color',['product' => $product])
                @else
                    @livewire('add-cart-item',['product' => $product])
                @endif

            </div>
        </div>
    </div>
    @push('scripts')
        <script src="https://cdn.ckeditor.com/ckeditor5/32.0.0/classic/ckeditor.js"></script>
        <script>
            ClassicEditor
                .create(document.querySelector('#editor'), {
                    toolbar: ['heading', '|', 'bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote'],
                })
                .catch(error => {
                    console.log(error);
                });
        </script>
        <script>
            // Can also be used with $(document).ready()
            $(document).ready(function() {
                $('.flexslider').flexslider({
                    animation: "slide",
                });
            });
        </script>
    @endpush
</x-app-layout>
