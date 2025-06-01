@extends('layouts.app')
@section('title', 'Empresas')

{{-- =============================================================== --}}
{{-- =============================================================== --}}
{{-- =============================================================== --}}

@section('css')
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
                <a href="#" role="button" title="Ayuda" class="text-blue" data-bs-toggle="modal" data-bs-target="#modalAyudaListarEmpresas">
                    <i class="fa fa-question-circle fa-2x" aria-hidden="false" title="Ayuda" style="color: #337AB7"></i>
                </a>
            </div>

            {{-- ======================================================================= --}}
            {{-- ======================================================================= --}}

            <div class="modal fade" id="modalAyudaListarEmpresas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static">
                <div class="modal-dialog" style="min-width: 75%;">
                    <div class="modal-content p-3">
                        <div class="modal-body p-0 rounded-top" style="border: solid 1px #337AB7; mw-50">
                            <div class="row">
                                <div class="col-12">
                                    <div class="rounded-top text-white text-center p-2" style="background-color: #337AB7; border: solid 1px #337AB7;">
                                        <span class="modal-title fs-5"><strong>Ayuda de Listar Empresas</strong></span>
                                    </div>
                                    {{-- =========================== --}}
                                    <div class="p-3">
                                        <p class="text-justify">Señor usuario en esta vista usted se va a encontrar con diferentes opciones ubicadas al lado izquierdo de la tabla, cada una con una acción diferente, esas opciones son:
                                        </p>

                                        <ul>
                                            <li><strong>Opcion de Modificación:</strong>
                                                <ol>Tener en cuenta a la hora de modificar una empresa lo siguiente:
                                                    <li class="text-justify">Todos los campos que poseen el asterisco (*) son obligatorios, por lo tanto sino se diligencian,
                                                    el sistema no le dejará seguir.</li>
                                                    <li class="text-justify">Los campos nombre de empresa e email no pueden ser idénticos a datos ya registrados.</li>
                                                </ol>
                                                <br>
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
                <h5 class="border rounded-top text-white text-center pt-2 pb-2 m-0"
                    style="background-color: #337AB7">Listar Empresas
                </h5>

                <div class="col-12 p-3" id="">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered w-100 mb-0" id="tbl_empresas"
                            aria-describedby="empresas">
                            <thead>
                                <tr class="header-table text-center">
                                    <th>Nit Empresa</th>
                                    <th>Nombre</th>
                                    <th>Teléfono</th>
                                    <th>Celular</th>
                                    <th>Email</th>
                                    <th>Dirección</th>
                                    <th>APP KEY</th>
                                    <th>APP URL</th>
                                    <th>DB CONNECTION</th>
                                    <th>DB DATABASE</th>
                                    <th>DB USERNAME</th>
                                    <th>DB PASSWORD</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            {{-- ============================== --}}
                            <tbody>
                                @foreach ($empresas as $empresa)
                                    <tr class="text-center">
                                        <td>{{ $empresa->nit_empresa }}</td>
                                        <td>{{ $empresa->nombre_empresa }}</td>
                                        <td>{{ $empresa->telefono_empresa }}</td>
                                        <td>{{ $empresa->celular_empresa }}</td>
                                        <td>{{ $empresa->email_empresa }}</td>
                                        <td>{{ $empresa->direccion_empresa }}</td>
                                        <td>{{ $empresa->app_key }}</td>
                                        <td>{{ $empresa->app_url }}</td>
                                        <td>{{ $empresa->tipo_bd }}</td>
                                        <td>{{ $empresa->db_database }}</td>
                                        <td>{{ $empresa->db_username }}</td>
                                        <td>{{ $empresa->db_password }}</td>
                                        <td>{{ $empresa->estado }}</td>
                                        <td>
                                            <button title="Editar Empresa" class="btn btn-success rounded-circle btn-circle text-white btn-editar-empresa" data-id="{{$empresa->id_empresa}}">
                                                <i class="fa fa-pencil-square-o"></i>
                                            </button>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> {{-- FIN div_campos_personas --}}
            </div> {{-- FIN div_crear_empresa --}}
        </div>
    </div>
    
    {{-- =============================================================== --}}
    {{-- =============================================================== --}}

    <!-- INICIO Modal EDITAR EMPRESA -->
    <div class="modal fade" id="modalEditarEmpresa" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content p-3" id="modalEditarEmpresaContent">
                {{-- El contenido AJAX se cargará aquí --}}
            </div> <!-- FIN modal-content -->
        </div> <!-- FIN modal-dialog -->
    </div> <!-- FIN modal fade -->
    <!-- FIN Modal EDITAR EMPRESA -->
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
            $("#tbl_empresas").DataTable({
                dom: 'Blfrtip',
                "infoEmpty": "No hay registros",
                stripe: true,
                bSort: true,
                autoWidth: false,
                scrollX: true,
                buttons: [
                    {
                        extend: 'pdfHtml5',
                        text: 'PDF',
                        className: 'waves-effect waves-light btn-rounded btn-sm btn-danger',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        title: 'Listado de Empresas',
                        exportOptions: {
                            columns: ':visible:not(:last-child)'
                        },
                        customize: function(doc) {
                            const columnCount = $('#tbl_proveedores thead th').length;
                            doc.pageSize = 'A4';
                            doc.defaultStyle.fontSize = 12;
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: 'Excel',
                        className: 'waves-effect waves-light btn-rounded btn-sm btn-primary mr-3',
                        customize: function( xlsx ) {
                            var sheet = xlsx.xl.worksheets['sheet1.xml'];
                            $('row:first c', sheet).attr( 's', '42' );
                        }
                    }
                ],
                "pageLength": 10
            });
            // CIERRE DataTable Lista Personas

            // ===========================================================================================
            // ===========================================================================================

            $(document).on('click', '.btn-editar-empresa', function () {
                const idEmpresa = $(this).data('id');

                $.ajax({
                    url: `/empresas/${idEmpresa}/edit`,
                    type: 'GET',
                    beforeSend: function () {
                        $('#modalEditarEmpresa').modal('show');
                        $('#modalEditarEmpresaContent').html('<div class="text-center p-5"><i class="fa fa-spinner fa-spin fa-2x"></i> Cargando...</div>');
                    },
                    success: function (html) {
                        $('#modalEditarEmpresaContent').html(html);
                    }, // FIN success
                    error: function () {
                        $('#modalEditarEmpresaContent').html('<div class="alert alert-danger">Error al cargar el formulario.</div>');
                    }
                }); // FIN $.ajax
            }); // FIN $(document).on('click', '.btn-cambiar_clave

            // ===========================================================================================
            // ===========================================================================================

            $(document).on("submit", "form[id^='formEditarEmpresa_']", function(e) {
                const form = $(this);
                const formId = form.attr('id'); // Obtenemos el ID del formulario
                const id = formId.split('_')[1]; // Obtener el ID del formulario desde el ID del formulario

                // Capturar el indicador de carga dinámicamente
                const submitButton = $(`#btn_editar_empresa_${id}`);
                const cancelButton = $(`#btn_cancelar_empresa_${id}`);
                const loadingIndicator = $(`#loadingIndicatorEditarEmpresa_${id}`);

                // Lógica del botón
                submitButton.prop("disabled", true).html(
                    "Procesando... <i class='fa fa-spinner fa-spin'></i>"
                );
                cancelButton.prop("disabled", true);

                // Cargar Spinner
                loadingIndicator.show();
            });
        }); // FIN document.ready
    </script>
@stop
