<style>
    /* Cambia el color de fondo del li al pasar el ratón sobre él */
    /* .hover-li:hover {
      background-color: #337AB7;
    } */
</style>

<header class="topbar m-0">
    <nav class="navbar navbar-expand-lg m-0 text-white" data-bs-theme="dark" style="background-color: #337AB7">
        <div class="row p-0 w-100 align-items-lg-center justify-content-between">
            <div class="logo-container col-4 col-md-2 text-center">
                <a class="w-100" href="/home">
                    <img src="{{asset('imagenes/logo_storedimo.png')}}" alt="Logo" width="140" height="50" class="text-center">
                </a>
            </div>
            {{-- ========================================== --}}
            <div class="menu-container col-4 col-md-8">
                <div class="collapse d-lg-flex justify-content-lg-end" id="navbarNavDropdown">
                    <ul class="navbar-nav justify-content-between">
                        <li class="nav-item" data-bs-toggle="modal" data-bs-target="#modal_ganancias">
                            <a href="#" title="Ganancias" class="nav-link text-white">
                                <i class="fa fa-bar-chart fa-1x"></i>
                            </a>
                        </li>

                        {{-- ==================== --}}

                        <li class="nav-item ms-2 me-2" data-bs-toggle="modal" data-bs-target="#modal_informacion">
                            <a href="#" title="Acerca de" class="nav-link text-white">
                                <i class="fa fa-info-circle fa-1x"></i>
                            </a>
                        </li>

                        {{-- ==================== --}}
                        
                        <li class="nav-item" data-bs-toggle="modal" data-bs-target="#modal_ayuda">
                            <a href="#" title="Ayuda" class="nav-link text-white">
                                <i class="fa fa-question-circle fa-1x"></i>
                            </a>
                        </li>

                        {{-- ==================== --}}

                        <li class="nav-item dropdown">
                            <a href="#" title="Configuraciones" class="nav-link dropdown-toggle text-white" data-bs-toggle="dropdown">
                                <i class="fa fa-cog fa-1x"></i>
                            </a>
                            <ul class="dropdown-menu bg-white" style="right:0;left:auto">
                                <li class="nav-item" data-bs-toggle="modal" data-bs-target="#modal_configurar_ventas">
                                    <a href="#" class="dropdown-item text-dark hover-li">Configurar Ventas</a>
                                </li>
                                <li class="nav-item" data-bs-toggle="modal" data-bs-target="#modal_configurar_pago">
                                    <a href="#" class="dropdown-item text-dark hover-li">Configuración de Pago</a>
                                </li>
                            </ul>
                        </li>

                        {{-- ==================== --}}

                        <li class="nav-item dropdown">
                            <a href="#" title="Notificaciones" class="nav-link text-white" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-bell fa-1x"></i>
                            </a>
                            <ul class="dropdown-menu bg-white" style="right:0;left:auto">
                                <li class="nav-item">
                                    <a href="{{route('stock_minimo')}}" class="dropdown-item text-dark hover-li">Hay productos por debajo del stock mínimo</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('prestamos_vencer')}}" class="dropdown-item text-dark hover-li">Hay Préstamos a punto de vencer</a>
                                </li>
                            </ul>
                        </li>

                        {{-- ==================== --}}

                        <li class="nav-item dropdown" data-bs-toggle="modal" data-bs-target="#modal_usuario">
                            <a  href="#" title="Usuario" class="nav-link dropdown-toggle text-white" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-user fa-fw fa-1x"></i>
                            </a>
                            <ul class="dropdown-menu bg-white" style="right:0;left:auto">
                                <li class="dropdown-item text-dark hover-li">
                                    <i class="fa fa-user fa-fw fa-1x"></i> {{ $usuarioLogueado->rol }}
                                    <h6 class="text-danger">{{ $usuarioLogueado->nombre_usuario }} {{ $usuarioLogueado->apellido_usuario }}</h6>
                                </li>

                                <li class="dropdown-item text-dark hover-li">
                                    <i class="fa fa-sign-out fa-fw fa-1x">
                                        <a href="{{route('logout')}}" class="" style="text-decoration: none;">Cerrar Sesión</a>
                                    </i>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>

{{-- ==================================================================================== --}}
{{-- ==================================================================================== --}}
{{-- ==================================================================================== --}}
{{-- ==================================================================================== --}}
{{-- ==================================================================================== --}}


