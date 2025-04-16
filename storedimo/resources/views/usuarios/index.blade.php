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
                <a href="#" role="button" title="Ayuda" class="text-blue" data-bs-toggle="modal"
                    data-bs-target="#modalAyudaListarUsuarios">
                    <i class="fa fa-question-circle fa-2x" aria-hidden="false" title="Ayuda" style="color: #337AB7"></i>
                </a>
            </div>

            {{-- ======================================================================= --}}
            {{-- ======================================================================= --}}

            <div class="modal fade h-auto modal-gral p-3" id="modalAyudaListarUsuarios" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static" style="max-width: 55%;">
                <div class="modal-dialog m-0 mw-100">
                    <div class="modal-content border-0">
                        <div class="modal-body p-0 rounded-top" style="border: solid 1px #337AB7; mw-50">
                            <div class="row">
                                <div class="col-12">
                                    <div class="rounded-top text-white text-center p-2"
                                        style="background-color: #337AB7; border: solid 1px #337AB7;">
                                        <span class="modal-title fs-5"><strong>Ayuda de Listar Empleados</strong></span>
                                    </div>
                                    {{-- =========================== --}}
                                    <div class="p-3">
                                        <p class="text-justify">Señor usuario en esta vista usted se va a encontrar con
                                            diferentes opciones ubicadas al lado izquierdo de la tabla, cada una con una
                                            acción diferente, esas opciones son:
                                        </p>

                                        <ul>
                                            <li><strong>Opcion de Modificación:</strong>
                                                <ol>Tener en cuenta a la hora de modificar un empleado lo siguiente:
                                                    <li class="text-justify">Todos los campos que poseen el asterisco (*)
                                                        son obligatorios, por lo tanto sino se diligencian,
                                                        el sistema no le dejará seguir.</li>
                                                    <li class="text-justify">Los campos nombre de usuario y email no pueden
                                                        ser idénticos a datos ya registrados.</li>
                                                    <li class="text-justify">Al cambiar un empleado temporal a vinculado, el
                                                        campo fecha de contrato cargará la fecha actual inicialmente, si
                                                        usted desea cambiar esa fecha, está no puede ser menor ni superior a
                                                        los 3 meses.</li>
                                                </ol>
                                                <br>
                                            </li>
                                            <li><strong>Opción de Cambio de Contraseña:</strong>
                                                <ol>Tener en cuenta a la hora de cambiar una contraseña lo siguente:
                                                    <li class="text-justify">La longitud de la contraseña debe ser mayor a 4
                                                        caracteres.</li>
                                                    <li class="text-justify">Ambos campos deben coincidir.</li>
                                                </ol>
                                            </li>
                                        </ul>
                                        <p class="text-justify">Por seguridad el empleado rol administrador no se le
                                            permitirá el cambio de estado</p>
                                    </div> {{-- FINpanel-body --}}
                                </div> {{-- FIN col-12 --}}
                            </div> {{-- FIN modal-body .row --}}
                        </div> {{-- FIN modal-body --}}
                        {{-- =========================== --}}
                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="button" class="btn btn-primary btn-md active pull-right"
                                    data-bs-dismiss="modal" style="background-color: #337AB7;">
                                    <i class="fa fa-check-circle" aria-hidden="true">&nbsp;Aceptar</i>
                                </button>
                            </div>
                        </div>
                    </div> {{-- FIN modal-content --}}
                </div> {{-- FIN modal-dialog --}}
            </div> {{-- FIN modalAyudaModificacionProductos --}}

            {{-- ======================================================================= --}}
            {{-- ======================================================================= --}}

            <div class="p-0" style="border: solid 1px #337AB7; border-radius: 5px;">
                <h5 class="border rounded-top text-white text-center pt-2 pb-2 m-0" style="background-color: #337AB7">Listar
                    Usuarios
                </h5>

                <div class="row pe-3 mt-3">
                    <div class="col-12 d-flex justify-content-end">
                        <a href="{{ route('usuarios.create') }}" class="btn text-white"
                            style="background-color:#337AB7">Crear Usuario</a>
                    </div>
                </div>

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
                                    <th>Tipo Persona</th>
                                    <th>Número Teléfono</th>
                                    <th>Celular</th>
                                    <th>Dirección</th>
                                    <th>Género</th>
                                    <th>Fecha Contrato</th>
                                    <th>Estado</th>
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
                                        <td>{{ $usuario->tipo_persona }}</td>
                                        <td>{{ $usuario->numero_telefono }}</td>
                                        <td>{{ $usuario->celular }}</td>
                                        <td>{{ $usuario->direccion }}</td>
                                        <td>{{ $usuario->genero }}</td>
                                        <td>{{ $usuario->fecha_contrato }}</td>
                                        <td>{{ $usuario->estado }}</td>
                                        <td>{{ $usuario->fecha_terminacion_contrato }}</td>
                                        <td>
                                            <button type="button" class="btn btn-success rounded-circle btn-circle"
                                                title="Editar" data-bs-toggle="modal"
                                                data-bs-target="#modalEditarUsuario_{{ $usuario->id_usuario }}">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </button>

                                            <button type="button" class="btn btn-warning rounded-circle btn-circle"
                                                title="Cambiar contraseña" data-bs-toggle="modal"
                                                data-bs-target="#modal_cambiar_clave_{{ $usuario->id_usuario }}">
                                                <i class="fa fa-key" aria-hidden="true"></i>
                                            </button>
                                        </td>

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

                                                        {{ Form::hidden('id_usuario', isset($usuario) ? $usuario->id_usuario : null, ['class' => '', 'id' => 'id_usuario', 'required' => 'required']) }}

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
                                                    <div id="loadingIndicatorEditClave_{{ $usuario->id_usuario }}"
                                                        class="loadingIndicator">
                                                        <img src="{{ asset('imagenes/loading.gif') }}"
                                                            alt="Procesando...">
                                                    </div>

                                                    {{-- ====================================================== --}}
                                                    {{-- ====================================================== --}}

                                                    <div class="d-flex justify-content-center mt-2">
                                                        <button type="submit" title="Guardar Configuración"
                                                            class="btn btn-success me-3"
                                                            id="btn_editar_clave_{{ $usuario->id_usuario }}">
                                                            <i class="fa fa-floppy-o" aria-hidden="true"> Modificar</i>
                                                        </button>


                                                        <button type="button" title="Cancelar" class="btn btn-secondary"
                                                            id="btn_cancelar_clave_{{ $usuario->id_usuario }}"
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
                                        <div class="modal fade h-auto modal-gral p-3"
                                            id="modalEditarUsuario_{{ $usuario->id_usuario }}" tabindex="-1"
                                            data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true"
                                            style="max-width: 55%;">
                                            <div class="modal-dialog m-0 mw-100">
                                                <div class="modal-content w-100 border-0">
                                                    {!! Form::model($usuario, [
                                                        'method' => 'PUT',
                                                        'route' => ['usuarios.update', $usuario->id_usuario],
                                                        'class' => 'mt-2',
                                                        'autocomplete' => 'off',
                                                        'id' => 'formEditarUsuario_' . $usuario->id_usuario,
                                                    ]) !!}
                                                    @csrf
                                                    <div class="rounded-top text-white text-center"
                                                        style="background-color: #337AB7; border: solid 1px #337AB7;">
                                                        <h5 class="m-0 pt-1 pb-1">Editar Usuario</h5>
                                                    </div>

                                                    {{ Form::hidden('id_usuario', isset($usuario) ? $usuario->id_usuario : null, ['class' => '', 'id' => 'id_usuario']) }}

                                                    {{-- ====================================================== --}}
                                                    {{-- ====================================================== --}}

                                                    <div class="modal-body p-0 m-0" style="border: solid 1px #337AB7;">
                                                        <div class="row m-2">
                                                            <div class="col-12 col-md-4">
                                                                <div class="form-group d-flex flex-column">
                                                                    <label for="id_tipo_persona" class=""
                                                                        style="font-size: 15px">Tipo Usuario
                                                                        <span class="text-danger">*</span></label>
                                                                    {{ Form::select(
                                                                        'id_tipo_persona',
                                                                        collect(['' => 'Seleccionar...'])->union($tipos_empleado),
                                                                        isset($usuario) ? $usuario->id_tipo_persona : null,
                                                                        ['class' => 'form-select', 'id' => 'id_tipo_persona', 'required' => 'required'],
                                                                    ) }}
                                                                </div>
                                                            </div>
                                                            {{-- ======================= --}}
                                                            <div class="col-12 col-md-4">
                                                                <div class="form-group d-flex flex-column">
                                                                    <label for="id_tipo_documento" class=""
                                                                        style="font-size: 15px">Tipo de documento
                                                                        <span class="text-danger">*</span></label>
                                                                    {!! Form::select(
                                                                        'id_tipo_documento',
                                                                        collect(['' => 'Seleccionar...'])->union($tipos_documento),
                                                                        isset($usuario) ? $usuario->id_tipo_documento : null,
                                                                        ['class' => 'form-select', 'id' => 'id_tipo_documento'],
                                                                    ) !!}
                                                                </div>
                                                            </div>
                                                            {{-- ======================= --}}
                                                            <div class="col-12 col-md-4">
                                                                <div class="form-group d-flex flex-column">
                                                                    <label for="identificacion" class=""
                                                                        style="font-size: 15px">Número de documento
                                                                        <span class="text-danger">*</span></label>
                                                                    {{ Form::text('identificacion', isset($usuario) ? $usuario->identificacion : null, ['class' => 'form-control', 'id' => 'identificacion', 'required' => 'required']) }}
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- ============================================== --}}

                                                        <div class="row m-2">
                                                            <div class="col-12 col-md-4">
                                                                <div class="form-group d-flex flex-column">
                                                                    <label for="nombre_usuario" class=""
                                                                        style="font-size: 15px">Nombre Usuario
                                                                        <span class="text-danger">*</span></label>
                                                                    {{ Form::text('nombre_usuario', isset($usuario) ? $usuario->nombre_usuario : null, ['class' => 'form-control', 'id' => 'nombre_usuario', 'required' => 'required']) }}
                                                                </div>
                                                            </div>
                                                            {{-- ======================= --}}
                                                            <div class="col-12 col-md-4">
                                                                <div class="form-group d-flex flex-column">
                                                                    <label for="apellido_usuario" class=""
                                                                        style="font-size: 15px">Apellido Usuario
                                                                        <span class="text-danger">*</span></label>
                                                                    {{ Form::text('apellido_usuario', isset($usuario) ? $usuario->apellido_usuario : null, ['class' => 'form-control', 'id' => 'apellido_usuario', 'required' => 'required']) }}
                                                                </div>
                                                            </div>
                                                            {{-- ======================= --}}
                                                            <div class="col-12 col-md-4">
                                                                <div class="form-group d-flex flex-column">
                                                                    <label for="numero_telefono" class=""
                                                                        style="font-size: 15px">Número Teléfono</label>
                                                                    {{ Form::text('numero_telefono', isset($usuario) ? $usuario->numero_telefono : null, ['class' => 'form-control', 'id' => 'numero_telefono']) }}
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- ============================================== --}}

                                                        <div class="row m-2">
                                                            <div class="col-12 col-md-4">
                                                                <div class="form-group d-flex flex-column">
                                                                    <label for="celular" class=""
                                                                        style="font-size: 15px">Celular
                                                                        <span class="text-danger">*</span>
                                                                    </label>
                                                                    {{ Form::text('celular', isset($usuario) ? $usuario->celular : null, [
                                                                        'class' => 'form-control',
                                                                        'id' => 'celular',
                                                                        'required' => 'required',
                                                                    ]) }}
                                                                </div>
                                                            </div>
                                                            {{-- ======================= --}}
                                                            <div class="col-12 col-md-4">
                                                                <div class="form-group d-flex flex-column">
                                                                    <label for="email" class=""
                                                                        style="font-size: 15px">Correo
                                                                        <span class="text-danger">*</span></label>
                                                                    {{ Form::email('email', isset($usuario) ? $usuario->email : null, ['class' => 'form-control', 'id' => 'email', 'required' => 'required']) }}
                                                                    {{-- <small id="email-error-{{ $usuario->id_usuario }}" class="text-danger d-none"></small> --}}
                                                                </div>
                                                            </div>

                                                            {{-- ======================= --}}
                                                            <div class="col-12 col-md-4">
                                                                <div class="form-group d-flex flex-column">
                                                                    <label for="id_genero" class=""
                                                                        style="font-size: 15px">Género
                                                                        <span class="text-danger">*</span></label>
                                                                    {!! Form::select(
                                                                        'id_genero',
                                                                        collect(['' => 'Seleccionar...'])->union($generos),
                                                                        isset($usuario) ? $usuario->id_genero : null,
                                                                        ['class' => 'form-select', 'id' => 'id_genero'],
                                                                    ) !!}
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- ============================================== --}}

                                                        <div class="row m-2">
                                                            <div class="col-12 col-md-3">
                                                                <div class="form-group d-flex flex-column">
                                                                    <label for="direccion" class=""
                                                                        style="font-size: 15px">Dirección</label>
                                                                    {{ Form::text('direccion', isset($usuario) ? $usuario->direccion : null, [
                                                                        'class' => 'form-control',
                                                                        'id' => 'direccion',
                                                                    ]) }}
                                                                </div>
                                                            </div>
                                                            {{-- ======================= --}}
                                                            <div class="col-12 col-md-3">
                                                                <div class="form-group d-flex flex-column">
                                                                    <label for="id_rol" class=""
                                                                        style="font-size: 15px">Rol
                                                                        <span class="text-danger">*</span>
                                                                    </label>
                                                                    {!! Form::select(
                                                                        'id_rol',
                                                                        collect(['' => 'Seleccionar...'])->union($roles),
                                                                        isset($usuario) ? $usuario->id_rol : null,
                                                                        ['class' => 'form-select', 'id' => 'id_rol'],
                                                                    ) !!}
                                                                </div>
                                                            </div>
                                                            {{-- ======================= --}}
                                                            <div class="col-12 col-md-3">
                                                                <div class="form-group d-flex flex-column">
                                                                    <label for="id_estado" class=""
                                                                        style="font-size: 15px">Estado
                                                                        <span class="text-danger">*</span>
                                                                    </label>
                                                                    {!! Form::select(
                                                                        'id_estado',
                                                                        collect(['' => 'Seleccionar...'])->union($estados),
                                                                        isset($usuario) ? $usuario->id_estado : null,
                                                                        ['class' => 'form-select', 'id' => 'id_estado_' . $usuario->id_usuario],
                                                                    ) !!}
                                                                </div>
                                                            </div>
                                                            {{-- ======================= --}}
                                                            <div class="col-12 col-md-3">
                                                                <div class="form-group d-flex flex-column">
                                                                    <label for="fecha_contrato" class="">Fecha
                                                                        contrato
                                                                        <span class="text-danger">*</span>
                                                                    </label>
                                                                    {!! Form::date('fecha_contrato', isset($usuario) ? $usuario->fecha_contrato : null, [
                                                                        'class' => 'form-control',
                                                                        'id' => 'fecha_contrato',
                                                                        'required' => 'required',
                                                                    ]) !!}
                                                                </div>
                                                            </div>
                                                            {{-- ======================= --}}
                                                            <div class="col-12 col-md-3"
                                                                id="div_fecha_terminacion_contrato_{{ $usuario->id_usuario }}">
                                                                <div class="form-group d-flex flex-column">
                                                                    <label for="fecha_terminacion_contrato"
                                                                        class="">Fecha terminación contrato
                                                                        <span class="text-danger">*</span>
                                                                    </label>
                                                                    {!! Form::date('fecha_terminacion_contrato', isset($usuario) ? $usuario->fecha_terminacion_contrato : null, [
                                                                        'class' => 'form-control',
                                                                        'id' => 'fecha_terminacion_contrato_' . $usuario->id_usuario,
                                                                    ]) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> {{-- FIN modal-body --}}

                                                    {{-- ====================================================== --}}
                                                    {{-- ====================================================== --}}

                                                    <div class="modal-footer d-block mt-0 border border-0">
                                                        <!-- Contenedor para el GIF -->
                                                        <div id="loadingIndicatorEditUser_{{ $usuario->id_usuario }}"
                                                            class="loadingIndicator">
                                                            <img src="{{ asset('imagenes/loading.gif') }}"
                                                                alt="Procesando...">
                                                        </div>

                                                        {{-- ====================================================== --}}
                                                        {{-- ====================================================== --}}

                                                        <div class="d-flex justify-content-center mt-3">
                                                            <button id="btn_editar_user_{{ $usuario->id_usuario }}"
                                                                type="submit" class="btn btn-success me-3"
                                                                title="Guardar Configuración">
                                                                <i class="fa fa-floppy-o" aria-hidden="true">
                                                                    Modificar</i>
                                                            </button>

                                                            <button id="btn_cancelar_user_{{ $usuario->id_usuario }}"
                                                                type="button" class="btn btn-secondary" title="Cancelar"
                                                                data-bs-dismiss="modal">
                                                                <i class="fa fa-times" aria-hidden="true"> Cancelar</i>
                                                            </button>
                                                        </div>
                                                    </div> {{-- modal-footer --}}
                                                    {!! Form::close() !!}
                                                </div> {{-- modal-content --}}
                                            </div> {{-- modal-dialog --}}
                                        </div> {{-- FINAL Modal EDITAR USUARIO --}}
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

            function validatePassword(nuevaClaveValor) {
                let regex =
                    /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&+\-/_¿¡#.,:;=~^(){}\[\]<>`|"'])[A-Za-z\d@$!%*?&+\-/_¿¡#.,:;=~^(){}\[\]<>`|"']{6,}$/;
                if (!regex.test(nuevaClaveValor)) {
                    return "La contraseña debe tener al menos una letra mayúscula, una letra minúscula, un número, un carácter especial, y ser de al menos 6 caracteres.";
                }
                return null;
            }

            // formCambiarClave para cargar gif en el submit
            $(document).on("submit", "form[id^='formCambiarClave_']", function(e) {
                e.preventDefault(); // Evita el envío si hay errores

                const form = $(this);
                const formId = form.attr('id'); // Obtenemos el ID del formulario
                const id = formId.split('_')[1]; // Obtener el ID del formulario desde el ID del formulario

                // Identificar campos de nueva clave y confirmación
                const nuevaClave = `#nueva_clave_${id}`;
                const confirmarClave = `#confirmar_clave_${id}`;

                let nuevaClaveValor = $(nuevaClave).val();
                let confirmarClaveValor = $(confirmarClave).val();

                if (nuevaClaveValor.trim() === '' || confirmarClaveValor.trim() === '') {
                    Swal.fire('Cuidado!', 'Ambos campos de contraseña deben estar diligenciados!',
                        'warning');
                    return;
                }

                if (nuevaClaveValor !== confirmarClaveValor) {
                    Swal.fire('Error!', 'Las contraseñas no coinciden!', 'error');
                    return;
                }

                // Validación de la seguridad de la contraseña
                let errorMessage = validatePassword(nuevaClaveValor);

                if (errorMessage) {
                    Swal.fire('Error!', errorMessage, 'error');
                    return;
                }

                // Deshabilitar campos
                $(nuevaClave).prop("readonly", true);
                $(confirmarClave).prop("readonly", true);

                // Capturar el indicador de carga y botones dinámicamente
                const submitButton = $(`#btn_editar_clave_${id}`);
                const cancelButton = $(`#btn_cancelar_clave_${id}`);
                const loadingIndicator = $(`#loadingIndicatorEditClave_${id}`);

                // Lógica del botón
                loadingIndicator.show();
                cancelButton.prop("disabled", true);
                submitButton.prop("disabled", true).html(
                    "Procesando... <i class='fa fa-spinner fa-spin'></i>");

                // Enviar formulario manualmente
                this.submit();
            });

            // ===========================================================================================

            // Botón de submit de editar usuario
            $(document).on("submit", "form[id^='formEditarUsuario_']", function(e) {

                const form = $(this);
                const formId = form.attr('id'); // Obtenemos el ID del formulario
                const id = formId.split('_')[1]; // Obtener el ID del formulario desde el ID del formulario

                // Capturar el indicador de carga dinámicamente
                const loadingIndicator = $(`#loadingIndicatorEditUser_${id}`);

                // Capturar el botón de submit dinámicamente
                const submitButton = $(`#btn_editar_user_${id}`);

                // Capturar el botón de cancelar
                const cancelButton = $(`#btn_cancelar_user_${id}`);

                // Lógica del botón
                submitButton.prop("disabled", true).html(
                    "Procesando... <i class='fa fa-spinner fa-spin'></i>"
                );

                // Lógica del botón cancelar
                cancelButton.prop("disabled", true);
                loadingIndicator.show();
            });

            // ===========================================================================================

            $(document).on('shown.bs.modal', '.modal', function() {
                // Buscar el select dentro del modal
                let selectEstado = $(this).find('[id^=id_estado_]');

                if (selectEstado.length > 0) {
                    let idEstado = selectEstado.val(); // Obtener el valor actual del select
                    console.log(`Estado al abrir el modal: ${idEstado}`);

                    // Buscar los elementos dentro de este modal
                    let divFechaTerminacion = $(this).find('[id^=div_fecha_terminacion_contrato]');
                    let inputFechaTerminacion = $(this).find('[id^=fecha_terminacion_contrato]');

                    // Aplicar la lógica de ocultar o mostrar
                    if (idEstado == 1 || idEstado == '') {
                        divFechaTerminacion.hide();
                        inputFechaTerminacion.removeAttr('required');
                        inputFechaTerminacion.val('');
                    } else {
                        divFechaTerminacion.show();
                        inputFechaTerminacion.attr('required', 'required');
                    }
                }
            });

            // ===========================================================================================

            $(document).on('change', '[id^=id_estado_]', function() {
                let idEstado = $(this).val();
                console.log("Estado cambiado a:", idEstado);

                // Buscar el modal más cercano donde está el select
                let modal = $(this).closest('.modal');

                // Buscar los elementos dentro de este modal
                let divFechaTerminacion = modal.find('[id^=div_fecha_terminacion_contrato]');
                let inputFechaTerminacion = modal.find('[id^=fecha_terminacion_contrato]');

                if (idEstado == 1) { // Activo
                    divFechaTerminacion.hide();
                    inputFechaTerminacion.removeAttr('required');
                    inputFechaTerminacion.val('');
                } else if (idEstado == 2) { // Inactivo
                    divFechaTerminacion.show('slow');
                    inputFechaTerminacion.attr('required', 'required');
                } else { // Seleccionar...
                    divFechaTerminacion.hide();
                    inputFechaTerminacion.removeAttr('required');
                }
            });
        }); // FIN document.ready
    </script>
@stop
