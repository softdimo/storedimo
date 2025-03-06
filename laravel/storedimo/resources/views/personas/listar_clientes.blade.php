@extends('layouts.app')
@section('title', 'Clientes')

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
                <a href="#" role="button" title="Ayuda" class="text-blue" data-bs-toggle="modal" data-bs-target="#modalAyudaListarClientes">
                    <i class="fa fa-question-circle fa-2x" aria-hidden="false" title="Ayuda" style="color: #337AB7"></i>
                </a>
            </div>

            {{-- =============================================================== --}}
            {{-- =============================================================== --}}

            <div class="modal fade h-auto modal-gral p-3" id="modalAyudaListarClientes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static" style="max-width: 55%;">
                <div class="modal-dialog m-0 mw-100">
                    <div class="modal-content border-0">
                        <div class="modal-body p-0 rounded-top" style="border: solid 1px #337AB7; mw-50">
                            <div class="row">
                                <div class="col-12">
                                    <div class="rounded-top text-white text-center p-2" style="background-color: #337AB7; border: solid 1px #337AB7;">
                                        <span class="modal-title"><strong>Ayuda de Listar Clientes</strong></span>
                                    </div>
                                    {{-- =========================== --}}
                                    <div class="p-3">
                                        <p class="text-justify">Señor usuario en esta vista usted se va a encontrar con diferentes opciones ubicadas al lado izquierdo de la tabla, cada una con una acción diferente, pero en esta ocasión solo se le orientará sobre el icono verde, que pertenece a la opción de modificación:
                                        </p>
    
                                        <ul>
                                            <li><strong>Opcion de Modificación:</strong>
                                                <ol>Tener en cuenta a la hora de modificar un Cliente lo siguiente:
                                                    <li class="text-justify">Todos los campos que poseen el asterisco (*) son obligatorios, por lo tanto sino se diligencian, el sistema no le dejará seguir.</li>
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
                <h5 class="border rounded-top text-white text-center pt-2 pb-2 m-0" style="background-color: #337AB7">Listar Clientes</h5>
            
                <div class="col-12 p-3" id="">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered w-100 mb-0" id="tbl_clientes" aria-describedby="clientes">
                            <thead>
                                <tr class="header-table text-center">
                                    <th>Tipo Cliente</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Celular</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            {{-- ============================== --}}
                            <tbody>
                                @foreach ($personaIndex as $persona)
                                    @if ($persona->id_tipo_persona == 5 || $persona->id_tipo_persona == 6)
                                        <tr class="text-center">
                                            <td>{{$persona->tipo_persona}}</td>
                                            <td>{{$persona->nombres_persona}}</td>
                                            <td>{{$persona->apellidos_persona}}</td>
                                            <td>{{$persona->celular}}</td>
                                            <td>{{$persona->estado}}</td>
                                            <td>
                                                <button type="button" class="btn btn-success rounded-circle btn-circle"
                                                    title="Editar Cliente"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalEditarCliente_{{ $persona->id_persona}}">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </button>
                                            </td>

                                            {{-- INICIO Modal EDITAR CLIENTE --}}
                                            <div class="modal fade h-auto modal-gral"
                                                id="modalEditarCliente_{{$persona->id_persona}}" tabindex="-1"
                                                data-bs-backdrop="static"
                                                data-bs-keyboard="false" aria-hidden="true"
                                                style="max-width: 55%;">
                                                <div class="modal-dialog m-0 mw-100">
                                                    <div class="modal-content w-100 border-0">
                                                        {!! Form::model($persona,[
                                                            'method' => 'PUT',
                                                            'route' => ['personas.update', $persona->id_persona],
                                                            'class' => 'mt-2',
                                                            'autocomplete' => 'off',
                                                            'id' => 'formEditarCliente_' . $persona->id_persona]) !!}
                                                            @csrf
                                                            <div class="rounded-top text-white text-center align-middle"
                                                                style="background-color: #337AB7; border: solid 1px #337AB7;">
                                                                <h5>Editar Cliente</h5>
                                                            </div>

                                                            {{ Form::hidden('id_persona', isset($persona) ? $persona->id_persona : null, ['class' => '', 'id' => 'id_persona']) }}

                                                            {{-- ====================================================== --}}
                                                            {{-- ====================================================== --}}

                                                            <div class="modal-body p-0 m-0" style="border: solid 1px #337AB7;">
                                                                <div class="row m-4">
                                                                    <div class="col-12 col-md-4">
                                                                        <div class="form-group d-flex flex-column">
                                                                            <label for="id_tipo_persona" class="" style="font-size: 15px">Tipo Cliente
                                                                                <span class="text-danger">*</span></label>
                                                                            {{ Form::select('id_tipo_persona',
                                                                                collect(['' => 'Seleccionar...'])
                                                                                ->union($tipos_persona),
                                                                                isset($persona) ? $persona->id_tipo_persona : null,
                                                                                [
                                                                                    'class' => 'form-control',
                                                                                    'id' => 'id_tipo_persona_'.$persona->id_tipo_persona,
                                                                                    'required' => 'required'
                                                                                ])
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
                                                                                    isset($persona) ? $persona->id_tipo_documento : null,
                                                                                    [
                                                                                        'class' => 'form-control',
                                                                                        'id' =>'id_tipo_documento',
                                                                                        'required' => 'required'
                                                                                    ])
                                                                                !!}
                                                                        </div>
                                                                    </div>
                                                                    {{-- ======================= --}}
                                                                    <div class="col-12 col-md-4"  id="div_identificacion">
                                                                        <div class="form-group d-flex flex-column">
                                                                            <label for="identificacion" class="" style="font-size: 15px">Número de documento
                                                                                <span class="text-danger">*</span></label>
                                                                            {{ Form::text('identificacion', isset($persona) ? $persona->identificacion : null, ['class' => 'form-control', 'id' => 'identificacion', 'required' => 'required']) }}
                                                                        </div>
                                                                    </div>
                                                                    {{-- ======================= --}}
                                                                    <div class="col-12 col-md-4 mt-4" id="div_nombres_persona">
                                                                        <div class="form-group d-flex flex-column">
                                                                            <label for="nombre_usuario" class="" style="font-size: 15px">Nombres
                                                                                <span class="text-danger">*</span></label>
                                                                            {{ Form::text('nombres_persona', isset($persona) ? $persona->nombres_persona : null, ['class' => 'form-control', 'id' => 'nombres_persona', 'required' => 'required']) }}
                                                                        </div>
                                                                    </div>
                                                                    {{-- ======================= --}}
                                                                    <div class="col-12 col-md-4 mt-4" id="div_apellidos_persona">
                                                                        <div class="form-group d-flex flex-column">
                                                                            <label for="apellido_usuario" class="" style="font-size: 15px">Apellidos
                                                                                <span class="text-danger">*</span>
                                                                            </label>
                                                                            {{ Form::text('apellidos_persona', isset($persona) ? $persona->apellidos_persona : null, ['class' => 'form-control', 'id' => 'apellidos_persona', 'required' => 'required']) }}
                                                                        </div>
                                                                    </div>
                                                                    {{-- ======================= --}}
                                                                    <div class="col-12 col-md-4 mt-4" id="div_numero_telefono">
                                                                        <div class="form-group d-flex flex-column">
                                                                            <label for="numero_telefono" class="" style="font-size: 15px">Número Teléfono</label>
                                                                            {{ Form::text('numero_telefono', isset($persona) ? $persona->numero_telefono : null, ['class' => 'form-control', 'id' => 'numero_telefono']) }}
                                                                        </div>
                                                                    </div>
                                                                    {{-- ======================= --}}
                                                                    <div class="col-12 col-md-4 mt-4" id="div_celular">
                                                                        <div class="form-group d-flex flex-column">
                                                                            <label for="celular" class="" style="font-size: 15px">Celular
                                                                                <span class="text-danger">*</span>
                                                                            </label>
                                                                            {{ Form::text('celular',
                                                                                isset($persona) ? $persona->celular : null,
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
                                                                            {{ Form::email('email', isset($persona) ? $persona->email : null, ['class' => 'form-control', 'id' => 'email', 'required' => 'required']) }}
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
                                                                                    isset($persona) ? $persona->id_genero : null,
                                                                                    ['class' => 'form-control', 'id' =>'id_genero','required' => 'required'])
                                                                                !!}
                                                                        </div>
                                                                    </div>
                                                                    {{-- ======================= --}}                                                                    
                                                                    <div class="col-12 col-md-4 mt-4" id="div_direccion">
                                                                        <div class="form-group d-flex flex-column">
                                                                            <label for="direccion" class="" style="font-size: 15px">Dirección</label>
                                                                            {{Form::text('direccion',
                                                                                isset($persona) ? $persona->direccion : null,
                                                                                ['class' => 'form-control', 'id' => 'direccion','required' => 'required']
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
                                                                                isset($persona) ? $persona->id_estado : null,
                                                                                [
                                                                                    'class' => 'form-control',
                                                                                    'id' =>'id_estado_'.$persona->id_estado,
                                                                                    'required' => 'required'
                                                                                ])
                                                                            !!}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> {{-- FIN modal-body --}}

                                                            {{-- ====================================================== --}}
                                                            {{-- ====================================================== --}}

                                                            <div class="modal-footer d-block mt-0 border border-0">
                                                                <!-- Contenedor para el GIF -->
                                                                <div id="loadingIndicatorEditCliente_{{$persona->id_persona}}"
                                                                    class="loadingIndicator">
                                                                    <img src="{{ asset('imagenes/loading.gif') }}" alt="Procesando...">
                                                                </div>

                                                                {{-- ====================================================== --}}
                                                                {{-- ====================================================== --}}

                                                                <div class="d-flex justify-content-around mt-3">
                                                                    <button type="submit" id="btn_editar_cliente_{{$persona->id_persona}}"
                                                                        class="btn btn-success">
                                                                        <i class="fa fa-floppy-o" aria-hidden="true"> Modificar</i>
                                                                    </button>

                                                                    <button id="btn_cancelar_cliente_{{$persona->id_persona}}"
                                                                        type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">
                                                                        <i class="fa fa-times" aria-hidden="true"> Cancelar</i>
                                                                    </button>
                                                                </div>
                                                            </div> {{-- modal-footer --}}
                                                        {!! Form::close() !!}
                                                    </div> {{-- modal-content --}}
                                                </div> {{-- modal-dialog --}}
                                            </div> {{-- FINAL Modal EDITAR PROVEEDOR --}}
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    {{-- ========================================================= --}}
                    {{-- ========================================================= --}}
                    {{-- ========================================================= --}}
                    {{-- ========================================================= --}}
            
                    <div class="mt-5 mb-2 d-flex justify-content-center">
                        <button type="submit" class="btn rounded-2 me-3 text-white" style="background-color: #286090">
                            <i class="fa fa-file-pdf-o"></i>
                            Reporte PDF de Proveedores
                        </button>
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
            // INICIO DataTable Lista Clientes
            $("#tbl_clientes").DataTable({
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
            // CIERRE DataTable Lista Clientes

            // ===========================================================================================
            // ===========================================================================================

            // Botón de submit de editar Cliente
            $(document).on("submit", "form[id^='formEditarCliente_']", function(e) {
                const form = $(this);
                const formId = form.attr('id'); // Obtenemos el ID del formulario
                const id = formId.split('_')[1]; // Obtener el ID del formulario desde el ID del formulario

                // Capturar el spinner y btns dinámicamente
                const loadingIndicator = $(`#loadingIndicatorEditCliente_${id}`);
                const submitButton = $(`#btn_editar_cliente_${id}`);
                const cancelButton = $(`#btn_cancelar_cliente_${id}`);

                // Deshabilitar botones
                cancelButton.prop("disabled", true);
                submitButton.prop("disabled", true).html("Procesando... <i class='fa fa-spinner fa-spin'></i>");

                // Cargar Spinner
                loadingIndicator.show();
            });
        }); // FIN document.ready
    </script>
@stop


