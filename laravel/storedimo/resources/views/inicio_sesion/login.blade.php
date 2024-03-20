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
        <img src="{{asset('imagenes/logo.png')}}" alt="">

        {{-- =========================================================== --}}

        <form class="" method="post" action="" autocomplete="off">
            @csrf
            
            {{-- ============================ --}}

            <div class="mb-4">
                <input class="w-100 form-control" type="text" name="usuario" id="usuario" placeholder="Nombre de Usuario *">
            </div>

            {{-- ============================ --}}

            <div class="">
                <span class="btn-show-pass">
                    <i class="zmdi zmdi-eye"></i>
                </span>
                <input class="w-100 form-control" type="password" name="clave" id="clave" placeholder="Contraseña *">
            </div>

            {{-- ============================ --}}

            <div class="mt-5 d-flex justify-content-center">
                <button class="btn btn-primary" type="submit">Iniciar Sesión</button>
            </div>

            {{-- ============================ --}}

            <div class="mt-5 d-flex justify-content-end">
                <a class="" href="" style="color: blue">Olvidé mi Clave</a>
            </div>
        </form>
    </div>
@stop

{{-- =============================================================== --}}
{{-- =============================================================== --}}
{{-- =============================================================== --}}

@section('scripts')
    <script>
        $( document ).ready(function() {
            // $("#username").trigger('focus');
        });
    </script>
@stop


