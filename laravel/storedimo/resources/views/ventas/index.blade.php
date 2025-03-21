@extends('layouts.app')
@section('title', 'Ventas')

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
            {{-- <div class="text-end">
                <a href="#" class="text-blue">
                    <i class="fa fa-question-circle fa-2x" aria-hidden="false" title="Ayuda" style="color: #337AB7"></i>
                </a>
            </div> --}}

            {{-- =============================================================== --}}
            {{-- =============================================================== --}}

            <div class="p-0" style="border: solid 1px #337AB7; border-radius: 5px;">
                <h5 class="border rounded-top text-white text-center pt-2 pb-2 m-0" style="background-color: #337AB7">Listar Ventas</h5>
            
                <div class="col-12 p-3" id="">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered w-100 mb-0" id="tbl_ventas" aria-describedby="ventas">
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
                                        <td>{{$venta->id_venta}}</td>
                                        <td>{{$venta->total_venta}}</td>
                                        <td>{{$venta->fecha_venta}}</td>
                                        <td>{{$venta->identificacion}}</td>
                                        <td>{{$venta->nombres_cliente}}</td>
                                        <td>{{$venta->tipo_pago}}</td>
                                        <td>{{$venta->estado}}</td>
                                        <td>
                                            <button title="Ver Detalles"
                                                class="btn rounded-circle btn-circle text-white"
                                                title="Detalles Ventas"
                                                style="background-color: #286090"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalDetalleVenta_{{$venta->id_venta}}">
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

                    <div class="mt-5 mb-2 d-flex justify-content-center">
                        <button class="btn rounded-2 me-3 text-white" type="submit" style="background-color: #286090">
                            <i class="fa fa-file-pdf-o"></i>
                            Reporte de Ventas
                        </button>
                    </div>
                </div> {{-- FIN div_campos_usuarios --}}
            </div> {{-- FIN div_crear_usuario --}}
        </div>
    </div>

    @foreach ($ventas as $venta)
        <!-- INICIO Modal Detalles compra -->
        <div class="modal fade h-auto modal-gral p-0" id="modalDetalleVenta_{{$venta->id_venta}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
            <div class="modal-dialog m-0">
                <div class="modal-content p-3 w-100">
                    <div class="rounded-top" style="border: solid 1px #337AB7;">
                        <div class="rounded-top text-white text-center" style="background-color: #337AB7; border: solid 1px #337AB7;">
                            <h5>Detalle de Venta Código: {{$venta->id_venta}}</h5>
                        </div>

                        <div class="mt-3 mb-0 ps-3">
                            <h6>Entrada realizada por: <span class="" style="color: #337AB7">{{$venta->nombres_usuario}}</span></h6>
                        </div>

                        <div class="modal-body p-0 m-0">
                            <div class="row m-0">
                                <div class="col-12 p-3 pt-1">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered w-100 mb-0" aria-describedby="venta">
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
                                                    <td>{{$venta->fecha_venta}}</td>
                                                    <td>{{$venta->nombres_cliente}}</td>
                                                    <td>{{$venta->subtotal_venta}}</td>
                                                    <td>{{$venta->descuento}}</td>
                                                    <td>{{$venta->total_venta}}</td>
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
                                            <table class="table table-striped table-bordered w-100 mb-0" aria-describedby="entradas">
                                                <thead>
                                                    <tr class="header-table text-center">
                                                        <th>Producto</th>
                                                        <th>Precio</th>
                                                        <th>Cantidad</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="text-center">
                                                        <td>{{$venta->nombre_producto}}</td>
                                                        <td>{{$venta->precio_unitario}}</td>
                                                        <td>{{$venta->cantidad}}</td>
                                                        <td>{{$venta->total_venta}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-around mt-3">
                        <button type="submit" title="Guardar Configuración" class="btn btn-success" id="btn_editar_categoria" style="background-color: #337AB7">
                            <i class="fa fa-file-pdf-o"> Recibo Caja</i>
                        </button>
                        
                        <button type="button" title="Cancelar" class="btn btn-secondary" data-bs-dismiss="modal" id="btn_editar_cancelar">
                            <i class="fa fa-times" aria-hidden="true"> Cerrar</i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIN Modal Detalles compra -->
    @endforeach
@stop

{{-- =============================================================== --}}
{{-- =============================================================== --}}
{{-- =============================================================== --}}

@section('scripts')
    <script src="{{asset('DataTables/datatables.min.js')}}"></script>
    <script src="{{asset('DataTables/Buttons-2.3.4/js/buttons.html5.min.js')}}"></script>

    <script>
        $( document ).ready(function() {
            // INICIO DataTable Lista Usuarios
            $("#tbl_ventas").DataTable({
                dom: 'Blfrtip',
                "infoEmpty": "No hay registros",
                stripe: true,
                "bSort": false,
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
                "pageLength": 10,
                "scrollX": true,
            });
            // CIERRE DataTable Lista Usuarios
        });
    </script>
@stop


