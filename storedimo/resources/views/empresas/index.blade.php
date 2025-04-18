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
                                            <button title="Editar Empresa" class="btn btn-success rounded-circle btn-circle text-white" data-bs-toggle="modal" data-bs-target="#modalEditarEmpresa_{{$empresa->id_empresa}}">
                                                <i class="fa fa-pencil-square-o"></i>
                                            </button>
                                        </td>

                                        {{-- =============================================================== --}}
                                        {{-- =============================================================== --}}

                                        <!-- INICIO Modal EDITAR EMPRESA -->
                                        <div class="modal fade h-auto modal-gral p-0" id="modalEditarEmpresa_{{$empresa->id_empresa}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
                                            <div class="modal-dialog m-0 mw-100">
                                                <div class="modal-content p-3">
                                                    {!! Form::open([
                                                        'method' => 'PUT',
                                                        'route' => ['empresas.update', $empresa->id_empresa],
                                                        'class' => 'mt-0',
                                                        'autocomplete' => 'off',
                                                        'id' => 'formEditarEmpresa_'.$empresa->id_empresa,
                                                        ]) !!}
                                                        @csrf

                                                        {!! Form::hidden('id_empresa', isset($empresa) ? $empresa->id_empresa : null, ['class' => '', 'id' => 'id_empresa', 'required']) !!}

                                                        <div class="rounded-top" style="border: solid 1px #337AB7;">
                                                            <div class="rounded-top text-white text-center" style="background-color: #337AB7; border: solid 1px #337AB7;">
                                                                <h5>Editar Empresa: {{$empresa->nombre_empresa}}</h5>
                                                            </div>

                                                            <div class="modal-body m-0">
                                                                <div class="row m-0">
                                                                    <div class="col-12 col-md-6">
                                                                        <label for="nit_empresa" class="fw-bold" style="font-size: 12px">Nit Empresa
                                                                            <span class="text-danger">*</span>
                                                                        </label>
                                                                        {!! Form::text('nit_empresa', isset($empresa) ? $empresa->nit_empresa : null, ['class' => 'form-control', 'id' => 'nit_empresa', 'required']) !!}
                                                                    </div>

                                                                    <div class="col-12 col-md-6">
                                                                        <label for="nombre_empresa" class="fw-bold" style="font-size: 12px">Nombre Empresa
                                                                            <span class="text-danger">*</span>
                                                                        </label>
                                                                        {!! Form::text('nombre_empresa', isset($empresa) ? $empresa->nombre_empresa : null, ['class' => 'form-control', 'id' => 'nombre_empresa', 'required']) !!}
                                                                    </div>

                                                                    <div class="col-12 col-md-6 mt-3">
                                                                        <label for="telefono_empresa" class="fw-bold" style="font-size: 12px">Teléfono Empresa
                                                                            <span class="text-danger">*</span>
                                                                        </label>
                                                                        {!! Form::text('telefono_empresa', isset($empresa) ? $empresa->telefono_empresa : null, ['class' => 'form-control', 'id' => 'telefono_empresa', 'required']) !!}
                                                                    </div>

                                                                    <div class="col-12 col-md-6 mt-3">
                                                                        <label for="celular_empresa" class="fw-bold" style="font-size: 12px">Celular Empresa
                                                                            <span class="text-danger">*</span>
                                                                        </label>
                                                                        {!! Form::text('celular_empresa', isset($empresa) ? $empresa->celular_empresa : null, ['class' => 'form-control', 'id' => 'celular_empresa', 'required']) !!}
                                                                    </div>

                                                                    <div class="col-12 col-md-6 mt-3">
                                                                        <label for="email_empresa" class="fw-bold" style="font-size: 12px">Email
                                                                            <span class="text-danger">*</span>
                                                                        </label>
                                                                        {!! Form::email('email_empresa', isset($empresa) ? $empresa->email_empresa : null, ['class' => 'form-control', 'id' => 'email_empresa']) !!}
                                                                    </div>
                                                        
                                                                    {{-- ======================= --}}
                                                                    
                                                                    <div class="col-12 col-md-6 mt-3">
                                                                        <label for="direccion_empresa" class="fw-bold" style="font-size: 12px">Dirección
                                                                            <span class="text-danger">*</span>
                                                                        </label>
                                                                        {!! Form::text('direccion_empresa', isset($empresa) ? $empresa->direccion_empresa : null, ['class' => 'form-control', 'id' => 'direccion_empresa']) !!}
                                                                    </div>
                                                                    
                                                                    {{-- ======================= --}}
                                                                    
                                                                    <div class="col-12 col-md-6 mt-3">
                                                                        <label for="id_estado" class="fw-bold" style="font-size: 12px">Estado
                                                                            <span class="text-danger">*</span>
                                                                        </label>
                                                                        {!! Form::select('id_estado', collect(['' => 'Seleccionar...'])->union($estados), isset($empresa) ? $empresa->id_estado : null, ['class' => 'form-select', 'id' => 'id_estado']) !!}
                                                                    </div>
                                                                </div>
                                                            </div> <!-- FIN modal-body -->
                                                        </div> <!-- FIN rounded-top -->

                                                        {{-- ====================================================== --}}
                                                        {{-- ====================================================== --}}

                                                        <!-- Contenedor para el GIF -->
                                                        <div id="loadingIndicatorEditarEmpresa_{{$empresa->id_empresa}}" class="loadingIndicator">
                                                            <img src="{{ asset('imagenes/loading.gif') }}" alt="Procesando...">
                                                        </div>

                                                        {{-- ====================================================== --}}
                                                        {{-- ====================================================== --}}

                                                        <div class="d-flex border-0 justify-content-center mt-2">
                                                            <div class="">
                                                                <button type="submit" class="btn btn-success me-3" id="btn_editar_empresa_{{$empresa->id_empresa}}">
                                                                    <i class="fa fa-floppy-o"> Editar</i>
                                                                </button>
                                                            </div>

                                                            <div class="">
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="btn_cancelar_empresa_{{$empresa->id_empresa}}">
                                                                    <i class="fa fa-remove">  Cancelar</i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    {!! Form::close() !!}
                                                </div> <!-- FIN modal-content -->
                                            </div> <!-- FIN modal-dialog -->
                                        </div> <!-- FIN Modal EDITAR EMPRESA -->
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

        });
    </script>
@stop
