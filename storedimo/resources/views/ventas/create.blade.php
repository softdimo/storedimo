@extends('layouts.app')
@section('title', 'Registrar Ventas')

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
                <a href="#" role="button" title="Ayuda" class="text-blue" data-bs-toggle="modal" data-bs-target="#modalAyudaRegistrarVentas">
                    <i class="fa fa-question-circle fa-2x" aria-hidden="false" title="Ayuda" style="color: #337AB7"></i>
                </a>
            </div>

            <div class="modal fade h-auto modal-gral p-3" id="modalAyudaRegistrarVentas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static" style="max-width: 55%;">
                <div class="modal-dialog m-0 mw-100">
                    <div class="modal-content border-0">
                        <div class="modal-body p-0 rounded-top" style="border: solid 1px #337AB7; mw-50">
                            <div class="row">
                                <div class="col-12">
                                    <div class="rounded-top text-white text-center p-2" style="background-color: #337AB7; border: solid 1px #337AB7;">
                                        <span class="modal-title fs-4"><strong>Ayuda de Ventas</strong></span>
                                    </div>
                                    {{-- =========================== --}}
                                    <div class="p-3">
                                        <p class="text-justify">Señor usuario para una mayor agilidad en el registro de la venta tener en cuenta lo siguiente:</p>
    
                                        <ol>
                                            <li class="text-justify">En el campo de producto se recomienda el uso de la pistola lectora de código de barras, para leer el código del producto para una asociación más ágil y rápida.</li>
                                            <li class="text-justify">Los campos marcados con asterisco (*) son obligatorios, por lo tanto sino se diligencian, el sistema no dejará seguir.</li>
                                            <li class="text-justify">Cliente que se asocie y sea frecuente tomará por defecto el precio al por mayor.</li>
                                            <li class="text-justify">Cliente que ya tenga un crédito registrado en el sistema, no se le dejará realizar otra Venta a crédito.</li>
                                            <li class="text-justify">El descuento ingresarlo en pesos.</li>
                                            <li class="text-justify">Para poder realizarle un descuento a un cliente, el total de la venta deberá superar el valor configurado por el administrador.</li>
                                            <li class="text-justify">Toda venta a crédito solo tendrá un límite de pago de los días calendario configurado por el administrador.</li>
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
                <h5 class="border rounded-top text-white text-center pt-2 pb-2 m-0" style="background-color: #337AB7">Registrar Ventas</h5>

                {!!Form::open(['method' => 'POST',
                    'route' => ['ventas.store'],
                    'class' => '', 'autocomplete' => 'off',
                    'id' => 'formRegistrarVenta'
                    ])!!}
                    @csrf

                    <div class="d-flex flex-column flex-md-row justify-content-between p-3">
                        <div class="w-100-div w-48 mb-auto" style="border: solid 1px #337AB7; border-radius: 5px;">
                            <h5 class="border rounded-top text-white p-2" style="background-color: #337AB7">Cliente <span class="text-danger">*</span></h5>
                            {{-- ============================================================== --}}
                            <div class="p-3 d-flex justify-content-between" id="" style="">
                                {{ Form::select('cliente_venta', collect(['' => 'Seleccionar...'])
                                    ->union(collect($clientes_ventas)->mapWithKeys(fn($cliente, $id) => [$id => $cliente['nombre']])),
                                    null, ['class' => 'form-select select2 ms-auto me-auto', 'id' => 'cliente_venta', 'required', 'style' => 'width: 85%;']) }}

                                {{ Form::hidden('id_tipo_persona', null, ['class' => '', 'id' => 'id_tipo_persona', 'required']) }}

                                <div class="d-flex justify-content-end" style="width:15%">
                                    <button type="button" class="btn rounded-2 text-white" style="background-color: #337AB7" title="Registrar Cliente" data-bs-toggle="modal" data-bs-target="#modal_registroCliente">
                                        <i class="fa fa-plus plus"></i>
                                    </button>
                                </div>
                            </div>
                            {{-- ============================================================== --}}
                            <h5 class="border rounded-top text-white p-2" style="background-color: #337AB7">Producto <span class="text-danger">*</span></h5>
                            {{-- ============================================================== --}}
                            <div class="p-3 d-flex justify-content-between" id="" style="">
                                <div class="d-flex justify-content-center w-100">
                                    {{ Form::select('producto_venta', collect(['' => 'Seleccionar...'])->union($productos), null, ['class' => 'form-select select2', 'id' => 'producto_venta']) }}
                                </div>
                            </div>
                            {{-- ============================================================== --}}
                            <div class="d-flex justify-content-center p-3">
                                <table class="table table-striped table-bordered w-100 mb-0" id="tbl_ventas" aria-describedby="ventas">
                                    <thead>
                                        <tr class="header-table text-center">
                                            <th>Precio Detal</th>
                                            <th>Precio por Mayor</th>
                                            <th>Aplicar Precio Al por Mayor</th>
                                        </tr>
                                    </thead>
                                    {{-- ============================== --}}
                                    <tbody>
                                            <tr class="text-center align-middle">
                                                <td>$ <span id="p_detal_venta"></span></td>
                                                <td>$ <span id="p_x_mayor_venta"></span></td>
                                                <td id="">
                                                    {{ Form::checkbox( 'aplicar_x_mayor_venta', null, ['class' => 'form-control', 'id' => 'aplicar_x_mayor_venta'] ) }}
                                                </td>
                                            </tr>
                                    </tbody>
                                </table>
                            </div>
                            {{-- ============ --}}
                            <div class="form-group p-3 id="cant">
                                <label for="cantidad_venta" class="fw-bold">Cantidad <span class="text-danger">*</span></label>
                                <div class="row align-items-center p-0 m-0">
                                    <div class="col-8 p-0 m-0">
                                        {!! Form::text('cantidad_venta', null, ['class' => 'form-control rounded-end-0', 'id' => 'cantidad_venta', 'min' => '1', 'maxlength' => '4']) !!}
                                    </div>
                                    
                                    <div class="col-4 m-0 p-0">
                                        <span class="form-control rounded-start-0 text-center" style="background-color: #EEEEEE">Unidades (<span id="cantidad_producto" class="text-success fw-bold"></span>)</span>
                                    </div>
                                </div>
                            </div>
                            {{-- ============ --}}
                            <div class="p-3 d-flex justify-content-end">
                                <button type="button" class="btn btn-primary active pull-right" id="btn_agregar_venta" title="Agregar">
                                    <i class="fa fa-plus plus"></i>
                                    Agregar
                                </button>
                            </div>
                        </div> {{-- FIN div_izquierdo registrar ventas (cliente, producto y add producto) --}}

                        {{-- ============================================================== --}}
                        {{-- ============================================================== --}}
                        {{-- ============================================================== --}}

                        <div class="w-100-div w-48 mt-5 mt-md-0">
                            <div class="m-0 p-0" style="border: solid 1px #337AB7; border-radius: 5px;">
                                <h5 class="border rounded-top text-white p-2 m-0" style="background-color: #337AB7">Detalle Venta</h5>
                            
                                <div class="">
                                    {{-- <strong class="p-3">Seleccione para agregar</strong> --}}
        
                                    {{-- <div class="row p-3 d-none" id="div_ventas_datos_producto"></div> --}}

                                    <div class="table-responsive p-3 d-flex flex-column justify-content-between h-100" style="">
                                        <table class="table table-striped table-bordered w-100 mb-0" id="tabla_detalle_venta" aria-describedby="ventas">
                                            <thead>
                                                <tr class="header-table text-center">
                                                    <th>Producto</th>
                                                    <th>Cantidad</th>
                                                    <th>subtotal</th>
                                                    <th>Opción</th>
                                                </tr>
                                            </thead>
                                            {{-- ============================== --}}
                                            <tbody>
                                                {{-- <tr class="text-center"></tr> --}}
                                            </tbody>
                                        </table>
                                    </div>
        
                                    <div class="" style="background-color: #F5F5F5; border-top: 1px solid #ddd;">
                                        <div class="d-flex" style="border: 1px solid #ddd;">
                                            <p class="p-1 m-0 fw-bold w-25">Subtotal: $</p>
                                            {!! Form::text('sub_total_venta', null, ['class' => 'form-control w-75 bg-success-subtle', 'id' => 'sub_total_venta', 'required', 'readonly']) !!}
                                        </div>

                                        <div class="d-flex mt-2 mb-2" style="border: 1px solid #ddd;">
                                            <p class="p-1 m-0 fw-bold w-25">Descuento: $</p>
                                            {!! Form::text('descuento_total_venta', null, ['class' => 'form-control w-75 bg-success-subtle', 'id' => 'descuento_total_venta', 'required', 'readonly']) !!}
                                        </div>

                                        <div class="d-flex" style="border: 1px solid #ddd;">
                                            <p class="p-1 m-0 fw-bold w-25">Total: $</p>
                                            {!! Form::text('total_venta', null, ['class' => 'form-control w-75 bg-success-subtle', 'id' => 'total_venta', 'required', 'readonly']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- ========================== --}}
                            <div class="mt-3 row m-0 p-2" style="border: solid 1px #337AB7; border-radius: 5px;">
                                <div class="col-12 col-md-6 d-flex flex-column">
                                    <div class="form-group">
                                        <label for="tipo_pago" class="fw-bold">Tipo de Pago
                                            <span class="text-danger">*</span>
                                        </label>

                                        {!! Form::select('tipo_pago', collect(['' => 'Seleccionar...'])->union($tipos_pago_ventas), null, ['class' => 'form-select select2', 'id' => 'tipo_pago', 'required']) !!}
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 d-flex flex-column d-none" id="div_plazo_credito">
                                    <label for="plazo_credito" class="fw-bold">Días Plazo Crédito<span class="text-danger">*</span></label>
                                    {!! Form::number('plazo_credito', null, ['class' => 'form-control', 'id' => 'plazo_credito', 'required']) !!}
                                </div>
                                
                                <div class="col-12 col-md-6 d-flex flex-column">
                                    <label for="descuento" class="fw-bold">Descuento en Pesos <span class="text-danger">*</span></label>
                                    {!! Form::number('descuento', null, ['class' => 'form-control', 'id' => 'descuento', 'required','min'=>'0','oninput' => 'validity.valid||(value=\'\');']) !!}
                                </div>
                            </div>

                            {{-- ====================================================== --}}
                            {{-- ====================================================== --}}

                            <!-- Contenedor para el GIF -->
                            <div id="loadingIndicatorRegistrarVenta"
                                class="loadingIndicator">
                                <img src="{{ asset('imagenes/loading.gif') }}" alt="Procesando...">
                            </div>

                            {{-- ====================================================== --}}
                            {{-- ====================================================== --}}

                            <div class="d-flex justify-content-end mt-4 p-3" style="">
                                <button type="submit" class="btn btn-success rounded-2 me-3" id="btn_registar_venta">
                                    <i class="fa fa-floppy-o"></i>
                                    Guardar
                                </button>
                            </div>
                        </div> {{-- FIN div_derecho (Detalle Venta) --}}
                    </div> {{-- FIN div_lateral derecho interno registrar ventas, cubre ambos --}}
                {!! Form::close() !!}
            </div> {{-- FIN div_registrar ventas (cubre ambos --}}
        </div> {{-- FIN div_contenido 80% --}}
    </div> {{-- FIN div_ppal (sidemarmenu y contenido derecho del 80%) --}}

    {{-- ==================================================================================== --}}
    {{-- ==================================================================================== --}}
    {{-- ==================================================================================== --}}
    {{-- ==================================================================================== --}}
    {{-- ==================================================================================== --}}

    {{-- INICIO MODAL REGISTRAR PRODUCTO --}}
    <div class="modal fade h-auto modal-gral p-0" id="modal_registroCliente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
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
                    'id' => 'formCrearProductoVenta',
                    'name' => 'crearProductoVenta'
                    ]) !!}
                    @csrf

                    <div class="modal-body pt-0">
                        <div class="rounded-top" style="background-color: #337AB7; border: solid 1px #337AB7;">
                            <h6 class="text-white p-2 m-0 text-center">Registrar Producto (Obligatorios *)</h6>
                        </div>

                        {{-- =================================== --}}

                        <div class="p-3" style="border: solid 1px #337AB7;" id="campos_producto">
                            <div class="row">
                                {!! Form::hidden('form_ventas', 'crearProductoVenta') !!}

                                
                                {{-- <div class="col-12 col-md-4">
                                    <label for="id_tipo_persona" class="fw-bold" style="font-size: 12px">Proveedor <span class="text-danger">*</span></label>
                                    {!! Form::select('id_tipo_persona', collect(['' => 'Seleccionar...'])->union($proveedores), null, ['class' => 'form-select', 'id' => 'id_tipo_persona']) !!}
                                </div> --}}
                        
                                <div class="col-12 col-md-4">
                                    <label for="nombre_producto" class="fw-bold" style="font-size: 12px">Nombre Producto <span class="text-danger">*</span>
                                    </label>
                                    {!! Form::text('nombre_producto', null, ['class' => 'form-control', 'id' => 'nombre_producto', 'required']) !!}
                                </div>

                                <div class="col-12 col-md-4">
                                    <label for="id_categoria" class="fw-bold" style="font-size: 12px">Categoría <span class="text-danger">*</span></label>
                                    {!! Form::select('id_categoria',collect(['' => 'Seleccionar...'])->union($categorias),null,['class' => 'form-select select2 select2-categoria', 'id' => 'id_categoria','required'=>'required']) !!}
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
                    <div id="loadingIndicatorCrearProductoVenta" class="loadingIndicator">
                        <img src="{{ asset('imagenes/loading.gif') }}" alt="Procesando...">
                    </div>

                    {{-- ====================================================== --}}
                    {{-- ====================================================== --}}

                    <div class="modal-footer border-0 d-flex justify-content-center mt-0">
                        <button type="submit" class="btn btn-success me-3"><i class="fa fa-floppy-o"> Guardar</i></button>

                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                            <i class="fa fa-remove"> Cancelar</i>
                        </button>
                    </div>
                {!! Form::close() !!}
          </div>
        </div>
    </div>
    {{-- FINAL MODAL REGISTRAR PRODUCTO --}}

    {{-- ==================================================================================== --}}
    {{-- ==================================================================================== --}}
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
    {{-- ==================================================================================== --}}
    {{-- ==================================================================================== --}}

    {{-- INICIO Modal Ayuda Modificar Precios --}}
    <div class="modal fade h-auto modal-gral p-0" id="mod_ayuda_precios" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
        <div class="modal-dialog m-0">
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
            $('.select2').select2({
                placeholder: "Seleccionar...",
                allowClear: false,
                width: '100%'
            });

            $(document).on('shown.bs.modal', '.modal', function() {
                $(this).find('.select2').select2({
                    dropdownParent: $(this),
                    placeholder: 'Seleccionar...',
                    width: '100%',
                    allowClear: false
                });
            });

            let idProducto = $('#producto_venta').val();
            console.log(idProducto);

            if (idProducto == '' ) {
                $('#p_detal_venta').html(0);
                $('#p_x_mayor_venta').html(0);
            }

            // INICIO - Consulta de los precios del productos
            $('#producto_venta').change(function () {
                let idProducto = $('#producto_venta').val();
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
                            $('#p_detal_venta').html(0);
                            $('#p_x_mayor_venta').html(0);
                            $('#cantidad_producto').html(0);
                        } else {
                            $('#p_detal_venta').html(respuesta.precio_detal);
                            $('#p_x_mayor_venta').html(respuesta.precio_por_mayor);
                            $('#cantidad_producto').html(respuesta.cantidad);
                        }
                    }
                });
            });
            // FIN - Consulta de los precios del productos

            // ===================================================================================
            // ===================================================================================

            // INICIO - Validar la cantidad ingresada vs la cantidad disponible para vender el producto
            $('#cantidad_venta').blur(function () {
                let idProducto = $('#cantidad_producto').val();

                let cantidadVenta = parseInt($('#cantidad_venta').val().trim()) || 0;
                let cantidadProducto = parseInt($('#cantidad_producto').text().trim()) || 0;

                if (cantidadVenta > cantidadProducto) {
                    Swal.fire('Cuidado!', 'No puedes vender más de la cantidad disponible.!', 'warning');
                    $('#cantidad_venta').val('');  // Limpiar cantidad a vender
                    return;
                }
            });
            // FIN - Validar la cantidad ingresada vs la cantidad disponible para vender el producto

            // ===================================================================================
            // ===================================================================================

            let aplicarXMayorVenta = $('#aplicar_x_mayor_venta').is(':checked');
            console.log(aplicarXMayorVenta);

            if (aplicarXMayorVenta == false) {
                aplicarXMayorVenta = $('input[name="aplicar_x_mayor_venta"]').removeAttr('checked');
            }

            var clientesInfo = @json($clientes_ventas);

            $('#cliente_venta').change(function () {
                let idCliVenta = $(this).val();  // Obtiene el ID de la persona seleccionada
                console.log("ID Cliente Venta:", idCliVenta);
                
                if (idCliVenta && clientesInfo[idCliVenta]) {
                    let tipoPersona = clientesInfo[idCliVenta].tipo; // Obtiene id_tipo_persona
                    console.log("Tipo Persona:", tipoPersona);
                    
                    $('#id_tipo_persona').val(tipoPersona);
                    console.log($('#id_tipo_persona').val(tipoPersona));
                    
                    if (tipoPersona == 5) {
                        $('input[name="aplicar_x_mayor_venta"]').prop('checked', true);
                    } else {
                        $('input[name="aplicar_x_mayor_venta"]').prop('checked', false);
                    }
                } else {
                    console.log("Cliente no encontrado en clientesInfo");
                    $('input[name="aplicar_x_mayor_venta"]').prop('checked', false);
                }
            });

            // ===================================================================================
            // ===================================================================================

            // INICIO - Función agregar datos de las ventas
            let productosAgregados = [];

            $("#btn_agregar_venta").click(function() {
                let idTipoClienteVenta = $('#cliente_venta').val();
                let clienteVenta = $('#cliente_venta option:selected').text();

                let idProductoVenta = $('#producto_venta').val();
                let productoVenta = $('#producto_venta option:selected').text();

                let pDetalVenta = parseFloat($('#p_detal_venta').text());
                let pxMayorVenta = parseFloat($('#p_x_mayor_venta').text());
                let cantidadVenta = parseInt($('#cantidad_venta').val());
                let aplicarMayor = $('input[name="aplicar_x_mayor_venta"]').is(':checked')

                // let idPersona = $('#id_tipo_persona').val(); // Captura el id_tipo_persona

                if (!idTipoClienteVenta || !idProductoVenta || !cantidadVenta || cantidadVenta <= 0) {
                    Swal.fire('Cuidado!', 'Todos los campos son obligatorios y la cantidad debe ser mayor a 0!', 'error');
                    return;
                }

                let valorSubTotal = aplicarMayor ? cantidadVenta * pxMayorVenta : cantidadVenta * pDetalVenta;

                if (aplicarMayor) {
                    pDetalVenta = '';
                } else {
                    pxMayorVenta = '';
                }
                
                let producto = {
                    idProductoVenta: idProductoVenta,
                    nombre: productoVenta,
                    cantidad: cantidadVenta,
                    pDetalVenta: pDetalVenta,
                    pxMayorVenta: pxMayorVenta,
                    subtotal: valorSubTotal,
                };
                productosAgregados.push(producto);

                actualizarDetalleVenta();

                // Limpia los campos después de agregar un producto exitosamente
                $('#cantidad_venta').attr('required');

                $('#producto_venta').val('').trigger('change'); // Reiniciar selección de producto

                $('#p_detal_venta').html(0);  // Resetear precio detal
                $('#p_x_mayor_venta').html(0);  // Resetear precio mayorista
                $('#aplicar_x_mayor_venta').prop('checked', false); // Desmarcar checkbox

                $('#cantidad_venta').val('');  // Limpiar cantidad
                $('#cantidad_producto').html(0);  // Limpiar cantidad disponible
            });
            // FIN - Función agregar datos de las ventas

            // ===================================================================================
            // ===================================================================================

            function actualizarDetalleVenta() {
                let detalleHTML = "";
                let totalVenta = 0;

                productosAgregados.forEach((producto, index) => {
                    detalleHTML += `
                        <tr id="row_${index}">
                            <td class="text-center">${producto.nombre}</td>
                            <td class="text-center">${producto.cantidad}</td>
                            <td class="text-center">$${producto.subtotal}</td>
                            <td class="text-center">
                                <button type="button" onclick="eliminarProducto(${index})" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash text-white"></i>
                                </button>
                            </td>

                            <input type="hidden" name="id_producto_venta[]" value="${producto.idProductoVenta}">
                            <input type="hidden" name="cantidad_venta[]" value="${producto.cantidad}">
                            <input type="hidden" name="p_detal_venta[]" value="${producto.pDetalVenta}">
                            <input type="hidden" name="p_mayor_venta[]" value="${producto.pxMayorVenta}">
                            <input type="hidden" name="subtotal_venta[]" value="${producto.subtotal}">
                        </tr>
                    `;

                    totalVenta += producto.subtotal;
                });

                $('#tabla_detalle_venta tbody').html(detalleHTML); // Asegúrate que tengas <tbody> en tu tabla
                $('#sub_total_venta').val(totalVenta);
                $('#total_venta').val(totalVenta);
            }

            // ===================================================================================
            // ===================================================================================

            window.eliminarProducto = function(index) {
                productosAgregados.splice(index, 1);
                actualizarDetalleVenta();
            };

            // ===================================================================================
            // ===================================================================================

            $('#tipo_pago').on('change', function () {

                let tipoPago = $('#tipo_pago').val();
                console.log(tipoPago);

                if (tipoPago == 2) {
                    $('#div_plazo_credito').removeClass('d-none');
                    $('#plazo_credito').attr('required');
                } else {
                    $('#div_plazo_credito').addClass('d-none');
                    $('#plazo_credito').removeAttr('required');
                }
            });

            // ===================================================================================
            // ===================================================================================

            // loadingIndicatorCrearProductoVenta para cargar gif en el submit
            $(document).on("submit", "form[id^='formCrearProductoVenta']", function(e) {
                const form = $(this);
                const submitButton = form.find('button[type="submit"]');
                const cancelButton = form.find('button[type="button"]');
                const loadingIndicator = form.find("div[id^='loadingIndicatorCrearProductoVenta']"); // Busca el GIF del form actual

                // Dessactivar Submit y Cancel
                submitButton.prop("disabled", true).html("Procesando... <i class='fa fa-spinner fa-spin'></i>");
                cancelButton.prop("disabled", true);

                // Cargar Spinner
                loadingIndicator.show();
            });

            // ===================================================================================
            // ===================================================================================

            // loadingIndicatorRegistrarVenta para cargar gif en el submit
            $(document).on("submit", "form[id^='formRegistrarVenta']", function(e) {
                const form = $(this);
                const submitButton = form.find('button[type="submit"]');
                const loadingIndicator = form.find("div[id^='loadingIndicatorRegistrarVenta']"); // Busca el GIF del form actual

                // Retirar required en el submit
                $('#btn_registar_venta').removeAttr('required');

                // Dessactivar Submit y Cancel
                submitButton.prop("disabled", true).html("Procesando... <i class='fa fa-spinner fa-spin'></i>");

                // Cargar Spinner
                loadingIndicator.show();
            });

            // ===================================================================================
            // ===================================================================================
        }); // FIN Document Ready
    </script>
@stop
