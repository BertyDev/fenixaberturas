<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        {{-- GliderJS --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glider-js@1/glider.min.css">
        {{-- FontAwesome --}}
        <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">

        {{-- FlexSlider --}}
        <link rel="stylesheet" href="{{ asset('vendor/flexSlider/flexslider.css') }}">

             @livewireStyles

        <!-- Scripts -->
          <script src="{{ mix('js/app.js') }}" defer></script>
          {{-- GliderJS --}}
        <script src="https://cdn.jsdelivr.net/npm/glider-js@1/glider.min.js"></script>
        {{-- Jquery --}}
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        {{-- FlexSlider --}}
        <script src="{{ asset('vendor/FlexSlider/jquery.flexslider-min.js') }}"></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation')

            <!-- Page Heading -->
           

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
        <script>
            function dropdown(){
                return {
                    open:false,
                    show(){
                        if(this.open){
                           //se cierra el menu
                            this.open = false;
                            document.getElementsByTagName('html')[0].style.overflow = 'auto'
                        }else{
                            //se abre el menu
                            this.open = true;
                            document.getElementsByTagName('html')[0].style.overflow = 'hidden'
                        }
                    },
                    close(){
                        this.open = false;
                            document.getElementsByTagName('html')[0].style.overflow = 'auto'
                    }
                }
            }
        
        </script>
        @stack('scripts')
    </body>
</html>
