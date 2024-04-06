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
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse d-lg-flex justify-content-lg-end" id="navbarNavDropdown">
                    <ul class="navbar-nav justify-content-between">
                        <li class="nav-item dropdown">
                            <li class="nav-item">
                                <a class="nav-link text-white" title="Ganancias" href="">
                                    <i class="fa fa-bar-chart fa-1x" aria-hidden="false"></i>
                                </a>
                            </li>
                        </li>

                        {{-- ==================== --}}

                        <li class="nav-item dropdown ms-2 me-2">
                            <a class="nav-link text-white" title="Acerca de" href="">
                                <i class="fa fa-info-circle fa-1x" aria-hidden="false"></i>
                            </a>
                        </li>

                        {{-- ==================== --}}
                        
                        <li class="nav-item dropdown">
                            <button type="button" title="Ayuda" class="nav-link text-white">
                                <i class="fa fa-question-circle fa-1x" aria-hidden="false"></i>
                            </button>

                            {{-- <a class="nav-link text-white" href="">
                                <i class="fa fa-question-circle fa-1x" aria-hidden="false"></i>
                            </a> --}}
                        </li>

                        {{-- ==================== --}}

                        <li class="nav-item dropdown ms-2 me-2">
                            <a href="" class="nav-link text-white"  title="Mapa Navegación">
                                <i class="fa fa-globe fa-1x" aria-hidden="false"></i>
                            </a>
                        </li>

                        {{-- ==================== --}}

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="Configuraciones">
                                <i class="fa fa-cog fa-1x" aria-hidden="false"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="">Configurar Ventas</a></li>
                                <li><a class="dropdown-item" href="">Configuración de Pago</a></li>
                            </ul>
                        </li>

                        {{-- ==================== --}}
                        
                        <li class="nav-item dropdown ms-2 me-2">
                            <a href="" class="nav-link text-white" title="Notificaciones">
                                <i class="fa fa-bell fa-1x" aria-hidden="false"></i>
                            </a>
                        </li>

                        {{-- ==================== --}}

                        <li class="nav-item dropdown">
                            <a  href="#" class="nav-link dropdown-toggle text-white" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="Usuario">
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
