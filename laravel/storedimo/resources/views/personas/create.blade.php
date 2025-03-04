@extends('layouts.app')
@section('title', 'Crear Personas')

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
        <div class="p-0" style="width: 20%">
            @include('layouts.sidebarmenu')
        </div>

        {{-- ======================================================================= --}}
        {{-- ======================================================================= --}}

        <div class="p-3" style="width: 80%">
            <div class="text-end">
                <a href="#" role="button" title="Ayuda" class="text-blue" data-bs-toggle="modal" data-bs-target="#modalAyudaCrearPersonas">
                    <i class="fa fa-question-circle fa-2x" aria-hidden="false" title="Ayuda" style="color: #337AB7"></i>
                </a>
            </div>

            {{-- =============================================================== --}}
            {{-- =============================================================== --}}
            
            <div class="modal fade h-auto modal-gral p-3" id="modalAyudaCrearPersonas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static" style="max-width: 55%;">
                <div class="modal-dialog m-0 mw-100">
                    <div class="modal-content border-0">
                        <div class="modal-body p-0 rounded-top" style="border: solid 1px #337AB7; mw-50">
                            <div class="row">
                                <div class="col-12">
                                    <div class="rounded-top text-white text-center p-2" style="background-color: #337AB7; border: solid 1px #337AB7;">
                                        <span class="modal-title fs-5"><strong>Ayuda Registrar Personas</strong></span>
                                    </div>
                                    {{-- =========================== --}}
                                    <div class="p-3">
                                        <p class="text-justify">Señor usuario a la hora de realizar un registro tener en cuenta las siguientes recomendaciones:</p>

                                        <ol>
                                            <li class="text-justify">Todos los campos que poseen el asterisco (*) son obligatorios, por lo tanto sino se diligencian, el sistema no le dejará seguir.</li>
                                            <li class="text-justify">El campo número de documento, su logitud debe ser mayor a los 7 caracteres.</li>
                                            <li class="text-justify">En el momento del registro no se debe ingresar un número de documento ya existente en la base de datos.</li>
                                        </ol>
                                    </div> {{--FINpanel-body --}}
                                </div> {{--FIN col-12 --}}
                            </div> {{--FIN modal-body .row --}}
                        </div> {{--FIN modal-body --}}
                        {{-- =========================== --}}
                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="button" class="btn btn-primary btn-md active pull-right" data-bs-dismiss="modal" style="background-color: #337AB7;">
                                    <i class="fa fa-check-circle" aria-hidden="true">&nbsp;Aceptar</i>
                                </button>
                            </div>
                        </div>
                    </div> {{--FIN modal-content --}}
                </div> {{--FIN modal-dialog --}}
            </div> {{--FIN modalAyudaModificacionProductos --}}

            {{-- =============================================================== --}}
            {{-- =============================================================== --}}

            {!! Form::open(['method' => 'POST', 'route' => ['personas.store'], 'class' => 'mt-2', 'autocomplete' => 'off', 'id' => 'form_crear_usuarios']) !!}
                @csrf
            
                @include('personas.fields_crear_personas')
            {!! Form::close() !!}
        </div>
    </div>
@stop

{{-- =============================================================== --}}
{{-- =============================================================== --}}
{{-- =============================================================== --}}

