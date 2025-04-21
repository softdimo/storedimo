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
            <div class="d-flex justify-content-between pe-3 mt-2 mb-3">
                <div class="">
                    <a href="{{ route('productos.create') }}" class="btn text-white" style="background-color:#337AB7">Crear
                        Producto</a>
                </div>

                <a href="#" role="button" title="Ayuda" class="text-blue" data-bs-toggle="modal"
                    data-bs-target="#modalAyudaModificacionProductos">
                    <i class="fa fa-question-circle fa-2x" aria-hidden="false" title="Ayuda" style="color: #337AB7"></i>
                </a>
            </div>

            <div class="modal fade h-auto modal-gral p-3" id="modalAyudaModificacionProductos" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static" style="max-width: 55%;">
                <div class="modal-dialog m-0 mw-100">
                    <div class="modal-content border-0">
                        <div class="modal-body p-0 rounded-top" style="border: solid 1px #337AB7; mw-50">
                            <div class="row">
                                <div class="col-12">
                                    <div class="rounded-top text-white text-center p-2"
                                        style="background-color: #337AB7; border: solid 1px #337AB7;">
                                        <span class="modal-title fs-4"><strong>Ayuda de Listar Productos</strong></span>
                                    </div>
                                    {{-- =========================== --}}
                                    <div class="p-3">
                                        <p class="text-justify">Señor usuario en esta vista usted se va a encontrar con
                                            diferentes
                                            opciones ubicadas al lado izquierdo de la tabla, cada una con una acción
                                            diferente, esas opciones son:
                                        </p>

                                        <ul>
                                            <li><strong>Opcion de Modificación:</strong>
                                                <ol>Tener en cuenta a la hora de modificar un producto lo siguiente:
                                                    <li class="text-justify">Todos los campos que poseen el asterisco (*)
                                                        son obligatorios, por lo tanto sino se diligencian,
                                                        el sistema no le dejará seguir.</li>
                                                    <li class="text-justify">Evitar ingresar nombres de productos ya
                                                        existentes.</li>
                                                    <li class="text-justify">El precio unitario no puede ser mayor al precio
                                                        al detal y precio al por mayor.</li>
                                                    <li class="text-justify">El precio al detal no puede ser menor al precio
                                                        al por mayor.</li>
                                                </ol>
                                                <br>
                                            </li>
                                            <li><strong>Opción de Generación Código de Barras:</strong>
                                                <ol>Tener en cuenta lo siguiente en el momento de generar el código de
                                                    barras de un producto:
                                                    <li class="text-justify">En el campo de cantidad la longitud máxima
                                                        permitida es de 3 caracteres.</li>
                                                    <li class="text-justify">Ingresar cantidades no mayores a 100.</li>
                                                </ol>
                                            </li>
                                        </ul>
                                        <p class="text-justify">El icono de color azul es de solo información.</p>
                                        <p class="text-justify">El icono rojo pertenece al cambio de estado, el cual pedirá
                                            confirmación en el momento de pulsar sobre el.</p>
                                    </div> {{-- FINpanel-body --}}
                                </div> {{-- FIN col-12 --}}
                            </div> {{-- FIN modal-body .row --}}
                        </div> {{-- FIN modal-body --}}
                        {{-- =========================== --}}
                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="button" class="btn btn-primary btn-md active pull-right"
                                    data-bs-dismiss="modal" style="background-color: #337AB7;">
                                    <i class="fa fa-check-circle" aria-hidden="true">&nbsp;Aceptar</i>
                                </button>
                            </div>
                        </div>
                    </div> {{-- FIN modal-content --}}
                </div> {{-- FIN modal-dialog --}}
            </div> {{-- FIN modalAyudaModificacionProductos --}}

            {{-- =============================================================== --}}
            {{-- =============================================================== --}}

            <div class="p-0" style="border: solid 1px #337AB7; border-radius: 5px;">
                <h5 class="border rounded-top text-white text-center pt-2 pb-2 m-0" style="background-color: #337AB7">Listar
                    Productos</h5>

                <div class="col-12 p-3" id="">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered w-100 mb-0" id="tbl_productos"
                            aria-describedby="productos">
                            <thead>
                                <tr class="header-table text-center">
                                    {{-- <th>Código</th> --}}
                                    <th class="align-middle">Referencia</th>
                                    <th class="align-middle">Nombre Producto</th>
                                    <th class="align-middle">Categoría</th>
                                    <th class="align-middle">Descripción</th>
                                    <th class="align-middle">Cantidad</th>
                                    <th class="align-middle">Stock Mínimo</th>
                                    <th class="align-middle">Fecha Vencimiento</th>
                                    <th class="align-middle">Estado</th>
                                    <th class="align-middle">Opciones</th>
                                </tr>
                            </thead>
                            {{-- ============================== --}}
                            <tbody>
                                @foreach ($productos as $producto)
                                    <tr class="text-center">
                                        {{-- <td>{{ $producto->id_producto }}</td> --}}
                                        <td class="align-middle">{{ $producto->referencia }}</td>
                                        <td class="align-middle">{{ $producto->nombre_producto }}</td>
                                        <td class="align-middle">{{ $producto->categoria }}</td>
                                        <td class="align-middle">{{ $producto->descripcion }}</td>

                                        @if (is_null($producto->cantidad))
                                            <td class="bg-warning-subtle align-middle">Sin compra realizada</td>
                                        @elseif ($producto->cantidad < $producto->stock_minimo)
                                            <td class="bg-danger-subtle align-middle">{{ $producto->cantidad }}</td>
                                        @else
                                            <td class="bg-success-subtle align-middle">{{ $producto->cantidad }}</td>
                                        @endif

                                        <td class="align-middle">{{ $producto->stock_minimo }}</td>

                                        <td class="align-middle">{{ $producto->fecha_vencimiento }}</td>
                                        <td class="align-middle">{{ $producto->estado }}</td>

                                        @if ($producto->id_estado == 1 || $producto->id_estado == '1')
                                            <td class="align-middle">
                                                <button class="btn btn-success rounded-circle btn-circle"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalEditarProducto_{{ $producto->id_producto }}"
                                                    title="Modificar">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </button>
                                                {{-- ============================== --}}
                                                <button class="btn btn-warning rounded-circle btn-circle barcode"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#barCodeModal_{{ $producto->id_producto }}"
                                                    title="Generar Código de Barras">
                                                    <i class="fa fa-barcode" aria-hidden="true"></i>
                                                </button>
                                                {{-- ============================== --}}
                                                <button class="btn btn-danger rounded-circle btn-circle"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalCambiarEstadoProducto_{{ $producto->id_producto }}"
                                                    title="Cambiar Estado">
                                                    <i class="fa fa-solid fa-recycle" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                        @else
                                            <td class="align-middle">
                                                <button class="btn btn-danger rounded-circle btn-circle"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalCambiarEstadoProducto_{{ $producto->id_producto }}"
                                                    title="Cambiar Estado">
                                                    <i class="fa fa-solid fa-recycle" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                        @endif

                                        {{-- =========================================================================== --}}
                                        {{-- =========================================================================== --}}
                                        {{-- =========================================================================== --}}

                                        {{-- INICIO Modal MODIFICAR PRODUCTO --}}
                                        <div class="modal fade h-auto modal-gral p-0"
                                            id="modalEditarProducto_{{ $producto->id_producto }}" tabindex="-1"
                                            role="dialog" aria-labelledby="myModalLabel" data-bs-keyboard="false"
                                            data-bs-backdrop="static">
                                            <div class="modal-dialog m-0">
                                                <div class="modal-content p-3">
                                                    {!! Form::open([
                                                        'method' => 'POST',
                                                        'route' => ['producto_update'],
                                                        'class' => 'm-0 p-0',
                                                        'autocomplete' => 'off',
                                                        'id' => 'formEditarProducto_' . $producto->id_producto,
                                                    ]) !!}
                                                    @csrf
                                                    <div class="rounded-top" style="border: solid 1px #337AB7;">
                                                        <div class="rounded-top text-white text-center"
                                                            style="background-color: #337AB7; border: solid 1px #337AB7;">
                                                            <h5>Modificar Producto (Obligatorios *)</h5>
                                                        </div>

                                                        {{-- ====================================================== --}}
                                                        {{-- ====================================================== --}}

                                                        <div class="modal-body p-0 m-0">
                                                            <div class="row m-0 pt-2 pb-4">
                                                                <div class="col-12 col-md-2">
                                                                    <div class="form-group d-flex flex-column">
                                                                        <label for="idProductoEdit" class=""
                                                                            style="font-size: 15px">Código<span
                                                                                class="text-danger"></span></label>
                                                                        {{ Form::text('idProductoEdit', isset($producto) ? $producto->id_producto : null, ['class' => 'form-control bg-secondary-subtle', 'id' => 'idProductoEdit', 'required' => 'required', 'readonly' => true]) }}
                                                                    </div>
                                                                </div>
                                                                {{-- =================== --}}
                                                                <div class="col-12 col-md-5">
                                                                    <div class="form-group d-flex flex-column">
                                                                        <label for="nombreProductoEdit" class=""
                                                                            style="font-size: 15px">Nombre Producto<span
                                                                                class="text-danger">*</span></label>
                                                                        {{ Form::text('nombreProductoEdit', isset($producto) ? $producto->nombre_producto : null, ['class' => 'form-control', 'id' => 'nombreProductoEdit', 'required' => 'required']) }}
                                                                    </div>
                                                                </div>
                                                                {{-- =================== --}}
                                                                <div class="col-12 col-md-5">
                                                                    <div class="form-group d-flex flex-column">
                                                                        <label for="categoriaEdit" class=""
                                                                            style="font-size: 15px">Categoría<span
                                                                                class="text-danger">*</span></label>
                                                                        {!! Form::select(
                                                                            'categoriaEdit',
                                                                            collect(['' => 'Seleccionar...'])->union($categorias),
                                                                            isset($producto) ? $producto->id_categoria : null,
                                                                            ['class' => 'form-select', 'id' => 'categoriaEdit', 'required' => 'required'],
                                                                        ) !!}
                                                                    </div>
                                                                </div>
                                                                {{-- =================== --}}
                                                                <div class="col-12 mt-md-3">
                                                                    <div class="form-group d-flex flex-column">
                                                                        <label for="descripcionEdit" class=""
                                                                            style="font-size: 15px">Descripción<span
                                                                                class="text-danger">*</span></label>
                                                                        {{ Form::textarea('descripcionEdit', isset($producto) ? $producto->descripcion : null, ['class' => 'form-control', 'id' => 'descripcionEdit', 'rows' => 2, 'style' => 'resize: none;']) }}
                                                                    </div>
                                                                </div>
                                                                {{-- =================== --}}
                                                                <div class="col-12 col-md-4 mt-md-3">
                                                                    <div class="form-group d-flex flex-column">
                                                                        <label for="precioUnitarioEdit" class=""
                                                                            style="font-size: 15px">Precio Unitario<span
                                                                                class="text-danger">*</span></label>
                                                                        {{ Form::text('precioUnitarioEdit', isset($producto) ? $producto->precio_unitario : null, ['class' => 'form-control', 'id' => 'precioUnitarioEdit', 'required' => 'required']) }}
                                                                    </div>
                                                                </div>
                                                                {{-- =================== --}}
                                                                <div class="col-12 col-md-4 mt-md-3">
                                                                    <div class="form-group d-flex flex-column">
                                                                        <label for="precioDetalEdit" class=""
                                                                            style="font-size: 15px">Precio Detal<span
                                                                                class="text-danger">*</span></label>
                                                                        {{ Form::text('precioDetalEdit', isset($producto) ? $producto->precio_detal : null, ['class' => 'form-control', 'id' => 'precioDetalEdit', 'required' => 'required']) }}
                                                                    </div>
                                                                </div>
                                                                {{-- =================== --}}
                                                                <div class="col-12 col-md-4 mt-md-3">
                                                                    <div class="form-group d-flex flex-column">
                                                                        <label for="precioPorMayorEdit" class=""
                                                                            style="font-size: 15px">Precio x Mayor
                                                                            <span class="text-danger">*</span>
                                                                        </label>
                                                                        {{ Form::text('precioPorMayorEdit', isset($producto) ? $producto->precio_por_mayor : null, ['class' => 'form-control', 'id' => 'precioPorMayorEdit', 'required' => 'required']) }}
                                                                    </div>
                                                                </div>
                                                                {{-- =================== --}}
                                                                <div class="col-12 col-md-4 mt-md-3">
                                                                    <div class="form-group d-flex flex-column">
                                                                        <label for="stockMinimoEdit" class=""
                                                                            style="font-size: 15px">Stock Mínimo<span
                                                                                class="text-danger">*</span></label>
                                                                        {{ Form::text('stockMinimoEdit', isset($producto) ? $producto->stock_minimo : null, ['class' => 'form-control', 'id' => 'stockMinimoEdit', 'required' => 'required']) }}
                                                                    </div>
                                                                </div>
                                                                {{-- =================== --}}
                                                                <div class="col-12 col-md-4 mt-md-3">
                                                                    <div class="form-group d-flex flex-column">
                                                                        <label for="referenciaEdit" class=""
                                                                            style="font-size: 15px">Referencia<span
                                                                                class="text-danger">*</span></label>
                                                                        {{ Form::text('referenciaEdit', isset($producto) ? $producto->referencia : null, ['class' => 'form-control', 'id' => 'referenciaEdit', 'required' => 'required']) }}
                                                                    </div>
                                                                </div>
                                                                {{-- =================== --}}
                                                                <div class="col-12 col-md-4 mt-md-3">
                                                                    <div class="form-group d-flex flex-column">
                                                                        <label for="fechaVencimientoEdit" class=""
                                                                            style="font-size: 15px">Fecha Vencimiento</label>
                                                                        {{ Form::date('fechaVencimientoEdit', isset($producto) ? $producto->fecha_vencimiento : null, ['class' => 'form-control', 'id' => 'fechaVencimientoEdit']) }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- ====================================================== --}}
                                                    {{-- ====================================================== --}}

                                                    <!-- Contenedor para el GIF -->
                                                    <div id="loadingIndicatorEditProducto_{{ $producto->id_producto }}"
                                                        class="loadingIndicator">
                                                        <img src="{{ asset('imagenes/loading.gif') }}"
                                                            alt="Procesando...">
                                                    </div>

                                                    {{-- ====================================================== --}}
                                                    {{-- ====================================================== --}}

                                                    <div class="d-flex justify-content-center mt-3">
                                                        <button type="submit" title="Modificar"
                                                            class="btn btn-success me-3"
                                                            id="btn_editar_producto_{{ $producto->id_producto }}">
                                                            <i class="fa fa-floppy-o" aria-hidden="true"> Modificar</i>
                                                        </button>

                                                        <button type="button" title="Cancelar" class="btn btn-danger"
                                                            data-bs-dismiss="modal"
                                                            id="btn_cancelar_producto_{{ $producto->id_producto }}">
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

                                        {{-- INICIO Modal CÓDIGO DE BARRAS PRODUCTO --}}
                                        <div class="modal fade h-auto modal-gral p-0"
                                            id="barCodeModal_{{ $producto->id_producto }}" tabindex="-1" role="dialog"
                                            aria-labelledby="myModalLabel" aria-hidden="true" data-bs-backdrop="static"
                                            data-bs-keyboard="false">
                                            <div class="modal-dialog m-0">
                                                <div class="modal-content p-3 w-100">
                                                    {!! Form::open([
                                                        'method' => 'POST',
                                                        'route' => ['producto_barcode'],
                                                        'class' => 'm-0 p-0',
                                                        'autocomplete' => 'off',
                                                        'id' => 'formProductoBarcode_' . $producto->id_producto,
                                                    ]) !!}
                                                    @csrf

                                                    <div class="rounded-top" style="border: solid 1px #337AB7;">
                                                        <div class="rounded-top text-white text-center"
                                                            style="background-color: #337AB7; border: solid 1px #337AB7;">
                                                            <h5>Producto: <span
                                                                    id="nombre_producto">{{ $producto->nombre_producto }}</span>
                                                                - Referencia: <span
                                                                    id="referencia">{{ $producto->referencia }}</span>
                                                            </h5>

                                                            {{ Form::hidden('id_producto_input', isset($producto) ? $producto->id_producto : null, ['class' => '', 'id' => 'id_producto_input', 'required' => 'required']) }}
                                                            {{ Form::hidden('referencia_input', isset($producto) ? $producto->referencia : null, ['class' => '', 'id' => 'referencia_input', 'required' => 'required']) }}
                                                            {{ Form::hidden('nombre_producto_input', isset($producto) ? $producto->nombre_producto : null, ['class' => 'form-control', 'id' => 'nombre_producto_input', 'required' => 'required']) }}
                                                        </div>
                                                        {{-- ====================================================== --}}
                                                        <div class="modal-body p-0 m-0">
                                                            <div class="m-0 p-4 d-flex justify-content-between">
                                                                <div class="">
                                                                    {{ Form::number('cantidad_barcode', null, [
                                                                        'class' => 'form-control',
                                                                        'id' => 'cantidad_barcode_' . $producto->id_producto,
                                                                        'placeholder' => 'Ingresar cantidad',
                                                                        'min' => '1',
                                                                    ]) }}
                                                                </div>

                                                                <div class="">
                                                                    <button type="submit" class="btn btn-success"
                                                                        id="btn_codebar_producto_{{ $producto->id_producto }}">
                                                                        <i class="fa fa-floppy-o" aria-hidden="true">
                                                                            Generar Código</i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- ====================================================== --}}
                                                    {{-- ====================================================== --}}

                                                    <!-- Contenedor para el GIF -->
                                                    <div id="loadingIndicatorCodeBarProducto_{{ $producto->id_producto }}"
                                                        class="loadingIndicator">
                                                        <img src="{{ asset('imagenes/loading.gif') }}"
                                                            alt="Procesando...">
                                                    </div>

                                                    {{-- ====================================================== --}}
                                                    {{-- ====================================================== --}}

                                                    <div class="d-flex justify-content-end mt-3">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal"
                                                            id="btn_cancelar_codebar_{{ $producto->id_producto }}">
                                                            <i class="fa fa-remove" aria-hidden="true"> Cancelar</i>
                                                        </button>
                                                    </div>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                        {{-- FINAL Modal CÓDIGO DE BARRAS PRODUCTO --}}

                                        {{-- =========================================================================== --}}
                                        {{-- =========================================================================== --}}
                                        {{-- =========================================================================== --}}

                                        {{-- INICIO Modal ESTADO PRODUCTO --}}
                                        <div class="modal fade h-auto modal-gral"
                                            id="modalCambiarEstadoProducto_{{ $producto->id_producto }}" tabindex="-1"
                                            data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
                                            <div class="modal-dialog m-0">
                                                <div class="modal-content w-100 border-0">
                                                    {!! Form::open([
                                                        'method' => 'POST',
                                                        'route' => ['cambiar_estado_producto'],
                                                        'class' => 'mt-2',
                                                        'autocomplete' => 'off',
                                                        'id' => 'formCambiarEstadoProducto_' . $producto->id_producto,
                                                    ]) !!}
                                                    @csrf
                                                    <div class="rounded-top" style="border: solid 1px #337AB7;">
                                                        <div class="rounded-top text-white text-center"
                                                            style="background-color: #337AB7; border: solid 1px #337AB7;">
                                                            <h5>Cambiar estado del producto: <br>
                                                                <span
                                                                    class="text-warning">{{ $producto->nombre_producto }}</span>
                                                            </h5>
                                                        </div>

                                                        <div class="mt-4 mb-4 text-center">
                                                            <span class="text-danger fs-5">¿Realmente desea cambiar el
                                                                estado del producto?</span>
                                                        </div>


                                                        {{ Form::hidden('id_producto', isset($producto) ? $producto->id_producto : null, ['class' => '', 'id' => 'id_producto']) }}
                                                    </div>

                                                    {{-- ====================================================== --}}
                                                    {{-- ====================================================== --}}

                                                    <!-- Contenedor para el GIF -->
                                                    <div id="loadingIndicatorEstadoProducto_{{ $producto->id_producto }}"
                                                        class="loadingIndicator">
                                                        <img src="{{ asset('imagenes/loading.gif') }}"
                                                            alt="Procesando...">
                                                    </div>

                                                    {{-- ====================================================== --}}
                                                    {{-- ====================================================== --}}

                                                    <div class="d-flex justify-content-center mt-3">
                                                        <button type="submit"
                                                            id="btn_cambiar_estado_producto_{{ $producto->id_producto }}"
                                                            class="btn btn-success me-3" title="Guardar Configuración">
                                                            <i class="fa fa-floppy-o" aria-hidden="true"> Modificar</i>
                                                        </button>


                                                        <button type="button"
                                                            id="btn_cancelar_estado_producto_{{ $producto->id_producto }}"
                                                            class="btn btn-secondary" title="Cancelar"
                                                            data-bs-dismiss="modal">
                                                            <i class="fa fa-times" aria-hidden="true"> Cancelar</i>
                                                        </button>
                                                    </div>
                                                    {!! Form::close() !!}
                                                </div> {{-- FIN modal-content --}}
                                            </div> {{-- FIN modal-dialog --}}
                                        </div> {{-- FIN modal --}}
                                        {{-- FINAL Modal ESTADO PRODUCTO --}}
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
                        <a href="{{ route('reporte_productos_pdf') }}" target="_blank"
                            class="btn rounded-2 me-3 text-white" style="background-color: #286090">
                            <i class="fa fa-file-pdf-o"></i>
                            Reporte Productos
                        </a>
                    </div> --}}
                </div> {{-- FIN div_ --}}
            </div> {{-- FIN div_ --}}
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
            // @if (isset($productos) && count($productos) > 0)
            // INICIO DataTable Lista Productos
            $("#tbl_productos").DataTable({
                dom: 'Blfrtip',
                "infoEmpty": "No hay registros",
                stripe: true,
                bSort: true,
                buttons: [{
                        text: 'PDF',
                        className: 'waves-effect waves-light btn-rounded btn-sm btn-danger',
                        action: function() {
                            window.open("{{ route('reporte_productos_pdf') }}", "_blank");
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
            // @endif
            // CIERRE DataTable Lista Productos

            // ===========================================================
            // ===========================================================

            // formEditarProducto para cargar gif en el submit
            $(document).on("submit", "form[id^='formEditarProducto_']", function(e) {
                const form = $(this);
                const formId = form.attr('id'); // Obtenemos el ID del formulario
                const id = formId.split('_')[1]; // Obtener el ID del formulario desde el ID del formulario

                // Capturar spinner y btns
                const loadingIndicator = $(`#loadingIndicatorEditProducto_${id}`);
                const submitButton = $(`#btn_editar_producto_${id}`);
                const cancelButton = $(`#btn_cancelar_producto_${id}`);

                // Desactivar btns
                submitButton.prop("disabled", true).html(
                    "Procesando... <i class='fa fa-spinner fa-spin'></i>");
                cancelButton.prop("disabled", true);
                loadingIndicator.show();
            });

            // ===========================================================
            // ===========================================================

            // Botón de submit de editar usuario
            $(document).on("submit", "form[id^='formCambiarEstadoProducto_']", function(e) {
                const form = $(this);
                const formId = form.attr('id'); // Obtenemos el ID del formulario
                const id = formId.split('_')[1]; // Obtener el ID del formulario desde el ID del formulario

                // Capturar spinner y btns dinámicamente
                const loadingIndicator = $(`#loadingIndicatorEstadoProducto_${id}`);
                const submitButton = $(`#btn_cambiar_estado_producto_${id}`);
                const cancelButton = $(`#btn_cancelar_estado_producto_${id}`);

                // Deshabilitar btns
                submitButton.prop("disabled", true).html(
                    "Procesando... <i class='fa fa-spinner fa-spin'></i>");
                cancelButton.prop("disabled", true);

                // Cargar spinner
                loadingIndicator.show();
            });

            // ===========================================================
            // ===========================================================

            // Botón de submit de editar usuario
            $(document).on("submit", "form[id^='formProductoBarcode_']", function(e) {
                const form = $(this);
                const formId = form.attr('id'); // Obtenemos el ID del formulario
                const id = formId.split('_')[1]; // Obtener el ID del formulario desde el ID del formulario

                // Capturar spinner y btns dinámicamente
                const loadingIndicator = $(`#loadingIndicatorCodeBarProducto_${id}`);
                const submitButton = $(`#btn_codebar_producto_${id}`);
                const cancelButton = $(`#btn_cancelar_codebar_${id}`);

                // Deshabilitar btns
                submitButton.prop("disabled", true).html(
                    "Procesando... <i class='fa fa-spinner fa-spin'></i>");
                cancelButton.prop("disabled", true);

                // Cargar spinner
                loadingIndicator.show();

                // ReadOnly para input de cantidad de barcodes a generar
                const cantidadBarcode = $(`#cantidad_barcode_${id}`).prop("readonly", true);
            });

            // ===========================================================
            // ===========================================================

            // Abre automáticamente el archivo con los códigos QR del producto recién solicitado
            let pdfUrl = "{{ session('pdfUrl') }}";
            if (pdfUrl) {
                window.open(pdfUrl, '_blank');
            }

            // ===========================================================
            // ===========================================================

            $(document).on('shown.bs.modal', '[id^="modalEditarProducto_"]', function() {
                // Buscar los elementos dentro de este modal
                let modal = $(this); // Guardamos la referencia del modal
                let inputPrecioUnitario = modal.find('[id^=precioUnitarioEdit]');
                let inputPrecioDetal = modal.find('[id^=precioDetalEdit]');
                let inputPrecioPorMayor = modal.find('[id^=precioPorMayorEdit]');

                if (inputPrecioUnitario.length > 0) { // Al cargar el modal
                    // Valido que el precio unitario sea menor que el precio al detal
                    inputPrecioDetal.on("blur", function() {
                        let precioUnitario = parseFloat(inputPrecioUnitario.val()) || 0;
                        let precioDetal = parseFloat(inputPrecioDetal.val()) || 0;

                        if (precioUnitario >= precioDetal) {
                            Swal.fire(
                                'Cuidado!',
                                'El precio unitario debe ser menor que el precio al detal!',
                                'warning'
                            )
                            inputPrecioDetal.val('');
                        }
                    });

                    // ===================================================

                    // Valido que el precio por mayor sea mayor que el unitario y menor que el precio al detal
                    inputPrecioPorMayor.blur(function() {
                        let precioUnitario = parseFloat(inputPrecioUnitario.val()) || 0;
                        let precioDetal = parseFloat(inputPrecioDetal.val()) || 0;
                        let precioPorMayor = parseFloat(inputPrecioPorMayor.val()) || 0;

                        if (precioPorMayor <= precioUnitario || precioPorMayor >= precioDetal) {
                            Swal.fire(
                                'Cuidado!',
                                'El precio al por mayor debe ser superior al precio unitario y menor que el precio al detal!',
                                'warning'
                            )
                            inputPrecioPorMayor.val('');
                        }
                    });
                } // FIN inputPrecioUnitario.length > 0
            }); // FIN '[id^="formEditarProducto_"]').on('shown.bs.modal'
        }); //FIN Document.ready
    </script>
@stop
