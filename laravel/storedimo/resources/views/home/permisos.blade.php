@extends('layouts.app')
@section('title', 'Permisos')

@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('css/custom.css') }}"> --}}
@stop

@section('content')
    <div class="d-flex p-0">
        <div class="p-0" style="width: 20%">
            @include('layouts.sidebarmenu')
        </div>

        <div class="p-3 d-flex flex-column" style="width: 80%">
            <div class="text-end">
                <a class="nav-link text-blue" href="">
                    <i class="fa fa-question-circle fa-2x" aria-hidden="true" title="Ayuda" style="color: #337AB7"></i>
                </a>
            </div>
            <h2 class="text-uppercase text-center" style="color: #337AB7">Permisos</h2>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $( document ).ready(function() {
            // $("#username").trigger('focus');
        });
    </script>
@stop