{{-- INICIO Modal GANANCIAS --}}
<div class="modal fade p-3 modal-gral h-auto" id="modal_ganancias" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog m-0">
        <div class="modal-content border-0">
            <div class="rounded-top" style="border: solid 1px #337AB7">
                <div class="rounded-top text-white text-center" style="background-color: #337AB7; border: solid 1px #337AB7;">
                    <h5>Ganancias</h5>
                </div>

                {{-- ====================================================== --}}
                {{-- ====================================================== --}}

                <div class="modal-body p-3">
                    <div class="row m-0 p-0">
                        <div class="col-12 col-md-6">
                            <div class="form-group d-flex flex-column">
                                <label for="fecha_inicial" class="">Fecha Inicial<span class="textx-danger">*</span></label>
                                {{ Form::date('fecha_inicial', null, ['class'=>'form-control', 'id'=>'fecha_inicial']) }}
                            </div>
                        </div>

                        <div class="col-12 col-md-6 form-group d-flex flex-column">
                            <div class="form-group d-flex flex-column">
                                <label for="fecha_final" class="">Fecha Final<span class="textx-danger">*</span></label>
                                {{ Form::date('fecha_final', null,['class' => 'form-control', 'id' => 'fecha_final']) }}
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mt-5">
                        <button type="button" class="btn btn-primary" id="btn_consultar_ganancias" name="btnconsultarganancia" onclick="consultarGanancia()">
                            <i class="fa fa-building-o" data-bs-toggle="modal" data-bs-target="#modal_generar_ganancias"> Generar Ganancias</i></button>
                    </div>
                </div>
            </div>
            
            {{-- ====================================================== --}}
            {{-- ====================================================== --}}

            <div class="d-flex justify-content-end mt-2 p-3">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                    <i class="fa fa-remove"> Cerrar</i>
                </button>
            </div>
        </div>
    </div>
</div>
{{-- FINAL Modal GANANCIAS --}}

{{-- ==================================================================================== --}}
{{-- ==================================================================================== --}}
{{-- ==================================================================================== --}}
{{-- ==================================================================================== --}}
{{-- ==================================================================================== --}}


{{-- INICIO Modal INFORMACIÓN --}}
<div class="modal fade modal-gral h-auto" id="modal_informacion" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog m-0">
        <div class="modal-content border-0">
            <div class="rounded-top" style="border: solid 1px #337AB7">
                <div class="rounded-top text-white text-center" style="background-color: #337AB7; border: solid 1px #337AB7;">
                    <h5>Información</h5>
                </div>

                {{-- ====================================================== --}}
                {{-- ====================================================== --}}

                <div class="modal-body p-3">
                    <div class="row m-0 p-0">
                        <div class="col-12">
                            <p>© Softdimo. Todos los derechos reservados</p>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- ====================================================== --}}
            {{-- ====================================================== --}}

            <div class="d-flex justify-content-end mt-2 p-3">
                <button type="button" class="btn btn-primary d-flex justify-content-end" data-bs-dismiss="modal">
                    <i class="fa fa-check-circle"> Aceptar</i>
                </button>
            </div>
        </div>
    </div>
</div>
{{-- FINAL Modal INFORMACIÓN --}}

{{-- ==================================================================================== --}}
{{-- ==================================================================================== --}}
{{-- ==================================================================================== --}}
{{-- ==================================================================================== --}}
{{-- ==================================================================================== --}}


{{-- INICIO Modal AYUDA --}}
<div class="modal fade modal-gral h-auto" id="modal_ayuda" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog m-0">
        <div class="modal-content border-0">
            <div class="rounded-top" style="border: solid 1px #337AB7">
                <div class="rounded-top text-white text-center" style="background-color: #337AB7; border: solid 1px #337AB7;">
                    <h5>Ayudas</h5>
                </div>

                {{-- ====================================================== --}}
                {{-- ====================================================== --}}

                <div class="modal-body">
                    <div class="row m-0 p-0">
                        <div class="col-12">
                            <p>El icono ayuda en forma de pregunta "?", estará ubicado en la parte superior de cada una de las vistas con el fin de dar una orientación al usuario de aquellos procesos más complejos de la aplicación.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- ====================================================== --}}
            {{-- ====================================================== --}}

            <div class="d-flex justify-content-end mt-2 p-3">
                <button type="button" class="btn btn-primary d-flex justify-content-end" data-bs-dismiss="modal">
                    <i class="fa fa-check-circle"> Aceptar</i>
                </button>
            </div>
        </div>
    </div>
</div>
{{-- FINAL Modal AYUDA --}}

{{-- ==================================================================================== --}}
{{-- ==================================================================================== --}}
{{-- ==================================================================================== --}}
{{-- ==================================================================================== --}}
{{-- ==================================================================================== --}}


