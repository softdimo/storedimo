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
                        {!! Form::text('proveedor', null, ['class' => 'form-control mt-4 mb-4 w-75 ms-auto me-auto', 'id' => 'proveedor', 'required', 'placeholder' => 'select Proveedor']) !!}
                        {{-- ============================================================== --}}
                        <h5 class="border rounded-top text-white p-2" style="background-color: #337AB7">Producto <span class="text-danger">*</span></h5>
                        {{-- ============================================================== --}}
                        <div class="p-3 d-flex justify-content-between" id="" style="">
                            <div class="d-flex justify-content-center w-75">
                                {!! Form::text('producto', null, ['class' => 'form-control', 'id' => 'producto', 'required', 'placeholder' => 'select Producto']) !!}
                            </div>

                            <div class="d-flex justify-content-end w-25">
                                <button class="btn rounded-2 text-white" type="submit" style="background-color: #337AB7" id="btn_add_pro">
                                    <i class="fa fa-plus plus"></i>
                                </button>
                            </div>
                        </div>
                        {{-- ============================================================== --}}
                        <div class="row p-3">
                            <div class="col-md-3 text-center">
                                <strong for="form-control fw-bold">Precio Unitario</strong>
                                <p id="precio">0</p>
                            </div>
                            {{-- ============ --}}
                            <div class="col-md-3 text-center">
                                <strong for="form-control fw-bold">Precio al Detal</strong>
                                <p id="precio2">0</p>
                            </div>
                            {{-- ============ --}}
                            <div class="col-md-3 text-center">
                                <strong for="form-control fw-bold">Precio por Mayor</strong>
                                <p id="precio3">0</p>
                            </div>
                            {{-- ============ --}}
                            <div class="col-md-3 text-center">
                                <button type="button" tabindex="4" onclick="preciosProducto()"
                                    class="btn btn-success btn-circle btn-md" data-toggle="modal" data-target="#modal-modificarPrecios" title="Modificar">
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
    </div>ç

    {{-- ==================================================================================== --}}
    {{-- ==================================================================================== --}}
    {{-- ==================================================================================== --}}
    {{-- ==================================================================================== --}}
    {{-- ==================================================================================== --}}

    {{-- INICIO MODAL REGISTRAR PRODUCTO --}}


    <div class="modal fade" id="modal_registroProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <button type="button" class="btn btn-primary btn-circle btn-md" data-toggle="modal" data-target="#mod_ayuda_registroProducto" onclick="modalAyuda()">
                        <i class="fa fa-question" aria-hidden="true" title="Ayuda"></i>
                    </button>

                    <div class="modal-header">
                        <div class="row">
                            <div class="col-12">
                                <div class="panel panel-primary">
                                    <div class="panel-heading" stlyle="height: 70px; width: 100px">
                                        <span id="myModalLabel" style="text-align:center; color: #fff; font-size: 18px"></span>
                                        <strong>Registrar Producto (Obligatorios *)</strong>
                                    </div> {{-- FIN panel-heading --}}

                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="txtnombreProd">Nombre Producto <span class="obligatorio">*</span></label>
                                                <input type="text" name="txtnombreProd" onkeypress="return soloLetras()" style="width: 100%" class="form-control" id="nombreProd" pattern="[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ@\-\.\\ \/$]+" maxlength="50" class="form-control"  placeholder="Nombre Producto" data-parsley-required="true">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="txtCategoria">Categoría <span class="obligatorio">*</span></label>
                                                <select name="txtCategoria" class="form-control" id="categoria" style="width: 100%" pattern="[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ0-9!@#\$%\-\.\?_~\\ \\()\/$]+" maxlength="20" data-parsley-required="true">
                                                    <option value="">Seleccionar</option>
                                                        <option value=""></option>
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="txtPrecioUnitario">Precio Unitario <span class="obligatorio">*</span></label>
                                                <input type="text" name="txtPrecioUnitario" onkeypress="return soloNumeros(event)" maxlenght="8" style="width: 100%"class="form-control" id="precioUnitario" data-parsley-type="integer" min="0" max="100000" step="10" class="form-control" placeholder="Precio Unitario" data-parsley-required="true">
                                            </div>
                                        </div> {{-- FIN row nombre producto, categoría, precios --}}

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="txtPrecioDetal">Precio Detal <span class="obligatorio">*</span></label>
                                                <input type="text" maxlenght="8" onkeypress="return soloNumeros()" name="txtPrecioDetal" class="form-control" style="width: 100%" id="precioDetal" data-parsley-type="integer" min="0" step="10" max="100000" placeholder="Precio Detal" data-parsley-required="true">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="txtPorMayor">Precio Por Mayor <span class="obligatorio">*</span></label>
                                                <input type="text" maxlenght="8" onkeypress="return soloNumeros()" name="txtPorMayor"  class="form-control" id="precioMayor" data-parsley-type="integer" min="0" step="10" max="100000" placeholder="Precio por Mayor" data-parsley-required="true">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="txtStock">Stock Mínimo <span class="obligatorio">*</span></label>
                                                <input type="text" maxlenght="8" onkeypress="return soloNumeros(event)" name="txtStock" class="form-control" id="stock" data-parsley-type="number" min="1" type="number"  max="50" placeholder="Stock Mínimo" data-parsley-required="true">
                                            </div>
                                        </div> {{-- FIN row precio detal, precio x mayor, stock mínimo --}}
                                        <hr>
                                    </div> {{-- FIN modal-body --}}

                                    <div class="row">
                                        <div class="col-md-6 col-xs-6 col-lg-7">
                                            <button type="submit" name="btnguardarProducto" id="btn-guardar" onclick="ValidarNombreProducto()" class="btn btn-success active pull-right" title="Guardar"><i class="fa fa-floppy-o" aria-hidden="true">  Guardar</i></button>
                                        </div>
                                        <div class="col-md-6 col-xs-6 col-lg-3">
                                            <button type="button" class="btn btn-danger active" onclick="cancelarRegistroProducto()" title="Cancelar"><i class="fa fa-remove" aria-hidden="true">  Cancelar</i></button>
                                        </div>
                                    </div> {{-- FIN row btns guardar y cancelar --}}
                                </div> {{-- FIN panel panel-primary --}}
                            </div> {{-- FIN col-12 --}}
                        </div> {{-- FIN row --}}
                    </div> {{-- FIN modal-header --}}
                </div> {{-- FIN modal-body --}}
            </div> {{-- FIN modal-content --}}
        </div> {{-- FIN  modal-dialog --}}
    </div> {{-- FIN modal_registroProducto --}}
    {{-- FINAL MODAL REGISTRAR PRODUCTO --}}
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


