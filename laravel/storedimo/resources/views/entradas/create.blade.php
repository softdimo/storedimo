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
                <a href="#" class="text-blue">
                    <i class="fa fa-question-circle fa-2x" aria-hidden="false" title="Ayuda" style="color: #337AB7"></i>
                </a>
            </div>

            {{-- =============================================================== --}}
            {{-- =============================================================== --}}

            <div class="p-0" style="border: solid 1px #337AB7; border-radius: 5px;">
                <h5 class="border rounded-top text-white text-center pt-2 pb-2 m-0" style="background-color: #337AB7">Registrar Entradas</h5>

                <div class="d-flex flex-column flex-md-row justify-content-between p-3">
                    <div class="w-100-div w-48 mb-auto" style="border: solid 1px #337AB7; border-radius: 5px;">
                        <h5 class="border rounded-top text-white p-2" style="background-color: #337AB7">Proveedor <span class="text-danger">*</span></h5>
                        {{-- ============================================================== --}}
                        {{ Form::select('proveedor', collect(['' => 'Seleccionar...'])->union(['1' => 'Anónimo','2' => 'Proveedor-Natural']), null, ['class' => 'form-control mt-4 mb-4 w-75 ms-auto me-auto', 'id' => 'proveedor']) }}
                        {{-- ============================================================== --}}
                        <h5 class="border rounded-top text-white p-2" style="background-color: #337AB7">Producto <span class="text-danger">*</span></h5>
                        {{-- ============================================================== --}}
                        <div class="p-3 d-flex justify-content-between" id="" style="">
                            <div class="d-flex justify-content-center w-75">
                                {{ Form::select('producto', collect(['' => 'Seleccionar...'])->union(['1' => 'Jabón','2' => 'Toalla']), null, ['class' => 'form-control', 'id' => 'producto']) }}
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
                                <button type="button" title="Modificar" data-bs-toggle="modal" data-bs-target="#modal_modificarPrecios" onclick="preciosProducto()"
                                    class="btn btn-success btn-circle">
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

                            <div class="d-none" id="div_datos_producto">
                                <div class="row p-3">
                                    <div class="col-12 col-md-9">
                                        <h3 class="" id="nombre_producto"></h3>
                                        <p class="">Cantidad: <span id="cantidad_producto"></span></p>
                                        <p class="">Valor subtotal: $ <span id="valor_subTotal"></span></p>
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

                            <div class="" style="background-color: #F5F5F5">
                                <h3>Total: $<span id="valor_total"></span></h3>
                            </div>

                            {{-- ============ --}}

                            <div class="d-flex justify-content-end mb-5 p-3" style="">
                                <button class="btn btn-success rounded-2 me-3" type="submit">
                                    <i class="fa fa-floppy-o"></i>
                                    Guardar
                                </button>
                    
                                <button class="btn btn-danger rounded-2" type="submit">
                                    <i class="fa fa-remove"></i>
                                    Cancelar
                                </button>
                            </div>
                        </div>
                    </div> {{-- FIN div_campos_usuarios --}}
                </div>
            </div> {{-- FIN div_crear_usuario --}}
        </div>
    </div>

    {{-- ==================================================================================== --}}
    {{-- ==================================================================================== --}}
    {{-- ==================================================================================== --}}
    {{-- ==================================================================================== --}}
    {{-- ==================================================================================== --}}

    {{-- INICIO MODAL REGISTRAR PRODUCTO --}}
    <div class="modal fade" id="modal_registroProducto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header justify-content-between border-0">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mod_ayuda_registroProducto" title="Ayuda Registrar producto">
                        <i class="fa fa-question" aria-hidden="true" title="Ayuda"></i>
                    </button>
                    
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                {{-- ====================================================== --}}
                {{-- ====================================================== --}}

                <div class="modal-body ">
                    <div class="rounded-top" style="background-color: #337AB7; border: solid 1px #337AB7;">
                        <h6 class="text-white p-2 m-0 text-center">Registrar Producto (Obligatorios *)</h6>
                    </div>

                    {{-- =================================== --}}

                    <div class="p-3" style="border: solid 1px #337AB7;" id="campos_producto">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <label for="nombre_producto" class="fw-bold" style="font-size: 12px">Nombre Producto <span class="text-danger">*</span></label>
                                {!! Form::text('nombre_producto', null, ['class' => 'form-control', 'id' => 'nombre_producto', 'required']) !!}
                            </div>

                            <div class="col-12 col-md-4">
                                <label for="categoria" class="fw-bold" style="font-size: 12px">Categoría <span class="text-danger">*</span></label>
                                <select name="categoria" class="form-control" id="categoria" >
                                    <option value="">Seleccionar</option>
                                    <option value="">Hoga</option>
                                    <option value="">Papelería</option>
                                    <option value="">Aseo</option>
                                </select>
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

                <div class="modal-footer border-0 justify-content-center">
                    <div class="">
                        <button type="button" class="btn btn-success" title="Guardar" onclick="ValidarNombreProducto()"  ><i class="fa fa-floppy-o" aria-hidden="true">  Guardar</i></button>
                    </div>
                    <div class="">
                        <button type="button" class="btn btn-danger" title="Cancelar" data-bs-dismiss="modal" ><i class="fa fa-remove" aria-hidden="true">  Cancelar</i></button>
                    </div>
                </div>
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
    <div class="modal fade" id="mod_ayuda_registroProducto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
        <div class="modal-dialog">
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

    {{-- INICIO Modal Modificar Precios --}}
    <div class="modal fade" id="modal_modificarPrecios" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header justify-content-between border-0">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mod_ayuda_precios" title="Ayuda Modificar Precios">
                        <i class="fa fa-question" aria-hidden="true" title="Ayuda"></i>
                    </button>
                    
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                {{-- ====================================================== --}}
                {{-- ====================================================== --}}

                <div class="modal-body">
                    <div class="rounded-top" style="background-color: #337AB7; border: solid 1px #337AB7;">
                        <h6 class="text-white p-2 m-0 text-center">Modificar Precios (Obligatorios *)</h6>
                    </div>

                    {{-- =================================== --}}

                    <div class="p-3" style="border: solid 1px #337AB7;" id="precios">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <label for="precio_unitario" class="fw-bold" style="font-size: 12px">Precio Unitario <span class="text-danger">*</span></label>
                                {!! Form::text('precio_unitario', null, ['class' => 'form-control', 'id' => 'precio_unitario', 'required']) !!}
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="precio_detal" class="fw-bold" style="font-size: 12px">Precio Detal <span class="text-danger">*</span></label>
                                {!! Form::text('precio_detal', null, ['class' => 'form-control', 'id' => 'precio_detal', 'required']) !!}
                            </div>

                            <div class="col-12 col-md-6 mt-3">
                                <label for="precio_por_mayor" class="fw-bold" style="font-size: 12px">Precio al por Mayor <span class="text-danger">*</span></label>
                                {!! Form::text('precio_por_mayor', null, ['class' => 'form-control', 'id' => 'precio_por_mayor', 'required']) !!}
                            </div>
                        </div>
                    </div> {{-- FIN campos precios --}}

                    {{-- ====================================================== --}}
                    {{-- ====================================================== --}}

                    <div class="modal-footer border-0 justify-content-center">
                        <div class="">
                            <button type="button" class="btn btn-success" title="Guardar" onclick="ValidarNombreProducto()"><i class="fa fa-floppy-o" aria-hidden="true"> Modificar</i></button>
                        </div>

                        <div class="">
                            <button type="button" class="btn btn-danger" title="Cancelar" data-bs-dismiss="modal" ><i class="fa fa-remove" aria-hidden="true">  Cancelar</i></button>
                        </div>
                    </div>
                </div> {{-- FIN modal-body --}}
            </div> {{-- FIN modal-content --}}
        </div> {{-- FIN modal-dialog --}}
    </div> {{-- FINAL MODAL Modificar Precios --}}
    
    {{-- ==================================================================================== --}}
    {{-- ==================================================================================== --}}
    {{-- ==================================================================================== --}}
    {{-- ==================================================================================== --}}
    {{-- ==================================================================================== --}}

    {{-- INICIO Modal Ayuda Modificar Precios --}}
    <div class="modal fade" id="mod_ayuda_precios" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
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

            // ================================================

        });

        // ===================================================================================
        // ===================================================================================

        // INICIO - Función agregar datos de la entrada
        $("#btn_add_entrada").click(function() {

            let idProveedor = $('#proveedor').val();
            let proveedor = $('#proveedor option:selected').text();
            let idProducto = $('#producto').val();
            let producto = $('#producto option:selected').text();
            let pUnitario = $('#p_unitario').text();
            let cantidad = $('#cantidad').val();

            console.log(`Id proveedor ${idProveedor}`);
            console.log(`nombre proveedor ${proveedor}`);
            console.log(`Id Producto ${idProducto}`);
            console.log(`nombre Producto ${producto}`);
            console.log(`Precio Unitario ${pUnitario}`);
            console.log(`Cantidad ${cantidad}`);

            if (idProveedor == '' || idProducto == '' || cantidad == '' ) {
                Swal.fire(
                    'Cuidado!',
                    'Todos los campos son obligatorios!',
                    'error'
                );
            } else {
                $('#div_datos_producto').removeClass('d-none');

                $('#nombre_producto').html(producto);

                $('#cantidad_producto').html(cantidad);

                let valor_subTotal = pUnitario * cantidad;

                $('#valor_subTotal').html(valor_subTotal);

                let valor_total = pUnitario * cantidad;

                $('#valor_total').html(valor_total);
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
            
            $('#valor_total').html('');

            $('#div_datos_producto').addClass('d-none');

            $('#proveedor').val('');
            // $('#proveedor option:selected').text();
            $('#producto').val('');
            // $('#producto option:selected').text();
            // $('#p_unitario').html('');
            $('#cantidad').val('');
        })

    </script>
@stop


