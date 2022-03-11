<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> Toma Talk </title>
    <link rel = "icon" href = "{{asset('img/tomatoe.png')}}" type = "image/x-icon">
    <!-- Fonts -->
    <script src="https://kit.fontawesome.com/050d023c4c.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/chat.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/feed.css') }}">
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
    <link type="text/css" href="{{asset('css/nav.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="{{asset('js/post.js')}}"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Latest compiled and minified CSS -->

    
    @livewireStyles



    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class=" bg-gray-100">
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
        </div>

        @stack('modals')
     
        @livewireScripts
    </body>
</html>
