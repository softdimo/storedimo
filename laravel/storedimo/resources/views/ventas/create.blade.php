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

                <div class="d-flex flex-column flex-md-row justify-content-between p-3">
                    <div class="w-100-div w-48 mb-auto" style="border: solid 1px #337AB7; border-radius: 5px;">
                        <h5 class="border rounded-top text-white p-2" style="background-color: #337AB7">Cliente <span class="text-danger">*</span></h5>
                        {{-- ============================================================== --}}
                        <div class="p-3 d-flex justify-content-between" id="" style="">
                            {{ Form::select('cliente_venta', collect(['' => 'Seleccionar...'])->union($clientes), null, ['class' => 'form-select w-75 ms-auto me-auto', 'id' => 'cliente_venta', 'required']) }}

                            <div class="w-25 d-flex justify-content-end">
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
                                {{ Form::select('producto_venta', collect(['' => 'Seleccionar...'])->union($productos), null, ['class' => 'form-select', 'id' => 'producto_venta']) }}
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
                                            <td>$ <span id="p_detal_venta">2500</span></td>
                                            <td>$ <span id="p_x_mayor_venta">2100</span></td>
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
                                    {!! Form::text('cantidad_venta', null, ['class' => 'form-control rounded-end-0', 'id' => 'cantidad_venta', 'required', 'min' => '1', 'maxlength' => '4']) !!}
                                </div>
                                
                                <div class="col-4 m-0 p-0">
                                    <span class="form-control rounded-start-0 text-center" style="background-color: #EEEEEE">Unidades (19)</span>
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
                                <strong class="p-3">Seleccione para agregar</strong>
    
                                <div class="row p-3 d-none" id="div_ventas_datos_producto">
                                    <div class="col-12 col-md-9">
                                        <h3 id="nombre_producto_venta"></h3>
                                        <p>Cantidad: <span id="cantidad_producto_venta"></span></p>
                                        <p>Valor subtotal: $<span id="valor_subTotal_venta"></span></p>
                                    </div>
                                    {{-- ========================== --}}
                                    <div class="col-12 col-md-3">
                                        <button type="button" class="btn btn-danger rounded-circle btn-circle" title="Eliminar Venta" id="btn_del_venta">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
    
                                <div class="" style="background-color: #F5F5F5; border-top: 1px solid #ddd;">
                                    <p class="p-1 m-0 fw-bold" style="border-bottom: 1px solid #ddd;">Subtotal: $<span class="fw-normal" id="sub_total_venta"></span></p>
                                    <p class="p-1 m-0 fw-bold" style="border-bottom: 1px solid #ddd;">Descuento: $<span class="fw-normal" id="descuento_total_venta"></span></p>
                                    <p class="p-1 m-0 fw-bold">Total: $<span class="fw-normal" id="total_venta"></span></p>
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

                                    {!! Form::select('tipo_pago', collect(['' => 'Seleccionar...'])->union($tipos_pago_ventas), null, ['class' => 'form-select', 'id' => 'tipo_pago', 'required']) !!}
                                </div>
                            </div>

                            <div class="col-12 col-md-6 d-flex flex-column d-none" id="div_plazo_credito">
                                <label for="plazo_credito" class="fw-bold">Días Plazo Crédito<span class="text-danger">*</span></label>
                                {!! Form::number('plazo_credito', null, ['class' => 'form-control', 'id' => 'plazo_credito', 'required']) !!}
                            </div>
                            
                            <div class="col-12 col-md-6 d-flex flex-column">
                                <label for="descuento" class="fw-bold">Descuento en Pesos <span class="text-danger">*</span></label>
                                {!! Form::number('tipo_pago', null, ['class' => 'form-control', 'id' => 'descuento', 'required']) !!}
                            </div>
                        </div>
                        {{-- ========================== --}}
                        <div class="d-flex justify-content-end mt-4 p-3" style="">
                            <button class="btn btn-success rounded-2 me-3" type="submit">
                                <i class="fa fa-floppy-o"></i>
                                Guardar
                            </button>
                
                            <button class="btn btn-danger rounded-2" type="submit">
                                <i class="fa fa-remove"></i>
                                Cancelar
                            </button>
                        </div>
                    </div> {{-- FIN div_derecho (Detalle Entrada) --}}
                </div> {{-- FIN div_lateral derecho interno registrar ventas, cubre ambos --}}
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

                                <div class="col-12 col-md-4">
                                    <label for="nombre_producto" class="fw-bold" style="font-size: 12px">Nombre Producto <span class="text-danger">*</span>
                                    </label>
                                    {!! Form::text('nombre_producto', null, ['class' => 'form-control', 'id' => 'nombre_producto', 'required']) !!}
                                </div>

                                <div class="col-12 col-md-4">
                                    <label for="id_categoria" class="fw-bold" style="font-size: 12px">Categoría <span class="text-danger">*</span></label>
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
                    <div id="loadingIndicatorCrearProductoVenta" class="loadingIndicator">
                        <img src="{{ asset('imagenes/loading.gif') }}" alt="Procesando...">
                    </div>

                    {{-- ====================================================== --}}
                    {{-- ====================================================== --}}

                    <div class="modal-footer border-0 justify-content-center">
                        <div class="">
                            <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"> Guardar</i></button>
                        </div>
                        <div class="">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                <i class="fa fa-remove" aria-hidden="true"> Cancelar</i>
                            </button>
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
            // INICIO - Validación Formulario Creación de Bajas de productos
            // form_bajas = $("#form_bajas");

            // form_bajas.validate({
            //     rules:{
            //         tipo_baja:{
            //             required:true
            //         },
            //         producto:{
            //             required:true
            //         },
            //         cantidad:{
            //             required:false
            //         },
            //     },
            //     errorPlacement: function(error, element) {
            //     if ( element.hasClass('datapicker') ){
            //             error.appendTo( element.closest("div.form-group") );
            //         }else{
            //             error.appendTo( element.parent() );
            //         }
            //     }
            // });
            // FIN - Validación Formulario Creación de Bajas de productos

            // ===================================================================================
            // ===================================================================================

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
                        } else {
                            $('#p_detal_venta').html(respuesta.precio_detal);
                            $('#p_x_mayor_venta').html(respuesta.precio_por_mayor);
                        }
                    }
                });
            });
            // FIN - Consulta de los precios del productos

            // ===================================================================================
            // ===================================================================================

            let aplicarXMayorVenta = $('#aplicar_x_mayor_venta').is(':checked');
            console.log(aplicarXMayorVenta);

            if (aplicarXMayorVenta == false) {
                aplicarXMayorVenta = $('input[name="aplicar_x_mayor_venta"]').removeAttr('checked');
            }

            $('#cliente_venta').change(function () {
                let idCliVenta = $('#cliente_venta').val();

                if (idCliVenta == 5) {
                    $('input[name="aplicar_x_mayor_venta"]').attr('checked', 'checked');
                    
                }
                else {
                    $('input[name="aplicar_x_mayor_venta"]').removeAttr('checked');
                }
            });

            // ===================================================================================
            // ===================================================================================
            
            // INICIO - Función agregar datos de las ventas
            $("#btn_agregar_venta").click(function() {

                let idClienteVenta = $('#cliente_venta').val();
                let clienteVenta = $('#cliente_venta option:selected').text();

                let idProductoVenta = $('#producto_venta').val();
                let productoVenta = $('#producto_venta option:selected').text();

                let pDetalVenta = $('#p_detal_venta').text();
                let pxMayorVenta = $('#p_x_mayor_venta').text();
                let cantidadVenta = $('#cantidad_venta').val();

                // =========================================

                // console.log(`Id Cliente Venta ${idClienteVenta}`);
                // console.log(`nombre Cliente Venta ${clienteVenta}`);

                // console.log(`Id Producto Venta ${idProductoVenta}`);
                // console.log(`nombre Producto Venta ${productoVenta}`);

                // console.log(`Precio Detal Venta ${pDetalVenta}`);
                // console.log(`PRecio mayor de Venta ${pxMayorVenta}`);
                // console.log(`Aplica precio al por mayor ${aplicarXMayorVenta}`);

                // console.log(`Cantidad Venta ${cantidadVenta}`);

                // =========================================

                if (idClienteVenta == '' || idProductoVenta == '' || cantidadVenta == '' ) {
                    Swal.fire(
                        'Cuidado!',
                        'Todos los campos son obligatorios!',
                        'error'
                    );
                } else {
                    $('#div_ventas_datos_producto').removeClass('d-none');

                    $('#nombre_producto_venta').html(productoVenta);

                    $('#cantidad_producto_venta').html(cantidadVenta);

                    if ($('input[name="aplicar_x_mayor_venta"]').not(':checked')) {
                        let valorSubTotal = cantidadVenta * pDetalVenta;

                        $('#valor_subTotal_venta').html(valorSubTotal);
                        $('#sub_total_venta').html(valorSubTotal);
                        $('#total_venta').html(valorSubTotal);
                    }
                    
                    if ($('input[name="aplicar_x_mayor_venta"]').is(':checked')) {
                        let valorSubTotal = cantidadVenta * pxMayorVenta

                        $('#valor_subTotal_venta').html(valorSubTotal);
                        $('#sub_total_venta').html(valorSubTotal);
                        $('#total_venta').html(valorSubTotal);
                    }
                }
            }); // FIN - Función agregar datos de las ventas

            // ===================================================================================
            // ===================================================================================

            $('#btn_del_venta').on('click', function () {
                alert(`Eliminar Venta`);

                $('#cliente_venta').val('');
                $('#producto_venta').val('');
                $('#cantidad_venta').val('');

                $('#nombre_producto_venta').val('');
                $('#cantidad_producto_venta').val('');
                $('#valor_subTotal_venta').val('');

                $('#sub_total_venta').val('');
                $('#descuento_total_venta').val('');
                $('#total_venta').val('');

                $('#div_ventas_datos_producto').addClass('d-none');
            });

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

            

        }); // FIN Document Ready

        // ===================================================================================
        // ===================================================================================



        // ===================================================================================
        // ===================================================================================

    </script>
@stop


