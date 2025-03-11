@extends('layouts.app')
@section('title', 'Registrar Pagos')

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

        /* Oculta el icono de calendario nativo en Chrome, Safari y Edge */
        input[type="date"]::-webkit-calendar-picker-indicator {
            display: none;
            -webkit-appearance: none;
        }

        /* Oculta el icono en Firefox */
        input[type="date"]::-moz-calendar-picker-indicator {
            display: none;
        }

        /* Para navegadores que aún muestran el ícono nativo */
        input[type="date"] {
            position: relative;
            z-index: 10;
            background-color: transparent;
        }

        .totales {
            padding: 10px 15px;
            background-color: #f5f5f5;
            border-top: 1px solid #ddd;
            border-bottom-right-radius: 3px;
            border-bottom-left-radius: 3px;
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
                <a href="#" role="button" title="Ayuda" class="text-blue" data-bs-toggle="modal" data-bs-target="#modalAyudaRegistrarPagos">
                    <i class="fa fa-question-circle fa-2x" aria-hidden="false" title="Ayuda" style="color: #337AB7"></i>
                </a>
            </div>

            <div class="modal fade h-auto modal-gral p-3" id="modalAyudaRegistrarPagos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static" style="max-width: 55%;">
                <div class="modal-dialog m-0 mw-100">
                    <div class="modal-content border-0">
                        <div class="modal-body p-0 rounded-top" style="border: solid 1px #337AB7; mw-50">
                            <div class="row">
                                <div class="col-12">
                                    <div class="rounded-top text-white text-center p-2" style="background-color: #337AB7; border: solid 1px #337AB7;">
                                        <span class="modal-title fs-4"><strong>Ayuda Registro de Pagos</strong></span>
                                    </div>
                                    {{-- =========================== --}}
                                    <div class="p-3">
                                        <p class="text-justify">Señor usuario tener en cuenta estas recomendaciones a la hora de registrar un pago:</p>
    
                                        <ol>
                                            <li class="text-justify">Dependiendo el tipo de pago y el tipo de empleado se habilitan o inhabilitan campos.</li>
                                            <li class="text-justify">Los campos marcados con asterisco (*) son obligatorios, por lo tanto si no se diligencian el sistema no dejará seguir.</li>
                                            <li class="text-justify">El campo valor prima solo se activará cuando el sistema se encuentre en las fechas del 15 al 30 de Junio y del 15 al 30 de Diciembre.</li>
                                            <li class="text-justify">Al registrar un pago final, si el empleado no ha cumplido el año de labores los diferentes valores como prima, cesantías, vacaciones, etc. se pagarán de forma proporcional de acuerdo a los días laborados desde la fecha de contrato hasta la fecha de ese pago.</li>
                                        </ol>
                                    </div> {{--FINpanel-body --}}
                                </div> {{--FIN col-12 --}}
                            </div> {{--FIN modal-body .row --}}
                        </div> {{--FIN modal-body --}}
                        {{-- =========================== --}}
                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="button" class="btn btn-primary btn-md active pull-right" data-bs-dismiss="modal" style="background-color: #337AB7;">
                                    <i class="fa fa-check-circle">&nbsp;Aceptar</i>
                                </button>
                            </div>
                        </div>
                    </div> {{--FIN modal-content --}}
                </div> {{--FIN modal-dialog --}}
            </div> {{--FIN modalAyudaModificacionProductos --}}

            {{-- =============================================================== --}}
            {{-- =============================================================== --}}

            <div class="p-0" style="border: solid 1px #337AB7; border-radius: 5px;">
                <h5 class="border rounded-top text-white text-center pt-2 pb-2 m-0" style="background-color: #337AB7">Registrar Pagos</h5>
            
                <div class="col-12 p-3" id="">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered w-100 mb-0" id="tbl_registrar_pagos" aria-describedby="registrar_pagos">
                            <thead>
                                <tr class="header-table text-center">
                                    <th>Número Documento</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Tipo Empleado</th>
                                    <th>Estado</th>
                                    <th>Registrar Pago</th>
                                </tr>
                            </thead>
                            {{-- ============================== --}}
                            <tbody>
                                    <tr class="text-center">
                                        <td>1234567890</td>
                                        <td>Victor</td>
                                        <td>Gómez</td>
                                        <td>Empleado-fijo</td>
                                        <td>Habilitado</td>
                                        <td>
                                            <button class="btn rounded-circle btn-circle text-white" title="Detalles Préstamo" style="background-color: #286090" data-bs-toggle="modal" data-bs-target="#modalRegistrarPago">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    {{-- INICIO Modal REGISTRAR PAGO --}}
                                    <div class="modal fade h-auto modal-gral" id="modalRegistrarPago" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" style="max-width: 70%">
                                        <div class="modal-dialog m-0 mw-100">
                                            <div class="modal-content border-0">
                                                {!! Form::open([
                                                    'method' => 'POST',
                                                    'route' => ['cambiar_estado_producto'],
                                                    'class' => 'mt-2',
                                                    'autocomplete' => 'off',
                                                    'id' => 'formRegistrarPago']) !!}
                                                    @csrf

                                                    <div class="rounded-top" style="border: solid 1px #337AB7;">
                                                        <div class="rounded-top text-white text-center"
                                                            style="background-color: #337AB7; border: solid 1px #337AB7;">
                                                            <h5>Registrar Pago</h5>
                                                        </div>

                                                        <div class="modal-body m-0">
                                                            <div class="row m-0">
                                                                <div class="col-12 col-md-4" id="div_identificacion">
                                                                    <label for="identificacion" class="fw-bold" style="font-size: 12px">Identificación <span class="text-danger">*</span></label>
                                                                    {!! Form::text('identificacion', isset($prestamo) ? $prestamo->identificacion : null, ['class' => 'form-control', 'id' => 'identificacion', 'required', 'readonly']) !!}
                                                                </div>
                            
                                                                <div class="col-12 col-md-4" id="div_nombres">
                                                                    <label for="nombre_usuario" class="fw-bold" style="font-size: 12px">Nombres <span class="text-danger">*</span></label>
                                                                    {!! Form::text('nombre_usuario', null, ['class' => 'form-control', 'id' => 'nombre_usuario', 'required', 'readonly']) !!}
                                                                </div>
                            
                                                                <div class="col-12 col-md-4" id="div_tipo_empleado">
                                                                    <label for="tipo_empleado" class="fw-bold" style="font-size: 12px">Tipo Empleado <span class="text-danger">*</span></label>
                                                                    {!! Form::text('tipo_empleado', null, ['class' => 'form-control', 'id' => 'tipo_empleado', 'required', 'readonly']) !!}
                                                                </div>

                                                                <div class="col-12 col-md-4 mt-3" id="div_valor_base">
                                                                    <label for="valor_base" class="fw-bold" style="font-size: 12px">Valor Base <span class="text-danger">*</span></label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text">$</span>
                                                                        {!! Form::text('valor_base', null, ['class' => 'form-control', 'id' => 'valor_base', 'required', 'readonly']) !!}
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-4 mt-3" id="div_fecha_inicio_labores">
                                                                    <label for="fecha_inicio_labores" class="fw-bold" style="font-size: 12px">
                                                                        Fecha inicio de labores <span class="text-danger">*</span>
                                                                    </label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text">
                                                                            <i class="fa fa-calendar"></i>
                                                                        </span>
                                                                        {!! Form::date('fecha_inicio_labores', null, ['class' => 'form-control', 'id' => 'fecha_inicio_labores', 'required']) !!}
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-4 mt-3" id="div_fecha_final_labores">
                                                                    <label for="fecha_final_labores" class="fw-bold" style="font-size: 12px">
                                                                        Fecha inicio de labores <span class="text-danger">*</span>
                                                                    </label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text">
                                                                            <i class="fa fa-calendar"></i>
                                                                        </span>
                                                                        {!! Form::date('fecha_final_labores', null, ['class' => 'form-control', 'id' => 'fecha_final_labores', 'required']) !!}
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-4 mt-3" id="div_id_tipo_pago">
                                                                    <label for="id_tipo_pago" class="fw-bold" style="font-size: 12px">Tipo Pago <span class="text-danger">*</span></label>
                                                                    {{ Form::select('id_tipo_pago', collect(['' => 'Seleccionar...'])->union($tipos_pago_nomina), isset($usuarioPrestamo) ? $usuarioPrestamo->id_tipo_persona : null, ['class' => 'form-control', 'id' => 'id_tipo_pago']) }}
                                                                </div>

                                                                <div class="col-12 col-md-4 mt-3" id="div_id_periodo_pago">
                                                                    <label for="id_periodo_pago" class="fw-bold" style="font-size: 12px">Periodo Pago <span class="text-danger">*</span></label>
                                                                    {{ Form::select('id_periodo_pago', collect(['' => 'Seleccionar...'])->union($periodos_pago), isset($usuarioPrestamo) ? $usuarioPrestamo->id_tipo_persona : null, ['class' => 'form-control', 'id' => 'id_periodo_pago']) }}
                                                                </div>

                                                                <div class="col-12 col-md-4 mt-3" id="div_cantidad_dias">
                                                                    <label for="cantidad_dias" class="fw-bold" style="font-size: 12px">Días a pagar <span class="text-danger">*</span></label>
                                                                    {!! Form::text('cantidad_dias', null, ['class' => 'form-control', 'id' => 'cantidad_dias', 'required', 'readonly']) !!}
                                                                </div>

                                                                <div class="col-12 col-md-4 mt-3" id="div_total_dias_pagar">
                                                                    <label for="total_dias_pagar" class="fw-bold" style="font-size: 12px">Total dias a pagar <span class="text-danger">*</span></label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text">$</span>
                                                                        {!! Form::text('total_dias_pagar', null, ['class' => 'form-control', 'id' => 'total_dias_pagar', 'required', 'readonly']) !!}
                                                                        <span class="input-group-btn">
                                                                            <button class="input-group-text" type="button" id="idBtnCalcularPagoEnLiquidacion" onclick="calcularElPagoNormalEnLiquidacion()" style="background-color: #E0F8E0"> <b>Calcular</b>
                                                                            </button>
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-4 mt-3" id="div_porcentaje_comision">
                                                                    <label for="porcentaje_comision" class="fw-bold" style="font-size: 12px">Porcentaje Comisión <span class="text-danger">*</span></label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text">%</span>
                                                                        {!! Form::text('porcentaje_comision', null, ['class' => 'form-control', 'id' => 'porcentaje_comision', 'required', 'readonly']) !!}
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-4 mt-3" id="div_valor_dia">
                                                                    <label for="valor_dia" class="fw-bold" style="font-size: 12px">Valor día <span class="text-danger">*</span></label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text">$</span>
                                                                        {!! Form::text('valor_dia', null, ['class' => 'form-control', 'id' => 'valor_dia', 'required', 'readonly']) !!}
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-4 mt-3" id="div_fecha_ultimo_pago">
                                                                    <label for="fecha_ultimo_pago" class="fw-bold" style="font-size: 12px">
                                                                        Fecha último pago <span class="text-danger">*</span>
                                                                    </label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text">
                                                                            <i class="fa fa-calendar"></i>
                                                                        </span>
                                                                        {!! Form::date('fecha_ultimo_pago', null, ['class' => 'form-control', 'id' => 'fecha_ultimo_pago', 'required']) !!}
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-6 mt-3" id="div_valor_ventas">
                                                                    <label for="valor_ventas" class="fw-bold" style="font-size: 12px">Valor ventas</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text">$</span>
                                                                        {!! Form::text('valor_ventas', null, ['class' => 'form-control', 'id' => 'valor_ventas', 'required']) !!}
                                                                        <button type="button" class="input-group-text" onclick="traervalorVentas()"><span class="fa fa-search-plus"></span></button>
                                                                        <button type="button" class="input-group-text" onclick="limpiarCampos()"><span class="fa fa-trash-o"></span></button>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-6 mt-3" id="div_pendiente_prestamos">
                                                                    <label for="pendiente_prestamos" class="fw-bold" style="font-size: 12px">Pendiente de Préstamos</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text">$</span>
                                                                        {!! Form::text('pendiente_prestamos', null, ['class' => 'form-control', 'id' => 'pendiente_prestamos', 'required']) !!}
                                                                        <button type="button" class="input-group-text" onclick="traervalorprestamopen()"><span class="fa fa-search-plus"></span></button>
                                                                        <button type="button" class="input-group-text" onclick="limpiarCampos()"><span class="fa fa-trash-o"></span></button>
                                                                    </div>
                                                                </div>
                                                            </div> <!-- FIN modal-body .row Campos registrar pago -->

                                                            {{-- ====================================================== --}}

                                                            <div class="rounded-top mt-5" style="border: solid 1px #337AB7;">
                                                                <div class="rounded-top text-white text-center"
                                                                    style="background-color: #337AB7; border: solid 1px #337AB7;">
                                                                    <h5>PAGO TOTAL</h5>
                                                                </div>

                                                                <div class="row p-3">
                                                                    <div class="col-12 col-md-4">
                                                                        <h5 class="fw-bold totales">
                                                                            Salario Neto:
                                                                            {!! Form::hidden('salario_neto', null, ['class' => '', 'id' => 'salario_neto', 'required']) !!}
                                                                            <span id="salario_neto"></span>
                                                                        </h5>
                                                                    </div>

                                                                    <div class="col-12 col-md-4">
                                                                        <h5 class="fw-bold totales">
                                                                            Comisiones:
                                                                            {!! Form::hidden('comisiones', null, ['class' => '', 'id' => 'comisiones', 'required']) !!}
                                                                            <span id="comisiones"></span>
                                                                        </h5>
                                                                    </div>

                                                                    <div class="col-12 col-md-4">
                                                                        <h5 class="fw-bold totales">
                                                                            Total:
                                                                            {!! Form::hidden('total', null, ['class' => '', 'id' => 'total', 'required']) !!}
                                                                            <span id="total"></span>
                                                                        </h5>
                                                                    </div>
                                                                </div>

                                                                {{-- =========================== --}}

                                                                <div class="row mt-3 me-3 mb-3">
                                                                    <div class="col-12">
                                                                        <button type="button" class="btn btn-primary btn-md active pull-right" style="background-color: #337AB7;">
                                                                            <i class="fa fa-building"> Aceptar</i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> <!-- FIN modal-body -->
                                                    </div>

                                                    {{-- ====================================================== --}}
                                                    {{-- ====================================================== --}}

                                                    <!-- Contenedor para el GIF -->
                                                    <div id="loadingIndicatorEstadoPrestamo}}"
                                                        class="loadingIndicator">
                                                        <img src="{{ asset('imagenes/loading.gif') }}" alt="Procesando...">
                                                    </div>

                                                    {{-- ====================================================== --}}
                                                    {{-- ====================================================== --}}

                                                    <div class="modal-footer border-0 d-flex justify-content-around mt-3">
                                                        <button type="submit" id="btn_cambiar_estado_prestamo"
                                                            class="btn btn-success" title="Guardar Configuración">
                                                            <i class="fa fa-floppy-o"> Guardar</i>
                                                        </button>

                                                        <button type="button" id="btn_cancelar_estado_prestamo"
                                                            class="btn btn-secondary" title="Cancelar"
                                                            data-bs-dismiss="modal">
                                                            <i class="fa fa-times"> Cancelar</i>
                                                        </button>
                                                    </div>
                                                {!! Form::close() !!}
                                            </div> {{-- FIN modal-content --}}
                                        </div> {{-- FIN modal-dialog --}}
                                    </div> {{-- FIN modal --}}
                                    {{-- FINAL Modal REGISTRAR PAGO --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

{{-- =============================================================== --}}
{{-- =============================================================== --}}
{{-- =============================================================== --}}

@section('scripts')
    <script src="{{asset('DataTables/datatables.min.js')}}"></script>
    <script src="{{asset('DataTables/Buttons-2.3.4/js/buttons.html5.min.js')}}"></script>

    <script>
        $( document ).ready(function() {
            // INICIO DataTable REGISTRAR PAGOS
            $("#tbl_registrar_pagos").DataTable({
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
            // CIERRE DataTable REGISTRAR PAGOS

            // ==========================================================
            // ==========================================================


        });
    </script>
@stop


