@extends('layouts.app')
@section('title', 'Productos')

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
                <h5 class="border rounded-top text-white text-center pt-2 pb-2 m-0" style="background-color: #337AB7">Listar Productos</h5>
            
                <div class="col-12 p-3" id="">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered w-100 mb-0" id="tbl_productos" aria-describedby="productos">
                            <thead>
                                <tr class="header-table text-center">
                                    <th>Código</th>
                                    <th>Nombre Producto</th>
                                    <th>Categoría</th>
                                    <th>Descripción</th>
                                    <th>Cantidad</th>
                                    <th>Stock Mínimo</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            {{-- ============================== --}}
                            <tbody>
                                {{-- @php
                                    dd($productos);
                                @endphp --}}
                                @if(isset($productos) && count($productos) > 0)
                                    @foreach ($productos as $producto)
                                        <tr class="text-center">
                                            <td>{{$producto['id_producto']}}</td>
                                            <td>{{$producto['nombre_producto']}}</td>
                                            <td>{{$producto['id_categoria']}}</td>
                                            <td>{{$producto['descripcion']}}</td>
                                            <td>{{$producto['cantidad']}}</td>
                                            <td>{{$producto['stock_minimo']}}</td>
                                            <td>{{$producto['estado']}}</td>
                                            <td>
                                                <a href="#" role="button" class="btn btn-primary rounded-circle btn-circle view-details" data-bs-toggle="modal" data-bs-target="#productoModal" data-url="{{route('producto_show',['idProducto'=>$producto['id_producto']])}}" title="Ver Detalles">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>

                                                {{-- <a href="{{route('producto_show', ['idProducto' => $producto['id_producto']])}}" role="button" class="btn btn-primary rounded-circle btn-circle view-details" data-bs-toggle="modal" data-bs-target="#productoModal" title="Ver Detalles">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a> --}}

                                                {{-- <button type="button" class="btn btn-primary rounded-circle btn-circle" title="Ver Detalles" onclick="verProducto({{$producto['id_producto']}})">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </button> --}}

                                                {{-- <a href="{{ route('producto_show', ['idProducto' => $producto['id_producto']]) }}" role="button" class="btn btn-primary rounded-circle btn-circle" title="Ver Detalles">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a> --}}
    
                                                <a href="#" role="button" class="btn btn-success rounded-circle btn-circle" title="Modificar">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </a>
    
                                                <a href="#" role="button" class="btn btn-warning rounded-circle btn-circle" title="Generar Código de Barras">
                                                    <i class="fa fa-key" aria-hidden="true"></i>
                                                </a>
                                                
                                                <a href="#" role="button" class="btn btn-danger rounded-circle btn-circle" title="Cambiar Estado">
                                                    <i class="fa fa-solid fa-recycle"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8" class="text-center">No hay productos disponibles.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    
                    {{-- ========================================================= --}}
                    {{-- ========================================================= --}}
                    {{-- ========================================================= --}}
                    {{-- ========================================================= --}}
            
                    <div class="mt-5 mb-2 d-flex justify-content-center">
                        <button type="submit" class="btn rounded-2 me-3 text-white" style="background-color: #286090">
                            <i class="fa fa-file-pdf-o"></i>
                            Reporte PDF Productos
                        </button>
                    </div>
                </div> {{-- FIN div_ --}}
            </div> {{-- FIN div_ --}}

            <!-- INICIO Modal -->
            {{-- <div class="modal fade" id="productoModal" tabindex="-1" role="dialog" aria-labelledby="productoModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="productoModalLabel">Detalles del Producto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Aquí se mostrará la información del producto -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- FIN Modal -->

            {{-- INICIO Modal DETALLES PRODUCTO --}}
            <div class="modal fade" id="productoModal" tabindex="-1" role="dialog" aria-labelledby="productoModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content p-3 w-100">
                        <div class="" style="border: solid 1px #337AB7;">
                            <div class="rounded-top text-white text-center" style="background-color: #337AB7; border: solid 1px #337AB7;">
                                <h5>Detalle de: <span id="nombreProducto"></span> - Código: <span id="idProducto"></span></h5>
                            </div>

                            {{-- ====================================================== --}}
                            {{-- ====================================================== --}}

                            <div class="modal-body p-0 m-0">
                                <div class="row m-0 pt-4 pb-4">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered w-100 mb-0" id="tbl_ver_producto" aria-describedby="producto">
                                                <thead>
                                                    <tr class="header-table text-center">
                                                        <th>Precio Unitario</th>
                                                        <th>Precio al Detal</th>
                                                        <th>Precio al por Mayor</th>
                                                    </tr>
                                                </thead>
                                                {{-- ============================== --}}
                                                <tbody>
                                                    <tr class="text-center">
                                                        <td id="precio_unitario"></td>
                                                        <td id="precio_detal"></td>
                                                        <td id="precio_por_mayor"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        {{-- ====================================================== --}}
                        {{-- ====================================================== --}}

                        <div class="d-flex justify-content-end mt-5">
                            <button type="button" class="btn btn-secondary" title="Cancelar" data-bs-dismiss="modal">
                                <i class="fa fa-remove" aria-hidden="true"> Cerrar</i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- FINAL Modal  DETALLES PRODUCTO --}}
        </div>
    </div>
@stop

{{-- =============================================================== --}}
{{-- =============================================================== --}}
{{-- =============================================================== --}}

@section('scripts')
    <script src="{{asset('DataTables/datatables.min.js')}}"></script>
    <script src="{{asset('DataTables/Buttons-2.3.4/js/buttons.html5.min.js')}}"></script>

    <script>
        $(document).ready(function() {
            @if(isset($productos) && count($productos) > 0)
                // INICIO DataTable Lista Usuarios
                $("#tbl_productos").DataTable({
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
            @endif
        }); //FIN Document.ready

        // ==========================================================
        // ==========================================================
        // ==========================================================

        $(document).ready(function() {
            $('.view-details').click(function(e) {
                e.preventDefault();
                var url = $(this).data('url');
                
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: "JSON",
                    data: {
                        '_token': "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        console.log(response);
                        // Actualiza el contenido del modal con la información del producto
                        $('#nombreProducto').html(response.nombre_producto);
                        $('#idProducto').html(response.id_producto);
                        $('#precio_unitario').html(response.precio_unitario);
                        $('#precio_detal').html(response.precio_detal);
                        $('#precio_por_mayor').html(response.precio_por_mayor);

                        // Muestra el modal
                        $('#productoModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        // Maneja los errores si la solicitud AJAX falla
                        console.error(error);
                    }
                });
            });
        });
    </script>
@stop


