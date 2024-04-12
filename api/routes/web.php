<?php

// use Illuminate\Support\Facades\Route;

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

// CATEGORIAS
// Route::group(['namespace' => 'App\Http\Controllers\categorias'], function () {
//     Route::resource('usuarios', 'AdministradorController');
//     Route::post('verificar_documento', 'AdministradorController@verificarDocumento')->name('verificar_documento');
//     Route::post('editar_usuario', 'AdministradorController@update')->name('editar_usuario');
// });

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('categoria_index', 'categorias\CategoriasController@index');
    $router->post('categoria_store', 'categorias\CategoriasController@store');
    $router->put('categoria_update/{id}', 'categorias\CategoriasController@update');
    // $router->post('categoria_destroy/{id}', 'categorias\CategoriasController@destroy');
    // $router->get('categoria_show/{id}', 'categorias\CategoriasController@show');
});

// ========================================================================
// ========================================================================
