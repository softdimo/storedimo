@extends('layouts.app')
@section('title', 'Inicio')

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
    <div class="d-flex p-0">
        <div class="col-4 p-0">
            @include('layouts.sidebarmenu')
        </div>

        <div class="col-8 p-5 d-flex flex-column align-items-center" style="">
            <div class="">
                <a class="nav-link text-blue" href="">
                    <i class="fa fa-question-circle fa-1x" aria-hidden="false"></i>
                </a>
            </div>

            <h2>storedimo</h2>

            <div class="d-flex">
                <div class="bg-danger border border-1 rounded" style="width:100%; height:100%"></div>
                <div class="bg-primary border border-1 rounded" style="width:100%; height:100%"></div>
            </div>

            <div class="d-flex mt-5">
                <div class="bg-info border border-1 rounded" style="width:100%; height:100%"></div>
                <div class="bg-warning border border-1 rounded" style="height:100px; width:200px"></div>
            </div>
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