{{-- INICIO Modal CONFIGURAR VENTAS --}}
<div class="modal fade modal-gral h-auto" id="modal_configurar_ventas" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog m-0">
        <div class="modal-content border-0">
            <div class="rounded-top" style="border: solid 1px #337AB7;">
                <div class="rounded-top text-white text-center" style="background-color: #337AB7; border: solid 1px #337AB7;">
                    <h5>Configuración Ventas</h5>
                </div>

                {{-- ====================================================== --}}
                {{-- ====================================================== --}}

                <div class="modal-body p-0 m-0">
                    <div class="row m-0 pt-4 pb-4">
                        <div class="col-12 col-md-6">
                            <div class="form-group d-flex flex-column">
                                <label for="v_minimo_subtotal" class="" style="font-size: 15px">Valor Mínimo Subtotal<span class="text-danger">*</span></label>
                                {{ Form::text('v_minimo_subtotal', null, ['class'=>'form-control', 'id'=>'v_minimo_subtotal']) }}
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group d-flex flex-column">
                                <label for="p_minimo_descuento" class="" style="font-size: 15px">% Mínimo Descuento<span class="text-danger">*</span></label>
                                {{ Form::text('p_minimo_descuento', null,['class' => 'form-control', 'id' => 'p_minimo_descuento']) }}
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mt-md-3">
                            <div class="form-group d-flex flex-column">
                                <label for="v_maximo_subtotal" class="" style="font-size: 15px">Valor Máximo Subtotal<span class="text-danger">*</span></label>
                                {{ Form::text('v_maximo_subtotal', null, ['class'=>'form-control', 'id'=>'v_maximo_subtotal']) }}
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mt-md-3">
                            <div class="form-group d-flex flex-column">
                                <label for="p_maximo_descuento" class="" style="font-size: 15px">% Máximo Descuento<span class="text-danger">*</span></label>
                                {{ Form::text('p_maximo_descuento', null,['class'=>'form-control', 'id'=>'p_maximo_descuento']) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- ====================================================== --}}
            {{-- ====================================================== --}}

            <div class="d-flex justify-content-between mt-3">
                <div>
                    <button type="button" class="btn btn-secondary" title="Cancelar" data-bs-dismiss="modal">
                        <i class="fa fa-floppy-o"> Cancelar</i>
                    </button>
                </div>

                <div>
                    <button type="button" class="btn btn-success" title="Guardar Configuración">
                        <i class="fa fa-floppy-o"> Guardar</i>
                    </button>
                    
                    <button type="button" class="btn btn-primary ms-3" title="Modificar Configuración">
                        <i class="fa fa-pencil-square-o"> Modificar</i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- FINAL Modal CONFIGURAR VENTAS --}}

{{-- ==================================================================================== --}}
{{-- ==================================================================================== --}}
{{-- ==================================================================================== --}}
{{-- ==================================================================================== --}}
{{-- ==================================================================================== --}}


{{-- INICIO Modal CONFIGURAR PAGOS --}}
<div class="modal fade modal-gral h-auto" id="modal_configurar_pago" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog m-0">
        <div class="modal-content border-0">
            <div class="rounded-top" style="border: solid 1px #337AB7;">
                <div class="rounded-top text-white text-center" style="background-color: #337AB7; border: solid 1px #337AB7;">
                    <h5>Configuración Pagos</h5>
                </div>

                {{-- ====================================================== --}}
                {{-- ====================================================== --}}

                <div class="modal-body p-0 m-0">
                    <div class="row m-0 pt-4 pb-4">
                        <div class="col-12 col-md-6">
                            <div class="form-group d-flex flex-column">
                                <label for="v_base_liquidacion" class="" style="font-size: 15px">Valor Base Liquidación<span class="text-danger">*</span></label>
                                {{ Form::text('v_base_liquidacion', null, ['class'=>'form-control', 'id'=>'v_base_liquidacion']) }}
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group d-flex flex-column">
                                <label for="periodo_pago" class="" style="font-size: 15px">Período de Pago<span class="text-danger">*</span></label>
                                {{Form::select('periodo_pago', collect(['' => 'Seleccionar...'])->union($periodos_pago), null, ['class' => 'form-select', 'id' => 'periodo_pago'])}}
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mt-md-3">
                            <div class="form-group d-flex flex-column">
                                <label for="porcentaje_comision" class="" style="font-size: 15px">Porcentaje Comisión<span class="text-danger">*</span></label>
                                {{Form::select('porcentaje_comision', collect(['' => 'Seleccionar...'])->union($porcentajes_comision), null, ['class' => 'form-select', 'id' => 'porcentaje_comision'])}}
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mt-md-3">
                            <div class="form-group d-flex flex-column">
                                <label for="v_dia_empleado_fijo" class="" style="font-size: 15px">Valor día empleado fijo<span class="text-danger">*</span></label>
                                {{ Form::text('v_dia_empleado_fijo', null,['class'=>'form-control', 'id'=>'v_dia_empleado_fijo']) }}
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-6 mt-md-3">
                            <div class="form-group d-flex flex-column">
                                <label for="v_día_empleado_temporal" class="" style="font-size: 15px">Valor día empleado temporal<span class="text-danger">*</span></label>
                                {{ Form::text('v_día_empleado_temporal', null,['class'=>'form-control', 'id'=>'v_día_empleado_temporal']) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- ====================================================== --}}
            {{-- ====================================================== --}}

            <div class="d-flex justify-content-between mt-3">
                <div>
                    <button type="button" class="btn btn-secondary" title="Cancelar" data-bs-dismiss="modal">
                        <i class="fa fa-remove"> Cancelar</i>
                    </button>
                </div>

                <div>
                    <button type="button" class="btn btn-success" title="Guardar">
                        <i class="fa fa-floppy-o"> Guardar</i>
                    </button>
                    
                    <button type="button" class="btn btn-primary ms-3" title="Modificar">
                        <i class="fa fa-pencil-square-o"> Modificar</i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- FINAL Modal CONFIGURAR PAGOS --}}

