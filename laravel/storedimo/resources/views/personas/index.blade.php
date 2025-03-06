@extends('layouts.app')
@section('title', 'Personas')

{{-- =============================================================== --}}
{{-- =============================================================== --}}
{{-- =============================================================== --}}

@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('css/custom.css') }}"> --}}
    <style>
        .btn-circle {
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
    <div id="modal-overlay"></div>
    <div class="d-flex p-0">
        <div class="p-0" style="width: 20%">
            @include('layouts.sidebarmenu')
        </div>

        {{-- ======================================================================= --}}
        {{-- ======================================================================= --}}

        <div class="p-3 d-flex flex-column" style="width: 80%">
            <div class="text-end">
                <a href="#" role="button" title="Ayuda" class="text-blue" data-bs-toggle="modal" data-bs-target="#modalAyudaListarPersonas">
                    <i class="fa fa-question-circle fa-2x" aria-hidden="false" title="Ayuda" style="color: #337AB7"></i>
                </a>
            </div>

            {{-- ======================================================================= --}}
            {{-- ======================================================================= --}}

            <div class="modal fade h-auto modal-gral p-3" id="modalAyudaListarPersonas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static" style="max-width: 55%;">
                <div class="modal-dialog m-0 mw-100">
                    <div class="modal-content border-0">
                        <div class="modal-body p-0 rounded-top" style="border: solid 1px #337AB7; mw-50">
                            <div class="row">
                                <div class="col-12">
                                    <div class="rounded-top text-white text-center p-2" style="background-color: #337AB7; border: solid 1px #337AB7;">
                                        <span class="modal-title fs-5"><strong>Ayuda de Listar Personas</strong></span>
                                    </div>
                                    {{-- =========================== --}}
                                    <div class="p-3">
                                        <p class="text-justify">Señor usuario en esta vista usted se va a encontrar con diferentes opciones ubicadas al lado izquierdo de la tabla, cada una con una acción diferente, esas opciones son:
                                        </p>

                                        <ul>
                                            <li><strong>Opcion de Modificación:</strong>
                                                <ol>Tener en cuenta a la hora de modificar un empleado lo siguiente:
                                                    <li class="text-justify">Todos los campos que poseen el asterisco (*) son obligatorios, por lo tanto sino se diligencian,
                                                    el sistema no le dejará seguir.</li>
                                                    <li class="text-justify">Los campos nombre de usuario y email no pueden ser idénticos a datos ya registrados.</li>
                                                    <li class="text-justify">Al cambiar un empleado temporal a vinculado, el campo fecha de contrato cargará la fecha actual inicialmente, si usted desea cambiar esa fecha, está no puede ser menor ni superior a los 3 meses.</li>
                                                </ol>
                                                <br>
                                            </li>
                                            <li><strong>Opción de Cambio de Contraseña:</strong>
                                                <ol>Tener en cuenta a la hora de cambiar una contraseña lo siguente:
                                                    <li class="text-justify">La longitud de la contraseña debe ser mayor a 4 caracteres.</li>
                                                    <li class="text-justify">Ambos campos deben coincidir.</li>
                                                </ol>
                                            </li>
                                        </ul>
                                        <p class="text-justify">Por seguridad el empleado rol administrador no se le permitirá el cambio de estado</p>
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

            {{-- ======================================================================= --}}
            {{-- ======================================================================= --}}

            <div class="p-0" style="border: solid 1px #337AB7; border-radius: 5px;">
                <h5 class="border rounded-top text-white text-center pt-2 pb-2 m-0" style="background-color: #337AB7">Listar
                    Empleados</h5>

                <div class="col-12 p-3" id="">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered w-100 mb-0" id="tbl_personas"
                            aria-describedby="users-empleados">
                            <thead>
                                <tr class="header-table text-center">
                                    <th>Identificación</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Celular</th>
                                    <th>Dirección</th>
                                    <th>Tipo Empleado</th>
                                    <th>Estado</th>
                                    <th>Nit Empresa</th>
                                    <th>Nombre Empresa</th>
                                    <th>Teléfono Empresa</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            {{-- ============================== --}}
                            <tbody>
                                @foreach ($personaIndex as $persona)
                                    <tr class="text-center">
                                        <td>{{ $persona->identificacion }}</td>
                                        <td>{{ $persona->nombres_persona }}</td>
                                        <td>{{ $persona->apellidos_persona }}</td>
                                        <td>{{ $persona->celular }}</td>
                                        <td>{{ $persona->direccion }}</td>
                                        <td>{{ $persona->tipo_persona }}</td>
                                        <td>{{ $persona->estado }}</td>
                                        <td>{{ $persona->nit_empresa }}</td>
                                        <td>{{ $persona->nombre_empresa }}</td>
                                        <td>{{ $persona->telefono_empresa }}</td>
                                        <td>
                                            <a href="#modalEditarPersona_{{ $persona->id_persona }}"
                                                id="verModal_{{ $persona->id_persona }}" rel="modal:open">
                                                <button class="btn btn-success rounded-circle btn-circle"><i
                                                        class="fa fa-pencil-square-o" aria-hidden="true"
                                                        title="Modificar"></i>
                                                </button>
                                            </a>

                                            <a href="#ex1_{{ $persona->id_persona }}" rel="modal:open">
                                                <button class="btn btn-info">JQueryModal{{ $persona->id_persona }}</button>
                                            </a>
                                        </td>

                                        {{-- =============================================================== --}}
                                        {{-- =============================================================== --}}

                                        {{-- INICIO JQuery Modal Ejemplo --}}
                                        <div id="ex1_{{ $persona->id_persona }}" class="modal h-auto modal-gral">
                                            <p>JQuery Modal</p>
                                            <a href="#" rel="modal:close">Cerrar</a>
                                        </div>
                                        {{-- FIN JQuery Modal Ejemplo --}}

                                        {{-- INICIO Modal EDITAR PERSONA --}}
                                        <div class="modal h-auto modal-gral" style="max-width: 55%"
                                            id="modalEditarPersona_{{ $persona->id_persona }}" rel="modal:close">
                                            {{-- <a href="#" rel="modal:close">Cerrar</a> --}}
                                            <div class="modal-dialog mw-100  m-0">
                                                <div class="modal-content w-100 border-0">
                                                    {!! Form::open([
                                                        'method' => 'PUT',
                                                        'route' => ['personas.update', $persona->id_persona],
                                                        'class' => 'mt-2',
                                                        'autocomplete' => 'off',
                                                        'id' => 'formEditarPersona_' . $persona->id_persona,
                                                    ]) !!}
                                                    @csrf
                                                    <div class="">
                                                        <div class="rounded-top text-white text-center"
                                                            style="background-color: #337AB7; border: solid 1px #337AB7;">
                                                            <h5>Editar Persona</h5>
                                                        </div>

                                                        {{ Form::hidden('id_persona', isset($persona) ? $persona->id_persona : null, ['class' => '', 'id' => 'id_persona']) }}

                                                        {{-- ====================================================== --}}
                                                        {{-- ====================================================== --}}

                                                        <div class="modal-body p-0 m-0">
                                                            <div class="row m-0 pt-4 pb-4"
                                                                style="border: solid 1px #337AB7;">
                                                                <div class="col-12 col-md-4">
                                                                    <div class="form-group d-flex flex-column">
                                                                        <label for="id_tipo_persona" class=""
                                                                            style="font-size: 15px">Tipo Persona
                                                                            <span class="text-danger">*</span></label>
                                                                        {!! Form::select(
                                                                            'id_tipo_persona',
                                                                            collect(['' => 'Seleccionar...'])->union($tipos_persona),
                                                                            isset($persona) ? $persona->id_tipo_persona : null,
                                                                            ['class' => 'form-control', 'id' => 'id_tipo_persona'],
                                                                        ) !!}
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-4">
                                                                    <div class="form-group d-flex flex-column">
                                                                        <label for="id_tipo_documento" class=""
                                                                            style="font-size: 15px">Tipo de documento
                                                                            <span class="text-danger">*</span></label>
                                                                        {!! Form::select(
                                                                            'id_tipo_documento',
                                                                            collect(['' => 'Seleccionar...'])->union($tipos_documento),
                                                                            isset($persona) ? $persona->id_tipo_documento : null,
                                                                            ['class' => 'form-control', 'id' => 'id_tipo_documento'],
                                                                        ) !!}
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-4">
                                                                    <div class="form-group d-flex flex-column">
                                                                        <label for="identificacion" class=""
                                                                            style="font-size: 15px">Número de documento
                                                                            <span class="text-danger">*</span></label>
                                                                        {{ Form::text('identificacion', isset($persona) ? $persona->identificacion : null, ['class' => 'form-control', 'id' => 'identificacion', 'required' => 'required']) }}
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-4 mt-3">
                                                                    <div class="form-group d-flex flex-column">
                                                                        <label for="nombres_persona" class=""
                                                                            style="font-size: 15px">Nombre Persona
                                                                            <span class="text-danger">*</span></label>
                                                                        {{ Form::text('nombres_persona', isset($persona) ? $persona->nombres_persona : null, ['class' => 'form-control', 'id' => 'nombres_persona', 'required' => 'required']) }}
                                                                    </div>
                                                                </div>



                                                                <div class="col-12 col-md-4 mt-3">
                                                                    <div class="form-group d-flex flex-column">
                                                                        <label for="apellidos_persona" class=""
                                                                            style="font-size: 15px">Apellido Persona
                                                                            <span class="text-danger">*</span></label>
                                                                        {{ Form::text('apellidos_persona', isset($persona) ? $persona->apellidos_persona : null, ['class' => 'form-control', 'id' => 'apellidos_persona', 'required' => 'required']) }}
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-4 mt-3">
                                                                    <div class="form-group d-flex flex-column">
                                                                        <label for="numero_telefono" class=""
                                                                            style="font-size: 15px">Número Teléfono
                                                                            <span class="text-danger">*</span></label>
                                                                        {!! Form::text('numero_telefono', isset($persona) ? $persona->numero_telefono : null, [
                                                                            'class' => 'form-control',
                                                                            'id' => 'numero_telefono',
                                                                        ]) !!}
                                                                    </div>
                                                                </div>



                                                                <div class="col-12 col-md-4 mt-3">
                                                                    <div class="form-group d-flex flex-column">
                                                                        <label for="celular" class=""
                                                                            style="font-size: 15px">Celular
                                                                            <span class="text-danger">*</span></label>
                                                                        {{ Form::text('celular', isset($persona) ? $persona->celular : null, ['class' => 'form-control', 'id' => 'celular', 'required' => 'required']) }}
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-4 mt-3">
                                                                    <div class="form-group d-flex flex-column">
                                                                        <label for="email" class=""
                                                                            style="font-size: 15px">Correo
                                                                            <span class="text-danger">*</span></label>
                                                                        {{ Form::text('email', isset($persona) ? $persona->email : null, ['class' => 'form-control', 'id' => 'email', 'required' => 'required']) }}
                                                                    </div>
                                                                </div>




                                                                <div class="col-12 col-md-4 mt-3">
                                                                    <div class="form-group d-flex flex-column">
                                                                        <label for="id_genero" class=""
                                                                            style="font-size: 15px">Género
                                                                            <span class="text-danger">*</span></label>
                                                                        {!! Form::select(
                                                                            'id_genero',
                                                                            collect(['' => 'Seleccionar...'])->union($generos),
                                                                            isset($persona) ? $persona->id_genero : null,
                                                                            ['class' => 'form-control', 'id' => 'id_genero'],
                                                                        ) !!}
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-4 mt-3">
                                                                    <div class="form-group d-flex flex-column">
                                                                        <label for="direccion" class=""
                                                                            style="font-size: 15px">Dirección
                                                                            <span class="text-danger">*</span></label>
                                                                        {{ Form::text('direccion', isset($persona) ? $persona->direccion : null, ['class' => 'form-control', 'id' => 'direccion', 'required' => 'required']) }}
                                                                    </div>
                                                                </div>



                                                                <div class="col-12 col-md-4 mt-3">
                                                                    <div class="form-group d-flex flex-column">
                                                                        <label for="nit_empresa" class=""
                                                                            style="font-size: 15px">Nit Empresa
                                                                            <span class="text-danger">*</span></label>
                                                                        {!! Form::text('nit_empresa', isset($persona) ? $persona->nit_empresa : null, [
                                                                            'class' => 'form-control',
                                                                            'id' => 'nit_empresa',
                                                                        ]) !!}
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-4 mt-3">
                                                                    <div class="form-group d-flex flex-column">
                                                                        <label for="nombre_empresa"
                                                                            class="" style="font-size: 15px">Nombre Empresa
                                                                            <span class="text-danger">*</span></label>
                                                                        {!! Form::text('nombre_empresa', isset($persona) ? $persona->nombre_empresa : null, [
                                                                            'class' => 'form-control',
                                                                            'id' => 'nombre_empresa',
                                                                        ]) !!}
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-4 mt-3">
                                                                    <div class="form-group d-flex flex-column">
                                                                        <label for="telefono_empresa"
                                                                            class="" style="font-size: 15px">Teléfono Empresa
                                                                            <span class="text-danger">*</span></label>
                                                                        {!! Form::text('telefono_empresa', isset($persona) ? $persona->telefono_empresa : null, [
                                                                            'class' => 'form-control',
                                                                            'id' => 'telefono_empresa',
                                                                        ]) !!}
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-4 mt-3">
                                                                    <div class="form-group d-flex flex-column">
                                                                        <label for="id_estado" class=""
                                                                            style="font-size: 15px">Estado
                                                                            <span class="text-danger">*</span></label>
                                                                        {!! Form::select(
                                                                            'id_estado',
                                                                            collect(['' => 'Seleccionar...'])->union($generos),
                                                                            isset($persona) ? $persona->id_estado : null,
                                                                            ['class' => 'form-control', 'id' => 'id_estado'],
                                                                        ) !!}
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            {{-- ====================================================== --}}
                                                            {{-- ====================================================== --}}

                                                            <!-- Contenedor para el GIF -->
                                                            <div id="loadingIndicatorEdit_{{ $persona->id_persona }}"
                                                                class="loadingIndicator">
                                                                <img src="{{ asset('imagenes/loading.gif') }}"
                                                                    alt="Procesando...">
                                                            </div>

                                                            {{-- ====================================================== --}}
                                                            {{-- ====================================================== --}}

                                                            <div class="d-flex justify-content-around mt-3">
                                                                <button id="btn_editar_{{ $persona->id_persona }}"
                                                                    type="submit" class="btn btn-success"
                                                                    title="Guardar Configuración">
                                                                    <i class="fa fa-floppy-o" aria-hidden="true">
                                                                        Modificar</i>
                                                                </button>

                                                                <button id="btn_cancelar_{{ $persona->id_persona }}"
                                                                    type="button" class="btn btn-secondary"
                                                                    title="Cancelar">
                                                                    <i class="fa fa-times" aria-hidden="true">
                                                                        Cancelar</i>
                                                                </button>
                                                            </div>
                                                            {!! Form::close() !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- FINAL Modal EDITAR PERSONA --}}
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                    {{-- ========================================================= --}}
                    {{-- ========================================================= --}}
                    {{-- ========================================================= --}}
                    {{-- ========================================================= --}}

                    <div class="mt-5 mb-2 d-flex justify-content-center">
                        <button class="btn rounded-2 me-3 text-white" type="submit" style="background-color: #286090">
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
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('DataTables/Buttons-2.3.4/js/buttons.html5.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // INICIO DataTable Lista Personas
            $("#tbl_personas").DataTable({
                dom: 'Blfrtip',
                "infoEmpty": "No hay registros",
                stripe: true,
                "bSort": false,
                "buttons": [{
                        extend: 'copyHtml5',
                        text: 'Copiar',
                        className: 'waves-effect waves-light btn-rounded btn-sm btn-primary',
                        init: function(api, node, config) {
                            $(node).removeClass('dt-button')
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: 'Excel',
                        className: 'waves-effect waves-light btn-rounded btn-sm btn-primary mr-3',
                        customize: function(xlsx) {
                            var sheet = xlsx.xl.worksheets['sheet1.xml'];
                            $('row:first c', sheet).attr('s', '42');
                        }
                    }
                ],
                "pageLength": 10,
                "scrollX": true,
            });
            // CIERRE DataTable Lista Personas

            // ===========================================================================================
            // ===========================================================================================
            // $("#modalEditarPersona_").modal("show");

            // Event delegation para el botón de abrir modal
            $(document).on('click', 'a[id^="verModal_"]', function(e) {
                e.preventDefault(); // Evita el comportamiento predeterminado del enlace

                // Obtén el ID del modal asociado al botón
                var modalId = $(this).attr('href'); // Obtiene el valor del atributo href (ej: "#ex1_1")
                $(modalId).css('display', 'block'); // Muestra el modal
                // $("#modal-overlay").fadeIn();
                if ($(modalId).length) {
                    $("#modal-overlay").fadeIn(); // Muestra el fondo oscuro
                    $(modalId).modal({
                        showClose: false, // Oculta el botón de cerrar si quieres
                        escapeClose: false
                    });
                }
            });



            // Event delegation para el botón de cerrar modal 
            $(document).on('click', 'button[id^="btn_cancelar_"]', function(e) {
                e.preventDefault(); // Evita el comportamiento predeterminado del enlace

                // Obtener el ID de la persona desde el botón
                var personaId = $(this).attr('id').replace('btn_cancelar_', '');

                // Construir el ID del modal correspondiente
                var modalId = '#modalEditarPersona_' + personaId;

                // Ocultar el modal
                $(modalId).css('display', 'none');
                $("#modal-overlay").fadeOut();
            });


            $(document).on("submit", "form[id^='formEditarPersona_']", function(e) {

                const form = $(this);
                const formId = form.attr('id'); // Obtenemos el ID del formulario
                const id = formId.split('_')[1]; // Obtener el ID del formulario desde el ID del formulario

                // Capturar el indicador de carga dinámicamente
                const loadingIndicator = $(`#loadingIndicatorEdit_${id}`);

                // Capturar el botón de submit dinámicamente
                const submitButton = $(`#btn_editar_${id}`);

                // Capturar el botón de cancelar
                const cancelButton = $(`#btn_cancelar_${id}`);

                // Lógica del botón
                submitButton.prop("disabled", true).html(
                    "Procesando... <i class='fa fa-spinner fa-spin'></i>"
                );

                // Lógica del botón cancelar
                cancelButton.prop("disabled", true);
                loadingIndicator.show();
            });

        });
    </script>
@stop
