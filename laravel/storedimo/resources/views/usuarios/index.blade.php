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

        .flex {
            display: flex;
            justify-content: space-between;
            padding: 1rem;
        }

        .flex-column {
            display: flex;
            flex-direction: column
        }

        .flex-column>label {
            text-align: left;
            font-weight: bold;
            padding-bottom: 0.5rem
        }

        .flex-column>label>span {
            color: red
        }

        .flex-column>input {
            border-radius: 5px;
            border: solid 1px gray;
            padding-left: 10px;
            padding-bottom: 10px
            text-align: left;
            
        }

        .flex-column>input::placeholder {
            font-size: 14px;
            text-align: left;
            opacity: 0.6;
        }

        .flex-column>input:focus {
            border: solid 2px #337AB7 !important;
            box-shadow: 0 0 5px blue !important;
            outline: none
        }

        /* Opcional: estilo cuando el input pierde el foco */
        .flex-column>input:not(:focus) {
            /* border: solid 1px #337AB7 !important; */
            box-shadow: none;
        }


        .div-principal {
            border: solid 1px blue;
            border-radius: 5px;
        }

        .div-principal>div:first-child {
            background-color: #337AB7;
        }

        .div-principal>div:first-child>p {
            color: white;
            font-weight: bold;
            padding: 0.5rem;
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

                                            <button type="button" class="btn btn-warning rounded-circle btn-circle"
                                                onclick="cambiarClave('{{ $usuario->id_usuario }}', '{{$usuario->identificacion}}', '{{$usuario->nombre_usuario}}', '{{$usuario->apellido_usuario}}')">
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

        });

        function cambiarClave(idUsuario, identificacion, nombres, apellidos) {
            let form = ''

            form += `
                <div class="div-principal">
                    <div>
                        <p> Cambiar Contraseña de C.C: ${identificacion} - ${nombres} ${apellidos}  </p>
                    </div>
                    <div class="flex">
                        <div class="flex-column">
                            <label>Clave Nueva<span>*</span></label>
                            <input type="text" name="nueva_clave" id="nueva_clave" class="" placeholder="Contraseña" required >
                        </div>

                        <div class="flex-column">
                            <label>Confirmar Clave<span>*</span></label>
                            <input type="text" name="confirmar_clave" id="confirmar_clave" class="" placeholder="ConfirmarContraseña" required >
                        </div>
                    </div>
                </div>
            `;

            Swal.fire({
                // title: "Desea cambiar la clave?",
                html: form,
                // icon: "warning",
                // type: "warning",
                showCancelButton: true,
                confirmButtonColor: 'green',
                confirmButtonText: '<i class="fa fa-floppy-o"></i> Modificar',
                cancelButtonText: '<i class="fa fa-thumbs-down"></i> Cancelar!',
                allowOutsideClick: false,
                allowEscapeKey: false
            }).then((result) => {
                console.log('Result: ' + result.value);

                /* Read more about isConfirmed, isDenied below */
                if (result.value == true) {
                    $('#nueva_clave').attr('required');
                    $('#confirmar_clave').attr('required');
                    let claveNueva = $('#nueva_clave').val();
                    let confirmarClave = $('#confirmar_clave').val();
                    if (claveNueva == null || claveNueva == '' && confirmarClave == null || confirmarClave == '') {
                        Swal.fire({
                            icon: "error",
                            type: "error",
                            title: "Las claves son requeridas",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        return;
                    }
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
                                    icon: "success",
                                    type: "success",
                                    title: "Clave cambiada",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                setTimeout('window.location.reload()', 3500);
                                return;
                            }

                            if (response == 'error_exception') {
                                Swal.fire({
                                    icon: "error",
                                    type: "error",
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
