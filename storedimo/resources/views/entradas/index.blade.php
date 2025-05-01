@extends('layouts.app')
@section('title', 'Listar Compras')

@section('css')
    <style>
        .btn-circle {
            padding-left: 0.3rem !important;
            padding-right: 0.3rem !important;
            padding-top: 0.0rem !important;
            padding-bottom: 0.0rem !important;
        }

        /* Oculta el icono de calendario nativo en Chrome, Safari y Edge */
        input[type="date"]::-webkit-calendar-picker-indicator {
            display: none;
            -webkit-appearance: none;
        }

        /* Oculta el icono en Firefox */
        input[type="date"]::-moz-calendar-picker-indicator {
            display: none;
        }

        /* Para navegadores que aún muestran el ícono nativo */
        input[type="date"] {
            position: relative;
            z-index: 2;
            background-color: transparent;
        }
    </style>
@stop

@section('content')
    <div class="d-flex p-0">
        <div class="p-0" style="width: 20%">
            @include('layouts.sidebarmenu')
        </div>

        <div class="p-3 d-flex flex-column" style="width: 80%">
            <div class="p-0" style="border: solid 1px #337AB7; border-radius: 5px;">
                <h5 class="border rounded-top text-white text-center pt-2 pb-2 m-0" style="background-color: #337AB7">Listar
                    Compras</h5>

                <div class="col-12 p-3" id="">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered w-100 mb-0" id="tbl_entradas"
                            aria-describedby="entradas">
                            <thead>
                                <tr class="header-table text-center">
                                    {{-- <th>Empresa</th> --}}
                                    <th>Código Compra</th>
                                    <th>Valor Total</th>
                                    <th>Fecha Registro Compra</th>
                                    <th>Identificación Proveedor</th>
                                    <th>Nombre Proveedor</th>
                                    <th>Comprador</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($entradas as $entrada)
                                    <tr class="text-center">
                                        {{-- <td>{{$entrada->empresa}}</td> --}}
                                        <td>{{ $entrada->id_compra }}</td>
                                        <td class="text-end">{{ $entrada->valor_compra }}</td>
                                        <td>{{ $entrada->fecha_compra }}</td>

                                        @if ($entrada->nit_proveedor)
                                            <td>{{ $entrada->nit_proveedor }}</td>
                                        @else
                                            <td>{{ $entrada->identificacion }}</td>
                                        @endif

                                        @if ($entrada->proveedor_juridico)
                                            <td>{{ $entrada->proveedor_juridico }}</td>
                                        @else
                                            <td>{{ $entrada->nombres_proveedor }} {{ $entrada->apellidos_proveedor }}</td>
                                        @endif

                                        <td>{{ $entrada->nombres_usuario }}</td>

                                        @if ($entrada->id_estado == 1)
                                            <td>
                                                <button title="Ver Detalles"
                                                    class="btn rounded-circle btn-circle text-white"
                                                    style="background-color: #286090" data-bs-toggle="modal"
                                                    data-bs-target="#modalDetalleEntrada_{{ $entrada->id_compra }}">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </button>

                                                <button title="Anular"
                                                    class="btn rounded-circle btn-circle text-white btn-danger"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalAnularCompra_{{ $entrada->id_compra }}">
                                                    <i class="fa fa-remove"></i>
                                                </button>
                                            </td>
                                        @else
                                            <td>
                                                <button title="Ver Detalles"
                                                    class="btn rounded-circle btn-circle text-white"
                                                    style="background-color: #286090" data-bs-toggle="modal"
                                                    data-bs-target="#modalDetalleEntrada_{{ $entrada->id_compra }}">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                        @endif

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- <div class="mt-5 mb-2 d-flex justify-content-center">
                        <button type="submit" class="btn rounded-2 me-3 text-white" style="background-color: #286090" data-bs-toggle="modal" data-bs-target="#modalReporteCompras">
                            <i class="fa fa-file-pdf-o"></i>
                            Reporte Compras
                        </button>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    {{-- =============================================================== --}}
    {{-- =============================================================== --}}

    {{-- INICIO Modal REPORTE COMPRAS --}}
    <div class="modal fade" id="modalReporteCompras" tabindex="-1" data-bs-backdrop="static"
        data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content p-3">
                <div class="rounded-top" style="border: solid 1px #337AB7;">
                    {!! Form::open([
                        'method' => 'POST',
                        'route' => ['reporte_compras_pdf'],
                        'class' => '',
                        'autocomplete' => 'off',
                        'id' => 'formReporteComprasPdf',
                        'target' => '_blank', // 👉 Abrir en nueva pestaña
                    ]) !!}
                    @csrf

                    <div class="rounded-top text-white text-center"
                        style="background-color: #337AB7; border: solid 1px #337AB7;">
                        <h5>Reporte Compras</h5>
                    </div>

                    <div class="modal-body m-0">
                        <div class="row m-0">
                            <div class="col-12 col-md-6">
                                <label for="fecha_inicial" class="fw-bold" style="font-size: 12px">
                                    Fecha Inicial <span class="text-danger">*</span>
                                </label>
                                <div class="input-group" id="calendar_addon_inicial" style="cursor: pointer;">
                                    {!! Form::date('fecha_inicial', null, ['class' => 'form-control', 'id' => 'fecha_inicial', 'required']) !!}
                                    <span class="input-group-text">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="fecha_final" class="fw-bold" style="font-size: 12px">
                                    Fecha Final <span class="text-danger">*</span>
                                </label>
                                <div class="input-group" id="calendar_addon_final" style="cursor: pointer;">
                                    {!! Form::date('fecha_final', null, ['class' => 'form-control', 'id' => 'fecha_final', 'required']) !!}
                                    <span class="input-group-text">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div> <!-- FIN modal-body -->

                    {{-- ====================================================== --}}
                    {{-- ====================================================== --}}

                    <div class="modal-footer border-0 d-flex justify-content-center mt-3">
                        <button type="submit" id="btn_reporte_compras" class="btn btn-success"
                            title="Guardar Configuración">
                            <i class="fa fa-file-pdf-o"> Generar Pdf Compras</i>
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div> {{-- FIN Div rounded-top --}}

                {{-- ====================================================== --}}
                {{-- ====================================================== --}}

                <div class="row mt-3">
                    <div class="col-12">
                        <button type="button" class="btn btn-primary btn-md active pull-right"
                            style="background-color: #337AB7;" data-bs-dismiss="modal" id="btnReportePrestamos">
                            <i class="fa fa-check-circle"> Aceptar</i>
                        </button>
                    </div>
                </div>
            </div> {{-- FIN modal-content --}}
        </div> {{-- FIN modal-dialog --}}
    </div> {{-- FIN modal --}}
    {{-- FINAL Modal REPORTE COMPRAS --}}

    {{-- =============================================================== --}}
    {{-- =============================================================== --}}

    @foreach ($entradas as $entrada)
        <!-- Modal Detalles compra -->
        <div class="modal fade" id="modalDetalleEntrada_{{$entrada->id_compra}}" tabindex="-1"
            data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true" style="max-height: 96vh">
            <div class="modal-dialog">
                <div class="modal-content p-3">
                    <div class="rounded-top" style="border: solid 1px #337AB7;">
                        <div class="rounded-top text-white text-center"
                            style="background-color: #337AB7; border: solid 1px #337AB7;">
                            <h5>Detalle de Compra Código: {{ $entrada->id_compra }}</h5>
                        </div>

                        <div class="mt-3 mb-0 ps-3">
                            <h6>Compra realizada por: <span style="color: #337AB7">{{$entrada->nombres_usuario}}</span></h6>
                        </div>

                        <div class="modal-body p-0 m-0">
                            <div class="row m-0">
                                <div class="col-12 p-3 pt-1">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered w-100 mb-0"
                                            aria-describedby="entradas">
                                            <thead>
                                                <tr class="header-table text-center">
                                                    <th>Fecha Compra</th>
                                                    {{-- <th>Empresa</th> --}}
                                                    <th>Id Proveedor</th>
                                                    <th>Nombre Proveedor</th>
                                                    <th>Valor Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="text-center">
                                                    <td>{{ $entrada->fecha_compra }}</td>
                                                    @if ($entrada->nit_proveedor)
                                                        <td>{{ $entrada->nit_proveedor }}</td>
                                                    @else
                                                        <td>{{ $entrada->identificacion }}</td>
                                                    @endif

                                                    @if ($entrada->proveedor_juridico)
                                                        <td>{{ $entrada->proveedor_juridico }}</td>
                                                    @else
                                                        <td>{{ $entrada->nombres_proveedor }}
                                                            {{ $entrada->apellidos_proveedor }}</td>
                                                    @endif

                                                    <td class="text-end">{{ $entrada->valor_compra }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="">
                                <div class="mt-3 mb-0 ps-3">
                                    <h4 class="mb-0" style="color: #337AB7">Productos</h4>
                                </div>

                                <div class="row m-0">
                                    <div class="col-12 p-3 pt-1">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered w-100 mb-0"
                                                aria-describedby="compra_detalle" id="tblDetalleCompraProductos_{{ $entrada->id_compra }}">
                                                <thead>
                                                    <tr class="header-table text-center">
                                                        <th>Producto</th>
                                                        <th>Cantidad</th>
                                                        <th>Precio</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($entrada->detalles as $producto)
                                                        <tr class="text-center">
                                                            <td>{{ $producto->nombre_producto }}</td>
                                                            <td>{{ $producto->cantidad }}</td>
                                                            <td class="text-end">{{ $producto->precio_unitario_compra }}</td>
                                                            <td class="text-end">{{ $producto->subtotal }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="loadingIndicatorEditCategoria" class="loadingIndicator">
                        <img src="{{ asset('imagenes/loading.gif') }}" alt="Procesando...">
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        <a href="{{ route('detalle_compras_pdf', $entrada->id_compra) }}" target="_blank"
                            class="btn btn-success me-3" style="background-color: #337AB7">
                            <i class="fa fa-file-pdf-o"></i> Pdf Detalle Compra
                        </a>

                        <button type="button" title="Cancelar" class="btn btn-secondary" data-bs-dismiss="modal"
                            id="btn_cancelar_detalle_compra">
                            <i class="fa fa-times" aria-hidden="true"> Cerrar</i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- ====================================================== --}}
        {{-- ====================================================== --}}
        {{-- ====================================================== --}}

        <!-- Modal Anular compra -->
        <div class="modal fade" id="modalAnularCompra_{{ $entrada->id_compra }}" tabindex="-1"
            data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content p-3">
                    {!! Form::open([
                        'method' => 'POST',
                        'route' => ['anular_compra'],
                        'class' => 'mt-2',
                        'autocomplete' => 'off',
                        'id' => 'formAnularCompra_' . $entrada->id_compra,
                    ]) !!}
                    @csrf

                    {{ Form::hidden('id_compra', isset($entrada) ? $entrada->id_compra : null, ['class' => '', 'id' => 'id_compra_' . $entrada->id_compra]) }}

                    <div class="rounded-top" style="border: solid 1px #337AB7;">
                        <div class="rounded-top text-white text-center"
                            style="background-color: #337AB7; border: solid 1px #337AB7;">
                            <h5>Anular Compra</h5>
                        </div>

                        <div class="modal-body p-0 m-0">
                            <div class="mt-3 mb-3 mb-0 ps-3 text-center">
                                <h5 class="text-danger">¿Realmente desea anular la compra del producto?</h5>

                                <h4 class="mt-4" style="color: #337AB7"> {{ $entrada->id_compra }} -
                                    {{ $entrada->nombre_producto }}</h4>
                            </div>
                        </div>
                    </div>

                    <div id="loadingIndicatorAnularCompra_{{ $entrada->id_compra }}" class="loadingIndicator">
                        <img src="{{ asset('imagenes/loading.gif') }}" alt="Procesando...">
                    </div>

                    <div class="d-flex justify-content-around mt-3">
                        <button type="submit" class="btn btn-success" id="btn_anular_compra_{{ $entrada->id_compra }}"
                            style="background-color: #337AB7">
                            <i class="fa fa-file-pdf-o"> Anular</i>
                        </button>

                        <button type="button" class="btn btn-secondary"
                            id="btn_cancelar_compra_{{ $entrada->id_compra }}" data-bs-dismiss="modal">
                            <i class="fa fa-times" aria-hidden="true"> Cerrar</i>
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    @endforeach
@stop

