@extends('layouts.app')
@section('title', 'Link Recuperación Clave')

@section('content')
    <div class="container-fluid mt-auto mb-auto d-flex flex-column align-items-center">
        <div class="row mb-5">
            <div class="col-12">
                <h2 class="text-center text-uppercase">Bienvenid@</h2>
            </div>
        </div>

        {{-- =========================================================== --}}

        <div class="d-flex justify-content-center align-items-center">
            <form class="border border-dark-subtle p-3 rounded-4" method="post" action="{{route('recuperar_clave_update')}}" autocomplete="off">
                @csrf
                <span class="">Recuperar Clave</span>

                <input type="hidden" name="id_usuario" id="id_usuario" value="{{$usuIdRecuperarClave}}">
                
                {{-- ============================================ --}}

                <div class="mb-3">
                    <span class="btn-show-pass">
                        <i class="zmdi zmdi-eye"></i>
                    </span>
                    <input class="w-100 form-control" type="password" name="clave_nueva" id="clave_nueva" placeholder="Nueva clave" required>
                </div>

                <div class="">
                    <span class="btn-show-pass">
                        <i class="zmdi zmdi-eye"></i>
                    </span>
                    <input class="w-100 form-control" type="password" name="clave_nueva_confirmar" id="clave_nueva_confirmar" placeholder="Confirma clave" required>
                </div>

                {{-- ============================================ --}}

                <div class="mt-4 d-flex justify-content-end">
                    <button class="btn btn-primary" type="submit">Cambiar clave</button>
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
    </div>
@stop

@section('scripts')
    <script>
        $( document ).ready(function() {
            $("#new_pass").trigger('focus');
        });
    </script>
@endsection
