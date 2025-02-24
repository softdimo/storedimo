@extends('layouts.app')
@section('title', 'Usuarios')

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

        .modal-clave {
            top: auto !important;
            left: auto !important;
        }

        .jquery-modal {
            display: none;
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
                <h5 class="border rounded-top text-white text-center pt-2 pb-2 m-0" style="background-color: #337AB7">Listar
                    Usuarios</h5>

                @php
                    #dd($usuarioIndex);
                @endphp
                <div class="col-12 p-3" id="">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered w-100 mb-0" id="tbl_usuarios"
                            aria-describedby="users-usuarios">
                            <thead>
                                <tr class="header-table text-center">
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Usuario</th>
                                    <th>Tipo Documento</th>
                                    <th>Identificación</th>
                                    <th>Correo</th>
                                    <th>Rol</th>
                                    <th>Estado</th>
                                    <th>Tipo Persona</th>
                                    <th>Número Teléfono</th>
                                    <th>Celular</th>
                                    <th>Dirección</th>
                                    <th>Género</th>
                                    <th>Fecha Contrato</th>
                                    <th>Terminación Contrato</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            {{-- ============================== --}}
                            <tbody>
                                @foreach ($usuarioIndex as $usuario)
                                    <tr class="text-center">
                                        <td>{{ $usuario->nombre_usuario }}</td>
                                        <td>{{ $usuario->apellido_usuario }}</td>
                                        <td>{{ $usuario->usuario }}</td>
                                        <td>{{ $usuario->tipo_documento }}</td>
                                        <td>{{ $usuario->identificacion }}</td>
                                        <td>{{ $usuario->email }}</td>
                                        <td>{{ $usuario->rol }}</td>
                                        <td>{{ $usuario->estado }}</td>
                                        <td>{{ $usuario->tipo_persona }}</td>
                                        <td>{{ $usuario->numero_telefono }}</td>
                                        <td>{{ $usuario->celular }}</td>
                                        <td>{{ $usuario->direccion }}</td>
                                        <td>{{ $usuario->genero }}</td>
                                        <td>{{ $usuario->fecha_contrato }}</td>
                                        <td>{{ $usuario->fecha_terminacion_contrato }}</td>
                                        <td>
                                            

                                            {{-- <a href="{{ route('usuarios.edit', $usuario->id_usuario) }}" role="button"
                                                class="btn btn-success rounded-circle btn-circle" title="Modificar">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a> --}}

                                            {{-- <a href="#edit_usuario_{{ $usuario->id_usuario }}" role="button"
                                                class="btn btn-success rounded-circle btn-circle" title="Modificar" rel="modales:open">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a> --}}

                                            <button type="button" class="btn btn-success rounded-circle btn-circle"
                                                title="Editar" data-bs-toggle="modal"
                                                data-bs-target="#modalEditarUsuario_{{$usuario->id_usuario}}">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </button>

                                            {{-- <a href="#editUsuario_{{ $usuario->id_usuario }}" role="button"
                                                class="btn btn-success rounded-circle btn-circle" title="Modificar"
                                                rel="modal:open">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a> --}}

                                            <button type="button" class="btn btn-warning rounded-circle btn-circle"
                                                title="Cambiar contraseña" data-bs-toggle="modal"
                                                data-bs-target="#modal_cambiar_clave_{{ $usuario->id_usuario }}">
                                                <i class="fa fa-key" aria-hidden="true"></i>
                                            </button>
                                        </td>

                                        <!-- Modal para editar usuario -->
                                        <div id="editUsuario_{{ $usuario->id_usuario }}" class="jquery-modal">
                                            <p>Editando usuario: {{ $usuario->nombre_usuario }}
                                                {{ $usuario->apellido_usuario }}</p>
                                            <a href="#" rel="modal:close">Cerrar</a>
                                        </div>

                                        {{-- ====================================================== --}}
                                        {{-- ====================================================== --}}

                                        {{-- INICIO Modal CAMBIAR CONTRASEÑA --}}
                                        <div class="modal fade h-auto modal-gral"
                                            id="modal_cambiar_clave_{{ $usuario->id_usuario }}" tabindex="-1"
                                            data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
                                            <div class="modal-dialog m-0">
                                                <div class="modal-content w-100 border-0">
                                                    {!! Form::open([
                                                        'method' => 'POST',
                                                        'route' => ['cambiar_clave'],
                                                        'class' => 'mt-2',
                                                        'autocomplete' => 'off',
                                                        'id' => 'formCambiarClave_' . $usuario->id_usuario,
                                                    ]) !!}
                                                    @csrf
                                                    <div class="" style="border: solid 1px #337AB7;">
                                                        <div class="rounded-top text-white text-center"
                                                            style="background-color: #337AB7; border: solid 1px #337AB7;">
                                                            <h5>Cambiar Contraseña de:
                                                                {{ $usuario->identificacion . ' - ' . $usuario->nombre_usuario . ' ' . $usuario->apellido_usuario }}
                                                            </h5>
                                                        </div>

                                                        {{ Form::hidden('id_usuario', isset($usuario) ? $usuario->id_usuario : null, ['class' => '', 'id' => 'id_usuario']) }}

                                                        {{-- ====================================================== --}}
                                                        {{-- ====================================================== --}}

                                                        <div class="modal-body p-0 m-0">
                                                            <div class="row m-0 pt-4 pb-4">
                                                                <div class="col-12 col-md-6">
                                                                    <div class="form-group d-flex flex-column">
                                                                        <label for="nueva_clave" class=""
                                                                            style="font-size: 15px">Nueva Contraseña<span
                                                                                class="text-danger">*</span></label>
                                                                        {{ Form::text('nueva_clave', null, ['class' => 'form-control', 'id' => 'nueva_clave_' . $usuario->id_usuario, 'placeholder' => 'Contraseña', 'required' => 'required']) }}
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-6">
                                                                    <div class="form-group d-flex flex-column">
                                                                        <label for="confirmar_clave" class=""
                                                                            style="font-size: 15px">Confirmar
                                                                            Contraseña<span
                                                                                class="text-danger">*</span></label>
                                                                        {{ Form::text('confirmar_clave', null, ['class' => 'form-control', 'id' => 'confirmar_clave_' . $usuario->id_usuario, 'placeholder' => 'Confirmar Contraseña', 'required' => 'required']) }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- ====================================================== --}}
                                                    {{-- ====================================================== --}}

                                                    <!-- Contenedor para el GIF -->
                                                    <div id="loadingIndicatorEdit_{{ $usuario->id_usuario }}"
                                                        class="loadingIndicator">
                                                        <img src="{{ asset('imagenes/loading.gif') }}" alt="Procesando...">
                                                    </div>

                                                    {{-- ====================================================== --}}
                                                    {{-- ====================================================== --}}

                                                    <div class="d-flex justify-content-around mt-2">
                                                        <button id="btn_editar_{{ $usuario->id_usuario }}" type="submit"
                                                            class="btn btn-success" title="Guardar Configuración">
                                                            <i class="fa fa-floppy-o" aria-hidden="true"> Modificar</i>
                                                        </button>


                                                        <button type="button" class="btn btn-secondary" title="Cancelar"
                                                            data-bs-dismiss="modal">
                                                            <i class="fa fa-times" aria-hidden="true"> Cancelar</i>
                                                        </button>
                                                    </div>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                        {{-- FINAL Modal CAMBIAR CONTRASEÑA --}}

                                        {{-- ====================================================== --}}
                                        {{-- ====================================================== --}}

                                        {{-- INICIO Modal EDITAR USUARIO --}}
                                        <div class="modal fade h-auto modal-gral"
                                            id="modalEditarUsuario_{{ $usuario->id_usuario }}" tabindex="-1"
                                            data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
                                            <div class="modal-dialog m-0">
                                                <div class="modal-content w-100 border-0">
                                                    {!! Form::open([
                                                        'method' => 'PUT',
                                                        'route' => ['usuarios.update', $usuario->id_usuario],
                                                        'class' => 'mt-2',
                                                        'autocomplete' => 'off',
                                                        'id' => 'formEditarUsuario_' . $usuario->id_usuario,
                                                    ]) !!}
                                                    @csrf
                                                    <div class="">
                                                        <div class="rounded-top text-white text-center"
                                                            style="background-color: #337AB7; border: solid 1px #337AB7;">
                                                            <h5>Editar Usuario</h5>
                                                        </div>

                                                        {{ Form::hidden('id_usuario', isset($usuario) ? $usuario->id_usuario : null, ['class' => '', 'id' => 'id_usuario']) }}

                                                        {{-- ====================================================== --}}
                                                        {{-- ====================================================== --}}

                                                        <div class="modal-body p-0 m-0" style="border: solid 1px #337AB7;">
                                                            <div class="row m-0 pt-4 pb-4">
                                                                <div class="col-12 col-md-6">
                                                                    <div class="form-group d-flex flex-column">
                                                                        <label for="nombre_usuario" class="" style="font-size: 15px">Nombre Usuario
                                                                            <span class="text-danger">*</span></label>
                                                                        {{ Form::text('nombre_usuario', isset($usuario) ? $usuario->nombre_usuario : null, ['class' => 'form-control', 'id' => 'nombre_usuario', 'required' => 'required']) }}
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-6">
                                                                    <div class="form-group d-flex flex-column">
                                                                        <label for="apellido_usuario" class="" style="font-size: 15px">Apellido Usuario
                                                                                <span class="text-danger">*</span></label>
                                                                        {{ Form::text('apellido_usuario', isset($usuario) ? $usuario->apellido_usuario : null, ['class' => 'form-control', 'id' => 'apellido_usuario', 'required' => 'required']) }}
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row m-0 pt-4 pb-4">
                                                                <div class="col-12 col-md-6">
                                                                    <div class="form-group d-flex flex-column">
                                                                        <label for="identificacion" class="" style="font-size: 15px">Número de documento
                                                                            <span class="text-danger">*</span></label>
                                                                        {{ Form::text('identificacion', isset($usuario) ? $usuario->identificacion : null, ['class' => 'form-control', 'id' => 'identificacion', 'required' => 'required']) }}
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-6">
                                                                    <div class="form-group d-flex flex-column">
                                                                        <label for="id_tipo_documento" class="" style="font-size: 15px">Tipo de documento
                                                                                <span class="text-danger">*</span></label>
                                                                            {!! Form::select('id_tipo_documento', collect(['' => 'Seleccionar...'])->union($tipos_documento), isset($usuario) ? $usuario->id_tipo_documento : null, ['class' => 'form-control', 'id' =>'id_tipo_documento'])!!}
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="row m-0 pt-4 pb-4">
                                                                <div class="col-12 col-md-6">
                                                                    <div class="form-group d-flex flex-column">
                                                                        <label for="email" class="" style="font-size: 15px">Correo
                                                                            <span class="text-danger">*</span></label>
                                                                        {{ Form::text('email', isset($usuario) ? $usuario->email : null, ['class' => 'form-control', 'id' => 'email', 'required' => 'required']) }}
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-6">
                                                                    <div class="form-group d-flex flex-column">
                                                                        <label for="id_rol" class="" style="font-size: 15px">Rol
                                                                                <span class="text-danger">*</span></label>
                                                                            {!! Form::select('id_rol', collect(['' => 'Seleccionar...'])->union($roles), isset($usuario) ? $usuario->id_rol : null, ['class' => 'form-control', 'id' =>'id_rol'])!!}
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="row m-0 pt-4 pb-4">
                                                                <div class="col-12 col-md-6">
                                                                    <div class="form-group d-flex flex-column">
                                                                        <label for="id_estado" class="" style="font-size: 15px">Estado
                                                                                <span class="text-danger">*</span></label>
                                                                            {!! Form::select('id_estado', collect(['' => 'Seleccionar...'])->union($estados), isset($usuario) ? $usuario->id_estado : null, ['class' => 'form-control', 'id' =>'id_estado'])!!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    {{-- ====================================================== --}}
                                                    {{-- ====================================================== --}}

                                                    <!-- Contenedor para el GIF -->
                                                    <div id="loadingIndicatorEdit_{{$usuario->id_usuario}}"
                                                        class="loadingIndicator">
                                                        <img src="{{ asset('imagenes/loading.gif') }}" alt="Procesando...">
                                                    </div>

                                                    {{-- ====================================================== --}}
                                                    {{-- ====================================================== --}}

                                                    <div class="d-flex justify-content-around mt-3">
                                                        <button id="btn_editar_{{ $usuario->id_usuario }}" type="submit"
                                                            class="btn btn-success" title="Guardar Configuración">
                                                            <i class="fa fa-floppy-o" aria-hidden="true"> Modificar</i>
                                                        </button>

                                                        <button id="btn_cancelar_{{ $usuario->id_usuario }}" type="button" class="btn btn-secondary" title="Cancelar"
                                                            data-bs-dismiss="modal">
                                                            <i class="fa fa-times" aria-hidden="true"> Cancelar</i>
                                                        </button>
                                                    </div>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                        {{-- FINAL Modal EDITAR USUARIO --}}
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
                            Reporte PDF de Usuarios
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
            // INICIO DataTable Lista Usuarios
            $("#tbl_usuarios").DataTable({
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
            // CIERRE DataTable Lista Usuarios

            // ===========================================================================================

            /* $('#manual-ajax').click(function(event) {
                event.preventDefault();
                this.blur(); // Manually remove focus from clicked link.
                $.get(this.href, function(html) {
                    $(html).appendTo('body').modal();
                });
            }); */
            // ===========================================================================================

            // formEditarCategoria para cargar gif en el submit

            $(document).on("submit", "form[id^='formCambiarClave_']", function(e) {

                const form = $(this);
                const formId = form.attr('id'); // Obtenemos el ID del formulario
                const id = formId.split('_')[1]; // Obtener el ID del formulario desde el ID del formulario

                // Capturar el indicador de carga dinámicamente
                const loadingIndicatorId = `#loadingIndicatorEdit_${id}`;
                const loadingIndicator = $(loadingIndicatorId);

                // Capturar el botón de submit dinámicamente
                const submitButtonId = `#btn_editar_${id}`;
                const submitButton = $(submitButtonId);

                // Lógica del botón
                submitButton.prop("disabled", true).html(
                    "Procesando... <i class='fa fa-spinner fa-spin'></i>");
                loadingIndicator.show();

                // Readonly para el campo nueva clave
                const nuevaClave = `#nueva_clave_${id}`;
                const nuevaClaveReadOnly = $(nuevaClave);
                nuevaClaveReadOnly.prop("readonly", true);


                // Readonly para el campo confirmar clave
                const confirmarClave = `#confirmar_clave_${id}`;
                const confirmarClaveReadOnly = $(confirmarClave);
                confirmarClaveReadOnly.prop("readonly", true);
            });

            
            // Botón de submit de editar usuario
            $(document).on("submit", "form[id^='formEditarUsuario_']", function(e) {

                const form = $(this);
                const formId = form.attr('id'); // Obtenemos el ID del formulario
                const id = formId.split('_')[1]; // Obtener el ID del formulario desde el ID del formulario

                // Capturar el indicador de carga dinámicamente
                const loadingIndicatorId = `#loadingIndicatorEdit_${id}`;
                const loadingIndicator = $(loadingIndicatorId);

                // Capturar el botón de submit dinámicamente
                const submitButtonId = `#btn_editar_${id}`;
                const submitButton = $(submitButtonId);

                // Capturar el botón de cancelar
                const cancelButtonId = `#btn_cancelar_${id}`;
                const cancelButton = $(cancelButtonId);

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
