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
                                    <th>Identificación</th>
                                    <th>Correo</th>
                                    <th>Rol</th>
                                    <th>Estado</th>
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
                                        <td>{{ $usuario->identificacion }}</td>
                                        <td>{{ $usuario->email }}</td>
                                        <td>{{ $usuario->rol }}</td>
                                        <td>{{ $usuario->estado }}</td>
                                        <td>
                                            <a href="#" role="button"
                                                class="btn btn-primary rounded-circle btn-circle" title="Ver Detalles">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>

                                            <a href="{{ route('usuarios.edit', $usuario->id_usuario) }}" role="button"
                                                class="btn btn-success rounded-circle btn-circle" title="Modificar">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>

                                            {{-- <a href="#" role="button"
                                                class="btn btn-warning rounded-circle btn-circle"
                                                title="Cambiar contraseña">
                                                <i class="fa fa-key" aria-hidden="true"></i>
                                            </a> --}}

                                            <button type="button" class="btn btn-warning rounded-circle btn-circle"
                                                title="Cambiar contraseña" data-bs-toggle="modal"
                                                data-bs-target="#modal_cambiar_clave_{{ $usuario->id_usuario }}">
                                                <i class="fa fa-key" aria-hidden="true"></i>
                                            </button>
                                        </td>
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

        {{-- =========== Modal cambiar contraseña =================== --}}

        {{-- INICIO Modal EDITAR CATEGORÍA --}}
        <div class="modal fade" id="modal_cambiar_clave_{{ $usuario->id_usuario }}" tabindex="-1"
            data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content p-3 w-100">
                    {!! Form::open([
                        'method' => 'POST',
                        'route' => ['cambiar_clave'],
                        'class' => 'mt-2',
                        'autocomplete' => 'off',
                        'id' => 'form_cambiar_clave',
                    ]) !!}
                    @csrf
                    <div class="" style="border: solid 1px #337AB7;">
                        <div class="rounded-top text-white text-center"
                            style="background-color: #337AB7; border: solid 1px #337AB7;">
                            <h5>Cambiar Contraseña de: {{$usuario->identificacion.' - '.$usuario->nombre_usuario.' '.$usuario->apellido_usuario}}</h5>
                        </div>

                        {{ Form::hidden('id_usuario', isset($usuario) ? $usuario->id_usuario : null, ['class' => '', 'id' => 'id_usuario']) }}

                        {{-- ====================================================== --}}
                        {{-- ====================================================== --}}

                        <div class="modal-body p-0 m-0">
                            <div class="row m-0 pt-4 pb-4">
                                <div class="col-12 col-md-6">
                                    <div class="form-group d-flex flex-column">
                                        <label for="nueva_clave" class="" style="font-size: 15px">Nueva Contraseña<span
                                                class="text-danger">*</span></label>
                                        {{ Form::text('nueva_clave', null, ['class' => 'form-control', 'id' => 'nueva_clave', 'placeholder' => 'Contraseña', 'required'=>'required']) }}
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-group d-flex flex-column">
                                        <label for="confirmar_clave" class="" style="font-size: 15px">Confirmar Contraseña<span
                                                class="text-danger">*</span></label>
                                        {{ Form::text('confirmar_clave', null, ['class' => 'form-control', 'id' => 'confirmar_clave', 'placeholder' => 'Confirmar Contraseña', 'required'=>'required']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ====================================================== --}}
                    {{-- ====================================================== --}}

                    <div class="d-flex justify-content-center mt-5">
                        <button type="submit" class="btn btn-success" title="Guardar Configuración">
                            <i class="fa fa-floppy-o" aria-hidden="true"> Modificar</i>
                        </button>


                        <button type="button" class="btn btn-secondary" title="Cancelar" data-bs-dismiss="modal">
                            <i class="fa fa-times" aria-hidden="true"> Cancelar</i>
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        {{-- FINAL Modal EDITAR CATEGORÍA --}}

        {{-- <form method="POST" id="form-3" role="form" data-parsley-validate="">
            <div class="modal fade" id="modal-cambiar-contras" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                data-keyboard ="false" data-backdrop = "static">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" style="width: 100%">

                        <div class="modal-body">
                            <input type="hidden" name="idusuario" value="<?= $persona['id_usuarios'] ?>">

                            <div class="row">
                                <div class="panel panel-primary" style="margin-left: 2%; margin-right: 2%">
                                    <div class="panel-heading" stlyle="height: 70px; width: 100px">
                                        <center><span style="color: #fff; font-size: 18px" id="myModalLabel"><strong>Cambiar
                                                    Contraseña de:
                                                    <?= $persona['tipo_documento'] == 'Cédula' ? 'C.C' : 'C.E' ?> :
                                                    <?= $persona['id_persona'] . ' - ' . $persona['nombres'] . ' ' . $persona['apellidos'] ?></strong></span>
                                        </center>
                                    </div>

                                    <div class="panel-body">
                                        <div class="col-xs-12 col-md-6" id="conClave">
                                            <label for="inputPassword" class="control-label">Nueva Contraseña <span
                                                    class="obligatorio">*</span></label>
                                            <input type="password" tabindex="1" maxlength="7" minlength="4"
                                                name="txtnueva" class="form-control" id="campoClave"
                                                placeholder="Contraseña"
                                                pattern="[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ0-9!@#\$%\-\*\?_~\\.\\()\/$]+"
                                                data-parsley-required="true">
                                        </div>

                                        <div class="col-xs-12 col-md-6" id="conConfirmar">
                                            <label for="">Confirmar Contraseña <span
                                                    class="obligatorio">*</span></label>
                                            <input type="password" tabindex="2" maxlength="7" minlength="4"
                                                name="txtConfClave" data-parsley-equalto="#campoClave" class="form-control"
                                                id="campoConfirmar"
                                                pattern="[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ0-9!@#\$%\-\*\?_~\\.\\()\/$]+"
                                                placeholder="Confirmar Contraseña" data-parsley-required="true">
                                        </div>

                                        <div class="col-md-3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-md-6 col-lg-6">
                                <button type="submit" tabindex="4" name="btn-modificar-clave"
                                    class="btn btn-success btn-md active pull-right" id="btn-contras"><i
                                        class="fa fa-floppy-o" aria-hidden="true"> Modificar</i></button>
                                <input type="hidden" tabindex="5">
                            </div>
                            <div class="col-xs-6 col-md-6 col-lg-3">
                                <button type="button" tabindex="3" class="btn btn-secondary btn-md active"
                                    data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"> Cerrar</i></button>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </form> --}}

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
        });
    </script>
@stop
