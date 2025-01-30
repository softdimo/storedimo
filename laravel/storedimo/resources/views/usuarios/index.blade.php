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
                                                onclick="cambiarClave('{{ $usuario->id_usuario }}')">
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
    @include('layouts.loader')
@stop

{{-- =============================================================== --}}
{{-- =============================================================== --}}
{{-- =============================================================== --}}

@section('scripts')
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('DataTables/Buttons-2.3.4/js/buttons.html5.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            setTimeout(() => {
                $("#loaderGif").hide();
                $("#loaderGif").addClass('ocultar');
            }, 1500);
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
            // ===========================================================================================

            // formEditarCategoria para cargar gif en el submit


        });






        function cambiarClave(idUsuario) {
            let form = ''

            form += `
                    <div style="margin-top:2rem;">
                        <label class="">Clave Nueva</label>
                        <input type="text" name="nueva_clave" id="nueva_clave" class="" required>
                    </div>

                    <div>
                        <label class="">Confirmar Clave</label>
                        <input type="text" name="confirmar_clave" id="confirmar_clave" class="" required>
                    </div>
            `;

            /* form += < img class = "ocultar"
            src = "{{ asset('imagenes/loading.gif') }}"
            id = "loading_ajax"
            alt = "loading..." / > ; */


            /* Swal.fire({
                title: 'Cambiar Clave',
                html: form,
                icon: 'success',
                type: 'success',
                showConfirmButton: true,
                focusConfirm: false,
                showCloseButton: true,
                showCancelButton: true,
                cancelButtonText: 'Cancel',
                allowOutsideClick: false,
            }); */


            Swal.fire({
                title: "Do you want to save the changes?",
                html: form,
                showCancelButton: true,
                confirmButtonText: "Cambiar clave",
            }).then((result) => {
                console.log('Result: ' + result.value);

                /* Read more about isConfirmed, isDenied below */
                if (result.value == true) {
                    let claveNueva = $('#nueva_clave').val();
                    let confirmarClave = $('#confirmar_clave').val();

                    $.ajax({
                        async: true,
                        url: "{{ route('cambiar_clave') }}",
                        type: "POST",
                        dataType: "json",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'id_usuario': idUsuario,
                            'nueva_clave': claveNueva,
                            'confirmar_clave': confirmarClave
                        },

                        beforeSend: function() {
                            $("#loaderGif").show();
                            $("#loaderGif").removeClass('ocultar');
                        },

                        success: function(response) {
                            console.log(response);

                            if (response == 'success') {
                                $("#loaderGif").hide();
                                $("#loaderGif").addClass('ocultar');
                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: "Clave cambiada",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                setTimeout('window.location.reload()', 3500);
                                return;
                            }

                            if (response == 'error_exception') {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "error",
                                    title: "Error, clave no cambiada",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                setTimeout('window.location.reload()', 3500);
                                return;
                            }
                        }
                    })
                }
            });

        }
    </script>
@stop
