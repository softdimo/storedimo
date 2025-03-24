@extends('layouts.app')
@section('title', 'Registrar Entradas')

{{-- =============================================================== --}}
{{-- =============================================================== --}}
{{-- =============================================================== --}}

@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('css/custom.css') }}"> --}}
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

        <div class="p-3" style="width: 80%">
            <div class="text-end">
                <a href="#" role="button" title="Ayuda" class="text-blue" data-bs-toggle="modal" data-bs-target="#modalAyudaRegistrarEntradas">
                    <i class="fa fa-question-circle fa-2x" aria-hidden="false" title="Ayuda" style="color: #337AB7"></i>
                </a>
            </div>

            <div class="modal fade h-auto modal-gral p-3" id="modalAyudaRegistrarEntradas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static" style="max-width: 55%;">
                <div class="modal-dialog m-0 mw-100">
                    <div class="modal-content border-0">
                        <div class="modal-body p-0 rounded-top" style="border: solid 1px #337AB7; mw-50">
                            <div class="row">
                                <div class="col-12">
                                    <div class="rounded-top text-white text-center p-2" style="background-color: #337AB7; border: solid 1px #337AB7;">
                                        <span class="modal-title fs-4"><strong>Ayuda de Entradas</strong></span>
                                    </div>
                                    {{-- =========================== --}}
                                    <div class="p-3">
                                        <p class="text-justify">Señor usuario para una mayor agilidad en el registro tener en cuenta lo siguiente:</p>
    
                                        <ol>
                                            <li class="text-justify">En el campo de producto se recomienda el uso de la pistola lectora de código de barras, para leer el código del producto para una asociación más ágil y rápida.</li>
                                            <li class="text-justify">Los campos marcados con asterisco (*) son obligatorios, por lo tanto sino se diligencian, el sistema no dejará seguir.</li>
                                        </ol>
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
                <h5 class="border rounded-top text-white text-center pt-2 pb-2 m-0" style="background-color: #337AB7">Registrar Entradas</h5>

                {!!Form::open(['method' => 'POST',
                'route' => ['entradas.store'],
                'class' => '', 'autocomplete' => 'off',
                'id' => 'formRegistrarCompra'
                ])!!}
                    @csrf

                    <div class="d-flex flex-column flex-md-row justify-content-between p-3">
                        <div class="w-100-div w-48 mb-auto" style="border: solid 1px #337AB7; border-radius: 5px;">
                            <h5 class="border rounded-top text-white p-2" style="background-color: #337AB7">Proveedor <span class="text-danger">*</span></h5>
                            {{-- ============================================================== --}}
                            {{ Form::select('id_tipo_proveedor', collect(['' => 'Seleccionar...'])->union($proveedores_compras), null, ['class' => 'form-select mt-4 mb-4', 'id' => 'id_tipo_proveedor', 'style'=>'width:90%; margin:auto']) }}

                            {{ Form::hidden('id_persona', null, ['class' => '', 'id' => 'id_persona', 'required']) }}
                            {{-- ============================================================== --}}

                            <h5 class="border rounded-top text-white p-2" style="background-color: #337AB7">Producto <span class="text-danger">*</span></h5>
                            {{-- ============================================================== --}}
                            <div class="p-3 d-flex justify-content-between" id="" style="">
                                <div class="d-flex justify-content-center w-75">
                                    {{ Form::select('id_producto', collect(['' => 'Seleccionar...'])->union($productos), null, ['class' => 'form-select', 'id' => 'id_producto']) }}
                                </div>

                                <div class="d-flex justify-content-end w-25">
                                    <button type="button" class="btn rounded-2 text-white" style="background-color: #337AB7" title="Registrar producto" data-bs-toggle="modal" data-bs-target="#modal_registroProducto">
                                        <i class="fa fa-plus plus"></i>
                                    </button>
                                </div>
                            </div>
                            {{-- ============================================================== --}}
                            <div class="row p-3">
                                <div class="col-md-3 text-center">
                                    <strong for="form-control fw-bold">Precio Unitario</strong>
                                    <p id="precio">$ <span class="" id="p_unitario">2000</span></p>
                                </div>
                                {{-- ============ --}}
                                <div class="col-md-3 text-center">
                                    <strong for="form-control fw-bold">Precio al Detal</strong>
                                    <p id="precio2">$ <span class="" id="p_detal">2500</span></p>
                                </div>
                                {{-- ============ --}}
                                <div class="col-md-3 text-center">
                                    <strong for="form-control fw-bold">Precio por Mayor</strong>
                                    <p id="precio3">$ <span class="" id="p_x_mayor">2100</span></p>
                                </div>
                                {{-- ============ --}}
                                <div class="col-md-3 text-center">
                                    <button type="button" title="Modificar" data-bs-toggle="modal" data-bs-target="#modalModificarPrecios" class="btn btn-success btn-circle">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true" title="Modificar"></i>
                                    </button>
                                </div>
                            </div>
                            {{-- ============ --}}
                            <div class="form-group p-3" id="cant">
                                <label for="">Cantidad <span class="text-danger">*</span></label>
                                
                                {!! Form::number('cantidad', null, ['class' => 'form-control', 'id' => 'cantidad', 'required', 'min' => '1', 'maxlength' => '4']) !!}
                            </div>
                            {{-- ============ --}}
                            <div class="p-3 d-flex justify-content-end">
                                <button type="button" class="btn btn-primary" id="btn_add_entrada" title="Agregar Entrada">
                                    <i class="fa fa-plus plus"></i>Agregar
                                </button>
                            </div>
                        </div>
                        {{-- ============================================================== --}}
                        <div class="w-100-div w-48 mt-5 mt-md-0" style="border: solid 1px #337AB7; border-radius: 5px;">
                            <h5 class="border rounded-top text-white p-2 m-0" style="background-color: #337AB7">Detalle Entrada</h5>
                            
                            <div class="">
                                <strong class="p-3">Seleccione para agregar</strong>

                                {{-- ============ --}}

                                <div class="d-none" id="div_compra_datos_producto">
                                    <div class="row p-3">
                                        <div class="col-12 col-md-9">
                                            <h3 class="" id="nombre_producto"></h3>
                                            <p class="">Cantidad: <span id="cantidad_producto"> </span></p>
                                            <p class="">Valor subtotal: $ <span id="valor_subTotal"> </span></p>
                                        </div>
                                        {{-- ========================== --}}
                                        <div class="col-12 col-md-3">
                                            <button type="button" class="btn btn-danger rounded-circle btn-circle" title="Eliminar" id="btn_del_entrada">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                {{-- ============ --}}

                                {!! Form::open([
                                    'method' => 'POST',
                                    'route' => ['entradas.store'],
                                    'class' => 'mt-0',
                                    'autocomplete' => 'off',
                                    'id' => 'formCrearCompraEntrada',
                                    'name' => 'crearCompraEntrada'
                                    ]) !!}
                                    @csrf

                                    {!! Form::hidden('form_compra_entradas', 'crearCompraEntrada') !!} {{-- id del gormulario origen --}}
                                    {!! Form::hidden('id_tipo_proveedor',null, ['id' => 'id_tipo_proveedor', 'required']) !!}
                                    {!! Form::hidden('id_producto_compra',null, ['id' => 'id_producto_compra', 'required']) !!}

                                    <div class="d-flex" style="background-color: #F5F5F5">
                                        <h3 class="col-3 d-flex align-middle">Total: $</h3>
                                        {!! Form::text('valor_compra', null, ['class' => 'form-control w-100 fs-4', 'id' => 'valor_compra', 'required']) !!}
                                    </div>

                                    {{-- ============ --}}
                                    
                                    <!-- Contenedor para el GIF -->
                                    <div id="loadingIndicatorCrearEntrada" class="loadingIndicator">
                                        <img src="{{ asset('imagenes/loading.gif') }}" alt="Procesando...">
                                    </div>

                                    {{-- ============ --}}

                                    <div class="d-flex justify-content-end mb-5 p-3" style="">
                                        <button type="submit" class="btn btn-success rounded-2 me-3">
                                            <i class="fa fa-floppy-o"></i>
                                            Guardar
                                        </button>
                            
                                        {{-- <button type="button" class="btn btn-danger rounded-2">
                                            <i class="fa fa-remove"></i>
                                            Cancelar
                                        </button> --}}
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div> {{-- FIN div_detalle-entradas --}}
                    </div>
                {!! Form::close() !!}
            </div> {{-- FIN div_crear_usuario --}}
        </div>
    </div>

    {{-- ==================================================================================== --}}
    {{-- ==================================================================================== --}}
    {{-- ==================================================================================== --}}
    {{-- ==================================================================================== --}}
    {{-- ==================================================================================== --}}

    {{-- INICIO MODAL REGISTRAR PRODUCTO --}}
    <div class="modal fade h-auto modal-gral p-0" id="modal_registroProducto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
        <div class="modal-dialog m-0">
            <div class="modal-content">
                <div class="modal-header justify-content-between border-0 pb-1">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mod_ayuda_registroProducto" title="Ayuda Registrar producto">
                        <i class="fa fa-question" aria-hidden="true" title="Ayuda"></i>
                    </button>
                    
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                {{-- ====================================================== --}}
                {{-- ====================================================== --}}

                {!! Form::open([
                    'method' => 'POST',
                    'route' => ['productos.store'],
                    'class' => 'mt-2',
                    'autocomplete' => 'off',
                    'id' => 'formCrearProductoEntrada',
                    'name' => 'crearProductoEntrada'
                    ]) !!}
                    @csrf

                    <div class="modal-body pt-0">
                        <div class="rounded-top" style="background-color: #337AB7; border: solid 1px #337AB7;">
                            <h6 class="text-white p-2 m-0 text-center">Registrar Producto (Obligatorios *)</h6>
                        </div>

                        {{-- =================================== --}}

                        <div class="p-3" style="border: solid 1px #337AB7;" id="campos_producto">
                            <div class="row">
                                {!! Form::hidden('form_entradas', 'crearProductoEntrada') !!}

                                {{-- <div class="col-12 col-md-4">
                                    <label for="id_tipo_persona" class="fw-bold" style="font-size: 12px">Proveedor <span class="text-danger">*</span></label>
                                    {!! Form::select('id_tipo_persona', collect(['' => 'Seleccionar...'])->union($proveedores), null, ['class' => 'form-select', 'id' => 'id_tipo_persona']) !!}
                                </div> --}}

                                <div class="col-12 col-md-4">
                                    <label for="nombre_producto" class="fw-bold" style="font-size: 12px">Nombre Producto <span class="text-danger">*</span></label>
                                    {!! Form::text('nombre_producto', null, ['class' => 'form-control', 'id' => 'nombre_producto', 'required']) !!}
                                </div>

                                <div class="col-12 col-md-4">
                                    <label for="categoria" class="fw-bold" style="font-size: 12px">Categoría <span class="text-danger">*</span></label>
                                    {!! Form::select('id_categoria',collect(['' => 'Seleccionar...'])->union($categorias),null,['class' => 'form-select', 'id' => 'id_categoria','required'=>'required']) !!}
                                </div>

                                <div class="col-12 col-md-4">
                                    <label for="precio_unitario" class="fw-bold" style="font-size: 12px">Precio Unitario <span class="text-danger">*</span></label>
                                    {!! Form::text('precio_unitario', null, ['class' => 'form-control', 'id' => 'precio_unitario', 'required']) !!}
                                </div>

                                <div class="col-12 col-md-4 mt-3">
                                    <label for="precio_detal" class="fw-bold" style="font-size: 12px">Precio Detal <span class="text-danger">*</span></label>
                                    {!! Form::text('precio_detal', null, ['class' => 'form-control', 'id' => 'precio_detal', 'required']) !!}
                                </div>

                                <div class="col-12 col-md-4 mt-3">
                                    <label for="precio_por_mayor" class="fw-bold" style="font-size: 12px">Precio Por Mayor<span class="text-danger">*</span></label>
                                    {!! Form::text('precio_por_mayor', null, ['class' => 'form-control', 'id' => 'precio_por_mayor', 'required']) !!}
                                </div>

                                <div class="col-12 col-md-4 mt-3">
                                    <label for="stock_minimo" class="fw-bold" style="font-size: 12px">Stock Mínimo <span class="text-danger">*</span></label>
                                    {!! Form::text('stock_minimo', null, ['class' => 'form-control', 'id' => 'stock_minimo', 'required']) !!}
                                </div>
                            </div> {{-- FIN row nombre producto, categoría, precio unitario, precio detal, precio x mayor, stock mínimo --}}
                        </div> {{-- FIN campos_producto --}}
                    </div> {{-- FIN modal-body --}}

                    {{-- ====================================================== --}}
                    {{-- ====================================================== --}}
                    
                    <!-- Contenedor para el GIF -->
                    <div id="loadingIndicatorCrearProducto" class="loadingIndicator">
                        <img src="{{ asset('imagenes/loading.gif') }}" alt="Procesando...">
                    </div>

                    {{-- ====================================================== --}}
                    {{-- ====================================================== --}}

                    <div class="modal-footer border-0 justify-content-center">
                        <div class="">
                            <button type="submit" class="btn btn-success" name="crearProductoEntrada"><i class="fa fa-floppy-o" aria-hidden="true"> Guardar</i></button>
                        </div>
                        <div class="">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" ><i class="fa fa-remove" aria-hidden="true"> Cancelar</i></button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    {{-- FINAL MODAL REGISTRAR PRODUCTO --}}

    {{-- ==================================================================================== --}}
    {{-- ==================================================================================== --}}
    {{-- ==================================================================================== --}}

    {{-- INICIO Modal Ayuda de Registrar Productos --}}
    <div class="modal fade h-auto modal-gral p-0" id="mod_ayuda_registroProducto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
        <div class="modal-dialog m-0">
            <div class="modal-content">
                <div class="modal-header d-none"></div>

                {{-- ====================================================== --}}
                {{-- ====================================================== --}}

                <div class="modal-body ">
                    <div class="rounded-top" style="background-color: #337AB7; border: solid 1px #337AB7;">
                        <h6 class="text-white p-2 m-0 text-center">Ayuda de Registrar Productos</h6>
                    </div>

                    {{-- =================================== --}}

                    <div class="p-3" style="border: solid 1px #337AB7;" id="campos_producto">
                        <div class="row">
                            <div class="col-12">
                                <p class="">Señor usuario a la hora de realizar un registro de un producto tener en cuenta las siguientes recomendaciones:</p>

                                <ol>
                                    <li>Los campos marcados con asterisco (*) son obligatorios, por o tanto sino se llenan el sistema no le dejará seguir.</li>
                                    <li>Evitar ingresar nombres de productos ya existentes.</li>
                                    <li>El precio unitario no puede ser mayor al precio al detal y precio al por mayor.</li>
                                    <li>El precio al detal no puede ser menor al precio al por mayor.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ====================================================== --}}
                {{-- ====================================================== --}}

                <div class="modal-footer border-0 justify-content-end">
                    <button type="button" class="btn text-white" style="background-color:#204d74" data-bs-dismiss="modal"><i class="fa fa-check-circle" aria-hidden="true"> Aceptar</i></button>
                </div>
            </div>
        </div>
    </div>
    {{-- FINAL MODAL Ayuda de Registrar Productos --}}
    
    {{-- ==================================================================================== --}}
    {{-- ==================================================================================== --}}
    {{-- ==================================================================================== --}}

    {{-- INICIO Modal Modificar Precios --}}
    <div class="modal fade h-auto modal-gral p-0" id="modalModificarPrecios" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
        <div class="modal-dialog m-0">
            <div class="modal-content">
                <div class="modal-header justify-content-between border-0 pb-1">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mod_ayuda_precios" title="Ayuda Modificar Precios">
                        <i class="fa fa-question" aria-hidden="true" title="Ayuda"></i>
                    </button>
                    
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                {{-- ====================================================== --}}
                {{-- ====================================================== --}}

                <div class="modal-body pt-0">
                    <div class="rounded-top" style="background-color: #337AB7; border: solid 1px #337AB7;">
                        <h6 class="text-white p-2 m-0 text-center">Modificar Precios (Obligatorios *)</h6>
                    </div>

                    {{-- =================================== --}}

                    {!! Form::open([
                        'method' => 'POST',
                        'route' => ['producto_update'],
                        'class' => 'mt-0',
                        'autocomplete' => 'off',
                        'id' => 'formEditarProductoEntrada',
                        'name' => 'crearProductoEntrada'
                        ]) !!}
                        @csrf

                        {!! Form::hidden('idProductoEdit', null, ['class' => 'form-control', 'id' => 'idProductoEdit', 'required']) !!}

                        {!! Form::hidden('form_editar_precios_entradas', 'formEditarPreciosEntradas') !!}

                        <div class="p-3" style="border: solid 1px #337AB7;" id="precios">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <label for="precioUnitarioEdit" class="fw-bold" style="font-size: 12px">Precio Unitario <span class="text-danger">*</span></label>
                                    {!! Form::text('precioUnitarioEdit', null, ['class' => 'form-control', 'id' => 'precioUnitarioEdit', 'required']) !!}
                                </div>

                                <div class="col-12 col-md-6">
                                    <label for="precioDetalEdit" class="fw-bold" style="font-size: 12px">Precio Detal <span class="text-danger">*</span></label>
                                    {!! Form::text('precioDetalEdit', null, ['class' => 'form-control', 'id' => 'precioDetalEdit', 'required']) !!}
                                </div>

                                <div class="col-12 col-md-6 mt-3">
                                    <label for="precioPorMayorEdit" class="fw-bold" style="font-size: 12px">Precio al por Mayor <span class="text-danger">*</span></label>
                                    {!! Form::text('precioPorMayorEdit', null, ['class' => 'form-control', 'id' => 'precioPorMayorEdit', 'required']) !!}
                                </div>
                            </div>
                        </div> {{-- FIN campos precios --}}

                        {{-- ====================================================== --}}
                        {{-- ====================================================== --}}
                        
                        <!-- Contenedor para el GIF -->
                        <div id="loadingIndicatorEditarProducto" class="loadingIndicator">
                            <img src="{{ asset('imagenes/loading.gif') }}" alt="Procesando...">
                        </div>

                        {{-- ====================================================== --}}
                        {{-- ====================================================== --}}

                        <div class="modal-footer border-0 justify-content-center">
                            <div class="">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-floppy-o" aria-hidden="true"> Modificar</i>
                                </button>
                            </div>

                            <div class="">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                    <i class="fa fa-remove" aria-hidden="true">  Cancelar</i>
                                </button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div> {{-- FIN modal-body --}}
            </div> {{-- FIN modal-content --}}
        </div> {{-- FIN modal-dialog --}}
    </div> {{-- FINAL MODAL Modificar Precios --}}
    
    {{-- ==================================================================================== --}}
    {{-- ==================================================================================== --}}
    {{-- ==================================================================================== --}}

    {{-- INICIO Modal Ayuda Modificar Precios --}}
    <div class="modal fade h-auto modal-gral p-0" id="mod_ayuda_precios" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-none"></div>

                {{-- ====================================================== --}}
                {{-- ====================================================== --}}

                <div class="modal-body ">
                    <div class="rounded-top" style="background-color: #337AB7; border: solid 1px #337AB7;">
                        <h6 class="text-white p-2 m-0 text-center">Ayuda Modificación Precios</h6>
                    </div>

                    {{-- =================================== --}}

                    <div class="p-3" style="border: solid 1px #337AB7;" id="campos_producto">
                        <div class="row">
                            <div class="col-12">
                                <p class="">Tener en cuenta para la modificación de los precios lo siguiente:</p>

                                <ol>
                                    <li>El precio unitario no puede ser mayor precio al detal y precio al por mayor.</li>
                                    <li>El precio al por mayor no puede ser menor al precio unitario, y tampoco mayor al precio al detal.</li>
                                    <li>El precio al detal debe ser mayor al precio al por mayor y al precio unitario.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ====================================================== --}}
                {{-- ====================================================== --}}

                <div class="modal-footer border-0 justify-content-end">
                    <button type="button" class="btn text-white" style="background-color:#204d74" data-bs-dismiss="modal"><i class="fa fa-check-circle" aria-hidden="true"> Aceptar</i></button>
                </div>
            </div>
        </div>
    </div>
    {{-- FINAL MODAL Ayuda Modificar Precios --}}
