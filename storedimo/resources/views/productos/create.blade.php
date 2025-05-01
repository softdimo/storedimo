@extends('layouts.app')
@section('title', 'Registrar Productos')

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
            <div class="d-flex justify-content-between pe-3 mt-2 mb-3">
                <div class="">
                    <a href="{{ route('productos.index') }}" class="btn text-white"
                        style="background-color:#337AB7">Productos</a>
                </div>

                <a href="#" role="button" title="Ayuda" class="text-blue" data-bs-toggle="modal"
                    data-bs-target="#modalAyudaRegistrarProductos">
                    <i class="fa fa-question-circle fa-2x" aria-hidden="false" title="Ayuda" style="color: #337AB7"></i>
                </a>
            </div>

            <div class="modal fade" id="modalAyudaRegistrarProductos" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static">
                <div class="modal-dialog" style="min-width: 60%;">
                    <div class="modal-content p-3">
                        <div class="modal-body p-0 rounded-top" style="border: solid 1px #337AB7; mw-50">
                            <div class="row">
                                <div class="col-12">
                                    <div class="rounded-top text-white text-center p-2"
                                        style="background-color: #337AB7; border: solid 1px #337AB7;">
                                        <span class="modal-title fs-4"><strong>Ayuda de Registrar Productos</strong></span>
                                    </div>
                                    {{-- =========================== --}}
                                    <div class="p-3">
                                        <p class="text-justify">Señor usuario a la hora de realizar un registro tener en
                                            cuenta las siguientes recomendaciones:</p>

                                        <ol>
                                            <li class="text-justify">Los campos marcados con asterisco (*) son obligatorios,
                                                por lo tanto sino se llenan el sistema no le dejará seguir.</li>
                                            <li class="text-justify">Evitar ingresar nombres de productos ya existentes.
                                            </li>
                                            <li class="text-justify">El precio unitario no puede ser mayor al precio al
                                                detal y precio al por mayor.</li>
                                            <li class="text-justify">El precio al detal no puede ser menor al precio al por
                                                mayor.</li>
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
                'route' => ['productos.store'],
                'class' => 'mt-2',
                'autocomplete' => 'off',
                'id' => 'formCrearProducto',
                'enctype' => 'multipart/form-data',
                'file' => true
            ]) !!}
                @csrf

                @include('productos.fields_crear_productos')
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
            
            // Valido si el nombre del producto existe
            $('#id_categoria').blur(function() {
                let nombreProducto = $('#nombre_producto').val();
                let idCategoria = $('#id_categoria').val();

                $.ajax({
                    url: "{{ route('verificar_producto') }}",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'nombre_producto': nombreProducto,
                        'id_categoria': idCategoria,
                    },
                    success: function(respuesta) {
                        console.log(respuesta);

                        if (respuesta == "existe_producto") {
                            Swal.fire(
                                'Cuidado!',
                                'Este producto ya existe!',
                                'warning'
                            )
                            $('#nombre_producto').val('');
                        }

                        if (respuesta == "error_exception") {
                            Swal.fire(
                                'Error!',
                                'No fue posible consultar el producto, intente nuevamente!',
                                'error'
                            )
                        }
                    }
                });
            });

            // =============================================

            // Valido que el precio unitario sea menor que el precio al detal
            $('#precio_detal').blur(function() {
                let precioUnitario = parseFloat($('#precio_unitario').val()) || 0;
                let precioDetal = parseFloat($('#precio_detal').val()) || 0;

                if (precioUnitario >= precioDetal) {
                    Swal.fire(
                        'Cuidado!',
                        'El precio unitario debe ser menor que el precio al detal!',
                        'warning'
                    )
                    $('#precio_detal').val('');
                }
            });

            // =============================================

            // Valido que el precio unitario sea menor que el precio al detal
            $('#precio_por_mayor').blur(function() {
                let precioUnitario = parseFloat($('#precio_unitario').val()) || 0;
                let precioDetal = parseFloat($('#precio_detal').val()) || 0;
                let precioPorMayor = parseFloat($('#precio_por_mayor').val()) || 0;

                console.log(precioUnitario);
                console.log(precioDetal);
                console.log(precioPorMayor);

                if (precioPorMayor <= precioUnitario || precioPorMayor >= precioDetal) {
                    Swal.fire(
                        'Cuidado!',
                        'El precio al por mayor debe ser superior al precio unitario y menor que el precio al detal!',
                        'warning'
                    )
                    $('#precio_por_mayor').val('');
                }
            });


            //======================== Validación de referencia ==============================//


            const referenceInput = document.getElementById('referencia');
            const errorReferenceMsg = document.getElementById('reference-error');

            referenceInput.addEventListener('blur', async () => {
                const reference = referenceInput.value.trim();
                const regexReferencia = /^[a-zA-Z0-9_-]+$/;
                errorReferenceMsg.classList.add('d-none');
                referenceInput.classList.remove('is-invalid');

                if (reference === '') {
                    errorReferenceMsg.textContent = 'Este campo es obligatorio.';
                    errorReferenceMsg.classList.remove('d-none');
                    referenceInput.classList.add('is-invalid');
                    return;
                }

                if (!regexReferencia.test(reference)) {
                    errorReferenceMsg.textContent = 'Ingrese una referencia válida.';
                    errorReferenceMsg.classList.remove('d-none');
                    referenceInput.classList.add('is-invalid');
                    return;
                }

                try {
                    const response = await fetch("{{ route('verificar_referencia') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .content
                        },
                        body: JSON.stringify({
                            referencia: reference
                        })
                    });

                    if (!response.ok) throw new Error('Error en la petición');

                    const data = await response.json();

                    if (!data.valido) {
                        errorReferenceMsg.textContent = 'Esta referencia ya está registrada.';
                        referenceInput.value = '';
                        errorReferenceMsg.classList.remove('d-none');
                        referenceInput.classList.add('is-invalid');
                    }
                } catch (error) {
                    console.error('Error al validar la referencia:', error);
                    errorReferenceMsg.textContent = 'Ocurrió un error. Intente más tarde.';
                    errorReferenceMsg.classList.remove('d-none');
                    referenceInput.classList.add('is-invalid');
                }
            });
            //=========================== Fin validación de referencia ==============================//

            // =============================================

            // formCrearCategoria para cargar gif en el submit
            $(document).on("submit", "form[id^='formCrearProducto']", function(e) {
                const form = $(this);
                const submitButton = form.find('button[type="submit"]');
                const cancelButton = form.find('button[type="button"]');
                const loadingIndicator = form.find(
                "div[id^='loadingIndicatorCrearProducto']"); // Busca el GIF del form actual

                // Dessactivar Submit y Cancel
                submitButton.prop("disabled", true).html(
                    "Procesando... <i class='fa fa-spinner fa-spin'></i>");
                cancelButton.prop("disabled", true);

                // Mostrar Spinner
                loadingIndicator.show();
            });
        }); // FIN document.ready

        // =============================================

        // Funcionalidad input tipo file para imagen producto
        function displaySelectedFile(inputId, displayElementId) {
            const input = document.getElementById(inputId);
            const displayElement = document.getElementById(displayElementId);
            const file = input.files[0];

            // Reset
            displayElement.textContent = '';
            displayElement.classList.add('hidden');

            if (file) {
                const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
                const maxSizeMB = 2;
                const fileSizeMB = file.size / (1024 * 1024);

                if (!allowedTypes.includes(file.type)) {
                    displayElement.textContent = 'Formato no permitido. Solo JPG, JPEG, PNG o WEBP.';
                    displayElement.classList.remove('hidden');
                    input.value = ''; // limpia el input
                    return;
                }

                if (fileSizeMB > maxSizeMB) {
                    displayElement.textContent = 'El archivo excede los 2MB permitidos.';
                    displayElement.classList.remove('hidden');
                    input.value = ''; // limpia el input
                    return;
                }

                // Todo bien
                displayElement.textContent = file.name;
                displayElement.classList.remove('hidden');
            }
        }

        // function displaySelectedFile(inputId, displayElementId) {
        //     const input = document.getElementById(inputId);
        //     const selectedFile = input.files[0];
        //     const displayElement = document.getElementById(displayElementId);

        //     if (selectedFile) {
        //         const selectedFileName = selectedFile.name;
        //         displayElement.textContent = selectedFileName;
        //         displayElement.classList.remove('hidden');
        //     } else {
        //         displayElement.textContent = '';
        //         displayElement.classList.add('hidden');
        //     }
        // }
    </script>
@stop
