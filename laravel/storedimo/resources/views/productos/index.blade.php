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
                <a href="#" role="button" title="Ayuda" class="text-blue" data-bs-toggle="modal" data-bs-target="#modalAyudaModificacionProductos">
                    <i class="fa fa-question-circle fa-2x" aria-hidden="false" title="Ayuda" style="color: #337AB7"></i>
                </a>
            </div>

            <div class="modal fade h-auto modal-gral p-3" id="modalAyudaModificacionProductos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static" style="max-width: 55%;">
                <div class="modal-dialog m-0 mw-100">
                    <div class="modal-content border-0">
                        <div class="modal-body p-0 rounded-top" style="border: solid 1px #337AB7; mw-50">
                            <div class="row">
                                <div class="col-12">
                                    <div class="rounded-top text-white text-center p-2" style="background-color: #337AB7; border: solid 1px #337AB7;">
                                        <span class="modal-title"><strong>Ayuda de Listar Productos</strong></span>
                                    </div>
                                    {{-- =========================== --}}
                                    <div class="p-3">
                                        <p class="text-justify">Señor usuario en esta vista usted se va a encontrar con diferentes
                                            opciones ubicadas al lado izquierdo de la tabla, cada una con una acción
                                            diferente, esas opciones son:
                                        </p>
    
                                        <ul>
                                            <li><strong>Opcion de Modificación:</strong>
                                                <ol>Tener en cuenta a la hora de modificar un producto lo siguiente:
                                                    <li class="text-justify">Todos los campos que poseen el asterisco (*) son obligatorios, por lo tanto sino se diligencian,
                                                    el sistema no le dejará seguir.</li>
                                                    <li class="text-justify">Evitar ingresar nombres de productos ya existentes.</li>
                                                    <li class="text-justify">El precio unitario no puede ser mayor al precio al detal y precio al por mayor.</li>
                                                    <li class="text-justify">El precio al detal no puede ser menor al precio al por mayor.</li>
                                                </ol>
                                                <br>
                                            </li>
                                            <li><strong>Opción de Generación Código de Barras:</strong>
                                                <ol>Tener en cuenta lo siguiente en el momento de generar el código de barras de un producto:
                                                    <li class="text-justify">En el campo de cantidad la longitud máxima permitida es de 3 caracteres.</li>
                                                    <li class="text-justify">Ingresar cantidades no mayores a 100.</li>
                                                </ol>
                                            </li>
                                        </ul>
                                        <p class="text-justify">El icono de color azul es de solo información.</p>
                                        <p class="text-justify">El icono rojo pertenece al cambio de estado, el cual pedirá confirmación
                                                            en el momento de pulsar sobre el.</p>
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
                                @if(isset($productos) && count($productos) > 0)
                                    @foreach ($productos as $producto)
                                        <tr class="text-center">
                                            <td>{{$producto->id_producto}}</td>
                                            <td>{{$producto->nombre_producto}}</td>
                                            <td>{{$producto->categoria}}</td>
                                            <td>{{$producto->descripcion}}</td>
                                            <td>{{$producto->cantidad}}</td>
                                            <td>{{$producto->stock_minimo}}</td>
                                            <td>{{$producto->estado}}</td>

                                            @if ( $producto->id_estado == 1 || $producto->id_estado == "1" )
                                                <td>
                                                    <a href="#" role="button" class="btn btn-primary rounded-circle btn-circle view-details" data-bs-toggle="modal" data-bs-target="#productoModal" data-url="{{route('producto_show',['idProducto'=>$producto->id_producto])}}" title="Ver Detalles">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                    {{-- ============================== --}}
                                                    <a href="#" role="button" class="btn btn-success rounded-circle btn-circle modificar" data-bs-toggle="modal" data-bs-target="#productoModificarModal" data-url="{{route('producto_edit',['idProducto'=>$producto->id_producto])}}" title="Modificar">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    </a>
                                                    {{-- ============================== --}}
                                                    <a href="#" role="button" class="btn btn-warning rounded-circle btn-circle barcode" data-bs-toggle="modal" data-bs-target="#barCodeModal" title="Generar Código de Barras" data-url="{{route('query_barcode_producto',['idProducto'=>$producto->id_producto])}}" >
                                                        <i class="fa fa-barcode" aria-hidden="true"></i>
                                                    </a>
                                                    {{-- ============================== --}}
                                                    <button type="button" class="btn btn-danger rounded-circle btn-circle" title="Cambiar Estado" onclick="inactivarProducto('{{$producto->id_producto}}')">
                                                        <i class="fa fa-solid fa-recycle"></i>
                                                    </button>
                                                </td>
                                            @else
                                                <td>
                                                    <a href="#" role="button" class="btn btn-primary rounded-circle btn-circle view-details" data-bs-toggle="modal" data-bs-target="#productoModal" data-url="{{route('producto_show',['idProducto'=>$producto->id_producto])}}" title="Ver Detalles">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                    {{-- ============================== --}}
                                                    <button type="button" class="btn btn-danger rounded-circle btn-circle" title="Cambiar Estado" onclick="inactivarProducto('{{$producto->id_producto}}')">
                                                        <i class="fa fa-solid fa-recycle"></i>
                                                    </button>
                                                </td>
                                            @endif
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
        </div>

        {{-- ===================================================================================================== --}}
        {{-- ===================================================================================================== --}}

