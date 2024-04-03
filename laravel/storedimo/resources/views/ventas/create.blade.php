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
                <a href="#" class="text-blue">
                    <i class="fa fa-question-circle fa-2x" aria-hidden="false" title="Ayuda" style="color: #337AB7"></i>
                </a>
            </div>

            {{-- =============================================================== --}}
            {{-- =============================================================== --}}

            <div class="p-0" style="border: solid 1px #337AB7; border-radius: 5px;">
                <h5 class="border rounded-top text-white text-center pt-2 pb-2 m-0" style="background-color: #337AB7">Registrar Ventas</h5>

                <div class="d-flex flex-column flex-md-row justify-content-between p-3">
                    <div class="w-100-div w-48 mb-auto" style="border: solid 1px #337AB7; border-radius: 5px;">
                        <h5 class="border rounded-top text-white p-2" style="background-color: #337AB7">Cliente <span class="text-danger">*</span></h5>
                        {{-- ============================================================== --}}
                        <div class="p-3 d-flex justify-content-between" id="" style="">
                            {!! Form::text('cliente', null, ['class' => 'form-control w-75 ms-auto me-auto', 'id' => 'cliente', 'required', 'placeholder' => 'select cliente']) !!}

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
                                {!! Form::text('producto', null, ['class' => 'form-control', 'id' => 'producto', 'required', 'placeholder' => 'select Producto']) !!}
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
                                            <td>$ 2.500</td>
                                            <td>$ 2.100</td>
                                            <td>
                                                {!! Form::checkbox('aplicar_por_mayor', null, ['class' => 'form-control', 'id' => 'aplicar_por_mayor', 'required']) !!}
                                            </td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                        {{-- ============ --}}
                        <div class="form-group p-3 id="cant">
                            <label for="cantidad" class="fw-bold">Cantidad <span class="text-danger">*</span></label>
                            <div class="row align-items-center p-0 m-0">
                                <div class="col-8 p-0 m-0">
                                    {!! Form::text('cantidad', null, ['class' => 'form-control rounded-end-0', 'id' => 'cantidad', 'required', 'min' => '1', 'maxlength' => '4']) !!}
                                </div>
                                
                                <div class="col-4 m-0 p-0">
                                    <span class="form-control rounded-start-0 text-center" style="background-color: #EEEEEE">Unidades (19)</span>
                                </div>
                            </div>
                        </div>
                        {{-- ============ --}}
                        <div class="p-3 d-flex justify-content-end">
                            <button type="button" tabindex="6" onclick="agregarProducto()" class="btn btn-primary active pull-right" id="btn-Agregar" title="Agregar">
                                <i class="fa fa-plus plus"></i>
                                Agregar
                            </button>
                        </div>
                    </div>
                    {{-- ============================================================== --}}
                    <div class="w-100-div w-48 mt-5 mt-md-0" style="border: solid 1px #337AB7; border-radius: 5px;">
                        <h5 class="border rounded-top text-white p-2 m-0" style="background-color: #337AB7">Detalle Entrada</h5>
                        
                        <div class="">
                            <strong class="p-3">Seleccione para agregar</strong>

                            <div class="row p-3">
                                <div class="col-12 col-md-9">
                                    <h3>2 jabón de baño frotex</h3>
                                    <p>Cantidad:  <span>5</span></p>
                                    <p>Valor subtotal: <span>$ 10.000</span></p>
                                </div>
                                {{-- ========================== --}}
                                <div class="col-12 col-md-3">
                                    <button type="button" class="btn btn-danger rounded-circle btn-circle" title="Eliminar">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="" style="background-color: #F5F5F5">
                                <h3>Total: <span>$ 10.000</span></h3>
                            </div>

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
    <div class="modal fade" id="modal_registroCliente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
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

        // INICIO - Función para agregar fila x fila cada producto para dar de baja
        $("#btn_add_baja").click(function() {

            let tipoBaja = $('#tipo_baja').val();
            let producto = $('#producto').val();
            let cantidad = $('#cantidad').val();

            if (tipoBaja == '' || producto == '' || cantidad == '' ) {
                Swal.fire(
                    'Cuidado!',
                    'Todos los campos son obligatorios!',
                    'error'
                );
            } else {
                let fila = '';
                var indiceSiguienteFila = $('#tbl_bajas tr').length;

                console.log(indiceSiguienteFila);

                fila +=
                    '<tr class="" name="'+indiceSiguienteFila+'">'+
                        '<td class="text-center">'+producto+'</td>'+

                        '<td class="text-center">'+cantidad+'</td>'+

                        '<td class="text-center">'+tipoBaja+'</td>'+
                        
                        '<td class="text-center">'+
                            '<button type="button" class="btn btn-danger rounded-circle btn-circle" title="Eliminar" onclick="delBaja('+indiceSiguienteFila+')">'+
                                '<i class="fa fa-trash" aria-hidden="true"></i>'+
                            '</button>'+
                        '</td>'+
                    '</tr>';

                $('#tbl_bajas').append(fila);

                $('#tipo_baja').val('');
                $('#producto').val('');
                $('#cantidad').val('');
            }
        });
        // FIN - Función para agregar fila x fila cada producto para dar de baja

        // ===================================================================================
        // ===================================================================================

        function delBaja(idBaja) {
            // alert(`Id de la Baja ${idBaja}`);
            $('#tbl_bajas tr[name="'+idBaja+'"]').remove();
            // $('tr[name="' + idBaja + '"]').remove();
        }
    </script>
@stop


