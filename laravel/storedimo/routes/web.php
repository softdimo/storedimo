<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('inicio_sesion.login');
})->name('login');

// ========================================================================
// ========================================================================
// ========================================================================

// LOGIN
Route::group(['namespace' => 'App\Http\Controllers\inicio_sesion'], function () {
    Route::resource('login', 'LoginController');
    Route::get('login_usuario', 'LoginController@index')->name('login_usuario');
    Route::get('logout', 'LoginController@logout')->name('logout');
    // CAMBIAR CLAVE
    Route::post('cambiar_clave', 'LoginController@cambiarClave')->name('cambiar_clave');
    Route::post('cambiar_clave_update', 'LoginController@cambiarClaveUpdate')->name('cambiar_clave_update');
    // RECUPERAR CLAVE
    Route::get('recuperar_clave', 'LoginController@recuperarClave')->name('recuperar_clave');
    Route::post('recuperar_clave_email', 'LoginController@recuperarClaveEmail')->name('recuperar_clave_email');
    Route::get('recuperar_clave_link/{usuIdRecuperarClave}', 'LoginController@recuperarClaveLink')->name('recuperar_clave_link');
    Route::post('recuperar_clave_update', 'LoginController@recuperarClaveUpdate')->name('recuperar_clave_update');
    
});

// ========================================================================
// ========================================================================
// ========================================================================

// HOME
Route::group(['namespace' => 'App\Http\Controllers\home'], function () {
    Route::resource('home', 'HomeController');
    Route::resource('permisos', 'PermisosController');
});

// ========================================================================
// ========================================================================
// ========================================================================

// USUARIOS
Route::group(['namespace' => 'App\Http\Controllers\usuarios'], function () {
    Route::resource('usuarios', 'UsuariosController');
});

// ========================================================================
// ========================================================================
// ========================================================================

// PERSONAS
Route::group(['namespace' => 'App\Http\Controllers\personas'], function () {
    Route::resource('personas', 'PersonasController');
    Route::get('listar_proveedores', 'PersonasController@listarProveedores')->name('listar_proveedores');
    Route::get('listar_clientes', 'PersonasController@listarClientes')->name('listar_clientes');
});


// ========================================================================
// ========================================================================
// ========================================================================

// CATEGORIAS
Route::group(['namespace' => 'App\Http\Controllers\categorias'], function () {
    Route::resource('categorias', 'CategoriasController');
    Route::post('editar_categoria', 'CategoriasController@update')->name('editar_categoria');
});

// ========================================================================
// ========================================================================
// ========================================================================

// PRODUCTOS
Route::group(['namespace' => 'App\Http\Controllers\productos'], function () {
    Route::resource('productos', 'ProductosController');
    Route::post('verificar_producto', 'ProductosController@verificarProducto')->name('verificar_producto');
    Route::post('producto_show/{idProducto}', 'ProductosController@show')->name('producto_show');
    Route::post('producto_edit/{idProducto}', 'ProductosController@edit')->name('producto_edit');
    Route::post('producto_update', 'ProductosController@update')->name('producto_update');
    Route::post('cambiar_estado_producto', 'ProductosController@destroy')->name('cambiar_estado_producto');
    Route::post('query_barcode_producto/{idProducto}', 'ProductosController@queryBarCodeProducto')->name('query_barcode_producto');
    Route::post('producto_barcode', 'ProductosController@productoGenerarBarCode')->name('producto_barcode');
    Route::post('query_valores_producto', 'ProductosController@queryValoresProducto')->name('query_valores_producto');

    // ========================================================================
    
    // Abre automáticamente el archivo con los códigos QR del producto recién solicitado
    Route::get('/ver-pdf/{archivo}', function ($archivo) {
        $rutaPdf = storage_path("app/public/upfiles/productos/barcodes/{$archivo}");
    
        if (!file_exists($rutaPdf)) {
            abort(404, "El archivo no existe.");
        }
    
        return response()->file($rutaPdf);
    })->name('ver.pdf');
});

// ========================================================================
// ========================================================================
// ========================================================================

// EXISTENCIAS
Route::group(['namespace' => 'App\Http\Controllers\existencias'], function () {
    Route::resource('existencias', 'ExistenciasController');
    Route::get('bajas_index', 'ExistenciasController@bajasIndex')->name('bajas_index');
    Route::post('baja_store', 'ExistenciasController@bajaStore')->name('baja_store');
    Route::post('reporte_bajas_pdf', 'ExistenciasController@reporteBajasPdf')->name('reporte_bajas_pdf');
    Route::get('stock_minimo', 'ExistenciasController@stockMinimo')->name('stock_minimo');
    Route::post('stock_minimo_pdf', 'ExistenciasController@stockMinimoPdf')->name('stock_minimo_pdf');
    Route::get('alerta_stock_minimo_app', 'ExistenciasController@alertaStockMinimo')->name('alerta_stock_minimo_app');
});

// ========================================================================
// ========================================================================
// ========================================================================

// ENTRADAS
Route::group(['namespace' => 'App\Http\Controllers\entradas'], function () {
    Route::resource('entradas', 'EntradasController');
    Route::post('anular_compra', 'EntradasController@anularCompra')->name('anular_compra');
    Route::post('reporte_compras_pdf', 'EntradasController@reporteComprasPdf')->name('reporte_compras_pdf');
    Route::get('detalle_compras_pdf/{idCompra}', 'EntradasController@detalleComprasPdf')->name('detalle_compras_pdf');
});

// ========================================================================
// ========================================================================
// ========================================================================

// VENTAS
Route::group(['namespace' => 'App\Http\Controllers\ventas'], function () {
    Route::resource('ventas', 'VentasController');
    Route::post('reporte_ventas_pdf', 'VentasController@reporteVentasPdf')->name('reporte_ventas_pdf');
    Route::get('detalle_ventas_pdf/{idVenta}', 'VentasController@detalleVentasPdf')->name('detalle_ventas_pdf');
    Route::post('recibo_caja_venta', 'VentasController@reciboCajaVenta')->name('recibo_caja_venta');

    Route::get('credito_ventas', 'VentasController@listarCreditoVentas')->name('credito_ventas');
});

// ========================================================================
// ========================================================================
// ========================================================================

// PRÉSTAMOS A EMPLEADOS
Route::group(['namespace' => 'App\Http\Controllers\prestamos'], function () {
    Route::resource('prestamos', 'PrestamosController');
    Route::get('prestamos_vencer', 'PrestamosController@prestamosVencer')->name('prestamos_vencer');
});

// ========================================================================
// ========================================================================
// ========================================================================

// PAGO A EMPLEADOS
Route::group(['namespace' => 'App\Http\Controllers\pago_empleados'], function () {
    Route::resource('pago_empleados', 'PagoEmpleadosController');
});

// ========================================================================
// ========================================================================
// ========================================================================

// EMPRESAS
Route::group(['namespace' => 'App\Http\Controllers\empresas'], function () {
    Route::resource('empresas', 'EmpresasController');
});