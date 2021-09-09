@props(['product'])

<li class=" bg-white rounded-lg shadow ">
    <article>
        <figure>
            <img class=" h-48 w-full rounded-t-lg object-cover object-center"
                src="{{ Storage::url($product->images->first()->url) }}" alt="">
        </figure>
        <div class=" py-4 px-6">
            <h1 class=" text-base font-semibold truncate">
                <a href="{{ route('products.show',$product) }}">
                    {{ $product->name }}
                </a>
            </h1>
            <p class=" text-sm font-bold text-trueGray-700">
                ${{ $product->price }}
            </p>
        </div>
    </article>
</li>