<<<<<<< HEAD
        <div class="modal fade h-auto modal-gral p-3" id="modalAyudaModificacionProductos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static" style="max-width: 55%;">
            <div class="modal-dialog m-0 mw-100">
                <div class="modal-content border-0">
                    <div class="modal-body p-0 rounded-top" style="border: solid 1px #337AB7; mw-50">
                        <div class="row">
                            <div class="col-12">
                                <div class="rounded-top text-white text-center p-2" style="background-color: #337AB7; border: solid 1px #337AB7;">
                                    <span class="modal-title fs-5"><strong>Ayuda de Listar Productos</strong></span>
                                </div>
                                {{-- =========================== --}}
                                <div class="p-3">
                                    <p class="text-justify">Señor usuario en esta vista usted se va a encontrar con diferentes
                                        opciones ubicadas al lado izquierdo de la tabla, cada una con una acción
                                        diferente, esas opciones son:
                                    </p>

                                    <ul>
                                        <li><strong>Opcion de Modificación:</strong>
                                            <ol>Tener en cuenta a la hora de modificar un producto lo siguiente:
                                                <li class="text-justify">Todos los campos que poseen el asterisco (*) son obligatorios, por lo tanto sino se diligencian,
                                                el sistema no le dejará seguir.</li>
                                                <li class="text-justify">Evitar ingresar nombres de productos ya existentes.</li>
                                                <li class="text-justify">El precio unitario no puede ser mayor al precio al detal y precio al por mayor.</li>
                                                <li class="text-justify">El precio al detal no puede ser menor al precio al por mayor.</li>
                                            </ol>
                                            <br>
                                        </li>
                                        <li><strong>Opción de Generación Código de Barras:</strong>
                                            <ol>Tener en cuenta lo siguiente en el momento de generar el código de barras de un producto:
                                            <li class="text-justify">En el campo de cantidad la longitud máxima permitida es de 3 caracteres.</li>
                                            <li class="text-justify">Ingresar cantidades no mayores a 100.</li>
                                            </ol>
                                        </li>
                                    </ul>
                                    <p class="text-justify">El icono de color azul es de solo información.</p>
                                    <p class="text-justify">El icono rojo pertenece al cambio de estado, el cual pedirá confirmación
                                                        en el momento de pulsar sobre el.</p>
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

        {{-- ===================================================================================================== --}}
        {{-- ===================================================================================================== --}}

