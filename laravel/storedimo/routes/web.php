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
    // return view('welcome');
    return view('inicio_sesion.login');
});

// ========================================================================
// ========================================================================
// ========================================================================

// HOME
Route::group(['namespace' => 'App\Http\Controllers\home'], function () {
    Route::resource('home', 'HomeController');
});

// ========================================================================
// ========================================================================
// ========================================================================

// PERSONAS
Route::group(['namespace' => 'App\Http\Controllers\usuarios'], function () {
    Route::resource('usuarios', 'UsuariosController');
    Route::get('listar_proveedores', 'UsuariosController@listarProveedores')->name('listar_proveedores');
    Route::get('listar_clientes', 'UsuariosController@listarClientes')->name('listar_clientes');
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
    Route::post('producto_show/{idProducto}', 'ProductosController@show')->name('producto_show');
    Route::post('producto_edit/{idProducto}', 'ProductosController@edit')->name('producto_edit');
    Route::post('producto_update', 'ProductosController@update')->name('producto_update');
    Route::post('inactivar_producto', 'ProductosController@destroy')->name('inactivar_producto');
    Route::post('barcode_producto/{idProducto}', 'ProductosController@queryBarCodeProducto')->name('barcode_producto');
});

// ========================================================================
// ========================================================================
// ========================================================================

// EXISTENCIAS
Route::group(['namespace' => 'App\Http\Controllers\existencias'], function () {
    Route::resource('existencias', 'ExistenciasController');
    Route::get('stock_minimo', 'ExistenciasController@stockMinimo')->name('stock_minimo');
});

// ========================================================================
// ========================================================================
// ========================================================================

// ENTRADAS
Route::group(['namespace' => 'App\Http\Controllers\entradas'], function () {
    Route::resource('entradas', 'EntradasController');
});

// ========================================================================
// ========================================================================
// ========================================================================

// VENTAS
Route::group(['namespace' => 'App\Http\Controllers\ventas'], function () {
    Route::resource('ventas', 'VentasController');
    Route::get('credito_ventas', 'VentasController@listarCreditoVentas')->name('credito_ventas');
});

// ========================================================================
// ========================================================================
// ========================================================================

// PRÉSTAMOS A EMPLEADOS
Route::group(['namespace' => 'App\Http\Controllers\prestamo_empleados'], function () {
    Route::resource('prestamo_empleados', 'PrestamoEmpleadosController');
    Route::get('listar_prestamos_empleados', 'PrestamoEmpleadosController@listarPrestamosEmpleados')->name('listar_prestamos_empleados');
});

// PAGO A EMPLEADOS
Route::group(['namespace' => 'App\Http\Controllers\pago_empleados'], function () {
    Route::resource('pago_empleados', 'PagoEmpleadosController');
});