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
                    <a href="{{route('productos.index')}}" class="btn text-white" style="background-color:#337AB7">Productos</a>
                </div>

                <a href="#" role="button" title="Ayuda" class="text-blue" data-bs-toggle="modal" data-bs-target="#modalAyudaRegistrarProductos">
                    <i class="fa fa-question-circle fa-2x" aria-hidden="false" title="Ayuda" style="color: #337AB7"></i>
                </a>
            </div>

            {{-- <div class="text-end">
                <a href="#" role="button" title="Ayuda" class="text-blue" data-bs-toggle="modal" data-bs-target="#modalAyudaRegistrarProductos">
                    <i class="fa fa-question-circle fa-2x" aria-hidden="false" title="Ayuda" style="color: #337AB7"></i>
                </a>
            </div> --}}

            <div class="modal fade h-auto modal-gral p-3" id="modalAyudaRegistrarProductos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static" style="max-width: 55%;">
                <div class="modal-dialog m-0 mw-100">
                    <div class="modal-content border-0">
                        <div class="modal-body p-0 rounded-top" style="border: solid 1px #337AB7; mw-50">
                            <div class="row">
                                <div class="col-12">
                                    <div class="rounded-top text-white text-center p-2" style="background-color: #337AB7; border: solid 1px #337AB7;">
                                        <span class="modal-title fs-4"><strong>Ayuda de Registrar Productos</strong></span>
                                    </div>
                                    {{-- =========================== --}}
                                    <div class="p-3">
                                        <p class="text-justify">Señor usuario a la hora de realizar un registro tener en cuenta las siguientes recomendaciones:</p>
    
                                        <ol>
                                            <li class="text-justify">Los campos marcados con asterisco (*) son obligatorios, por lo tanto sino se llenan el sistema no le dejará seguir.</li>
                                            <li class="text-justify">Evitar ingresar nombres de productos ya existentes.</li>
                                            <li class="text-justify">El precio unitario no puede ser mayor al precio al detal y precio al por mayor.</li>
                                            <li class="text-justify">El precio al detal no puede ser menor al precio al por mayor.</li>
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

            {!! Form::open(['method' => 'POST', 'route' => ['productos.store'], 'class' => 'mt-2', 'autocomplete' => 'off', 'id' => 'formCrearProducto']) !!}
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
        $( document ).ready(function() {
            // Valido si el nombre del producto existe
            $('#id_categoria').blur(function () {
                let nombreProducto = $('#nombre_producto').val();
                let idCategoria = $('#id_categoria').val();
                
                $.ajax({
                    url: "{{route('verificar_producto')}}",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'nombre_producto': nombreProducto,
                        'id_categoria': idCategoria,
                    },
                    success: function (respuesta) {
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
            $('#precio_detal').blur(function () {
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
            $('#precio_por_mayor').blur(function () {
                let precioUnitario = parseFloat($('#precio_unitario').val()) || 0;
                let precioDetal = parseFloat($('#precio_detal').val()) || 0;
                let precioPorMayor = parseFloat($('#precio_por_mayor').val()) || 0;

                console.log(precioUnitario);
                console.log(precioDetal);
                console.log(precioPorMayor);

                if ( precioPorMayor <= precioUnitario || precioPorMayor >= precioDetal) {
                    Swal.fire(
                        'Cuidado!',
                        'El precio al por mayor debe ser superior al precio unitario y menor que el precio al detal!',
                        'warning'
                    )
                    $('#precio_por_mayor').val('');
                }
            });

            // =============================================

            // formCrearCategoria para cargar gif en el submit
            $(document).on("submit", "form[id^='formCrearProducto']", function(e) {
                const form = $(this);
                const submitButton = form.find('button[type="submit"]');
                const cancelButton = form.find('button[type="button"]');
                const loadingIndicator = form.find("div[id^='loadingIndicatorCrearProducto']"); // Busca el GIF del form actual

                // Dessactivar Submit y Cancel
                submitButton.prop("disabled", true).html("Procesando... <i class='fa fa-spinner fa-spin'></i>");
                cancelButton.prop("disabled", true);

                // Mostrar Spinner
                loadingIndicator.show();
            });
        }); // FIN document.ready
    </script>
@stop


