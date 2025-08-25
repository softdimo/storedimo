<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


// =====================================================================

/**
 * Rutas de Administración (BD Principal)
 * - Gestión de usuarios
 * - Permisos y roles
 * - Configuración de empresas
 */

$router->group(['prefix' => 'api/administracion'], function () use ($router) {
    // USUARIOS
    $router->get('usuarios_index', 'usuarios\UsuariosController@index');
    $router->post('query_identificacion', 'usuarios\UsuariosController@consultarId');
    $router->post('query_usuario', 'usuarios\UsuariosController@consultaUsuario');
    $router->post('usuario_store', 'usuarios\UsuariosController@store');
    $router->post('query_usuario_update/{idUsuario}', 'usuarios\UsuariosController@queryUsuarioUpdate');
    $router->put('usuario_update/{idUsuario}', 'usuarios\UsuariosController@update');
    $router->post('cambiar_clave/{idUsuario}', 'usuarios\UsuariosController@cambiarClave');
    $router->post('consulta_recuperar_clave', 'usuarios\UsuariosController@consultaRecuperarClave');
    $router->post('inactivar_usuario/{idUsuario}', 'usuarios\UsuariosController@inactivarUsuario');
    $router->post('actualizar_clave_fallas/{idUsuario}', 'usuarios\UsuariosController@actualizarClaveFallas');
    $router->post('validar_email', 'usuarios\UsuariosController@validarEmail');
    $router->post('validar_identificacion', 'usuarios\UsuariosController@validarIdentificacion');
    $router->post('validar_email_login', 'usuarios\UsuariosController@validarEmailLogin');
    $router->get('consulta_usuario_logueado/{idUsuario}', 'usuarios\UsuariosController@consultaUsuarioLogueado');

    // ========================================================================

    // Roles y Permisos
    $router->post('guardar_rol', 'roles_permisos\RolesPermisosController@crearRol');
    $router->post('guardar_permiso', 'roles_permisos\RolesPermisosController@crearPermiso');
    $router->post('crear_permiso_usuario', 'roles_permisos\RolesPermisosController@crearPermisosUsuario');
    $router->post('consultar_permisos', 'roles_permisos\RolesPermisosController@consultarPermisosPorUsuario');
    // $router->post('eliminar_permiso_usuario', 'roles_permisos\RolesPermisosController@eliminarPermisosPorUsuario');
    $router->get('permisos_por_usuario_trait/{idUsuario}', 'roles_permisos\RolesPermisosController@permisosPorUsuarioTrait');
    $router->get('permisos_trait', 'roles_permisos\RolesPermisosController@permisosTrait');
    $router->get('permisos_view_share_trait', 'roles_permisos\RolesPermisosController@permisosViewShareTrait');

    // ========================================================================

    // EMPRESAS
    $router->get('empresa_index', 'empresas\EmpresasController@index');
    $router->post('empresa_store', 'empresas\EmpresasController@store');
    $router->put('empresa_update/{idEmpresa}', 'empresas\EmpresasController@update');
    $router->post('consultar_empresa', 'empresas\EmpresasController@consultarEmpresa');
    $router->get('empresa_edit/{idEmpresa}', 'empresas\EmpresasController@edit');

    // Informes Gerenciales
    $router->post('informe_gerencial', 'informes\InformeController@index');
}); // FIN api/administracion

// ========================================================================
// ========================================================================
// ========================================================================

