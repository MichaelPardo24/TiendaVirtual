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
        <link rel="shortcut icon" type="image/png" href="{{ asset('https://cdn-icons-png.flaticon.com/512/39/39560.png') }}">
        <link rel="shortcut icon" sizes="192x192" href="{{ asset('https://cdn-icons-png.flaticon.com/512/39/39560.png') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/10.0.0/highcharts.js"></script>
        <script src = "https://code.highcharts.com/modules/exporting.js" ></script>
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
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

            <footer class="text-center lg:text-left bg-white text-gray-600">
                <div class="mx-6 py-10 text-center md:text-left">
                  <div class="grid grid-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="">
                      <h6 class="
                          uppercase
                          font-semibold
                          mb-4
                          flex
                          items-center
                          justify-center
                          md:justify-start
                        ">
                        Only Games
                      </h6>
                      <p>
                        Only Games es una tienda de videojuegos online, aqui encontraras los ultimos juegos agregados al mercado y todos tus favoritos ¿Que esperas para comprar?
                      </p>
                    </div>
                    <div class="">
                      <h6 class="uppercase font-semibold mb-4 flex justify-center md:justify-start">
                        Generos de videojuegos
                      </h6>
                      <p class="mb-4 text-gray-600">
                        Acción
                      </p>
                      <p class="mb-4 text-gray-600">
                        Platagorma
                      </p>
                      <p class="mb-4 text-gray-600">
                        Disparos
                      </p>
                      <p class="mb-4 text-gray-600">
                        Audiojuego
                      </p>
                    </div>
                    <div class="">
                      <h6 class="uppercase font-semibold mb-4 flex justify-center md:justify-start">
                        Enlances
                      </h6>
                      <p class="mb-4">
                        <a href="{{ route('shop') }}" class="text-gray-600">Productos</a>
                      </p>
                      <p class="mb-4">
                        <a href="{{ route('shoppingHistory') }}" class="text-gray-600">Mis Compras</a>
                      </p>
                    </div>
                    <div class="">
                      <h6 class="uppercase font-semibold mb-4 flex justify-center md:justify-start">
                        Contactos
                      </h6>
                      <p class="flex items-center justify-center md:justify-start mb-4">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="envelope"
                          class="w-4 mr-4" role="img" xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 512 512">
                          <path fill="currentColor"
                            d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z">
                          </path>
                        </svg>
                        admin@onlyGames.com
                      </p>
                      <p class="flex items-center justify-center md:justify-start mb-4">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="phone"
                          class="w-4 mr-4" role="img" xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 512 512">
                          <path fill="currentColor"
                            d="M493.4 24.6l-104-24c-11.3-2.6-22.9 3.3-27.5 13.9l-48 112c-4.2 9.8-1.4 21.3 6.9 28l60.6 49.6c-36 76.7-98.9 140.5-177.2 177.2l-49.6-60.6c-6.8-8.3-18.2-11.1-28-6.9l-112 48C3.9 366.5-2 378.1.6 389.4l24 104C27.1 504.2 36.7 512 48 512c256.1 0 464-207.5 464-464 0-11.2-7.7-20.9-18.6-23.4z">
                          </path>
                        </svg>
                        +57 302 5092 123
                      </p>
                    </div>
                  </div>
                </div>
                <div class="text-center p-6 bg-gray-200">
                  <span>© 2021 Copyright:</span>
                  <a class="text-gray-600 font-semibold" href="{{ route('shop') }}">Only Games</a>
                </div>
              </footer>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
