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
            let idEstado = $('#id_estado').val();
            console.log(idEstado);

            if (idEstado == 1 || idEstado == '') {
                $('#div_fecha_terminacion_contrato').hide();
                $('#fecha_terminacion_contrato').removeAttr('required');
            }

            $('#id_estado').change(function () {
                let idEstado = $('#id_estado').val();
                console.log(idEstado);

                if (idEstado == 1) { // Activo
                    $('#div_fecha_terminacion_contrato').hide();
                    $('#fecha_terminacion_contrato').removeAttr('required');
                } else if (idEstado == 2) { // Inactivo
                    $('#div_fecha_terminacion_contrato').show('slow');
                    $('#fecha_terminacion_contrato').attr('required');
                } else { // Seleccionar...
                    $('#div_fecha_terminacion_contrato').hide();
                    $('#fecha_terminacion_contrato').removeAttr('required');
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


