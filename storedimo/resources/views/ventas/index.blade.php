@extends('layouts.app')
@section('title', 'Ventas')

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
            <div class="p-0" style="border: solid 1px #337AB7; border-radius: 5px;">
                <h5 class="border rounded-top text-white text-center pt-2 pb-2 m-0" style="background-color: #337AB7">Listar
                    Ventas</h5>

                <div class="col-12 p-3" id="">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered w-100 mb-0" id="tbl_ventas"
                            aria-describedby="ventas">
                            <thead>
                                <tr class="header-table text-center">
                                    <th>Código</th>
                                    <th>Total Venta</th>
                                    <th>Fecha Registro Venta</th>
                                    <th>Identificación Cliente</th>
                                    <th>Nombre Cliente</th>
                                    <th>Tipo Pago</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            {{-- ============================== --}}
                            <tbody>
                                @foreach ($ventas as $venta)
                                    <tr class="text-center align-middle">
                                        <td>{{ $venta->id_venta }}</td>
                                        <td>{{ $venta->total_venta_index }}</td>
                                        <td>{{ $venta->fecha_venta }}</td>
                                        <td>{{ $venta->identificacion }}</td>
                                        <td>{{ $venta->nombres_cliente }}</td>
                                        <td>{{ $venta->tipo_pago }}</td>
                                        <td>{{ $venta->estado }}</td>
                                        <td>
                                            <button title="Ver Detalles" class="btn rounded-circle btn-circle text-white"
                                                title="Detalles Ventas" style="background-color: #286090"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalDetalleVenta_{{ $venta->id_venta }}">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
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

                    {{-- <div class="mt-5 mb-2 d-flex justify-content-center">
                        <button type="submit" class="btn rounded-2 me-3 text-white" style="background-color: #286090"
                            data-bs-toggle="modal" data-bs-target="#modalReporteVentas">
                            <i class="fa fa-file-pdf-o"></i>
                            Reporte Ventas
                        </button>
                    </div> --}}
                </div> {{-- FIN div_campos_usuarios --}}
            </div> {{-- FIN div_crear_usuario --}}
        </div>
    </div>

    {{-- =============================================================== --}}
    {{-- =============================================================== --}}

    {{-- INICIO Modal REPORTE VENTAS --}}
    <div class="modal fade h-auto modal-gral p-3" id="modalReporteVentas" tabindex="-1" data-bs-backdrop="static"
        data-bs-keyboard="false">
        <div class="modal-dialog m-0">
            <div class="modal-content w-100 border-0">
                <div class="rounded-top" style="border: solid 1px #337AB7;">
                    {!! Form::open([
                        'method' => 'POST',
                        'route' => ['reporte_ventas_pdf'],
                        'class' => '',
                        'autocomplete' => 'off',
                        'id' => 'formReporteVentasPdf',
                        'target' => '_blank', // 👉 Abrir en nueva pestaña
                    ]) !!}
                    @csrf

                    <div class="rounded-top text-white text-center"
                        style="background-color: #337AB7; border: solid 1px #337AB7;">
                        <h5>Reporte Ventas</h5>
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
                        <button type="submit" id="btn_reporte_ventas" class="btn btn-success">
                            <i class="fa fa-file-pdf-o"> Generar Pdf Ventas</i>
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div> {{-- FIN Div rounded-top --}}

                {{-- ====================================================== --}}
                {{-- ====================================================== --}}

                <div class="row mt-3">
                    <div class="col-12">
                        <button type="button" class="btn btn-primary btn-md active pull-right"
                            style="background-color: #337AB7;" data-bs-dismiss="modal" id="btnReporteVentas">
                            <i class="fa fa-check-circle"> Aceptar</i>
                        </button>
                    </div>
                </div>
            </div> {{-- FIN modal-content --}}
        </div> {{-- FIN modal-dialog --}}
    </div> {{-- FIN modal --}}
    {{-- FINAL Modal REPORTE VENTAS --}}

    {{-- =============================================================== --}}
    {{-- =============================================================== --}}

    @foreach ($ventas as $venta)
        <!-- INICIO Modal Detalles VENTA -->
        <div class="modal fade h-auto modal-gral p-0" id="modalDetalleVenta_{{ $venta->id_venta }}" tabindex="-1"
            data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
            <div class="modal-dialog m-0">
                <div class="modal-content p-3 w-100">
                    <div class="rounded-top" style="border: solid 1px #337AB7;">
                        <div class="rounded-top text-white text-center"
                            style="background-color: #337AB7; border: solid 1px #337AB7;">
                            <h5>Detalle de Venta Código: {{ $venta->id_venta }}</h5>
                        </div>

                        <div class="mt-3 mb-0 ps-3">
                            <h6>Entrada realizada por: <span class=""
                                    style="color: #337AB7">{{ $venta->nombres_usuario }}</span></h6>
                        </div>

                        <div class="modal-body p-0 m-0">
                            <div class="row m-0">
                                <div class="col-12 p-3 pt-1">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered w-100 mb-0"
                                            aria-describedby="venta">
                                            <thead>
                                                <tr class="header-table text-center">
                                                    <th>Fecha Venta</th>
                                                    <th>Nombre Cliente</th>
                                                    <th>Subtotal</th>
                                                    <th>Descuento</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="text-center">
                                                    <td>{{ $venta->fecha_venta }}</td>
                                                    <td>{{ $venta->nombres_cliente }}</td>
                                                    <td>{{ $venta->subtotal_venta }}</td>
                                                    <td>{{ $venta->descuento }}</td>
                                                    <td>{{ $venta->total_venta_index }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="">
                                <div class="mt-3 mb-0 ps-3">
                                    <h6 class="mb-0" style="color: #337AB7">Productos</h6>
                                </div>

                                <div class="row m-0">
                                    <div class="col-12 p-3 pt-1">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered w-100 mb-0"
                                                aria-describedby="entradas">
                                                <thead>
                                                    <tr class="header-table text-center">
                                                        <th>Producto</th>
                                                        <th>Precio</th>
                                                        <th>Cantidad</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($venta->detalles as $producto)
                                                        <tr class="text-center">
                                                            <td>{{ $producto->nombre_producto }}</td>
                                                            <td>{{ $producto->precio_venta_detalle }}</td>
                                                            <td>{{ $producto->cantidad }}</td>
                                                            <td>{{ $producto->subtotal_detalle }}</td>
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

                    <div class="d-flex justify-content-around mt-3">
                        <button class="btn btn-success generar-pdf" style="background-color: #337AB7"
                            data-id="{{ $venta->id_venta }}" data-fecha="{{ $venta->fecha_venta }}"
                            data-usuario="{{ $venta->nombres_usuario }}" data-cliente="{{ $venta->nombres_cliente }}"
                            data-subtotal="{{ $venta->subtotal_venta }}" data-descuento="{{ $venta->descuento }}"
                            data-total="{{ $venta->total_venta }}" data-detalles='@json($venta->detalles)'>
                            <i class="fa fa-file-pdf-o"></i> Recibo Caja
                        </button>

                        <button type="button" title="Cancelar" class="btn btn-secondary" data-bs-dismiss="modal"
                            id="btn_editar_cancelar">
                            <i class="fa fa-times" aria-hidden="true"> Cerrar</i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIN Modal Detalles VENTA -->
    @endforeach
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
            $("#tbl_ventas").DataTable({
                dom: 'Blfrtip',
                "infoEmpty": "No hay registros",
                stripe: true,
                bSort: true,
                buttons: [{
                        text: 'PDF',
                        className: 'waves-effect waves-light btn-rounded btn-sm btn-danger',
                        action: function() {
                            let modal = new bootstrap.Modal(document.getElementById(
                                'modalReporteVentas'));
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
            });
            // CIERRE DataTable Lista Usuarios

            // =========================================================================
            // =========================================================================
            // =========================================================================

            $(document).on('shown.bs.modal', '#modalReporteVentas', function() {
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

            // =========================================================================
            // =========================================================================
            // =========================================================================

            document.querySelectorAll(".generar-pdf").forEach(button => {
                button.addEventListener("click", function() {
                    let venta = {
                        id: this.dataset.id,
                        fecha: this.dataset.fecha,
                        usuario: this.dataset.usuario,
                        cliente: this.dataset.cliente,
                        subtotal: this.dataset.subtotal,
                        descuento: this.dataset.descuento,
                        total: this.dataset.total,
                        detalles: JSON.parse(this.dataset.detalles)
                    };

                    fetch("/recibo_caja_venta", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute("content")
                            },
                            body: JSON.stringify(venta)
                        })
                        .then(response => response.blob())
                        .then(blob => {
                            let url = window.URL.createObjectURL(blob);
                            window.open(url, "_blank");
                        })
                        .catch(error => console.error("Error al generar PDF:", error));
                });
            });
        }); // FIN document.ready
    </script>
@stop
