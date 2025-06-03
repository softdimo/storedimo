@extends('layouts.app')
@section('title', 'Login')

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
    <div class="d-flex justify-content-center align-items-center bg-light py-4 vh-100">
        <div class="border border-dark-subtle p-4 shadow-lg rounded-4 bg-white text-center w-25" style="overflow-y: auto;">
            <div class="d-flex justify-content-center p-3">
                <img src="{{asset('imagenes/logo_storedimo_fondo.png')}}" alt="logo" class="text-center" width="200" height="100">
            </div>
            
            <form class="p-3" method="post" action="{{route('login.store')}}" autocomplete="off">
                @csrf
                
                <h3 class="mb-4 fw-bold text-primary">Iniciar Sesión</h3>

                <div class="mb-4">
                    {{ Form::select('id_empresa', collect(['' => 'Seleccione Empresa...'])->union($empresas), null, ['class' => 'form-select select2', 'id' => 'id_empresa', 'required']) }}
                </div>
                
                <div class="mb-4">
                    <input type="text" name="usuario" id="usuario" class="w-100 form-control p-3" placeholder="Usuario *" required>
                </div>
                
                <div class="mb-4 position-relative">
                    <input type="password" name="clave" id="clave" class="w-100 form-control p-3" placeholder="Contraseña *" required>
                    <span class="btn-show-pass position-absolute top-50 end-0 translate-middle-y me-3">
                        <i class="zmdi zmdi-eye fs-5"></i>
                    </span>
                </div>
                
                <button class="btn btn-primary btn-lg w-100" type="submit">Iniciar Sesión</button>
                
                <div class="mt-3">
                    <a href="{{route('recuperar_clave')}}" class="text-primary">¿Olvidó la Contraseña?</a>
                </div>
            </form>
        </div>
    </div>
@stop

{{-- =============================================================== --}}
{{-- =============================================================== --}}
{{-- =============================================================== --}}

@section('scripts')
    <script>
        $( document ).ready(function() {
            // Limpieza inicial
            $("#id_empresa").focus();

            $("#usuario").hide();
            $("#clave").hide();

            $("#id_empresa").change(function() {
                var idEmpresa = $(this).val();
                console.log("idEmpresa:", idEmpresa);

                if (idEmpresa != '') {
                    $.ajax({
                        url: "{{route('empresa_datos_conexion')}}",
                        method: "POST",
                        data: {
                            id_empresa: idEmpresa,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        beforeSend: function() {
                            $("#usuario").hide().val('').removeAttr("required");
                            $("#clave").hide().val('').removeAttr("required");
                        },
                        success: function(response) {
                            if (response) {
                                $("#usuario").show().attr("required", "required");
                                $("#clave").show().attr("required", "required");

                                console.log("Datos recibidos:", response);

                                // 🔁 Segundo AJAX para guardar datos en el .env
                                $.ajax({
                                    url: "{{route('guardar_datos_env')}}",
                                    method: "POST",
                                    data: {
                                        _token: $('meta[name="csrf-token"]').attr('content'),
                                        app_key: response.app_key,
                                        app_url: response.app_url,
                                        db_connection: response.tipo_bd,
                                        db_database: response.db_database,
                                        db_username: response.db_username,
                                        db_password: response.db_password
                                    },
                                    success: function(resp) {
                                        console.log("Datos guardados correctamente en el .env");
                                        
                                    },
                                    error: function(err) {
                                        console.log("Error guardando datos en el .env");
                                    }
                                });
                            } else {
                                console.log("No se pudieron obtener los datos de conexión.");
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Error AJAX, consultando la empresa:", error);
                        }
                    });

                } else {
                    $("#usuario").hide().val('').removeAttr("required");
                    $("#clave").hide().val('').removeAttr("required");
                }
            });
        }); // FIN document.ready
    </script>
@stop


