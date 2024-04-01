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

                        <div class="p-3 d-flex flex-column" style="height: 50%;">
                            <div>
                                <label for="tipo_baja" class="form-label">Tipo de Baja <span class="text-danger">*</span></label>
                                {!! Form::text('tipo_baja', null, ['class' => 'form-control', 'id' => 'tipo_baja']) !!}
                            </div>

                            <div class="mt-3">
                                <label for="producto" class="form-label">Producto <span class="text-danger">*</span></label>
                                {!! Form::text('producto', null, ['class' => 'form-control', 'id' => 'producto']) !!}
                            </div>

                            <div class="mt-3">
                                <label for="cantidad" class="form-label">Cantidad <span class="text-danger">*</span></label>
                                {!! Form::text('cantidad', null, ['class' => 'form-control', 'id' => 'cantidad']) !!}
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
                                        <tr class="text-center">
                                            <td>2 jabón de baño frotex</td>
                                            <td>1</td>
                                            <td>Hurto</td>
                                            <td>
                                                <a href="#" role="button" class="btn btn-danger rounded-circle btn-circle" title="Eliminar">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
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
            // $("#username").trigger('focus');
        });

        // ===================================================================================
        // ===================================================================================

        // INICIO - Función para agregar fila x fila cada producto para dar de baja
        $("#btn_add_baja").click(function() {

            let tipoBaja = $('#tipo_baja').val();
            let producto = $('#producto').val();
            let cantidad = $('#cantidad').val();

            console.log(tipoBaja);
            console.log(producto);
            console.log(cantidad);
           
            let fila = '';
            var indiceSiguienteFila = $('#tbl_bajas tr').length;

            console.log(indiceSiguienteFila);

            fila +=
                '<tr class="" name="'+indiceSiguienteFila+'">'+
                    '<td class="text-center">'+producto+'</td>'+

                    '<td class="text-center">'+cantidad+'</td>'+

                    '<td class="text-center">'+tipoBaja+'</td>'+
                    
                    '<td class="text-center">'+cantidad+'</td>'+

                    // '<td class="text-center">'+
                    //     <a href="#" role="button" class="btn btn-danger rounded-circle btn-circle" title="Eliminar">+
                    //         <i class="fa fa-trash" aria-hidden="true"></i>+
                    //     </a>+
                    // '</td>'+
                '</tr>';

            $('#tbl_bajas').append(fila);

            // window.$('.datapicker').daterangepicker(optionsDatePicker).on('apply.daterangepicker', function(ev, picker) {
            //     $(this).val(picker.startDate.format('DD-MM-YYYY'));
            // });

            // window.$("#parentesco["+indiceSiguienteFila+"]").append(new Option("Seleccionar...", "-1"));
            // window.$(".select2").append(new Option("Seleccionar...", "-1"));
            
            // $("#b option[data-cod="+cod+"]")[0].selected = true;

            // $.each(parentesco, function(index, element) {
            //     $('select[name*="parentesco_id['+indiceSiguienteFila+']"]').append(new Option(element, index));
                
            // });

            // $.each(ocupaciones, function(index, element) {
            //     $('select[name*="ocupacion_id['+indiceSiguienteFila+']"]').append(new Option(element, index));
                
            // });
           
            // window.$('.select2').select2({
            //    'placeholder':'Seleccionar...'
            // });
        });
        // FIN - Función para agregar fila x fila cada producto para dar de baja

        // ===================================================================================
        // ===================================================================================
    </script>
@stop


