<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    @yield('css')

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('imagenes/logo_storedimo_fondo.png') }}" type="image/x-icon" width="100" height="60">

    {{-- ========================================= --}}

    <!-- Bootstrap CSS 5.3.2 -->
    <link rel="stylesheet" href="{{ asset('bootstrap/bootstrap.5.3.2.min.css') }}">

    <!-- SELECT2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{asset('vendor/select2-4.1.0/dist/css/select2.min.css')}}"> --}}

    {{-- ========================================= --}}

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('font-awesome-4.5.0/css/font-awesome.min.css') }}"> {{-- Necesario para el ícono del logout --}}
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">


    {{-- ========================================= --}}

    {{-- Sweetalert2 (No necesita jquery para funcionar) --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert2.min.css') }}">

    <!--  Js -->
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/jquery-1.19.1.validate.min.js') }}"></script>
</head>

{{-- =========================================================================== --}}
{{-- =========================================================================== --}}

<body>
    <div class="page-container">
        @if (Request()->path() == '/' ||
                Request()->path() == 'login' ||
                Request()->path() == 'logout' ||
                Request()->path() == 'recuperar_clave' ||
                Request()->is('recuperar_clave_link*'))
            @include('layouts.topbar_login')
        @else
            @include('layouts.topbar')
        @endif

        @yield('content')

        @include('layouts.footer')
    </div>

    {{-- ======================================================== --}}
    {{-- ======================================================== --}}

    @yield('scripts')

    <!-- Bootstrap Bundle JS 5.3.2 -->
    <script src="{{ asset('bootstrap/bootstrap5.3.2.bundle.min.js') }}"></script>

    {{-- ========================================================================= --}}

    <!-- SELECT2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    {{-- <script src="{{asset('vendor/select2-4.1.0/dist/js/select2.min.js')}}"></script> --}}

    {{-- ========================================================================= --}}

    {{-- Sweetalert (No necesita jquery para funcionar) --}}
    <script src="{{ asset('js/sweetalert2.all.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>


    <!-- SCRIPTS -->
    @include('sweetalert::alert')
    
    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });

        // Cerrar el menú al hacer clic fuera de él en dispositivos móviles
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            
            if (!sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
                sidebar.classList.remove('active');
            }
        });
    </script>
</body>

</html>
