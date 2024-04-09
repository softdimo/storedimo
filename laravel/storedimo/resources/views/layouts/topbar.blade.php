<header class="topbar m-0">
    <nav class="navbar navbar-expand-lg m-0 text-white" data-bs-theme="dark" style="background-color: #337AB7">
        <div class="row p-0 w-100 align-items-lg-center justify-content-between">
            <div class="logo-container col-4 col-md-2 text-center">
                <a class="w-100" href="/home">
                    <img src="{{asset('imagenes/logo.png')}}" alt="Logo" width="150" height="40" class="text-center">
                </a>
            </div>
            {{-- ========================================== --}}
            <div class="menu-container col-4 col-md-8">
                <div class="collapse d-lg-flex justify-content-lg-end" id="navbarNavDropdown">
                    <ul class="navbar-nav justify-content-between">
                        <li class="nav-item" data-bs-toggle="modal" data-bs-target="#modal_ganancias">
                            <a href="#" title="Ganancias" class="nav-link text-white">
                                <i class="fa fa-bar-chart fa-1x" aria-hidden="false"></i>
                            </a>
                        </li>

                        {{-- ==================== --}}

                        <li class="nav-item ms-2 me-2" data-bs-toggle="modal" data-bs-target="#modal_informacion">
                            <a href="#" title="Acerca de" class="nav-link text-white">
                                <i class="fa fa-info-circle fa-1x" aria-hidden="false"></i>
                            </a>
                        </li>

                        {{-- ==================== --}}
                        
                        <li class="nav-item" data-bs-toggle="modal" data-bs-target="#modal_ayuda">
                            <a href="#" title="Ayuda" class="nav-link text-white">
                                <i class="fa fa-question-circle fa-1x" aria-hidden="false"></i>
                            </a>
                        </li>

                        {{-- ==================== --}}

                        <li class="nav-item dropdown" data-bs-toggle="modal" data-bs-target="#modal_configuraciones">
                            <a href="#" title="Configuraciones" class="nav-link dropdown-toggle text-white" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-cog fa-1x" aria-hidden="false"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="">Configurar Ventas</a></li>
                                <li><a class="dropdown-item" href="">Configuración de Pago</a></li>
                            </ul>
                        </li>

                        {{-- ==================== --}}
                        
                        <li class="nav-item dropdown ms-2 me-2" data-bs-toggle="modal" data-bs-target="#modal_notificaciones">
                            <a href="#" title="Notificaciones" class="nav-link text-white">
                                <i class="fa fa-bell fa-1x" aria-hidden="false"></i>
                            </a>
                        </li>

                        {{-- ==================== --}}

                        <li class="nav-item dropdown" data-bs-toggle="modal" data-bs-target="#modal_usuario">
                            <a  href="#" title="Usuario" class="nav-link dropdown-toggle text-white" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-user fa-fw fa-1x" aria-hidden="false"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="">SuperAdmin</a></li>
                                <li><a class="dropdown-item" href="">Cerrar Sesión</a></li>
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
<div class="modal fade p-3" id="modal_ganancias" tabindex="-1" data-bs-backdrop="false" data-bs-keyboard="true" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-3">
            <div class="" style="border: solid 1px #337AB7;">
                <div class="rounded-top text-white text-center" style="background-color: #337AB7; border: solid 1px #337AB7;">
                    <h5>Ganancias</h5>
                </div>

                {{-- ====================================================== --}}
                {{-- ====================================================== --}}

                <div class="modal-body">
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
                </div>

                {{-- ====================================================== --}}
                {{-- ====================================================== --}}

                <button type="button" class="btn btn-secondary d-flex justify-content-end" data-bs-dismiss="modal">
                    <i class="fa fa-remove" aria-hidden="true">Cerrar</i>
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
<div class="modal fade" id="modal_informacion" style="border: solid 1px #337AB7;" tabindex="-1" data-bs-backdrop="false" data-bs-keyboard="true" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="rounded-top text-white text-center" style="background-color: #337AB7; border: solid 1px #337AB7;">
                <h5>Información</h5>
            </div>

            {{-- ====================================================== --}}
            {{-- ====================================================== --}}

            <div class="modal-body">
                <div class="row m-0 p-0">
                    <div class="col-12">
                        <p>© Softdimo. Todos los derechos reservados</p>
                    </div>
                </div>
            </div>

            {{-- ====================================================== --}}
            {{-- ====================================================== --}}

            <button type="button" class="btn btn-secondary d-flex justify-content-end" data-bs-dismiss="modal">
                <i class="fa fa-check-circle" aria-hidden="true">Aceptar</i>
            </button>
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
<div class="modal fade" id="modal_ayuda" style="border: solid 1px #337AB7;" tabindex="-1" data-bs-backdrop="false" data-bs-keyboard="true" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="rounded-top text-white text-center" style="background-color: #337AB7; border: solid 1px #337AB7;">
                <h5>Ayuda</h5>
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

            {{-- ====================================================== --}}
            {{-- ====================================================== --}}

            <button type="button" class="btn btn-secondary d-flex justify-content-end" data-bs-dismiss="modal">
                <i class="fa fa-check-circle" aria-hidden="true">Aceptar</i>
            </button>
        </div>
    </div>
</div>
{{-- FINAL Modal AYUDA --}}

