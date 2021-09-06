
<header class=" bg-blue-600 sticky top-0 z-50" x-data="dropdown()">
    <div class="container flex items-center justify-between md:justify-start h-16">
        <a 
        :class="{'bg-opacity-100 text-blue-500' :open}"
        x-on:click="show()"
            class="order-last md:order-first flex flex-col items-center justify-center bg-white bg-opacity-25 text-white cursor-pointer font-semibold h-full px-6 md:px-4">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <span class="hidden md:block text-sm">Categorias</span>
        </a>
        <a href="/" class=" mx-0 md:mx-6 bg-gray-50 items-center justify-center h-full flex  px-2">

            <x-jet-application-mark class=" h-14 w-auto" />
        </a>

        <div class="flex-1 hidden md:block">
            @livewire('search')
        </div>

        <div class="mx-6 relative hidden md:block">
            @auth
                <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">

                        <button
                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                                alt="{{ Auth::user()->name }}" />
                        </button>

                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Account') }}
                        </div>

                        <x-jet-dropdown-link href="{{ route('profile.show') }}">
                            {{ __('Profile') }}
                        </x-jet-dropdown-link>



                        <div class="border-t border-gray-100"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-jet-dropdown-link href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                    this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-jet-dropdown-link>
                        </form>
                    </x-slot>
                </x-jet-dropdown>

            @else
                <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <i class="fas fa-user-circle text-white text-3xl cursor-pointer"></i>
                    </x-slot>
                    <x-slot name="content">
                        <x-jet-dropdown-link href="{{ route('login') }}">
                            {{ __('Log in') }}
                        </x-jet-dropdown-link>
                        <x-jet-dropdown-link href="{{ route('register') }}">
                            {{ __('Register') }}
                        </x-jet-dropdown-link>
                    </x-slot>
                </x-jet-dropdown>

            @endauth

        </div>
       <div class=" hidden md:block">
        @livewire('dropdown-cart')
       </div>
    </div>
    <nav id="navigation-menu" :class="{'block': open,'hidden': !open}"
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="transform opacity-0 scale-100" 
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-300" 
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-100"
    
        class=" bg-trueGray-700 bg-opacity-25 absolute w-full hidden">
        {{-- Menu pantallas grandes --}}
        <div class="container h-full hidden md:block">
            <div x-on:click.away="close()" class="grid grid-cols-3 md:grid-cols-4 h-full relative">
                <ul class=" bg-white">
                    @foreach ($categories as $category)
                        <li class="navigation-link text-trueGray-500 hover:bg-gray-500 hover:text-white">
                            <a href="{{ route('categories.show',$category) }}" class="py-2 px-4 text-sm flex items-center">
                                <span class="flex justify-center w-9">
                                    {!! $category->icon !!}
                                </span>
                                {{ $category->name }}
                            </a>

                            <div
                                class="navigation-submenu bg-gray-100 absolute w-2/3 md:w-3/4 h-full top-0 right-0 hidden">
                                <x-navigation-subcategories :category="$category" />
                            </div>
                        </li>
                    @endforeach

                </ul>
                <div class="col-span-2 md:col-span-3 bg-gray-100">
                    <x-navigation-subcategories :category="$categories->first()" />
                </div>

            </div>
        </div>
        {{-- Menu pantallas pequeñas --}}
        <div class=" bg-white h-full overflow-y-auto">

            <div class="container bg-blue-100 py-3 mb-2">
                @livewire('search')
            </div>
            <p class=" text-trueGray-500 px-6 my-2">Categorias</p>
            <ul>
                @foreach ($categories as $category)
                <li class=" text-trueGray-500 hover:bg-gray-500 hover:text-white">
                    <a href="{{ route('categories.show',$category) }}" class="py-2 px-4 text-sm flex items-center ">
                        <span class="flex justify-center w-9">
                            {!! $category->icon !!}
                        </span>
                        {{ $category->name }}
                    </a>

                 </li>
                @endforeach
            </ul>

            <p class=" text-trueGray-500 px-6 my-2">Usuarios</p>
            @livewire('cart-mobil')
            @auth
            <a href="{{ route('profile.show') }}" class="py-2 px-4 text-sm flex items-center text-trueGray-500 hover:bg-gray-500 hover:text-white">
                <span class="flex justify-center w-9">
                    <i class="fas fa-user-circle cursor-pointer"></i>
                </span>
               {{ __('Profile') }}
            </a>
            <a href="" 
            onclick="event.preventDefault();
                    document.getElementById('logout-form').submit()"
            class="py-2 px-4 text-sm flex items-center text-trueGray-500 hover:bg-gray-500 hover:text-white">
                <span class="flex justify-center w-9">
                    <i class="fas fa-sign-out-alt cursor-pointer"></i>
                </span>
               {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf

            </form>
            @else
            <x-jet-dropdown-link class="py-2 px-4 text-sm flex items-center text-trueGray-500 hover:bg-gray-500 hover:text-white" href="{{ route('login') }}">
                <span class="flex justify-center w-9">
                    <i class="fas fa-user-circle cursor-pointer"></i>
                </span>
                {{ __('Log in') }}
            </x-jet-dropdown-link>
            <x-jet-dropdown-link class="py-2 px-4 text-sm flex items-center text-trueGray-500 hover:bg-gray-500 hover:text-white" href="{{ route('register') }}">
                <span class="flex justify-center w-9">
                    <i class="fas fa-fingerprint cursor-pointer"></i>
                </span>
                {{ __('Register') }}
            </x-jet-dropdown-link>
            @endauth
        </div>
    </nav>

</header>
