<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Wootrap: Contratá servicios profesionales de forma garantizada.</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        
        {{-- Estilos personalizados para el chat --}}
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

        {{-- Fontawesone --}}
        <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">

        {{-- DROPZONE --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        {{-- Glider Slider css --}}
        {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.7/glider.min.css" integrity="sha512-YM6sLXVMZqkCspZoZeIPGXrhD9wxlxEF7MzniuvegURqrTGV2xTfqq1v9FJnczH+5OGFl5V78RgHZGaK34ylVg==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}

        @livewireStyles

        <!-- Scripts -->
        <script defer src="{{ mix('js/app.js') }}"></script>
        
        <!-- AOS Animate -->
        {{-- <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" /> --}}

        <!-- https://animate.style/ -->
        {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/> --}}

        <link rel="icon" type="image/png" href="{{asset('favicon.png')}}">

        {{-- MEGA MENU --}}        
        {{-- <link rel="stylesheet" href="{{asset('css/style.css')}}"/> --}}

        {{-- Glider.js Slider --}}
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.7/glider.min.js" integrity="sha512-tHimK/KZS+o34ZpPNOvb/bTHZb6ocWFXCtdGqAlWYUcz+BGHbNbHMKvEHUyFxgJhQcEO87yg5YqaJvyQgAEEtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

        {{-- FlexSlider css--}}
        {{-- <link rel="stylesheet" href="{{ asset('vendor/FlexSlider/flexslider.css') }}"> --}}

        {{-- JQUERY --}}
        {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

        {{-- FlexSlider js--}}
        {{-- <script src="{{ asset('vendor/FlexSlider/jquery.flexslider-min.js') }}"></script> --}}

        {{-- VANTA.JS BACKGROUND ANIMATION --}}
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r121/three.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.net.min.js"></script> --}}
        {{-- <script src="https://cdn.jsdelivr.net/npm/vanta@0.5.21/dist/vanta.waves.min.js"></script> --}}
        {{-- <script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.globe.min.js"></script> --}}
        {{-- <script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.halo.min.js"></script> --}}

        {{-- CKEDITOR --}}
        <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>

        {{-- SWEET-ALERT2 --}}
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        {{-- DROPZONE --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js" integrity="sha512-VQQXLthlZQO00P+uEu4mJ4G4OAgqTtKG1hri56kQY1DtdLeIqhKUp9W/lllDDu3uN3SnUNawpW7lBda8+dSi7w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        {{-- PUSHER --}}
        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

        <script>

            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;
        
            var pusher = new Pusher('80b329a9e40bdf97a6bb', {
              cluster: 'sa1'
            });
        
            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', function(data) {
              alert(JSON.stringify(data));
            });
          </script>

        @yield('styles')

    </head>

    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-white">

            @livewire('navigation-menu')

            @if(isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @include('layouts/footer')

        @stack('modals')

        @livewireScripts

        @stack('js')

        @stack('script')
    </body>
</html>
