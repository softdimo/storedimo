@extends('layouts.app')
@section('title', 'Registrar Bajas')

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
                <h5 class="border rounded-top text-white text-center pt-2 pb-2 m-0" style="background-color: #337AB7">Registar Bajas</h5>

                <div class="d-flex flex-column flex-md-row justify-content-between p-3">
                    <div class="w-100-div w-48 mb-auto" style="border: solid 1px #337AB7; border-radius: 5px;">
                        <h5 class="border rounded-top text-white p-2" style="background-color: #337AB7">Información de la Baja</h5>

                        <div class="p-3 d-flex flex-column" id="form_bajas" style="height: 50%;">
                            <div>
                                <label for="tipo_baja" class="form-label">Tipo de Baja <span class="text-danger">*</span></label>
                                {{ Form::select('tipo_baja', collect(['' => 'Seleccionar...'])->union(['1'=>'Avería','2'=>'Hurto']), null, ['class' => 'form-control', 'id' => 'tipo_baja', 'required']) }}
                            </div>

                            <div class="mt-3">
                                <label for="producto" class="form-label">Producto <span class="text-danger">*</span></label>
                                {{ Form::select('producto', collect(['' => 'Seleccionar...'])->union(['1'=>'Jabón','2'=>'Toalla']), null, ['class' => 'form-control', 'id' => 'producto', 'required']) }}
                            </div>

                            <div class="mt-3">
                                <label for="cantidad" class="form-label">Cantidad <span class="text-danger">*</span></label>
                                {!! Form::text('cantidad', null, ['class' => 'form-control', 'id' => 'cantidad', 'required']) !!}
                            </div>

                            <div class="d-flex justify-content-end mt-3">
                                <button class="btn rounded-2 me-3 text-white" type="submit" style="background-color: #337AB7" id="btn_add_baja">
                                    <i class="fa fa-plus plus"></i>
                                    Agregar
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="w-100-div w-48 mt-5 mt-md-0" style="border: solid 1px #337AB7; border-radius: 5px;">
                        <h5 class="border rounded-top text-white p-2 m-0" style="background-color: #337AB7">Verificación</h5>

                        <div class="table-responsive p-3 d-flex flex-column justify-content-between h-100" style="">
                            <table class="table table-striped table-bordered w-100 mb-0" id="tbl_bajas" aria-describedby="categorias">
                                <thead>
                                    <tr class="header-table text-center">
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Tipo de Baja</th>
                                        <th>Opción</th>
                                    </tr>
                                </thead>
                                {{-- ============================== --}}
                                <tbody>
                                        <tr class="text-center"></tr>
                                </tbody>
                            </table>
                            {{-- ========================================== --}}
                            <div class="d-flex justify-content-end mb-5" style="">
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

            let idtipoBaja = $('#tipo_baja').val();
            let tipoBaja = $('#tipo_baja option:selected').text();
            let idProducto = $('#producto').val();
            let producto = $('#producto option:selected').text();
            let cantidad = $('#cantidad').val();

            console.log(idtipoBaja);
            console.log(tipoBaja);
            console.log(idProducto);
            console.log(producto);
            console.log(cantidad);

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


