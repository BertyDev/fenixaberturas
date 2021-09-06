@props(['color' => 'gray'])

<button {{ $attributes->merge(['type' => 'submit', 'class' => "inline-flex justify-center items-center px-4 py-2 bg-$color-700 border border-transparent 
    rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-$color-600 active:bg-blue-900 
    focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"]) }}>
    {{ $slot }}
</button>