@extends('layouts.app')
@section('title', 'Listar Entradas')

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

@section('content')
    <div class="d-flex p-0">
        <div class="p-0" style="width: 20%">
            @include('layouts.sidebarmenu')
        </div>

        <div class="p-3 d-flex flex-column" style="width: 80%">
            <div class="text-end">
                <a href="#" class="text-blue">
                    <i class="fa fa-question-circle fa-2x" aria-hidden="false" title="Ayuda" style="color: #337AB7"></i>
                </a>
            </div>

            <div class="p-0" style="border: solid 1px #337AB7; border-radius: 5px;">
                <h5 class="border rounded-top text-white text-center pt-2 pb-2 m-0" style="background-color: #337AB7">Listar Entradas</h5>
            
                <div class="col-12 p-3" id="">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered w-100 mb-0" id="tbl_entradas" aria-describedby="entradas">
                            <thead>
                                <tr class="header-table text-center">
                                    <th>Código Entrada</th>
                                    <th>Valor Total</th>
                                    <th>Fecha Registro Entrada</th>
                                    <th>Identificación Proveedor</th>
                                    <th>Nombre Proveedor</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($entradas as $entrada)
                                    <tr class="text-center">
                                        <td>{{$entrada->id_compra}}</td>
                                        <td>{{$entrada->valor_compra}}</td>
                                        <td>{{$entrada->fecha_compra}}</td>
                                        <td>{{$entrada->nit_empresa}}</td>
                                        <td>{{$entrada->nombre_empresa}}</td>
                                        <td>{{$entrada->estado}}</td>
                                        <td>
                                            <button title="Ver Detalles"
                                                class="btn rounded-circle btn-circle text-white"
                                                style="background-color: #286090"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalDetalleEntrada_{{$entrada->id_compra}}">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </button>

                                            <button title="Anular"
                                                class="btn rounded-circle btn-circle text-white btn-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalAnularCompra_{{$entrada->id_compra}}">
                                                <i class="fa fa-remove"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-5 mb-2 d-flex justify-content-center">
                        <button class="btn rounded-2 me-3 text-white" type="submit" style="background-color: #286090">
                            <i class="fa fa-file-pdf-o"></i>
                            Reporte Entradas
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($entradas as $entrada)
        <!-- Modal Detalles compra -->
        <div class="modal fade h-auto modal-gral p-0" id="modalDetalleEntrada_{{$entrada->id_compra}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
            <div class="modal-dialog m-0">
                <div class="modal-content p-3 w-100">
                    <div class="rounded-top" style="border: solid 1px #337AB7;">
                        <div class="rounded-top text-white text-center" style="background-color: #337AB7; border: solid 1px #337AB7;">
                            <h5>Detalle de Entrada Código: {{$entrada->id_compra}}</h5>
                        </div>

                        <div class="mt-3 mb-0 ps-3">
                            <h6>Entrada realizada por: <span class="" style="color: #337AB7">{{$entrada->nombres_usuario}}</span></h6>
                        </div>

                        <div class="modal-body p-0 m-0">
                            <div class="row m-0">
                                <div class="col-12 p-3 pt-1">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered w-100 mb-0" aria-describedby="entradas">
                                            <thead>
                                                <tr class="header-table text-center">
                                                    <th>Fecha Entrada</th>
                                                    <th>Id Proveedor</th>
                                                    <th>Nombre Proveedor</th>
                                                    <th>Valor Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="text-center">
                                                    <td>{{$entrada->fecha_compra}}</td>
                                                    <td>{{$entrada->nit_empresa}}</td>
                                                    <td>{{$entrada->nombre_empresa}}</td>
                                                    <td>{{$entrada->valor_compra}}</td>
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
                                                        <th>Cantidad</th>
                                                        <th>Precio</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="text-center">
                                                        <td>{{$entrada->nombre_producto}}</td>
                                                        <td>{{$entrada->cantidad}}</td>
                                                        <td>{{$entrada->precio_unitario}}</td>
                                                        <td>{{$entrada->precio_unitario}}</td>
                                                    </tr>
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

                    <div class="d-flex justify-content-around mt-3">
                        <button type="submit" title="Guardar Configuración" class="btn btn-success" id="btn_editar_categoria" style="background-color: #337AB7">
                            <i class="fa fa-file-pdf-o"> PdfDetalles Entradas</i>
                        </button>
                        
                        <button type="button" title="Cancelar" class="btn btn-secondary" data-bs-dismiss="modal" id="btn_editar_cancelar">
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
        <div class="modal fade h-auto modal-gral p-0" id="modalAnularCompra_{{$entrada->id_compra}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
            <div class="modal-dialog m-0">
                <div class="modal-content p-3 w-100">
                    {!!Form::open(['method' => 'POST',
                        'route' => ['anular_compra'],
                        'class' => 'mt-2', 'autocomplete' => 'off',
                        'id' => 'formAnularCompra_'.$entrada->id_compra])!!}
                        @csrf

                        {{Form::hidden('id_compra',isset($entrada) ? $entrada->id_compra : null,['class'=>'','id'=>'id_compra_'.$entrada->id_compra])}}

                        <div class="rounded-top" style="border: solid 1px #337AB7;">
                            <div class="rounded-top text-white text-center" style="background-color: #337AB7; border: solid 1px #337AB7;">
                                <h5>Anular Compra</h5>
                            </div>

                            <div class="modal-body p-0 m-0">
                                <div class="mt-3 mb-3 mb-0 ps-3 text-center">
                                    <h5 class="text-danger">¿Realmente desea anular la compra del producto?</h5>
        
                                    <h4 class="mt-4" style="color: #337AB7"> {{$entrada->id_compra}} - {{$entrada->nombre_producto}}</h4>
                                </div>
                            </div>
                        </div>

                        <div id="loadingIndicatorAnularCompra_{{$entrada->id_compra}}" class="loadingIndicator">
                            <img src="{{ asset('imagenes/loading.gif') }}" alt="Procesando...">
                        </div>

                        <div class="d-flex justify-content-around mt-3">
                            <button type="submit" class="btn btn-success" id="btn_anular_compra_{{$entrada->id_compra}}" style="background-color: #337AB7">
                                <i class="fa fa-file-pdf-o"> Anular</i>
                            </button>
                            
                            <button type="button" class="btn btn-secondary" id="btn_cancelar_compra_{{$entrada->id_compra}}" data-bs-dismiss="modal">
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
    <script src="{{asset('DataTables/datatables.min.js')}}"></script>
    <script src="{{asset('DataTables/Buttons-2.3.4/js/buttons.html5.min.js')}}"></script>

    <script>
        $( document ).ready(function() {
            // INICIO DataTable Lista Usuarios
            $("#tbl_entradas").DataTable({
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
            }); // CIERRE DataTable Lista Usuarios

            // =========================================================================
            // =========================================================================
            // =========================================================================
            
            // formEditarCategoria para cargar gif en el submit
            $(document).on("submit", "form[id^='formAnularCompra_']", function(e) {
                const form = $(this);
                const formId = form.attr('id'); // Obtenemos el ID del formulario
                const id = formId.split('_')[1]; // Obtener el ID del formulario desde el ID del formulario

                // Capturar spinner y btns
                const loadingIndicator = $(`#loadingIndicatorAnularCompra_${id}`);
                const submitButton = $(`#btn_anular_compra_${id}`);
                const cancelButton = $(`#btn_cancelar_compra_${id}`);

                // Desactivar btns
                submitButton.prop("disabled", true).html("Procesando... <i class='fa fa-spinner fa-spin'></i>");
                cancelButton.prop("disabled", true);

                // Cargar Spinner
                loadingIndicator.show();
            });
        }); // FIN document.ready
    </script>
@stop