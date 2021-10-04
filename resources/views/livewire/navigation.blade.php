<header class="sticky top-0 z-50 bg-blue-600 " x-data="dropdown()">
    <div class="container flex items-center justify-between h-16 md:justify-start">
        <a :class="{'bg-opacity-100 text-blue-500' :open}" x-on:click="show()"
            class="flex flex-col items-center justify-center order-last h-full px-6 font-semibold text-white bg-white bg-opacity-25 cursor-pointer md:order-first md:px-4">
            <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <span class="hidden text-sm md:block">Categorias</span>
        </a>
        <a href="/" class="flex items-center justify-center h-full px-2 mx-0 md:mx-6 bg-gray-50">

            <x-jet-application-mark class="w-auto h-14" />
        </a>

        <div class="flex-1 hidden md:block">
            @livewire('search')
        </div>

        <div class="relative hidden mx-6 md:block">
            @auth
                <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">

                        <button
                            class="flex text-sm transition border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300">
                            <img class="object-cover w-8 h-8 rounded-full" src="{{ Auth::user()->profile_photo_url }}"
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
                        <x-jet-dropdown-link href="{{ route('orders.index') }}">
                            {{ __('My orders') }}
                        </x-jet-dropdown-link>
                        @role('admin')
                        <x-jet-dropdown-link href="{{ route('admin.index') }}">
                            {{ __('Administrator') }}
                        </x-jet-dropdown-link>
                        @endrole

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
                        <i class="text-3xl text-white cursor-pointer fas fa-user-circle"></i>
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
        <div class="hidden md:block">
            @livewire('dropdown-cart')
        </div>
    </div>
    <nav id="navigation-menu" :class="{'block': open,'hidden': !open}" x-show="open"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="transform opacity-0 scale-100"
        x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-100"
        class="absolute hidden w-full bg-opacity-25 bg-trueGray-700">
        {{-- Menu pantallas grandes --}}
        <div class="container hidden h-full md:block">
            <div x-on:click.away="close()" class="relative grid h-full grid-cols-3 md:grid-cols-4">
                <ul class="bg-white ">
                    @foreach ($categories as $category)
                        <li class="navigation-link text-trueGray-500 hover:bg-gray-500 hover:text-white">
                            <a href="{{ route('categories.show', $category) }}"
                                class="flex items-center px-4 py-2 text-sm">
                                <span class="flex justify-center w-9">
                                    {!! $category->icon !!}
                                </span>
                                {{ $category->name }}
                            </a>

                            <div
                                class="absolute top-0 right-0 hidden w-2/3 h-full bg-gray-100 navigation-submenu md:w-3/4">
                                <x-navigation-subcategories :category="$category" />
                            </div>
                        </li>
                    @endforeach

                </ul>
                <div class="col-span-2 bg-gray-100 md:col-span-3">
                    <x-navigation-subcategories :category="$categories->first()" />
                </div>

            </div>
        </div>
        {{-- Menu pantallas pequeñas --}}
        <div class="h-full overflow-y-auto bg-white ">

            <div class="container py-3 mb-2 bg-blue-100">
                @livewire('search')
            </div>
            <p class="px-6 my-2 text-trueGray-500">Categorias</p>
            <ul>
                @foreach ($categories as $category)
                    <li class=" text-trueGray-500 hover:bg-gray-500 hover:text-white">
                        <a href="{{ route('categories.show', $category) }}"
                            class="flex items-center px-4 py-2 text-sm ">
                            <span class="flex justify-center w-9">
                                {!! $category->icon !!}
                            </span>
                            {{ $category->name }}
                        </a>

                    </li>
                @endforeach
            </ul>

            <p class="px-6 my-2 text-trueGray-500">Usuarios</p>
            @livewire('cart-mobil')
            @auth
                <a href="{{ route('profile.show') }}"
                    class="flex items-center px-4 py-2 text-sm text-trueGray-500 hover:bg-gray-500 hover:text-white">
                    <span class="flex justify-center w-9">
                        <i class="cursor-pointer fas fa-user-circle"></i>
                    </span>
                    {{ __('Profile') }}
                </a>
                <a href="{{ route('orders.index') }}"
                    class="flex items-center px-4 py-2 text-sm text-trueGray-500 hover:bg-gray-500 hover:text-white">
                    <span class="flex justify-center w-9">
                        <i class="cursor-pointer fas fa-truck"></i>
                    </span>
                    {{ __('My orders') }}
                </a>
                @role('admin')
                <a href="{{ route('admin.index') }}"
                    class="flex items-center px-4 py-2 text-sm text-trueGray-500 hover:bg-gray-500 hover:text-white">
                    <span class="flex justify-center w-9">
                        <i class="cursor-pointer fas fa-tools"></i>
                    </span>
                    {{ __('Administrator') }}
                </a>
                @endrole
                <a href="" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit()"
                    class="flex items-center px-4 py-2 text-sm text-trueGray-500 hover:bg-gray-500 hover:text-white">
                    <span class="flex justify-center w-9">
                        <i class="cursor-pointer fas fa-sign-out-alt"></i>
                    </span>
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf

                </form>
            @else
                <x-jet-dropdown-link
                    class="flex items-center px-4 py-2 text-sm text-trueGray-500 hover:bg-gray-500 hover:text-white"
                    href="{{ route('login') }}">
                    <span class="flex justify-center w-9">
                        <i class="cursor-pointer fas fa-user-circle"></i>
                    </span>
                    {{ __('Log in') }}
                </x-jet-dropdown-link>
                <x-jet-dropdown-link
                    class="flex items-center px-4 py-2 text-sm text-trueGray-500 hover:bg-gray-500 hover:text-white"
                    href="{{ route('register') }}">
                    <span class="flex justify-center w-9">
                        <i class="cursor-pointer fas fa-fingerprint"></i>
                    </span>
                    {{ __('Register') }}
                </x-jet-dropdown-link>
            @endauth
        </div>
    </nav>

</header>
