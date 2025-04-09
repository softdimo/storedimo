@extends('layouts.app')
@section('title', 'Login')

{{-- =============================================================== --}}
{{-- =============================================================== --}}
{{-- =============================================================== --}}

@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('css/custom.css') }}"> --}}
@stop

{{-- =============================================================== --}}
{{-- =============================================================== --}}
{{-- =============================================================== --}}

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100 bg-light py-4">
    <div class="border border-dark-subtle p-4 shadow-lg rounded-4 bg-white text-center w-25" style="max-height: 90vh; overflow-y: auto;">
        <div class="d-flex justify-content-center p-3">
            <img src="{{asset('imagenes/logo_storedimo_fondo.png')}}" alt="logo" class="text-center" width="200" height="100">
        </div>
        
        <form class="p-3" method="post" action="{{route('login.store')}}" autocomplete="off">
            @csrf
            
            <h3 class="mb-4 fw-bold text-primary">Iniciar Sesión</h3>
            
            <div class="mb-4">
                <input class="w-100 form-control p-3" type="text" name="usuario" id="usuario" placeholder="Usuario *" required>
            </div>
            
            <div class="mb-4 position-relative">
                <input class="w-100 form-control p-3" type="password" name="clave" id="clave" placeholder="Contraseña *" required>
                <span class="btn-show-pass position-absolute top-50 end-0 translate-middle-y me-3">
                    <i class="zmdi zmdi-eye fs-5"></i>
                </span>
            </div>
            
            <button class="btn btn-primary btn-lg w-100" type="submit">Iniciar Sesión</button>
            
            <div class="mt-3">
                <a href="{{route('recuperar_clave')}}" class="text-primary">¿Olvidó la Contraseña?</a>
            </div>
        </form>
    </div>
</div>

@stop

{{-- =============================================================== --}}
{{-- =============================================================== --}}
{{-- =============================================================== --}}

@section('scripts')
    <script>
        $( document ).ready(function() {
            // Limpieza inicial
            $("#usuario").focus();

            
        }); // FIN document.ready
    </script>
@stop


