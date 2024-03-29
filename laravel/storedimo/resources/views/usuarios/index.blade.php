@extends('layouts.app')
@section('title', 'Usuarios')

{{-- =============================================================== --}}
{{-- =============================================================== --}}
{{-- =============================================================== --}}

@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('css/custom.css') }}"> --}}
    <style>
        .btn-circle {
            width: 30px;
            height: 30px;
            padding: 6px 0;
            border-radius: 50%;
            text-align: center;
            font-size: 12px;
            /* line-height: 1.428571429; */
        }

        .p-a {
            padding-left: 0.3rem !important;
            padding-right: 0.3rem !important;
            padding-top: 0.0rem !important;
            padding-bottom: 0.0rem !important;
        }
    </style>
@stop

{{-- =============================================================== --}}
{{-- =============================================================== --}}
{{-- =============================================================== --}}

@section('content')
    <div class="d-flex p-0">
        <div class="p-0" style="width: 20%">
            @include('layouts.sidebarmenu')
        </div>

        {{-- ======================================================================= --}}
        {{-- ======================================================================= --}}

        <div class="p-3 d-flex flex-column" style="width: 80%">
            <div class="text-end">
                <a href="#" class="text-blue">
                    <i class="fa fa-question-circle fa-2x" aria-hidden="false" title="Ayuda" style="color: #337AB7"></i>
                </a>
            </div>

            {{-- =============================================================== --}}
            {{-- =============================================================== --}}

            <div class="p-0" style="border: solid 1px #337AB7; border-radius: 5px;">
                <h5 class="border rounded-top text-white text-center pt-2 pb-2 m-0" style="background-color: #337AB7">Listar Usuarios-Empleados</h5>
            
                <div class="col-12 p-3" id="">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered w-100" id="tbl_usuarios" aria-describedby="users-empleados">
                            <thead>
                                <tr class="header-table text-center">
                                    <th>Identificación</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Celular</th>
                                    <th>Dirección</th>
                                    <th>Tipo Empleado</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            {{-- ============================== --}}
                            <tbody>
                                    <tr class="text-center">
                                        <td>Identificación</td>
                                        <td>Nombres</td>
                                        <td>Apellidos</td>
                                        <td>Celular</td>
                                        <td>Dirección</td>
                                        <td>Tipo Empleado</td>
                                        <td>Estado</td>
                                        <td>
                                            <a href="#" role="button" class="btn btn-primary rounded-circle p-a" title="Ver Detalles">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>

                                            <a href="#" role="button" class="btn btn-success rounded-circle p-a" title="Modificar">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>

                                            <a href="#" role="button" class="btn btn-warning rounded-circle p-a" title="Cambiar contraseña">
                                                <i class="fa fa-key" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    {{-- ========================================================= --}}
                    {{-- ========================================================= --}}
                    {{-- ========================================================= --}}
                    {{-- ========================================================= --}}
            
                    <div class="mt-5 mb-2 d-flex justify-content-center">
                        <button class="btn btn-success rounded-2 me-3" type="submit">
                            <i class="fa fa-file-pdf-o"></i>
                            Reporte PDF de Empleados
                        </button>
                    </div>
                </div> {{-- FIN div_campos_usuarios --}}
            </div> {{-- FIN div_crear_usuario --}}
            
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