@section('scripts')
    <script>
        $( document ).ready(function() {
            $('#tipo_persona').change(function () {
                let idTipoPersona = $('#tipo_persona').val();

                if (idTipoPersona == 1) {// Empleado-fijo
                    $('#div_fecha_contrato').removeClass('d-none');
                    $('#fecha_contrato').attr('required');

                    $('#div_rol').removeClass('d-none');
                    $('#rol').attr('required');

                    $('#div_nombre_usuario').removeClass('d-none');
                    $('#nombre_usuario').attr('required');

                    $('#div_password').removeClass('d-none');
                    $('#password').attr('required');

                    $('#div_confirmar_password').removeClass('d-none');
                    $('#confirmar_password').attr('required');

                    $('#div_nit_empresa').addClass('d-none');
                    $('#nit_empresa').removeAttr('required');

                    $('#div_nombre_empresa').addClass('d-none');
                    $('#nombre_empresa').removeAttr('required');

                    $('#div_telefono_empresa').addClass('d-none');
                    $('#telefono_empresa').removeAttr('required');
                }
                // Empleado-temporal
                else if (idTipoPersona == 2) {
                    $('#div_fecha_contrato').addClass('d-none');
                    $('#fecha_contrato').removeAttr('required');

                    $('#div_rol').removeClass('d-none');
                    $('#rol').attr('required');

                    $('#div_nombre_usuario').removeClass('d-none');
                    $('#nombre_usuario').attr('required');

                    $('#div_password').removeClass('d-none');
                    $('#password').attr('required');

                    $('#div_confirmar_password').removeClass('d-none');
                    $('#confirmar_password').attr('required');
                    
                    $('#div_nit_empresa').addClass('d-none');
                    $('#nit_empresa').removeAttr('required');

                    $('#div_nombre_empresa').addClass('d-none');
                    $('#nombre_empresa').removeAttr('required');

                    $('#div_telefono_empresa').addClass('d-none');
                    $('#telefono_empresa').removeAttr('required');
                }
                // Proveedor-natural
                else if (idTipoPersona == 3) {
                    $('#div_fecha_contrato').addClass('d-none');
                    $('#fecha_contrato').removeAttr('required');

                    $('#div_rol').addClass('d-none');
                    $('#rol').removeAttr('required');

                    $('#div_nombre_usuario').addClass('d-none');
                    $('#nombre_usuario').removeAttr('required');

                    $('#div_password').addClass('d-none');
                    $('#password').removeAttr('required');

                    $('#div_confirmar_password').addClass('d-none');
                    $('#confirmar_password').removeAttr('required');
                    
                    $('#div_nit_empresa').addClass('d-none');
                    $('#nit_empresa').removeAttr('required');

                    $('#div_nombre_empresa').addClass('d-none');
                    $('#nombre_empresa').removeAttr('required');

                    $('#div_telefono_empresa').addClass('d-none');
                    $('#telefono_empresa').removeAttr('required');
                }
                // Proveedor-juridico
                else if (idTipoPersona == 4) {
                    $('#div_fecha_contrato').addClass('d-none');
                    $('#fecha_contrato').removeAttr('required');

                    $('#div_rol').addClass('d-none');
                    $('#rol').removeAttr('required');

                    $('#div_nombre_usuario').addClass('d-none');
                    $('#nombre_usuario').removeAttr('required');

                    $('#div_password').addClass('d-none');
                    $('#password').removeAttr('required');

                    $('#div_confirmar_password').addClass('d-none');
                    $('#confirmar_password').removeAttr('required');

                    $('#div_nit_empresa').removeClass('d-none');
                    $('#nit_empresa').attr('required');

                    $('#div_nombre_empresa').removeClass('d-none');
                    $('#nombre_empresa').attr('required');

                    $('#div_telefono_empresa').removeClass('d-none');
                    $('#telefono_empresa').attr('required');
                }
                // Cliente-frecuente
                else if (idTipoPersona == 5) {
                    $('#div_fecha_contrato').addClass('d-none');
                    $('#fecha_contrato').removeAttr('required');

                    $('#div_rol').addClass('d-none');
                    $('#rol').removeAttr('required');

                    $('#div_nombre_usuario').addClass('d-none');
                    $('#nombre_usuario').removeAttr('required');

                    $('#div_password').addClass('d-none');
                    $('#password').removeAttr('required');

                    $('#div_confirmar_password').addClass('d-none');
                    $('#confirmar_password').removeAttr('required');

                    $('#div_nit_empresa').addClass('d-none');
                    $('#nit_empresa').removeAttr('required');

                    $('#div_nombre_empresa').addClass('d-none');
                    $('#nombre_empresa').removeAttr('required');

                    $('#div_telefono_empresa').addClass('d-none');
                    $('#telefono_empresa').removeAttr('required');
                }
                //  Cliente-NO-frecuente
                else if (idTipoPersona == 6) {
                    $('#div_fecha_contrato').addClass('d-none');
                    $('#fecha_contrato').removeAttr('required');

                    $('#div_rol').addClass('d-none');
                    $('#rol').removeAttr('required');

                    $('#div_nombre_usuario').addClass('d-none');
                    $('#nombre_usuario').removeAttr('required');

                    $('#div_password').addClass('d-none');
                    $('#password').removeAttr('required');

                    $('#div_confirmar_password').addClass('d-none');
                    $('#confirmar_password').removeAttr('required');

                    $('#div_nit_empresa').addClass('d-none');
                    $('#nit_empresa').removeAttr('required');

                    $('#div_nombre_empresa').addClass('d-none');
                    $('#nombre_empresa').removeAttr('required');

                    $('#div_telefono_empresa').addClass('d-none');
                    $('#telefono_empresa').removeAttr('required');
                }
                // Seleccionar...
                else {
                    $('#div_fecha_contrato').addClass('d-none');
                    $('#fecha_contrato').removeAttr('required');

                    $('#div_rol').addClass('d-none');
                    $('#rol').removeAttr('required');

                    $('#div_nombre_usuario').addClass('d-none');
                    $('#nombre_usuario').removeAttr('required');

                    $('#div_password').addClass('d-none');
                    $('#password').removeAttr('required');

                    $('#div_confirmar_password').addClass('d-none');
                    $('#confirmar_password').removeAttr('required');

                    $('#div_nit_empresa').addClass('d-none');
                    $('#nit_empresa').removeAttr('required');

                    $('#div_nombre_empresa').addClass('d-none');
                    $('#nombre_empresa').removeAttr('required');

                    $('#div_telefono_empresa').addClass('d-none');
                    $('#telefono_empresa').removeAttr('required');
                }
            });

            // ===================================================================================
            // ===================================================================================
        });
    </script>
@stop


