@extends('layouts.app')
@section('title', 'Crear Empresas')

{{-- =============================================================== --}}
{{-- =============================================================== --}}
{{-- =============================================================== --}}

@section('css')
    
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
                <a href="#" role="button" title="Ayuda" class="text-blue" data-bs-toggle="modal" data-bs-target="#modalAyudaCrearEmpresas">
                    <i class="fa fa-question-circle fa-2x" aria-hidden="false" title="Ayuda" style="color: #337AB7"></i>
                </a>
            </div>

            {{-- =============================================================== --}}
            {{-- =============================================================== --}}
            
            <div class="modal fade" id="modalAyudaCrearEmpresas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static">
                <div class="modal-dialog">
                    <div class="modal-content p-3">
                        <div class="modal-body p-0 rounded-top" style="border: solid 1px #337AB7; mw-50">
                            <div class="row">
                                <div class="col-12">
                                    <div class="rounded-top text-white text-center p-2" style="background-color: #337AB7; border: solid 1px #337AB7;">
                                        <span class="modal-title fs-5"><strong>Ayuda Registrar Empresas</strong></span>
                                    </div>
                                    {{-- =========================== --}}
                                    <div class="p-3">
                                        <p class="text-justify">Señor usuario a la hora de realizar un registro tener en cuenta las siguientes recomendaciones:</p>

                                        <ol>
                                            <li class="text-justify">Todos los campos que poseen el asterisco (*) son obligatorios, por lo tanto sino se diligencian, el sistema no le dejará seguir.</li>
                                            <li class="text-justify">El campo número de documento, su logitud debe ser mayor a los 7 caracteres.</li>
                                            <li class="text-justify">En el momento del registro no se debe ingresar un número de documento ya existente en la base de datos.</li>
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

            {!! Form::open(['method' => 'POST', 'route' => ['empresas.store'], 'class' => 'mt-2', 'autocomplete' => 'off', 'id' => 'formCrearEmpresas']) !!}
                @csrf
            
                @include('empresas.fields_crear_empresas')

                {{-- ========================================================= --}}
                {{-- ========================================================= --}}
                
                <!-- Contenedor para el GIF -->
                <div id="loadingIndicatorEmpresaStore" class="loadingIndicator">
                    <img src="{{asset('imagenes/loading.gif')}}" alt="Procesando...">
                </div>

                {{-- ========================================================= --}}
                {{-- ========================================================= --}}

                <div class="mt-5 mb-2 d-flex justify-content-center">
                    <button type="submit" class="btn btn-success rounded-2 me-3">
                        <i class="fa fa-floppy-o"></i>
                        Guardar
                    </button>

                    <button type="button" class="btn btn-danger rounded-2">
                        <i class="fa fa-remove"></i>
                        Cancelar
                    </button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
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

            // formCrearEmpresas para cargar gif en el submit
            $(document).on("submit", "form[id^='formCrearEmpresas']", function (e) {
                const form = $(this);
                const submitButton = form.find('button[type="submit"]');
                const cancelButton = form.find('button[type="button"]');
                const loadingIndicator = form.find("div[id^='loadingIndicatorEmpresaStore']"); // Busca el GIF del form actual

                // Dessactivar Botones
                submitButton.prop("disabled", true).html("Procesando... <i class='fa fa-spinner fa-spin'></i>");
                cancelButton.prop("disabled", true);
                
                // Mostrar Spinner
                loadingIndicator.show();
            });
        }); // FIN document.ready
    </script>
@stop