=======
>>>>>>> juguimeco
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

        {{-- =========================================================================== --}}
        {{-- =========================================================================== --}}
        {{-- =========================================================================== --}}
        {{-- =========================================================================== --}}
        {{-- =========================================================================== --}}

        {{-- INICIO Modal MODIFICAR PRODUCTO --}}
        <div class="modal fade" id="productoModificarModal" tabindex="-1" role="dialog" aria-labelledby="productoModificarModal" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content p-3 w-100">
                    {!! Form::open(['method' => 'POST', 'route' => ['producto_update'], 'class' => 'm-0 p-0', 'autocomplete' => 'off', 'id' => 'form_producto_update']) !!}
                        @csrf
                        <div class="" style="border: solid 1px #337AB7;">
                            <div class="rounded-top text-white text-center" style="background-color: #337AB7; border: solid 1px #337AB7;">
                                <h5>Modificar Producto (Obligatorios *)</h5>
                            </div>

                            {{-- ====================================================== --}}
                            {{-- ====================================================== --}}

                            <div class="modal-body p-0 m-0">
                                <div class="row m-0 pt-4 pb-4">
                                    <div class="col-12 col-md-2">
                                        <div class="form-group d-flex flex-column">
                                            <label for="idProductoEdit" class="" style="font-size: 15px">Código<span class="text-danger">*</span></label>
                                            {{ Form::text('idProductoEdit', null, ['class'=>'form-control', 'id'=>'idProductoEdit', 'readonly'=>true ]) }}
                                        </div>
                                    </div>
                                    {{-- =================== --}}
                                    <div class="col-12 col-md-5">
                                        <div class="form-group d-flex flex-column">
                                            <label for="nombreProductoEdit" class="" style="font-size: 15px">Nombre Producto<span class="text-danger">*</span></label>
                                            {{Form::text('nombreProductoEdit', null, ['class' => 'form-control', 'id' => 'nombreProductoEdit'])}}
                                        </div>
                                    </div>
                                    {{-- =================== --}}
                                    <div class="col-12 col-md-5">
                                        <div class="form-group d-flex flex-column">
                                            <label for="categoriaEdit" class="" style="font-size: 15px">Categoría<span class="text-danger">*</span></label>
                                            {!! Form::select('categoriaEdit', collect(['' => 'Seleccionar...'])->union($categorias), null, ['class' => 'form-control', 'id' => 'categoriaEdit']) !!}
                                        </div>
                                    </div>
                                    {{-- =================== --}}
                                    <div class="col-12 mt-md-3">
                                        <div class="form-group d-flex flex-column">
                                            <label for="descripcionEdit" class="" style="font-size: 15px">Descripción<span class="text-danger">*</span></label>
                                            {{ Form::textarea('descripcionEdit', null,['class'=>'form-control', 'id'=>'descripcionEdit', 'rows' => 3, 'style' => 'resize: none;']) }}
                                        </div>
                                    </div>
                                    {{-- =================== --}}
                                    <div class="col-12 col-md-6 mt-md-3">
                                        <div class="form-group d-flex flex-column">
                                            <label for="precioUnitarioEdit" class="" style="font-size: 15px">Precio Unitario<span class="text-danger">*</span></label>
                                            {{ Form::text('precioUnitarioEdit', null,['class'=>'form-control', 'id'=>'precioUnitarioEdit']) }}
                                        </div>
                                    </div>
                                    {{-- =================== --}}
                                    <div class="col-12 col-md-6 mt-md-3">
                                        <div class="form-group d-flex flex-column">
                                            <label for="precioPorMayorEdit" class="" style="font-size: 15px">Precio al por Mayor<span class="text-danger">*</span></label>
                                            {{ Form::text('precioPorMayorEdit', null,['class'=>'form-control', 'id'=>'precioPorMayorEdit']) }}
                                        </div>
                                    </div>
                                    {{-- =================== --}}
                                    <div class="col-12 col-md-6 mt-md-3">
                                        <div class="form-group d-flex flex-column">
                                            <label for="precioDetalEdit" class="" style="font-size: 15px">Precio Detal<span class="text-danger">*</span></label>
                                            {{ Form::text('precioDetalEdit', null,['class'=>'form-control', 'id'=>'precioDetalEdit']) }}
                                        </div>
                                    </div>
                                    {{-- =================== --}}
                                    <div class="col-12 col-md-6 mt-md-3">
                                        <div class="form-group d-flex flex-column">
                                            <label for="stockMinimoEdit" class="" style="font-size: 15px">Stock Mínimo<span class="text-danger">*</span></label>
                                            {{ Form::text('stockMinimoEdit', null,['class'=>'form-control', 'id'=>'stockMinimoEdit']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        {{-- ====================================================== --}}
                        {{-- ====================================================== --}}

                        <div class="d-flex justify-content-center mt-5">
                            <button type="submit" class="btn btn-success me-3" title="Modificar">
                                <i class="fa fa-floppy-o" aria-hidden="true"> Modificar</i>
                            </button>
                            
                            <button type="button" class="btn btn-danger" title="Cancelar" data-bs-dismiss="modal">
                                <i class="fa fa-remove" aria-hidden="true"> Cancelar</i>
                            </button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        {{-- FINAL Modal MODIFICAR PRODUCTO --}}
        
        {{-- =========================================================================== --}}
        {{-- =========================================================================== --}}
        {{-- =========================================================================== --}}
        {{-- =========================================================================== --}}
        {{-- =========================================================================== --}}
        
        {{-- INICIO Modal CÓDIGO DE BARRAS PRODUCTO --}}
        <div class="modal fade" id="barCodeModal" tabindex="-1" role="dialog" aria-labelledby="barCodeModal" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content p-3 w-100">
                    {!! Form::open(['method' => 'POST', 'route' => ['producto_barcode'], 'class' => 'm-0 p-0', 'autocomplete' => 'off', 'id' => 'form_producto_barcode']) !!}
                    @csrf
                        <div class="" style="border: solid 1px #337AB7;">
                            <div class="rounded-top text-white text-center" style="background-color: #337AB7; border: solid 1px #337AB7;">
                                <h5>Producto: <span id="nombre_producto"></span> - Código: <span id="id_producto"></span></h5>

                                {{ Form::hidden('id_producto_input',null,['class'=>'','id'=>'id_producto_input','required'=>'required']) }}
                                {{ Form::hidden('nombre_producto_input',null,['class'=>'form-control','id'=>'nombre_producto_input', 'required'=>'required']) }}
                            </div>

                            {{-- ====================================================== --}}
                            {{-- ====================================================== --}}

                            <div class="modal-body p-0 m-0">
                                    <div class="m-0 p-4 d-flex justify-content-between">
                                        <div class="">
                                            {{ Form::number('cantidad_barcode',null,['class'=>'form-control','id'=>'cantidad_barcode','placeholder'=>'Ingresar cantidad', 'required'=>'required']) }}
                                        </div>
                                        
                                        <div class="">
                                            <button type="submit" class="btn btn-success">
                                                <i class="fa fa-floppy-o" aria-hidden="true"> Generar Código</i>
                                            </button>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                        
                    {{-- ====================================================== --}}
                    {{-- ====================================================== --}}

                    <div class="d-flex justify-content-end mt-5">
                        <button type="button" class="btn btn-secondary" title="Cancelar" data-bs-dismiss="modal">
                            <i class="fa fa-remove" aria-hidden="true"> Cancelar</i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        {{-- FINAL Modal CÓDIGO DE BARRAS PRODUCTO --}}
    </div>
@stop

{{-- =============================================================== --}}
{{-- =============================================================== --}}
{{-- =============================================================== --}}

@section('scripts')
    <script src="{{asset('DataTables/datatables.min.js')}}"></script>
    <script src="{{asset('DataTables/Buttons-2.3.4/js/buttons.html5.min.js')}}"></script>

    <script>
        // Variables globales para almacenar id_producto y nombre_producto para generar el código de barras
        // let idProductoGlobal;
        // let nombreProductoGlobal;

        $(document).ready(function() {
            @if(isset($productos) && count($productos) > 0)
                // INICIO DataTable Lista Productos
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
            @endif  // CIERRE DataTable Lista Productos
            
            // ===========================================================
            // ===========================================================

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
            });  // CIERRE Ver detalles producto
                        
            // ===========================================================
            // ===========================================================
            
            $('.modificar').click(function(e) {
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
                        $('#idProductoEdit').val(response.id_producto);
                        $('#nombreProductoEdit').val(response.nombre_producto);
                        $('#categoriaEdit').val(response.id_categoria);
                        $('#descripcionEdit').val(response.descripcion);
                        $('#precioUnitarioEdit').val(response.precio_unitario);
                        $('#precioPorMayorEdit').val(response.precio_por_mayor);
                        $('#precioDetalEdit').val(response.precio_detal);
                        $('#stockMinimoEdit').val(response.stock_minimo);

                        // Muestra el modal
                        $('#productoModificarModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        // Maneja los errores si la solicitud AJAX falla
                        console.error(error);
                    }
                });
            });  // CIERRE Ver editar producto

            // ===========================================================
            // ===========================================================
            
            $('.barcode').click(function(e) {
                e.preventDefault();
                let url = $(this).data('url');
                
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
                        $('#nombre_producto').html(response.nombre_producto);
                        $('#id_producto').html(response.id_producto);

                        $('#nombre_producto_input').val(response.nombre_producto);
                        $('#id_producto_input').val(response.id_producto);

                        idProductoGlobal = response.id_producto;
                        nombreProductoGlobal = response.nombre_producto;

                        // Muestra el modal
                        $('#barCodeModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        // Maneja los errores si la solicitud AJAX falla
                        console.error(error);
                    }
                });
            });  // CIERRE consulta el ID y nombre del producto
            
            // ===========================================================
            // ===========================================================

        }); //FIN Document.ready

        // ==========================================================
        // ==========================================================
        // ==========================================================

        function inactivarProducto(idProducto) {
            Swal.fire({
                title: "¿Realmente desea cambiar el estado del producto?",
                // text: "No se puede revertir!",
                icon: "warning",
                type: "warning",
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: "Aceptar",
                cancelButtonText: `Cancelar`
            }).then((result) => {
                console.log(result.value);
                /* Read more about isConfirmed, isDenied below */
                if (result.value) {
                    let url = "{{ route('inactivar_producto') }}";
                
                    $.ajax({
                        url: url,
                        type: 'POST',
                        dataType: "JSON",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'id_producto': idProducto,
                        },
                        success: function(response) {
                            console.log(response);

                            if (response == "estado_cambiado") {
                                Swal.fire(
                                    'Bien!',
                                    'Se cambia estado al Producto!',
                                    'success',
                                );
                                setTimeout(function() {
                                    window.location.reload();
                                }, 3000);
                            }

                            // ============================

                            if (response == "error_exception") {
                                Swal.fire(
                                    'Error!',
                                    'No fue posible cambiar el estado, Contacte a Soporte!',
                                    'error'
                                );
                                setTimeout(function() {
                                    window.location.reload();
                                }, 3000);
                            }
                        },
                        error: function(xhr, status, error) {
                            // Maneja los errores si la solicitud AJAX falla
                            console.error(error);
                        }
                    });
                }
            });
        }  // CIERRE Ver INACTIVAR producto

        // ==========================================================
        // ==========================================================
        // ==========================================================
        


        // ==========================================================
        // ==========================================================
        // ==========================================================
        

        
    </script>
@stop