$router->group(['prefix' => 'api'], function () use ($router) {
    // CATEGORIAS
    $router->get('categoria_index', 'categorias\CategoriasController@index');
    $router->post('categoria_store', 'categorias\CategoriasController@store');
    $router->put('categoria_update/{id}', 'categorias\CategoriasController@update');
    $router->post('consulta_categoria', 'categorias\CategoriasController@consultaCategoria');
    $router->post('cambiar_estado_categoria/{idCategoria}', 'categorias\CategoriasController@destroy');
    $router->get('categoria_edit/{idCategoria}', 'categorias\CategoriasController@edit');
    $router->get('categorias_trait', 'categorias\CategoriasController@categoriasTrait');
    $router->get('umd_trait', 'productos\ProductosController@consultarUmd');

    // ========================================================================

    // PRODUCTOS
    $router->get('producto_index', 'productos\ProductosController@index');
    $router->post('verificar_producto', 'productos\ProductosController@verificarProducto');
    $router->post('producto_store', 'productos\ProductosController@store');
    $router->post('producto_show/{idProducto}', 'productos\ProductosController@show');
    $router->post('producto_edit/{idProducto}', 'productos\ProductosController@edit');
    $router->put('producto_update/{idProducto}', 'productos\ProductosController@update');
    $router->post('cambiar_estado_producto/{idProducto}', 'productos\ProductosController@destroy');
    $router->post('query_producto/{idProducto}', 'productos\ProductosController@queryProducto');
    $router->get('reporte_productos_pdf', 'productos\ProductosController@reporteProductosPdf');
    $router->post('verificar_referencia', 'productos\ProductosController@referenceValidator');
    $router->get('productos_trait_ventas', 'productos\ProductosController@productosTraitVentas');
    $router->get('productos_trait_compras', 'productos\ProductosController@productosTraitCompras');
    $router->get('productos_trait_existencias', 'productos\ProductosController@productosTraitExistencias');

    // ========================================================================

    // PERSONAS
    $router->get('personas_index', 'personas\PersonasController@index');
    $router->post('query_id_persona', 'personas\PersonasController@consultarIdPersona');
    $router->post('query_nit_empresa', 'personas\PersonasController@consultarNitEmpresa');
    $router->post('persona_store', 'personas\PersonasController@store');
    $router->put('persona_update/{idPersona}', 'personas\PersonasController@update');
    $router->get('persona_edit/{idPersona}', 'personas\PersonasController@edit');
    $router->get('clientes_trait', 'personas\PersonasController@personaTrait');

    // ========================================================================

    // PROVEEDORES
    $router->get('proveedores_index', 'proveedores\ProveedoresController@index');
    $router->post('query_identificacion_proveedor', 'proveedores\ProveedoresController@consultarIdentificacionProveedor');
    $router->post('query_nit_proveedor', 'proveedores\ProveedoresController@consultarNitProveedor');
    $router->post('proveedor_store', 'proveedores\ProveedoresController@store');
    $router->put('proveedor_update/{idProveedor}', 'proveedores\ProveedoresController@update');
    $router->get('proveedor_edit/{idProveedor}', 'proveedores\ProveedoresController@edit');
    $router->get('proveedores_trait', 'proveedores\ProveedoresController@proveedoresTrait');

    // ========================================================================

    // ENTRADAS
    $router->get('entrada_index', 'entradas\EntradasController@index');
    $router->post('entrada_store', 'entradas\EntradasController@store');
    $router->post('anular_compra/{idCompra}', 'entradas\EntradasController@anularCompra');
    $router->post('reporte_compras_pdf', 'entradas\EntradasController@reporteComprasPdf');
    $router->post('detalle_compra/{idCompra}', 'entradas\EntradasController@detalleCompra');
    $router->get('entrada/{idEntrada}', 'entradas\EntradasController@entrada');
    $router->post('detalle_compra_pdf/{idCompra}', 'entradas\EntradasController@detalleCompraProductoPdf');
    $router->get('entrada_dia_mes', 'entradas\EntradasController@entradaDiaMes');

    // ========================================================================

    // VENTAS
    $router->get('venta_index', 'ventas\VentasController@index');
    $router->get('venta/{idVenta}', 'ventas\VentasController@ventaDetalle');
    $router->post('venta_store', 'ventas\VentasController@store');
    $router->post('anular_venta/{idVenta}', 'ventas\VentasController@anularVenta');
    $router->post('reporte_ventas_pdf', 'ventas\VentasController@reporteVentasPdf');
    $router->post('detalle_venta/{idVenta}', 'ventas\VentasController@detalleVenta');
    $router->get('venta_dia_mes', 'ventas\VentasController@ventaDiaMes');

    // ========================================================================

    // EXISTENCIAS-BAJAS
    $router->get('baja_index', 'existencias\ExistenciasController@bajaIndex');
    $router->get('baja/{idBaja}', 'existencias\ExistenciasController@baja');
    $router->post('baja_store', 'existencias\ExistenciasController@bajaStore');
    $router->post('baja_detalle/{idBaja}', 'existencias\ExistenciasController@bajaDetalle');
    $router->post('reporte_bajas_pdf', 'existencias\ExistenciasController@reporteBajasPdf');
    $router->get('stock_minimo_index', 'existencias\ExistenciasController@stockMinimoIndex');
    $router->get('alerta_stock_minimo', 'existencias\ExistenciasController@alertaStockMinimo');

    // ========================================================================

    // PAGO EMPLEADOS
    $router->get('pago_empleado_index', 'pago_empleados\PagoEmpleadosController@index');
    $router->get('pago_empleado_create', 'pago_empleados\PagoEmpleadosController@create');
    $router->post('pago_empleado_store', 'pago_empleados\PagoEmpleadosController@store');

    // ========================================================================

    // PRESTAMOS
    $router->get('prestamo_index', 'prestamos\PrestamosController@index');
    $router->get('prestamo_create', 'prestamos\PrestamosController@create');
    $router->post('prestamo_store', 'prestamos\PrestamosController@store');
    $router->get('prestamo_vencer', 'prestamos\PrestamosController@prestamoVencer');

    // ========================================================================
}); // api
