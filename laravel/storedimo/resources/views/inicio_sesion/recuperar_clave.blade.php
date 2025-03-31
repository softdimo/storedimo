@extends('layouts.app')
@section('title', 'Recovery Password')

@section('content')
    <div class="d-flex justify-content-center align-items-center">
        <form class="border border-dark-subtle p-3 rounded-4" method="post" action="{{route('recuperar_clave_email')}}" autocomplete="off">
            @csrf
            <span class="">Recuperar Clave</span>

            <div class="mt-3 mb-3">
                <input class="w-100 form-control" type="email" name="email" id="email" placeholder="Email" required>
            </div>

            <div class="mb-3">
                <input class="w-100 form-control" type="text" name="identificacion" id="identificacion" placeholder="Identificación" required>
            </div>

            {{-- ============================================ --}}

            <div class="mt-4 d-flex justify-content-end">
                <button class="btn btn-primary" type="submit">Correo clave</button>
            </div>

            {{-- ============================================ --}}

            <div class="text-left p-t-50 mt-3">
                <span class="txt1">
                    <a class="txt2 text-white btn btn-primary" href="{{route('login')}}">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Login
                    </a>
                </span>
            </div>
        </form>
    </div>
@stop

@section('scripts')
    <script>
        $( document ).ready(function() {
            $("#email").trigger('focus');
        });
    </script>
@endsection
