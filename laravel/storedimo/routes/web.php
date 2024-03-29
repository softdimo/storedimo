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
    // Route::post('verificar_documento', 'AdministradorController@verificarDocumento')->name('verificar_documento');
    // Route::post('editar_usuario', 'AdministradorController@update')->name('editar_usuario');
});

// ========================================================================
// ========================================================================
// ========================================================================

// PERSONAS
Route::group(['namespace' => 'App\Http\Controllers\usuarios'], function () {
    Route::resource('usuarios', 'UsuariosController');
    Route::get('listar_proveedores', 'UsuariosController@listarProveedores')->name('listar_proveedores');
    // Route::post('verificar_documento', 'AdministradorController@verificarDocumento')->name('verificar_documento');
    // Route::post('editar_usuario', 'AdministradorController@update')->name('editar_usuario');
});


// ========================================================================
// ========================================================================
// ========================================================================



// ========================================================================
// ========================================================================
// ========================================================================



// ========================================================================
// ========================================================================
// ========================================================================


// ========================================================================
// ========================================================================
// ========================================================================