@stop

{{-- =============================================================== --}}
{{-- =============================================================== --}}
{{-- =============================================================== --}}

@section('scripts')
    <script>
        $( document ).ready(function() {
            let idProducto = $('#id_producto').val();
            console.log(idProducto);

            if (idProducto == '' ) {
                $('#p_unitario').html(0);
                $('#p_detal').html(0);
                $('#p_x_mayor').html(0);
            }

            // INICIO - Validación Formulario Creación de Bajas de productos
            $('#id_producto').change(function () {
                let idProducto = $('#id_producto').val();
                console.log(idProducto);

                $.ajax({
                    async: true,
                    url: "{{route('query_valores_producto')}}",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'id_producto': idProducto
                    },
                    success: function (respuesta) {
                        console.log(respuesta);
                        console.log(respuesta.precio_unitario);

                        if (idProducto == '' ) {
                            $('#p_unitario').html(0);
                            $('#p_detal').html(0);
                            $('#p_x_mayor').html(0);
                        } else {
                            $('#p_unitario').html(respuesta.precio_unitario);
                            $('#p_detal').html(respuesta.precio_detal);
                            $('#p_x_mayor').html(respuesta.precio_por_mayor);

                            $('#idProductoEdit').val(respuesta.id_producto);
                            $('#precioUnitarioEdit').val(respuesta.precio_unitario);
                            $('#precioDetalEdit').val(respuesta.precio_detal);
                            $('#precioPorMayorEdit').val(respuesta.precio_por_mayor);

                            $('#id_producto_compra').val(respuesta.id_producto);
                        }
                    }
                });
            });
            // FIN - Validación Formulario Creación de Bajas de productos

            // ================================================

            // Modal modal_registroProducto (Store)
            $(document).on('shown.bs.modal', '[id^="modal_registroProducto"]', function () {
                // Buscar los elementos dentro de este modal
                let modal = $(this); // Guardamos la referencia del modal
                let inputPrecioUnitario = modal.find('[id^=precio_unitario]');
                let inputPrecioDetal = modal.find('[id^=precio_detal]');
                let inputPrecioPorMayor = modal.find('[id^=precio_por_mayor]');

                if (inputPrecioUnitario.length > 0) { // Al cargar el modal
                    // Valido que el precio unitario sea menor que el precio al detal
                    inputPrecioDetal.on("blur", function () {
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
                    inputPrecioPorMayor.blur(function () {
                        let precioUnitario = parseFloat(inputPrecioUnitario.val()) || 0;
                        let precioDetal = parseFloat(inputPrecioDetal.val()) || 0;
                        let precioPorMayor = parseFloat(inputPrecioPorMayor.val()) || 0;

                        if ( precioPorMayor <= precioUnitario || precioPorMayor >= precioDetal) {
                            Swal.fire(
                                'Cuidado!',
                                'El precio al por mayor debe ser superior al precio unitario y menor que el precio al detal!',
                                'warning'
                            )
                            inputPrecioPorMayor.val('');
                        }
                    });
                } // FIN inputPrecioUnitario.length > 0
            }); // FIN '[id^="modal_registroProducto"]').on('shown.bs.modal'
            
            // ================================================

            // Modal modalModificarPrecios (Update)
            $(document).on('shown.bs.modal', '[id^="modalModificarPrecios"]', function () {
                // Buscar los elementos dentro de este modal
                let modal = $(this); // Guardamos la referencia del modal
                let inputPrecioUnitarioEdit = modal.find('[id^=precioUnitarioEdit]');
                let inputPrecioDetalEdit = modal.find('[id^=precioDetalEdit]');
                let inputPrecioPorMayorEdit = modal.find('[id^=precioPorMayorEdit]');

                if (inputPrecioUnitarioEdit.length > 0) { // Al cargar el modal
                    // Valido que el precio unitario sea menor que el precio al detal
                    inputPrecioDetalEdit.on("blur", function () {
                        let precioUnitario = parseFloat(inputPrecioUnitarioEdit.val()) || 0;
                        let precioDetal = parseFloat(inputPrecioDetalEdit.val()) || 0;

                        if (precioUnitario >= precioDetal) {
                            Swal.fire(
                                'Cuidado!',
                                'El precio unitario debe ser menor que el precio al detal!',
                                'warning'
                            )
                            inputPrecioDetalEdit.val('');
                        }
                    });

                    // ===================================================

                    // Valido que el precio por mayor sea mayor que el unitario y menor que el precio al detal
                    inputPrecioPorMayorEdit.blur(function () {
                        let precioUnitario = parseFloat(inputPrecioUnitarioEdit.val()) || 0;
                        let precioDetal = parseFloat(inputPrecioDetalEdit.val()) || 0;
                        let precioPorMayor = parseFloat(inputPrecioPorMayorEdit.val()) || 0;

                        if ( precioPorMayor <= precioUnitario || precioPorMayor >= precioDetal) {
                            Swal.fire(
                                'Cuidado!',
                                'El precio al por mayor debe ser superior al precio unitario y menor que el precio al detal!',
                                'warning'
                            )
                            inputPrecioPorMayorEdit.val('');
                        }
                    });
                } // FIN inputPrecioUnitario.length > 0
            }); // FIN '[id^="modalModificarPrecios"]').on('shown.bs.modal'

            // ===================================================================================
            // ===================================================================================

            // INICIO - Función agregar datos de la entrada
            $("#btn_add_entrada").click(function() {
                let idTipoProveedor = $('#id_tipo_proveedor').val();
                let tipoProveedor = $('#id_tipo_proveedor option:selected').text();

                let idProducto = $('#id_producto').val();
                let producto = $('#id_producto option:selected').text();

                let pUnitario = $('#p_unitario').text();
                let cantidad = $('#cantidad').val();

                console.log(`Id proveedor ${idTipoProveedor}`);
                console.log(`nombre proveedor ${tipoProveedor}`);
                console.log(`Id Producto ${idProducto}`);
                console.log(`nombre Producto ${producto}`);
                console.log(`Precio Unitario ${pUnitario}`);
                console.log(`Cantidad ${cantidad}`);

                if (!idTipoProveedor || !idProducto || !cantidad) {
                    Swal.fire(
                        'Cuidado!',
                        'Todos los campos son obligatorios!',
                        'error'
                    );
                } else {
                    $('#div_compra_datos_producto').removeClass('d-none');

                    $('#nombre_producto').html(producto);

                    $('#cantidad_producto').html(cantidad);

                    let valor_subTotal = pUnitario * cantidad;

                    $('#valor_subTotal').html(valor_subTotal);

                    let valor_compra = pUnitario * cantidad;

                    $('#valor_compra').val(valor_compra);

                    $('#id_tipo_proveedor').val(idTipoProveedor);
                }
            });
            // FIN - Función agregar datos de la entrada

            // ===================================================================================
            // ===================================================================================

            function delEntrada() {
                // $('#tbl_bajas tr[name="'+idBaja+'"]').remove();
                // $('tr[name="' + idBaja + '"]').remove();
            }

            $('#btn_del_entrada').on('click', function name(params) {
                // alert(`eliminar entrada`);
                
                $('#nombre_producto').html('');
                
                $('#cantidad_producto').html('');
                
                $('#valor_subTotal').html('');
                
                $('#valor_compra').val('');
                // $('#valor_compra').html('');

                $('#div_compra_datos_producto').addClass('d-none');

                $('#id_tipo_proveedor').val('');
                // $('#id_tipo_proveedor option:selected').text();
                $('#id_producto').val('');
                // $('#producto option:selected').text();
                // $('#p_unitario').html('');
                $('#cantidad').val('');
            })
            
            // ===================================================================================
            // ===================================================================================

            // formCrearProducto para cargar gif en el submit
            $(document).on("submit", "form[id^='formCrearProducto']", function(e) {
                const form = $(this);
                const submitButton = form.find('button[type="submit"]');
                const cancelButton = form.find('button[type="button"]');
                const loadingIndicator = form.find("div[id^='loadingIndicatorCrearProducto']"); // Busca el GIF del form actual

                // Dessactivar Submit y Cancel
                submitButton.prop("disabled", true).html("Procesando... <i class='fa fa-spinner fa-spin'></i>");
                cancelButton.prop("disabled", true);

                // Mostrar Spinner
                loadingIndicator.show();
            });
        
            // ===================================================================================
            // ===================================================================================
            
            // formEditarProductoEntrada para cargar gif en el submit
            $(document).on("submit", "form[id^='formEditarProductoEntrada']", function(e) {
                const form = $(this);
                const submitButton = form.find('button[type="submit"]');
                const cancelButton = form.find('button[type="button"]');
                const loadingIndicator = form.find("div[id^='loadingIndicatorEditarProducto']"); // Busca el GIF del form actual

                // Dessactivar Submit y Cancel
                submitButton.prop("disabled", true).html("Procesando... <i class='fa fa-spinner fa-spin'></i>");
                cancelButton.prop("disabled", true);

                // Mostrar Spinner
                loadingIndicator.show();
            });
            
            // ===================================================================================
            // ===================================================================================
            
            // formCrearProducto para cargar gif en el submit
            $(document).on("submit", "form[id^='formCrearCompraEntrada']", function(e) {
                const form = $(this);
                const submitButton = form.find('button[type="submit"]');
                const cancelButton = form.find('button[type="button"]');
                const loadingIndicator = form.find("div[id^='loadingIndicatorCrearEntrada']"); // Busca el GIF del form actual

                // Dessactivar Submit y Cancel
                submitButton.prop("disabled", true).html("Procesando... <i class='fa fa-spinner fa-spin'></i>");
                cancelButton.prop("disabled", true);

                // Mostrar Spinner
                loadingIndicator.show();
            });
            
            // ===================================================================================
            // ===================================================================================


        }); // FIN document.ready
    </script>
@stop


