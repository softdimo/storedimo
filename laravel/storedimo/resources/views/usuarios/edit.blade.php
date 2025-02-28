@extends('layouts.app')
@section('title', 'Crear Usuarios')

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
                <a href="#" class="text-blue">
                    <i class="fa fa-question-circle fa-2x" aria-hidden="false" title="Ayuda" style="color: #337AB7"></i>
                </a>
            </div>

            {{-- =============================================================== --}}
            {{-- =============================================================== --}}

            {!! Form::open(['method' => 'PATCH', 'route' => ['usuarios.update', $usuario->id_usuario ], 'class' => 'mt-2', 'autocomplete' => 'off', 'id' => 'formEditarUsuario_'.$usuario->id_usuario]) !!}
            @csrf
                @method('PUT')
            
                @include('usuarios.fields_usuarios')
                
                {{-- ========================================================= --}}
                {{-- ========================================================= --}}

                <!-- Contenedor para el GIF -->
                <div id="loadingIndicatorEdit_{{$usuario->id_usuario}}" class="loadingIndicator">
                    <img src="{{asset('imagenes/loading.gif')}}" alt="Procesando...">
                </div>

                {{-- ========================================================= --}}
                {{-- ========================================================= --}}

                <div class="mt-5 mb-2 d-flex justify-content-center">
                    <button type="submit" class="btn btn-success rounded-2 me-3" id="btn_editar_{{$usuario->id_usuario}}">
                        <i class="fa fa-floppy-o"></i>
                        Guardar
                    </button>

                    <button type="button" class="btn btn-danger rounded-2" id="btn_cancelar_{{$usuario->id_usuario}}">
                        <i class="fa fa-remove"></i>
                        Cancelar
                    </button>
                </div>
            {!! Form::close() !!}

            {{-- @include('layouts.loader') --}}
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

            // formEditarUsuario para cargar gif en el submit
            $(document).on("submit", "form[id^='formEditarUsuario_']", function (e) {
                const form = $(this);
                const formId = form.attr('id'); // Obtenemos el ID del formulario
                const id = formId.split('_')[1]; // Obtener el ID de la categoría desde el ID del formulario

                // Capturar Spinner y botones dinámicamente
                const submitButton = $(`#btn_editar_${id}`);
                const cancelButton = $(`#btn_cancelar_${id}`);
                const loadingIndicator = $(`#loadingIndicatorEdit_${id}`);

                // Dessactivar Botones
                submitButton.prop("disabled", true).html("Procesando... <i class='fa fa-spinner fa-spin'></i>");
                cancelButton.prop("disabled", true);

                // Mostrar Spinner
                loadingIndicator.show();
            });
        }); // FIN document.ready
    </script>
@stop


