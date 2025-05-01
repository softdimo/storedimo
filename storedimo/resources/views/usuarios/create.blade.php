@extends('layouts.app')
@section('title', 'Crear Usuarios')

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
            <div class="d-flex justify-content-between pe-3 mt-3">
                <div class="">
                    <a href="{{ route('usuarios.index') }}" class="btn text-white"
                        style="background-color:#337AB7">Usuarios</a>
                </div>

                <div class="text-end">
                    <a href="#" role="button" title="Ayuda" class="text-blue" data-bs-toggle="modal"
                        data-bs-target="#modalAyudaCrearUsuarios">
                        <i class="fa fa-question-circle fa-2x" aria-hidden="false" title="Ayuda"
                            style="color: #337AB7"></i>
                    </a>
                </div>
            </div>

            {{-- =============================================================== --}}
            {{-- =============================================================== --}}

            <div class="modal fade" id="modalAyudaCrearUsuarios" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static">
                <div class="modal-dialog">
                    <div class="modal-content p-3">
                        <div class="modal-body p-0 rounded-top" style="border: solid 1px #337AB7; mw-50">
                            <div class="row">
                                <div class="col-12">
                                    <div class="rounded-top text-white text-center p-2"
                                        style="background-color: #337AB7; border: solid 1px #337AB7;">
                                        <span class="modal-title fs-5"><strong>Ayuda Registrar Usuarios</strong></span>
                                    </div>
                                    {{-- =========================== --}}
                                    <div class="p-3">
                                        <p class="text-justify">Señor usuario a la hora de realizar un registro tener en
                                            cuenta las siguientes recomendaciones:</p>

                                        <ol>
                                            <li class="text-justify">Todos los campos que poseen el asterisco (*) son
                                                obligatorios, por lo tanto sino se diligencian, el sistema no le dejará
                                                seguir.</li>
                                            <li class="text-justify">El campo número de documento, su logitud debe ser mayor
                                                a los 7 caracteres.</li>
                                            <li class="text-justify">En el momento del registro no se debe ingresar un
                                                número de documento ya existente en la base de datos.</li>
                                        </ol>
                                    </div> {{-- FINpanel-body --}}
                                </div> {{-- FIN col-12 --}}
                            </div> {{-- FIN modal-body .row --}}
                        </div> {{-- FIN modal-body --}}
                        {{-- =========================== --}}
                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="button" class="btn btn-primary btn-md active pull-right"
                                    data-bs-dismiss="modal" style="background-color: #337AB7;">
                                    <i class="fa fa-check-circle" aria-hidden="true">&nbsp;Aceptar</i>
                                </button>
                            </div>
                        </div>
                    </div> {{-- FIN modal-content --}}
                </div> {{-- FIN modal-dialog --}}
            </div> {{-- FIN modalAyudaModificacionProductos --}}

            {{-- =============================================================== --}}
            {{-- =============================================================== --}}

            {!! Form::open([
                'method' => 'POST',
                'route' => ['usuarios.store'],
                'class' => 'mt-2',
                'autocomplete' => 'off',
                'id' => 'formCrearUsuarios',
            ]) !!}
            @csrf

            @include('usuarios.fields_usuarios')

            {{-- ========================================================= --}}
            {{-- ========================================================= --}}

            <!-- Contenedor para el GIF -->
            <div id="loadingIndicatorStore" class="loadingIndicator">
                <img src="{{ asset('imagenes/loading.gif') }}" alt="Procesando...">
            </div>

            {{-- ========================================================= --}}
            {{-- ========================================================= --}}

            <div class="mt-4 mb-0 d-flex justify-content-center">
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
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Seleccionar...",
                allowClear: false,
                width: '100%'
            });

            let idEstado = $('#id_estado').val();
            console.log(idEstado);

            if (idEstado == 1 || idEstado == '') {
                $('#div_fecha_terminacion_contrato').hide();
                $('#fecha_terminacion_contrato').removeAttr('required');
            }

            $('#id_estado').change(function() {
                let idEstado = $('#id_estado').val();
                console.log(idEstado);

                if (idEstado == 1) { // Activo
                    $('#div_fecha_terminacion_contrato').hide();
                    $('#fecha_terminacion_contrato').removeAttr('required');
                } else if (idEstado == 2) { // Inactivo
                    $('#div_fecha_terminacion_contrato').show('slow');
                    $('#fecha_terminacion_contrato').attr('required');
                } else { // Seleccionar...
                    $('#div_fecha_terminacion_contrato').hide();
                    $('#fecha_terminacion_contrato').removeAttr('required');
                }
            });

            // ===================================================================================

            //======================== Validación de correo ==============================//


            const emailInput = document.getElementById('email');
            const errorMsg = document.getElementById('email-error');

            emailInput.addEventListener('blur', async () => {
                const email = emailInput.value.trim();
                const regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                errorMsg.classList.add('d-none');
                emailInput.classList.remove('is-invalid');

                if (!regexCorreo.test(email)) {
                    errorMsg.textContent = 'Ingrese un correo válido.';
                    errorMsg.classList.remove('d-none');
                    emailInput.classList.add('is-invalid');
                    return;
                }

                try {
                    const response = await fetch("{{ route('email_validator') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]')
                                .content
                        },
                        body: JSON.stringify({
                            email
                        })
                    });

                    if (!response.ok) throw new Error('Error en la petición');

                    const data = await response.json();

                    if (!data.valido) {
                        errorMsg.textContent = 'Este correo ya está registrado.';
                        emailInput.value = '';
                        errorMsg.classList.remove('d-none');
                        emailInput.classList.add('is-invalid');
                    }
                } catch (error) {
                    console.error('Error al validar el correo:', error);
                    errorMsg.textContent = 'Ocurrió un error. Intente más tarde.';
                    errorMsg.classList.remove('d-none');
                    emailInput.classList.add('is-invalid');
                }
            });

            //========================== Fin validación correo=================================//

            //======================== Validación de documento ==============================//


            const documentoInput = document.getElementById('identificacion');
            const errorDocumentoMsg = document.getElementById('documento-error');

            documentoInput.addEventListener('blur', async () => {
                const documento = documentoInput.value.trim();
                const regexDocumento = /^[0-9]+$/;
                errorDocumentoMsg.classList.add('d-none');
                documentoInput.classList.remove('is-invalid');

                if (documento === '') {
                    errorDocumentoMsg.textContent = 'Este campo es obligatorio.';
                    errorDocumentoMsg.classList.remove('d-none');
                    documentoInput.classList.add('is-invalid');
                    return;
                }

                if (!regexDocumento.test(documento)) {
                    errorDocumentoMsg.textContent = 'Ingrese una identificación válida.';
                    errorDocumentoMsg.classList.remove('d-none');
                    documentoInput.classList.add('is-invalid');
                    return;
                }

                try {
                    const response = await fetch("{{ route('identification_validator') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .content
                        },
                        body: JSON.stringify({
                            identificacion: documento
                        })
                    });

                    if (!response.ok) throw new Error('Error en la petición');

                    const data = await response.json();

                    if (!data.valido) {
                        errorDocumentoMsg.textContent = 'Este documento ya está registrado.';
                        documentoInput.value = '';
                        errorDocumentoMsg.classList.remove('d-none');
                        documentoInput.classList.add('is-invalid');
                    }
                } catch (error) {
                    console.error('Error al validar el documento:', error);
                    errorDocumentoMsg.textContent = 'Ocurrió un error. Intente más tarde.';
                    errorDocumentoMsg.classList.remove('d-none');
                    documentoInput.classList.add('is-invalid');
                }
            });
            //=========================== Fin validación documento ==============================//

            // ===================================================================================

            // formCrearUsuario para cargar gif en el submit
            $("form").on("submit", function(e) {
                const form = $(this);
                const submitButton = form.find('button[type="submit"]');
                const cancelButton = form.find('button[type="button"]');
                const loadingIndicator = form.find(
                    "div[id^='loadingIndicatorStore']"); // Busca el GIF del form actual

                // Dessactivar Botones
                submitButton.prop("disabled", true).html(
                    "Procesando... <i class='fa fa-spinner fa-spin'></i>");
                cancelButton.prop("disabled", true);

                // Mostrar Spinner
                loadingIndicator.show();
            });
        }); // FIN document.readey
    </script>
@stop
