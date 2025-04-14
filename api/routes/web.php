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
// =====================================================================

// USUARIOS
$router->group(['prefix' => 'api'], function () use ($router) {
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
});

// =====================================================================
// =====================================================================

// CATEGORIAS
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('categoria_index', 'categorias\CategoriasController@index');
    $router->post('categoria_store', 'categorias\CategoriasController@store');
    $router->put('categoria_update/{id}', 'categorias\CategoriasController@update');
    $router->post('consulta_categoria', 'categorias\CategoriasController@consultaCategoria');
    $router->post('cambiar_estado_categoria/{idCategoria}', 'categorias\CategoriasController@destroy');
});

// ========================================================================
// ========================================================================

// PRODUCTOS
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('producto_index', 'productos\ProductosController@index');
    $router->post('verificar_producto', 'productos\ProductosController@verificarProducto');
    $router->post('producto_store', 'productos\ProductosController@store');
    $router->post('producto_show/{idProducto}', 'productos\ProductosController@show');
    $router->post('producto_edit/{idProducto}', 'productos\ProductosController@edit');
    $router->put('producto_update/{idProducto}', 'productos\ProductosController@update');
    $router->post('cambiar_estado_producto/{idProducto}', 'productos\ProductosController@destroy');
    $router->post('query_producto/{idProducto}', 'productos\ProductosController@queryProducto');
    $router->get('reporte_productos_pdf', 'productos\ProductosController@reporteProductosPdf');
});

// ========================================================================
// ========================================================================

// PERSONAS
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('personas_index', 'personas\PersonasController@index');
    $router->post('query_id_persona', 'personas\PersonasController@consultarIdPersona');
    $router->post('query_nit_empresa', 'personas\PersonasController@consultarNitEmpresa');
    $router->post('persona_store', 'personas\PersonasController@store');
    $router->put('persona_update/{idPersona}', 'personas\PersonasController@update');
});

// ========================================================================
// ========================================================================

// ENTRADAS
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('entrada_index', 'entradas\EntradasController@index');
    $router->post('entrada_store', 'entradas\EntradasController@store');
    $router->post('anular_compra/{idCompra}', 'entradas\EntradasController@anularCompra');
    $router->post('reporte_compras_pdf', 'entradas\EntradasController@reporteComprasPdf');
    $router->post('detalle_compra/{idCompra}', 'entradas\EntradasController@detalleCompra');
    $router->post('detalle_compra_pdf/{idCompra}', 'entradas\EntradasController@detalleCompraProductoPdf');
});

// ========================================================================
// ========================================================================

// VENTAS
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('venta_index', 'ventas\VentasController@index');
    $router->post('venta_store', 'ventas\VentasController@store');
    $router->post('anular_venta/{idVenta}', 'ventas\VentasController@anularVenta');

    $router->post('reporte_ventas_pdf', 'ventas\VentasController@reporteVentasPdf');
    $router->post('detalle_venta/{idVenta}', 'ventas\VentasController@detalleVenta');
});

// ========================================================================
// ========================================================================

// PRESTAMOS
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('prestamo_index', 'prestamos\PrestamosController@index');
    $router->get('prestamo_create', 'prestamos\PrestamosController@create');
    $router->post('prestamo_store', 'prestamos\PrestamosController@store');
    $router->get('prestamo_vencer', 'prestamos\PrestamosController@prestamoVencer');
});

// ========================================================================
// ========================================================================

// PAGO EMPLEADOS
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('pago_empleado_index', 'pago_empleados\PagoEmpleadosController@index');
    $router->get('pago_empleado_create', 'pago_empleados\PagoEmpleadosController@create');
    $router->post('pago_empleado_store', 'pago_empleados\PagoEmpleadosController@store');
});

// ========================================================================
// ========================================================================

// EMPRESAS
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('empresa_index', 'empresas\EmpresasController@index');
    $router->post('empresa_store', 'empresas\EmpresasController@store');
    $router->put('empresa_update/{idEmpresa}', 'empresas\EmpresasController@update');
    $router->post('consultar_empresa', 'empresas\EmpresasController@consultarEmpresa');
});


// ========================================================================
// ========================================================================

// EXISTENCIAS-BAJAS
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('baja_index', 'existencias\ExistenciasController@bajaIndex');
    $router->post('baja_store', 'existencias\ExistenciasController@bajaStore');
    $router->post('baja_detalle/{idBaja}', 'existencias\ExistenciasController@bajaDetalle');
    $router->post('reporte_bajas_pdf', 'existencias\ExistenciasController@reporteBajasPdf');
    $router->get('stock_minimo_index', 'existencias\ExistenciasController@stockMinimoIndex');
    $router->get('alerta_stock_minimo', 'existencias\ExistenciasController@alertaStockMinimo');
});


