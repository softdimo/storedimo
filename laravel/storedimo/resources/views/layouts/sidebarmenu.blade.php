<aside class="vh-100" style="border: 1px solid #e7e7e7">
    <nav class="w-100 " role="">
        <ul class="nav d-flex flex-column justify-content-center flex-nowrap navbar-nav" id="sidebarnav">
            <li class="pt-1 pb-1 d-flex justify-content-between align-items-center" style="background-color: #EEEEEE; border-bottom: 1px solid #e7e7e7">
                <i class="fa fa-th-list text-center" style="color: #000; width: 10%"></i>
                <a href="/home" class="nav-link active text-decoration-none text-start" style="width: 80%">Menú Principal</a>
                <span class="" style="width: 10%"></span>
            </li>

            {{-- ==================================== --}}

            <li class="pt-1 pb-1 d-flex justify-content-between align-items-center nav-item" style="border-bottom: 1px solid #e7e7e7">
                <i class="fa fa-users text-center" style="color: #000; width: 10%"></i>
                <a href="" class="text-decoration-none" style="width: 80%" id="personas" role="button" data-bs-toggle="dropdown" aria-expanded="false">Personas</a>
                <span class="fa fa-angle-left text-center" aria-hidden="false" style="color: #000; width: 10%"></span>

                <ul class="dropdown-menu" aria-labelledby="personas">
                    <li><a class="dropdown-item" href="{{route('usuarios.create')}}">Registrar Personas</a></li>
                    <li><a class="dropdown-item" href="{{route('usuarios.index')}}">Listar Usuario/Empleados</a></li>
                    <li><a class="dropdown-item" href="{{route('listar_proveedores')}}">Listar Proveedores</a></li>
                    <li><a class="dropdown-item" href="{{route('listar_clientes')}}">Listar Clientes</a></li>
                </ul>
            </li>

            {{-- ==================================== --}}

            <li class="pt-1 pb-1 d-flex justify-content-between align-items-center nav-item" style="border-bottom: 1px solid #e7e7e7">
                <i class="fa fa-database text-center" style="color: #000; width: 10%"></i>
                <a href="" class="text-decoration-none" style="width: 80%" id="categorias" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categorías</a>
                <span class="fa fa-angle-left text-center" aria-hidden="false" style="color: #000; width: 10%"></span>
                <ul class="dropdown-menu" aria-labelledby="categorias">
                    <li><a class="dropdown-item" href="{{route('categorias.index')}}">Gestionar Categorías</a></li>
                </ul>
            </li>

            {{-- ==================================== --}}
            
            <li class="pt-1 pb-1 d-flex justify-content-between align-items-center nav-item" style="border-bottom: 1px solid #e7e7e7">
                <i class="fa fa-cubes text-center" style="color: #000; width: 10%"></i>
                <a href="" class="text-decoration-none" style="width: 80%" id="productos" role="button" data-bs-toggle="dropdown" aria-expanded="false">Productos</a>
                <span class="fa fa-angle-left text-center" aria-hidden="false" style="color: #000; width: 10%"></span>
                <ul class="dropdown-menu" aria-labelledby="productos">
                    <li><a class="dropdown-item" href="{{route('productos.create')}}">Registrar Productos</a></li>
                    <li><a class="dropdown-item" href="{{route('productos.index')}}">Listar Productos</a></li>
                </ul>
            </li>

            {{-- ==================================== --}}

            <li class="pt-1 pb-1 d-flex justify-content-between align-items-center nav-item" style="border-bottom: 1px solid #e7e7e7">
                <i class="fa fa-check-square-o text-center" style="color: #000; width: 10%"></i>
                <a href="" class="text-decoration-none" style="width: 80%" id="existencias" role="button" data-bs-toggle="dropdown" aria-expanded="false">Gestionar Existencias</a>
                <span class="fa fa-angle-left text-center" aria-hidden="false" style="color: #000; width: 10%"></span>
                <ul class="dropdown-menu" aria-labelledby="existencias">
                    <li><a class="dropdown-item" href="{{route('existencias.create')}}">Registrar Bajas</a></li>
                    <li><a class="dropdown-item" href="{{route('existencias.index')}}">Listar Bajas</a></li>
                    <li><a class="dropdown-item" href="{{route('stock_minimo')}}">Listar Productos en stock Mínimo</a></li>
                </ul>
            </li>

            {{-- ==================================== --}}

            <li class="pt-1 pb-1 d-flex justify-content-between align-items-center nav-item" style="border-bottom: 1px solid #e7e7e7">
                <i class="fa fa-shopping-cart text-center" style="color: #000; width: 10%"></i>
                <a href="" class="text-decoration-none" style="width: 80%" id="entradas" role="button" data-bs-toggle="dropdown" aria-expanded="false">Entradas</a>
                <span class="fa fa-angle-left text-center" aria-hidden="false" style="color: #000; width: 10%"></span>
                <ul class="dropdown-menu" aria-labelledby="entradas">
                    <li><a class="dropdown-item" href="{{route('entradas.create')}}">Registrar Entradas</a></li>
                    <li><a class="dropdown-item" href="{{route('entradas.index')}}">Listar Entradas</a></li>
                </ul>
            </li>

            {{-- ==================================== --}}

            <li class="pt-1 pb-1 d-flex justify-content-between align-items-center nav-item" style="border-bottom: 1px solid #e7e7e7">
                <i class="fa fa-usd text-center" style="color: #000; width: 10%"></i>
                <a href="" class="text-decoration-none" style="width: 80%" id="ventas" role="button" data-bs-toggle="dropdown" aria-expanded="false">Ventas</a>
                <span class="fa fa-angle-left text-center" aria-hidden="false" style="color: #000; width: 10%"></span>
                <ul class="dropdown-menu" aria-labelledby="ventas">
                    <li><a class="dropdown-item" href="{{route('ventas.create')}}">Registrar Ventas</a></li>
                    <li><a class="dropdown-item" href="{{route('ventas.index')}}">Listar Ventas</a></li>
                    <li><a class="dropdown-item" href="{{route('credito_ventas')}}">Listar Créditos-Abonos</a></li>
                </ul>
            </li>

            {{-- ==================================== --}}

            <li class="pt-1 pb-1 d-flex justify-content-between align-items-center nav-item" style="border-bottom: 1px solid #e7e7e7">
                <i class="fa fa-credit-card text-center" style="color: #000; width: 10%"></i>
                <a href="" class="text-decoration-none" style="width: 80%" id="prestamos" role="button" data-bs-toggle="dropdown" aria-expanded="false">Préstamos a Empleados</a>
                <span class="fa fa-angle-left text-center" aria-hidden="false" style="color: #000; width: 10%"></span>
                <ul class="dropdown-menu" aria-labelledby="prestamos">
                    <li><a class="dropdown-item" href="{{route('prestamo_empleados.create')}}">Registrar Préstamos</a></li>
                    <li><a class="dropdown-item" href="{{route('prestamo_empleados.index')}}">Listar Préstamos</a></li>
                </ul>
            </li>

            {{-- ==================================== --}}

            <li class="pt-1 pb-1 d-flex justify-content-between align-items-center nav-item" style="border-bottom: 1px solid #e7e7e7">
                <i class="fa fa-money text-center" style="color: #000; width: 10%"></i>
                <a href="" class="text-decoration-none" style="width: 80%" id="pagos" role="button" data-bs-toggle="dropdown" aria-expanded="false">Pagos a Empleados</a>
                <span class="fa fa-angle-left text-center" aria-hidden="false" style="color: #000; width: 10%"></span>
                <ul class="dropdown-menu" aria-labelledby="pagos">
                    <li><a class="dropdown-item" href="{{route('pago_empleados.create')}}">Registrar Pagos</a></li>
                    <li><a class="dropdown-item" href="{{route('pago_empleados.index')}}">Listar Pagos</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</aside>
