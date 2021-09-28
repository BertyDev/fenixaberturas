@props(['category'])
<div class=" grid grid-cols-4 p-4">
    <div class="mx-2 col-span-2 md:col-span-1">
        <p class=" text-sm md:text-lg font-bold text-center text-trueGray-500 mb-3">SubCategorias</p>
        <ul>
            @foreach ($category->subcategories as $subcategory)
                <li>
                    <a href="{{ route('categories.show', $category) . '?subcategoryh=' . $subcategory->slug }}"
                        class=" text-trueGray-500 w-full text-sm md:text-base text-center font-semibold inline-block py-1 px-4 hover:text-blue-500">
                        {{ $subcategory->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="col-span-2 md:col-span-3">
        <img class=" h-32 md:h-64 w-full object-cover object-center" src="{{ Storage::url($category->image) }}" alt="">
    </div>
</div>