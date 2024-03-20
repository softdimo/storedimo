@extends('layouts.app')
@section('title', 'Login')

{{-- =============================================================== --}}
{{-- =============================================================== --}}
{{-- =============================================================== --}}

@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@stop

{{-- =============================================================== --}}
{{-- =============================================================== --}}
{{-- =============================================================== --}}

@section('content')
    <div class="container-fluid mt-auto mb-auto d-flex flex-column align-items-center">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center text-uppercase">Bienvenid@</h2>
            </div>
        </div>

        {{-- =========================================================== --}}

        <div class="d-flex justify-content-center align-items-center">
            <form class="" method="post" action="" autocomplete="off">
                @csrf
                <div class="mb-5">
                    <h4>Datos de Acceso</h4>
                </div>

                {{-- ============================ --}}

                <div class="mb-4">
                    <input class="w-100 form-control" type="text" name="usuario" id="usuario" placeholder="Usuario">
                </div>

                {{-- ============================ --}}

                <div class="">
                    <span class="btn-show-pass">
                        <i class="zmdi zmdi-eye"></i>
                    </span>
                    <input class="w-100 form-control" type="password" name="clave" id="clave" placeholder="Clave">
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


