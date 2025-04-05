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
    <div class="vh-100 d-flex flex-column align-items-center justify-content-center">
        <div class="w-25 border border-1 rounded">
            <div class="d-flex justify-content-center p-1" style="background-color:#FFFFFF">
                <img src="{{asset('imagenes/logo_storedimo_fondo.png')}}" alt="logo" class="text-center" width="250" height="130">
            </div>

            {{-- =========================================================== --}}

            <form class="bg-white p-3 mt-3" method="post" action="{{route('login.store')}}" autocomplete="off" id="formLogin">
                @csrf
                
                {{-- ============================ --}}

                <div class="mb-4">
                    <input class="w-100 form-control" type="text" name="usuario" id="usuario" placeholder="Usuario *" required>
                </div>

                {{-- ============================ --}}

                <div class="">
                    <span class="btn-show-pass">
                        <i class="zmdi zmdi-eye"></i>
                    </span>
                    <input class="w-100 form-control" type="password" name="clave" id="clave" placeholder="Contraseña *" required>
                </div>

                {{-- ============================ --}}

                <div class="mt-5 d-flex justify-content-center">
                    <button class="btn btn-primary w-100" type="submit">Iniciar Sesión</button>
                </div>

                {{-- ============================ --}}

                <div class="mt-3 d-flex justify-content-center">
                    <a class="" href="{{route('recuperar_clave')}}" style="color: blue">¿Olvidó la Contraseña?</a>
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