@section('scripts')
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('DataTables/Buttons-2.3.4/js/buttons.html5.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // INICIO DataTable
            $("#tbl_entradas").DataTable({
                dom: 'Blfrtip',
                "infoEmpty": "No hay registros",
                stripe: true,
                bSort: true,
                buttons: [
                    {
                        text: 'PDF',
                        className: 'waves-effect waves-light btn-rounded btn-sm btn-danger',
                        action: function() {
                            let modal = new bootstrap.Modal(document.getElementById(
                                'modalReporteCompras'));
                            modal.show();
                        },
                        init: function(api, node, config) {
                            $(node).removeClass('dt-button');
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
            }); // CIERRE DataTable

            // =========================================================================
            // =========================================================================
            // =========================================================================

            $('[id^=modalDetalleEntrada_]').on('shown.bs.modal', function () {
                const modalId = $(this).attr('id');
                const idCompra = modalId.replace('modalDetalleEntrada_', '');
                const tableId = `#tblDetalleCompraProductos_${idCompra}`;

                // Evitar reinicialización
                if (!$.fn.DataTable.isDataTable(tableId)) {
                    $(tableId).DataTable({
                        // dom: 'Blfrtip',
                        dom: 'lrtip', // sin botones, solo length, table, info, pagination
                        infoEmpty: 'No hay registros',
                        stripe: true,
                        bSort: false,
                        autoWidth: false,
                        scrollX: true,
                        pageLength: 10
                    });
                } else {
                    // Solo ajustar columnas si ya está inicializado
                    $(tableId).DataTable().columns.adjust();
                }
            });

            // =========================================================================
            // =========================================================================
            // =========================================================================

            // formAnularCompra para cargar gif en el submit
            $(document).on("submit", "form[id^='formAnularCompra_']", function(e) {
                const form = $(this);
                const formId = form.attr('id'); // Obtenemos el ID del formulario
                const id = formId.split('_')[1]; // Obtener el ID del formulario desde el ID del formulario

                // Capturar spinner y btns
                const loadingIndicator = $(`#loadingIndicatorAnularCompra_${id}`);
                const submitButton = $(`#btn_anular_compra_${id}`);
                const cancelButton = $(`#btn_cancelar_compra_${id}`);

                // Desactivar btns
                submitButton.prop("disabled", true).html(
                    "Procesando... <i class='fa fa-spinner fa-spin'></i>");
                cancelButton.prop("disabled", true);

                // Cargar Spinner
                loadingIndicator.show();
            });

            // =========================================================================
            // =========================================================================
            // =========================================================================

            $(document).on('shown.bs.modal', '#modalReporteCompras', function() {
                let modal = $(this); // Referencia del modal

                function configurarCalendario(inputId, iconoId) {
                    let inputFecha = modal.find(`#${inputId}`);
                    let iconoCalendario = modal.find(`#${iconoId}`);

                    if (inputFecha.length > 0) {
                        // Abre el calendario al hacer clic en el input
                        inputFecha.on("focus", function() {
                            if (typeof this.showPicker === "function") {
                                this.showPicker();
                            }
                        });

                        // Abre el calendario al hacer clic en el icono
                        iconoCalendario.on("mousedown touchstart", function(event) {
                            event.preventDefault();
                            if (typeof inputFecha[0].showPicker === "function") {
                                inputFecha[0].showPicker();
                            }
                        });

                        // Evento para asegurarse de que la fecha se refleje
                        inputFecha.on("change", function() {
                            console.log("Fecha seleccionada:", inputFecha.val()); // Para depuración
                        });
                    }
                }

                // Configura ambos campos de fecha dentro del modal
                configurarCalendario("fecha_inicial", "calendar_addon_inicial");
                configurarCalendario("fecha_final", "calendar_addon_final");
            });
        }); // FIN document.ready
    </script>
@stop
