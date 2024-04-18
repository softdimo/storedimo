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
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('categoria_index', 'categorias\CategoriasController@index');
    $router->post('categoria_store', 'categorias\CategoriasController@store');
    $router->put('categoria_update/{id}', 'categorias\CategoriasController@update');
    // $router->post('categoria_destroy/{id}', 'categorias\CategoriasController@destroy');
    // $router->get('categoria_show/{id}', 'categorias\CategoriasController@show');
});

// ========================================================================
// ========================================================================

// PRODUCTOS
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('producto_index', 'productos\ProductosController@index');
    $router->post('producto_store', 'productos\ProductosController@store');
    $router->put('producto_update/{id}', 'productos\ProductosController@update');
    $router->post('producto_show/{idProducto}', 'productos\ProductosController@show');
    // $router->post('producto_destroy/{id}', 'productos\ProductosController@destroy');
});

// ========================================================================
// ========================================================================
