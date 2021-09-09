<div>
    <a href="" class="py-2 px-4 text-sm flex items-center text-trueGray-500 hover:bg-gray-500 hover:text-white">
        <span class="flex justify-center w-9">
            <i class="fas fa-shopping-cart"></i>
        </span>
        <span class=" relative inline-block cursor-pointer pr-5">
        {{ __('Shopping cart') }}
        <span class="absolute top-2 right-0 inline-flex items-center justify-center px-2 py-1 text-xs 
        font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">{{ Cart::count() }}</span>
   
        </span>
    </a>
</div>
