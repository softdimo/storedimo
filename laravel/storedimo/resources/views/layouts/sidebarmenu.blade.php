<aside class="vh-100" style="border: 1px solid #e7e7e7">
    <nav class="w-100 " role="">
        <ul class="nav navbar-nav d-flex flex-column justify-content-center flex-nowrap" id="sidebarnav">
            <li class="pt-1 pb-1 d-flex justify-content-between align-items-center" style="background-color: #EEEEEE; border-bottom: 1px solid #e7e7e7">
                <i class="fa fa-th-list text-center" style="color: #000; width: 10%"></i>
                <a href="/home" class="nav-link active text-decoration-none text-start" style="width: 80%">Menú Principal</a>
                <span class="" style="width: 10%"></span>
            </li>

            {{-- ==================================== --}}

            <li class="nav-item pt-1 pb-1 d-flex flex-column" style="border-bottom: 1px solid #e7e7e7">
                <div class="d-flex flex-row justify-content-between align-items-center colapsar" id="usuarios" role="button" data-bs-toggle="collapse" data-bs-target="#ul_usuarios" aria-controls="ul_usuarios" aria-expanded="false" aria-label="Toggle navigation">
                    <div class="col-11">
                        <i class="fa fa-users text-center" style="color: #000; width: 10%"></i>
                        <a href="#" class="text-decoration-none" style="width: 80%" id="">Usuarios</a>
                    </div>
                    <div class="col-1 text-center text-dark">
                        <span class="fa collapse-icon" aria-hidden="false" style=""></span>
                    </div>
                </div>

                <ul class="nav collapse navbar-collapse ps-3" id="ul_usuarios">
                    <li class="nav-item w-100">
                        <a class="link-underline-light" href="{{route('usuarios.create')}}">Registrar Usuarios</a>
                    </li>
                    <li class="nav-item w-100">
                        <a class="link-underline-light" href="{{route('usuarios.index')}}">Listar Usuarios</a>
                    </li>
                </ul>
            </li>

            {{-- ==================================== --}}

            <li class="nav-item pt-1 pb-1 d-flex flex-column" style="border-bottom: 1px solid #e7e7e7">
                <div class="d-flex flex-row justify-content-between align-items-center colapsar" id="personas" role="button" data-bs-toggle="collapse" data-bs-target="#ul_personas" aria-controls="ul_personas" aria-expanded="false" aria-label="Toggle navigation">
                    <div class="col-11">
                        <i class="fa fa-users text-center" style="color: #000; width: 10%"></i>
                        <a href="#" class="text-decoration-none" style="width: 80%" id="">Personas</a>
                    </div>
                    <div class="col-1 text-center text-dark">
                        <span class="fa collapse-icon" aria-hidden="false" style=""></span>
                    </div>
                </div>

                <ul class="nav collapse navbar-collapse ps-3" id="ul_personas">
                    <li class="nav-item w-100">
                        <a class="link-underline-light" href="{{route('personas.create')}}">Registrar Personas</a>
                    </li>
                    <li class="nav-item w-100">
                        {{-- <a class="link-underline-light" href="{{route('personas.index')}}">Listar Personas</a> --}}
                    </li>
                    <li class="nav-item w-100">
                        <a class="link-underline-light" href="{{route('listar_proveedores')}}">Listar Proveedores</a>
                    </li>
                    <li class="nav-item w-100">
                        <a class="link-underline-light" href="{{route('listar_clientes')}}">Listar Clientes</a>
                    </li>
                </ul>
            </li>

            {{-- ==================================== --}}

            <li class="nav-item pt-1 pb-1 d-flex flex-column" style="border-bottom: 1px solid #e7e7e7">
                <div class="d-flex flex-row justify-content-between align-items-center colapsar" id="personas"  role="button" data-bs-toggle="collapse" data-bs-target="#ul_categorias" aria-controls="ul_categorias" aria-expanded="false" aria-label="Toggle navigation">
                    <div class="col-11">
                        <i class="fa fa-database text-center" style="color: #000; width: 10%"></i>
                        <a href="#" class="text-decoration-none" style="width: 80%" id="">Categorías</a>
                    </div>
                    <div class="col-1 text-center text-dark">
                        <span class="fa collapse-icon" aria-hidden="false" style=""></span>
                    </div>
                </div>

                <ul class="nav collapse navbar-collapse ps-3" id="ul_categorias">
                    <li class="nav-item w-100">
                        <a class="link-underline-light" href="{{route('categorias.index')}}">Gestionar Categorías</a>
                    </li>
                </ul>
            </li>

            {{-- ==================================== --}}

            <li class="nav-item pt-1 pb-1 d-flex flex-column" style="border-bottom: 1px solid #e7e7e7">
                <div class="d-flex flex-row justify-content-between align-items-center colapsar" id="personas"  role="button" data-bs-toggle="collapse" data-bs-target="#ul_productos" aria-controls="ul_productos" aria-expanded="false" aria-label="Toggle navigation">
                    <div class="col-11">
                        <i class="fa fa-cubes text-center text-dark" style="width: 10%"></i>
                        <a href="#" class="text-decoration-none" style="width: 80%" id="">Productos</a>
                    </div>
                    <div class="col-1 text-center text-dark">
                        <span class="fa collapse-icon" aria-hidden="false" style=""></span>
                    </div>
                </div>

                <ul class="nav collapse navbar-collapse ps-3" id="ul_productos">
                    <li class="nav-item w-100">
                        <a class="link-underline-light" href="{{route('productos.create')}}">Registrar Productos</a>
                    </li>
                    <li class="nav-item  w-100">
                        <a class="link-underline-light" href="{{route('productos.index')}}">Listar Productos</a>
                    </li>
                </ul>
            </li>

            {{-- ==================================== --}}

            <li class="nav-item pt-1 pb-1 d-flex flex-column" style="border-bottom: 1px solid #e7e7e7">
                <div class="d-flex flex-row justify-content-between align-items-center colapsar" id="personas"  role="button" data-bs-toggle="collapse" data-bs-target="#ul_existencias" aria-controls="ul_existencias" aria-expanded="false" aria-label="Toggle navigation">
                    <div class="col-11">
                        <i class="fa fa-check-square-o text-center text-dark" style="width: 10%"></i>
                        <a href="#" class="text-decoration-none" style="width: 80%" id="">Gestionar Existencias</a>
                    </div>
                    <div class="col-1 text-center text-dark">
                        <span class="fa collapse-icon" aria-hidden="false" style=""></span>
                    </div>
                </div>

                <ul class="nav collapse navbar-collapse ps-3" id="ul_existencias">
                    <li class="nav-item w-100">
                        <a class="link-underline-light" href="{{route('existencias.create')}}">Registrar Bajas</a>
                    </li>
                    <li class="nav-item w-100">
                        <a class="link-underline-light" href="{{route('existencias.index')}}">Listar Bajas</a>
                    </li>
                    <li class="nav-item w-100">
                        <a class="link-underline-light" href="{{route('stock_minimo')}}">Listar Productos en stock Mínimo</a>
                    </li>
                </ul>
            </li>

            {{-- ==================================== --}}

            <li class="nav-item pt-1 pb-1 d-flex flex-column" style="border-bottom: 1px solid #e7e7e7">
                <div class="d-flex flex-row justify-content-between align-items-center colapsar" id="personas"  role="button" data-bs-toggle="collapse" data-bs-target="#ul_entradas" aria-controls="ul_entradas" aria-expanded="false" aria-label="Toggle navigation">
                    <div class="col-11">
                        <i class="fa fa-shopping-cart text-center text-dark" style="width: 10%"></i>
                        <a href="#" class="text-decoration-none" style="width: 80%" id="">Entradas</a>
                    </div>
                    <div class="col-1 text-center text-dark">
                        <span class="fa collapse-icon" aria-hidden="false" style=""></span>
                    </div>
                </div>

                <ul class="nav collapse navbar-collapse ps-3" id="ul_entradas">
                    <li class="nav-item w-100">
                        <a class="link-underline-light" href="{{route('entradas.create')}}">Registrar Entradas</a>
                    </li>
                    <li class="nav-item w-100">
                        <a class="link-underline-light" href="{{route('entradas.index')}}">Listar Entradas</a>
                    </li>
                </ul>
            </li>

            {{-- ==================================== --}}

            <li class="nav-item pt-1 pb-1 d-flex flex-column" style="border-bottom: 1px solid #e7e7e7">
                <div class="d-flex flex-row justify-content-between align-items-center colapsar" id="personas"  role="button" data-bs-toggle="collapse" data-bs-target="#ul_ventas" aria-controls="ul_ventas" aria-expanded="false" aria-label="Toggle navigation">
                    <div class="col-11">
                        <i class="fa fa-usd text-center text-dark" style="width: 10%"></i>
                        <a href="#" class="text-decoration-none" style="width: 80%" id="">Ventas</a>
                    </div>
                    <div class="col-1 text-center text-dark">
                        <span class="fa collapse-icon" aria-hidden="false" style=""></span>
                    </div>
                </div>

                <ul class="nav collapse navbar-collapse ps-3" id="ul_ventas">
                    <li class="nav-item w-100">
                        <a class="link-underline-light" href="{{route('ventas.create')}}">Registrar Ventas</a>
                    </li>
                    <li class="nav-item w-100">
                        <a class="link-underline-light" href="{{route('ventas.index')}}">Listar Ventas</a>
                    </li>
                    <li class="nav-item w-100">
                        <a class="link-underline-light" href="{{route('credito_ventas')}}">Listar Créditos-Abonos</a>
                    </li>
                </ul>
            </li>

            {{-- ==================================== --}}

            <li class="nav-item pt-1 pb-1 d-flex flex-column" style="border-bottom: 1px solid #e7e7e7">
                <div class="d-flex flex-row justify-content-between align-items-center colapsar" id="pestamos_empleados"  role="button" data-bs-toggle="collapse" data-bs-target="#ul_pestamos_empleados" aria-controls="ul_pestamos_empleados" aria-expanded="false" aria-label="Toggle navigation">
                    <div class="col-11">
                        <i class="fa fa-credit-card text-center text-dark" style="width: 10%"></i>
                        <a href="#" class="text-decoration-none" style="width: 80%" id="">Préstamos a Empleados</a>
                    </div>
                    <div class="col-1 text-center text-dark">
                        <span class="fa collapse-icon" aria-hidden="false" style=""></span>
                    </div>
                </div>

                <ul class="nav collapse navbar-collapse ps-3" id="ul_pestamos_empleados">
                    <li class="nav-item w-100">
                        <a class="link-underline-light" href="{{route('prestamos.create')}}">Registrar Préstamos</a>
                    </li>
                    <li class="nav-item w-100">
                        <a class="link-underline-light" href="{{route('prestamos.index')}}">Listar Préstamos</a>
                    </li>
                </ul>
            </li>

            {{-- ==================================== --}}

            <li class="nav-item pt-1 pb-1 d-flex flex-column" style="border-bottom: 1px solid #e7e7e7">
                <div class="d-flex flex-row justify-content-between align-items-center colapsar" id="pago_empleados"  role="button" data-bs-toggle="collapse" data-bs-target="#ul_pago_empleados" aria-controls="ul_pago_empleados" aria-expanded="false" aria-label="Toggle navigation">
                    <div class="col-11">
                        <i class="fa fa-money text-center text-dark" style="width: 10%"></i>
                        <a href="#" class="text-decoration-none" style="width: 80%" id="">Pagos a Empleados</a>
                    </div>
                    <div class="col-1 text-center text-dark">
                        <span class="fa collapse-icon" aria-hidden="false" style=""></span>
                    </div>
                </div>

                <ul class="nav collapse navbar-collapse ps-3" id="ul_pago_empleados">
                    <li class="nav-item w-100">
                        <a class="link-underline-light" href="{{route('pago_empleados.create')}}">Registrar Pagos</a>
                    </li>
                    <li class="nav-item w-100">
                        <a class="link-underline-light" href="{{route('pago_empleados.index')}}">Listar Pagos</a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</aside>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const elementosColapsar = document.querySelectorAll('.colapsar');

        elementosColapsar.forEach(colapsar => {
            const iconoColapsar = colapsar.querySelector('.collapse-icon');

            iconoColapsar.classList.add('fa-angle-left');

            colapsar.addEventListener('click', function () {
                iconoColapsar.classList.toggle('fa-angle-left');
                iconoColapsar.classList.toggle('fa-angle-down');
            });
        });
    });
</script>
 