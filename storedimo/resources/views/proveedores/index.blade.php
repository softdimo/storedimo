@extends('layouts.app')
@section('title', 'Proveedores')

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
            <div class="text-end">
                <a href="#" role="button" title="Ayuda" class="text-blue" data-bs-toggle="modal" data-bs-target="#modalAyudaListarProveedores">
                    <i class="fa fa-question-circle fa-2x" aria-hidden="false" title="Ayuda" style="color: #337AB7"></i>
                </a>
            </div>

            {{-- =============================================================== --}}
            {{-- =============================================================== --}}

            <div class="modal fade h-auto modal-gral p-3" id="modalAyudaListarProveedores" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static" style="max-width: 55%;">
                <div class="modal-dialog m-0 mw-100">
                    <div class="modal-content border-0">
                        <div class="modal-body p-0 rounded-top" style="border: solid 1px #337AB7; mw-50">
                            <div class="row">
                                <div class="col-12">
                                    <div class="rounded-top text-white text-center p-2" style="background-color: #337AB7; border: solid 1px #337AB7;">
                                        <span class="modal-title"><strong>Ayuda de Listar Proveedores</strong></span>
                                    </div>
                                    {{-- =========================== --}}
                                    <div class="p-3">
                                        <p class="text-justify">Señor usuario en esta vista usted se va a encontrar con diferentes opciones ubicadas al lado izquierdo de la tabla, cada una con una acción diferente, pero en esta ocasión solo se le orientará sobre el icono verde, que pertenece a la opción de modificación:
                                        </p>
    
                                        <ul>
                                            <li><strong>Opcion de Modificación:</strong>
                                                <ol>Tener en cuenta a la hora de modificar un proveedor lo siguiente:
                                                    <li class="text-justify">Todos los campos que poseen el asterisco (*) son obligatorios, por lo tanto sino se diligencian, el sistema no le dejará seguir.</li>
                                                    <li class="text-justify">Al cambiar un proveedor natural a proveedor jurídico, se le solicitará los datos adicionales de la empresa, todos obligatorios.</li>
                                                </ol>
                                                <br>
                                            </li>
                                        </ul>
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
                <h5 class="border rounded-top text-white text-center pt-2 pb-2 m-0" style="background-color: #337AB7">Listar Proveedores</h5>
            
                <div class="col-12 p-3" id="">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered w-100 mb-0" id="tbl_proveedores" aria-describedby="proveedores">
                            <thead>
                                <tr class="header-table text-center">
                                    <th>Tipo Proveedor</th>
                                    <th>Empresa</th>
                                    <th>Nit empresa</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Identificación</th>
                                    <th>Celular</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            {{-- ============================== --}}
                            <tbody>
                                {{-- @php
                                    dd($resProveedoresIndex);
                                @endphp --}}

                                @foreach ($resProveedoresIndex as $proveedor)
                                    {{-- @php
                                        dd($proveedor);
                                    @endphp --}}
                                        <tr class="text-center">
                                            <td>{{$proveedor->tipo_persona}}</td>
                                            <td>{{$proveedor->nombre_empresa}}</td>
                                            <td>{{$proveedor->nit_empresa}}</td>
                                            <td>{{$proveedor->nombres_persona}}</td>
                                            <td>{{$proveedor->apellidos_persona}}</td>
                                            <td>{{$proveedor->identificacion}}</td>
                                            <td>{{$proveedor->celular}}</td>
                                            <td>{{$proveedor->estado}}</td>
                                            <td>
                                                <button type="button" class="btn btn-success rounded-circle btn-circle"
                                                    title="Editar Proveedor"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalEditarProveedor_{{ $proveedor->id_proveedor}}">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </button>
                                            </td>

                                            {{-- INICIO Modal EDITAR PROVEEDOR --}}
                                            <div class="modal fade h-auto modal-gral"
                                                id="modalEditarProveedor_{{$proveedor->id_persona}}" tabindex="-1"
                                                data-bs-backdrop="static"
                                                data-bs-keyboard="false" aria-hidden="true"
                                                style="max-width: 55%;">
                                                <div class="modal-dialog m-0 mw-100">
                                                    <div class="modal-content w-100 border-0">
                                                        {!! Form::model($proveedor,[
                                                            'method' => 'PUT',
                                                            'route' => ['proveedores.update', $proveedor->id_proveedor],
                                                            'class' => 'mt-2',
                                                            'autocomplete' => 'off',
                                                            'id' => 'formEditarProveedor_' . $proveedor->id_proveedor]) !!}
                                                            @csrf
                                                            <div class="rounded-top text-white text-center"
                                                                style="background-color: #337AB7; border: solid 1px #337AB7;">
                                                                <h5 class="align-middle">Editar Proveedor</h5>
                                                            </div>

                                                            {{ Form::hidden('id_proveedor', isset($proveedor) ? $proveedor->id_proveedor : null, ['class' => '', 'id' => 'id_proveedor']) }}

                                                            {{-- ====================================================== --}}
                                                            {{-- ====================================================== --}}

                                                            <div class="modal-body p-0 m-0" style="border: solid 1px #337AB7;">
                                                                <div class="row m-4">
                                                                    <div class="col-12 col-md-4">
                                                                        <div class="form-group d-flex flex-column">
                                                                            <label for="id_tipo_persona" class="" style="font-size: 15px">Tipo Proveedor
                                                                                <span class="text-danger">*</span></label>
                                                                            {{ Form::select('id_tipo_persona',
                                                                                collect(['' => 'Seleccionar...'])
                                                                                ->union($tipos_persona),
                                                                                isset($proveedor) ? $proveedor->id_tipo_persona : null,
                                                                                ['class' => 'form-select',
                                                                                'id' => 'id_tipo_persona_'.$proveedor->id_tipo_persona,
                                                                                'required' => 'required'])
                                                                            }}
                                                                        </div>
                                                                    </div>
                                                                    {{-- ======================= --}}
                                                                    <div class="col-12 col-md-4">
                                                                        <div class="form-group d-flex flex-column">
                                                                            <label for="id_tipo_documento" class="" style="font-size: 15px">Tipo de documento
                                                                                    <span class="text-danger">*</span></label>
                                                                                {!! Form::select('id_tipo_documento',
                                                                                    collect(['' => 'Seleccionar...'])
                                                                                    ->union($tipos_documento),
                                                                                    isset($proveedor) ? $proveedor->id_tipo_documento : null,
                                                                                    [
                                                                                        'class' => 'form-select',
                                                                                        'id' =>'id_tipo_documento',
                                                                                        'required' => 'required'
                                                                                    ])
                                                                                !!}
                                                                        </div>
                                                                    </div>
                                                                    {{-- ======================= --}}
                                                                    <div class="col-12 col-md-4"  id="div_identificacion">
                                                                        <div class="form-group d-flex flex-column">
                                                                            <label for="identificacion" class="" style="font-size: 15px">Número de documento</label>
                                                                            {{ Form::text('identificacion',
                                                                                isset($proveedor) ? $proveedor->identificacion : null,
                                                                                [
                                                                                    'class' => 'form-control',
                                                                                    'id' => 'identificacion'
                                                                                ]) }}
                                                                        </div>
                                                                    </div>
                                                                    {{-- ======================= --}}
                                                                    <div class="col-12 col-md-4 mt-4" id="div_nombres_persona">
                                                                        <div class="form-group d-flex flex-column">
                                                                            <label for="nombre_usuario" class="" style="font-size: 15px">Nombres
                                                                                <span class="text-danger">*</span></label>
                                                                            {{ Form::text('nombres_persona',
                                                                                isset($proveedor) ? $proveedor->nombres_proveedor : null,
                                                                                [
                                                                                    'class' => 'form-control',
                                                                                    'id' => 'nombres_persona'
                                                                                ])
                                                                            }}
                                                                        </div>
                                                                    </div>
                                                                    {{-- ======================= --}}
                                                                    <div class="col-12 col-md-4 mt-4" id="div_apellidos_persona">
                                                                        <div class="form-group d-flex flex-column">
                                                                            <label for="apellido_usuario" class="" style="font-size: 15px">Apellidos
                                                                                <span class="text-danger">*</span>
                                                                            </label>
                                                                            {{ Form::text('apellidos_persona',
                                                                                isset($proveedor) ? $proveedor->apellidos_proveedor : null,
                                                                                [
                                                                                    'class' => 'form-control',
                                                                                    'id' => 'apellidos_persona'
                                                                                ]) }}
                                                                        </div>
                                                                    </div>
                                                                    {{-- ======================= --}}
                                                                    <div class="col-12 col-md-4 mt-4" id="div_numero_telefono">
                                                                        <div class="form-group d-flex flex-column">
                                                                            <label for="numero_telefono" class="" style="font-size: 15px">Número Teléfono</label>
                                                                            {{ Form::text('numero_telefono',
                                                                                isset($proveedor) ? $proveedor->telefono_proveedor : null,
                                                                                [
                                                                                    'class' => 'form-control',
                                                                                    'id' => 'numero_telefono'
                                                                                ])
                                                                            }}
                                                                        </div>
                                                                    </div>
                                                                    {{-- ======================= --}}
                                                                    <div class="col-12 col-md-4 mt-4" id="div_celular">
                                                                        <div class="form-group d-flex flex-column">
                                                                            <label for="celular" class="" style="font-size: 15px">Celular
                                                                                <span class="text-danger">*</span>
                                                                            </label>
                                                                            {{ Form::text('celular',
                                                                                isset($proveedor) ? $proveedor->celular_proveedor : null,
                                                                                [
                                                                                    'class' => 'form-control',
                                                                                    'id' => 'celular',
                                                                                    'required' => 'required'
                                                                                ])
                                                                            }}
                                                                        </div>
                                                                    </div>
                                                                    {{-- ======================= --}}
                                                                    <div class="col-12 col-md-4 mt-4" id="div_email">
                                                                        <div class="form-group d-flex flex-column">
                                                                            <label for="email" class="" style="font-size: 15px">Correo
                                                                                <span class="text-danger">*</span></label>
                                                                            {{ Form::email('email',
                                                                                isset($proveedor) ? $proveedor->email_proveedor : null,
                                                                                [
                                                                                    'class' => 'form-control',
                                                                                    'id' => 'email',
                                                                                    'required' => 'required'
                                                                                ])
                                                                            }}
                                                                        </div>
                                                                    </div>
                                                                    {{-- ======================= --}}
                                                                    <div class="col-12 col-md-4 mt-4" id="div_id_genero">
                                                                        <div class="form-group d-flex flex-column">
                                                                            <label for="id_genero" class="" style="font-size: 15px">Género
                                                                                    <span class="text-danger">*</span></label>
                                                                                {!! Form::select('id_genero',
                                                                                    collect(['' => 'Seleccionar...'])
                                                                                    ->union($generos),
                                                                                    isset($proveedor) ? $proveedor->id_genero : null,
                                                                                    ['class' => 'form-select', 'id' =>'id_genero'])
                                                                                !!}
                                                                        </div>
                                                                    </div>
                                                                    {{-- ======================= --}}                                                                    
                                                                    <div class="col-12 col-md-4 mt-4" id="div_direccion">
                                                                        <div class="form-group d-flex flex-column">
                                                                            <label for="direccion" class="" style="font-size: 15px">Dirección</label>
                                                                            {{Form::text('direccion',
                                                                                isset($proveedor) ? $proveedor->direccion_proveedor : null,
                                                                                ['class' => 'form-control', 'id' => 'direccion']
                                                                            )}}
                                                                        </div>
                                                                    </div>
                                                                    {{-- ======================= --}}
                                                                    <div class="col-12 col-md-4 mt-4" id="div_id_estado">
                                                                        <div class="form-group d-flex flex-column">
                                                                            <label for="id_estado" class="" style="font-size: 15px">Estado
                                                                                <span class="text-danger">*</span>
                                                                            </label>
                                                                            {!! Form::select('id_estado',
                                                                                collect(['' => 'Seleccionar...'])
                                                                                ->union($estados),
                                                                                isset($proveedor) ? $proveedor->id_estado : null,
                                                                                [
                                                                                    'class' => 'form-select',
                                                                                    'id' =>'id_estado_'.$proveedor->id_estado
                                                                                ])
                                                                            !!}
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                {{-- ============================================== --}}

                                                                <div class="row m-4" id="div_proveedor_juridico">
                                                                    <div class="col-12 col-md-4">
                                                                        <div class="form-group d-flex flex-column">
                                                                            <label for="nit_empresa" class="form-label">Nit Empresa<span class="text-danger">*</span></label>
                                                                            {!! Form::text('nit_empresa', null, ['class' => 'form-control', 'id' => 'nit_empresa']) !!}
                                                                        </div>
                                                                    </div>
                                                        
                                                                    {{-- ======================= --}}
                                                                    
                                                                    <div class="col-12 col-md-4">
                                                                        <div class="form-group d-flex flex-column">
                                                                            <label for="nombre_empresa" class="form-label">Nombre Empresa<span class="text-danger">*</span></label>
                                                                            {!! Form::text('nombre_empresa', null, ['class' => 'form-control', 'id' => 'nombre_empresa']) !!}
                                                                        </div>
                                                                    </div>
                                                        
                                                                    {{-- ======================= --}}
                                                                    
                                                                    <div class="col-12 col-md-4">
                                                                        <div class="form-group d-flex flex-column">
                                                                            <label for="telefono_empresa" class="form-label">Teléfono Empresa<span class="text-danger">*</span></label>
                                                                            {!! Form::text('telefono_empresa', null, ['class' => 'form-control', 'id' => 'telefono_empresa']) !!}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> {{-- FIN modal-body --}}

                                                            {{-- ====================================================== --}}
                                                            {{-- ====================================================== --}}

                                                            <div class="modal-footer d-block mt-0 border border-0">
                                                                <!-- Contenedor para el GIF -->
                                                                <div id="loadingIndicatorEditProveedor_{{$proveedor->id_proveedor}}"
                                                                    class="loadingIndicator">
                                                                    <img src="{{ asset('imagenes/loading.gif') }}" alt="Procesando...">
                                                                </div>

                                                                {{-- ====================================================== --}}
                                                                {{-- ====================================================== --}}

                                                                <div class="d-flex justify-content-around mt-3">
                                                                    <button type="submit" id="btn_editar_proveedor_{{$proveedor->id_proveedor}}"
                                                                        class="btn btn-success">
                                                                        <i class="fa fa-floppy-o" aria-hidden="true"> Modificar</i>
                                                                    </button>

                                                                    <button id="btn_cancelar_proveedor_{{$proveedor->id_proveedor}}"
                                                                        type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">
                                                                        <i class="fa fa-times" aria-hidden="true"> Cancelar</i>
                                                                    </button>
                                                                </div>
                                                            </div> {{-- modal-footer --}}
                                                        {!! Form::close() !!}
                                                    </div> {{-- modal-content --}}
                                                </div> {{-- modal-dialog --}}
                                            </div> {{-- FINAL Modal EDITAR PROVEEDOR  --}}
                                        </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> {{-- FIN div_campos_usuarios --}}
            </div> {{-- FIN div_crear_usuario --}}
            
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
            // INICIO DataTable Lista Proveedores
            $("#tbl_proveedores").DataTable({
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
                "pageLength": 25,
                "scrollX": true,
            });
            // CIERRE DataTable Lista Proveedores

            // ===========================================================================================
            // ===========================================================================================

            // Botón de submit de editar Proveedor
            $(document).on("submit", "form[id^='formEditarProveedor_']", function(e) {
                const form = $(this);
                const formId = form.attr('id'); // Obtenemos el ID del formulario
                const id = formId.split('_')[1]; // Obtener el ID del formulario desde el ID del formulario

                // Capturar el spinner y btns dinámicamente
                const loadingIndicator = $(`#loadingIndicatorEditProveedor_${id}`);
                const submitButton = $(`#btn_editar_proveedor_${id}`);
                const cancelButton = $(`#btn_cancelar_proveedor_${id}`);

                // Deshabilitar botones
                cancelButton.prop("disabled", true);
                submitButton.prop("disabled", true).html("Procesando... <i class='fa fa-spinner fa-spin'></i>");

                // Cargar Spinner
                loadingIndicator.show();
            });

            // ===========================================================================================
            // ===========================================================================================

            $(document).on('shown.bs.modal', '[id^="modalEditarProveedor_"]', function () {
                // Buscar el select dentro del modal
                let modal = $(this); // Guardamos la referencia del modal
                let selectTipoPersona = modal.find('[id^=id_tipo_persona_]');

                if (selectTipoPersona.length > 0) { // Al cargar el modal
                    let idTipoPersona = selectTipoPersona.val(); // Obtener el valor actual del select
                    console.log(`Id Tipo Persona al abrir el modal: ${idTipoPersona}`);

                    // Buscar los elementos dentro de este modal
                    let divIdentificacion = modal.find('[id^=div_identificacion]');
                    let inputIdentificacion = modal.find('[id^=identificacion]');

                    let divNombresPersona = modal.find('[id^=div_nombres_persona]');
                    let inputNombresPersona = modal.find('[id^=nombres_persona]');

                    let divApellidosPersona = modal.find('[id^=div_apellidos_persona]');
                    let inputApellidosPersona = modal.find('[id^=apellidos_persona]');

                    let divNumeroTelefono = modal.find('[id^=div_numero_telefono]');
                    let inputNumeroTelefono = modal.find('[id^=numero_telefono]');

                    let divCelular = modal.find('[id^=div_celular]');
                    let inputCelular = modal.find('[id^=celular]');

                    let divEmail = modal.find('[id^=div_email]');
                    let inputEmail = modal.find('[id^=email]');

                    let divDireccion = modal.find('[id^=div_direccion]');
                    let inputDireccion = modal.find('[id^=direccion]');

                    let divIdGenero = modal.find('[id^=div_id_genero]');
                    let inputIdGenero = modal.find('[id^=id_genero]');

                    let divProveedorJuridico = modal.find('[id^=div_proveedor_juridico]');
                    let inputNitEmpresa = modal.find('[id^=nit_empresa]');
                    let inputNombreEmpresa = modal.find('[id^=nombre_empresa]');
                    let inputTelefonoEmpresa = modal.find('[id^=telefono_empresa]');

                    // Ocultar o mostrar al cargar el modal
                    if (idTipoPersona == 4) {
                        divIdentificacion.hide('slow');
                        inputIdentificacion.removeAttr('required');

                        divNombresPersona.hide('slow');
                        inputNombresPersona.removeAttr('required');

                        divApellidosPersona.hide('slow');
                        inputApellidosPersona.removeAttr('required');

                        divNumeroTelefono.hide('slow');
                        inputNumeroTelefono.removeAttr('required');

                        divCelular.removeClass('mt-4');

                        divIdGenero.hide('slow');
                        inputIdGenero.removeAttr('required');

                        divProveedorJuridico.show('slow');
                        inputNitEmpresa.attr('required', true);
                        inputNombreEmpresa.attr('required', true);
                        inputTelefonoEmpresa.attr('required', true);
                    } else {
                        divIdentificacion.show('slow');
                        inputIdentificacion.attr('required', true);

                        divNombresPersona.show('slow');
                        inputNombresPersona.attr('required', true);

                        divApellidosPersona.show('slow');
                        inputApellidosPersona.attr('required', true);

                        divNumeroTelefono.show('slow');
                        inputNumeroTelefono.attr('required', true);

                        divCelular.addClass('mt-4');

                        divIdGenero.show('slow');
                        inputIdGenero.attr('required', true);

                        divProveedorJuridico.hide('slow');
                        inputNitEmpresa.removeAttr('required');
                        inputNombreEmpresa.removeAttr('required');
                        inputTelefonoEmpresa.removeAttr('required');
                    }

                    // ===================================================

                    // Al cambiar el tipo de persona
                    selectTipoPersona.change(function () {
                        let idTipoPersona = selectTipoPersona.val(); // Obtener el valor actual del select al cambiar
                        console.log(`cambio ${idTipoPersona}`);

                        let modal = $(this).closest('[id^="modalEditarProveedor_"]'); // Asegurar que buscamos dentro del modal correcto

                        let divIdentificacion = modal.find('[id^=div_identificacion]');
                        let inputIdentificacion = modal.find('[id^=identificacion]');

                        let divNombresPersona = modal.find('[id^=div_nombres_persona]');
                        let inputNombresPersona = modal.find('[id^=nombres_persona]');

                        let divApellidosPersona = modal.find('[id^=div_apellidos_persona]');
                        let inputApellidosPersona = modal.find('[id^=apellidos_persona]');

                        let divNumeroTelefono = modal.find('[id^=div_numero_telefono]');
                        let inputNumeroTelefono = modal.find('[id^=numero_telefono]');

                        let divCelular = modal.find('[id^=div_celular]');
                        let inputCelular = modal.find('[id^=celular]');

                        let divEmail = modal.find('[id^=div_email]');
                        let inputEmail = modal.find('[id^=email]');

                        let divDireccion = modal.find('[id^=div_direccion]');
                        let inputDireccion = modal.find('[id^=direccion]');

                        let divIdGenero = modal.find('[id^=div_id_genero]');
                        let inputIdGenero = modal.find('[id^=id_genero]');

                        let divProveedorJuridico = modal.find('[id^=div_proveedor_juridico]');
                        let inputNitEmpresa = modal.find('[id^=nit_empresa]');
                        let inputNombreEmpresa = modal.find('[id^=nombre_empresa]');
                        let inputTelefonoEmpresa = modal.find('[id^=telefono_empresa]');

                        if (idTipoPersona == 4) { // Proveedor-juridico
                            console.log(`juridico ${idTipoPersona}`);
                            divIdentificacion.hide('slow');
                            inputIdentificacion.removeAttr('required');

                            divNombresPersona.hide('slow');
                            inputNombresPersona.removeAttr('required');

                            divApellidosPersona.hide('slow');
                            inputApellidosPersona.removeAttr('required');

                            divNumeroTelefono.hide('slow');
                            inputNumeroTelefono.removeAttr('required');

                            divCelular.show('slow');
                            divCelular.removeClass('mt-4');
                            inputCelular.attr('required', true);

                            divEmail.show('slow');
                            inputEmail.attr('required', true);

                            divDireccion.show('slow');
                            inputDireccion.attr('required', true);

                            divIdGenero.hide('slow');
                            inputIdGenero.removeAttr('required');

                            divProveedorJuridico.show('slow');
                            inputNitEmpresa.attr('required', true);
                            inputNombreEmpresa.attr('required', true);
                            inputTelefonoEmpresa.attr('required', true);
                        } else {
                            console.log(`natural ${idTipoPersona}`);
                            divIdentificacion.show('slow');
                            inputIdentificacion.attr('required', true);

                            divNombresPersona.show('slow');
                            inputNombresPersona.attr('required', true);

                            divApellidosPersona.show('slow');
                            inputApellidosPersona.attr('required', true);

                            divNumeroTelefono.show('slow');
                            inputNumeroTelefono.attr('required', true);

                            divCelular.show('slow');
                            divCelular.addClass('mt-4');
                            inputCelular.attr('required', true);

                            divEmail.show('slow');
                            inputEmail.attr('required', true);

                            divDireccion.show('slow');
                            inputDireccion.attr('required', true);

                            divIdGenero.show('slow');
                            inputIdGenero.attr('required', true);

                            divProveedorJuridico.hide('slow');
                            inputNitEmpresa.removeAttr('required');
                            inputNombreEmpresa.removeAttr('required');
                            inputTelefonoEmpresa.removeAttr('required');
                        }
                    }); // FIN Tipo Persona Jurídica
                } // FIN selectTipoPersona.length > 0
            }); // FIN '[id^="modalEditarProveedor_"]').on('shown.bs.modal'
        }); // FIN document.ready
    </script>
@stop
