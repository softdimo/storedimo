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
                                                <ol>Tener en cuenta a la hora de modificar una empresa lo siguiente:
                                                    <li class="text-justify">Todos los campos que poseen el asterisco (*) son obligatorios, por lo tanto sino se diligencian,
                                                    el sistema no le dejará seguir.</li>
                                                    <li class="text-justify">Los campos nombre de empresa e email no pueden ser idénticos a datos ya registrados.</li>
                                                    {{-- <li class="text-justify">Al cambiar un empleado temporal a vinculado, el campo fecha de contrato cargará la fecha actual inicialmente, si usted desea cambiar esa fecha, está no puede ser menor ni superior a los 3 meses.</li> --}}
                                                </ol>
                                                <br>
                                            </li>
                                            {{-- <li><strong>Opción de Cambio de Contraseña:</strong>
                                                <ol>Tener en cuenta a la hora de cambiar una contraseña lo siguente:
                                                    <li class="text-justify">La longitud de la contraseña debe ser mayor a 4 caracteres.</li>
                                                    <li class="text-justify">Ambos campos deben coincidir.</li>
                                                </ol>
                                            </li> --}}
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
                                        <td>{{ $empresa->estado }}</td>
                                        <td>
                                            <a href="#modalEditarPersona_{{ $empresa->id_empresa }}"
                                                id="verModal_{{ $empresa->id_empresa }}" rel="modal:open" class="btn btn-success rounded-circle btn-circle" title="Modificar">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>

                                            <a href="#ex1_{{ $empresa->id_empresa }}" rel="modal:open">
                                                <button class="btn btn-info">JQueryModal{{ $empresa->id_persona }}</button>
                                            </a>
                                        </td>

                                        {{-- =============================================================== --}}
                                        {{-- =============================================================== --}}

                                      
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> {{-- FIN div_campos_personas --}}
            </div> {{-- FIN div_crear_empresa --}}
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
            $("#tbl_empresas").DataTable({
                dom: 'Blfrtip',
                "infoEmpty": "No hay registros",
                stripe: true,
                "bSort": false,
                "autoWidth": false,
                "scrollX": true,
                "buttons": [
                    {
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

            // $(document).on("submit", "form[id^='formEditarPersona_']", function(e) {

            //     const form = $(this);
            //     const formId = form.attr('id'); // Obtenemos el ID del formulario
            //     const id = formId.split('_')[1]; // Obtener el ID del formulario desde el ID del formulario

            //     // Capturar el indicador de carga dinámicamente
            //     const loadingIndicator = $(`#loadingIndicatorEdit_${id}`);

            //     // Capturar el botón de submit dinámicamente
            //     const submitButton = $(`#btn_editar_${id}`);

            //     // Capturar el botón de cancelar
            //     const cancelButton = $(`#btn_cancelar_${id}`);

            //     // Lógica del botón
            //     submitButton.prop("disabled", true).html(
            //         "Procesando... <i class='fa fa-spinner fa-spin'></i>"
            //     );

            //     // Lógica del botón cancelar
            //     cancelButton.prop("disabled", true);
            //     loadingIndicator.show();
            // });

        });
    </script>
@stop
