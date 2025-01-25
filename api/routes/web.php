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

    // $router->post('usuario_destroy/{id}', 'usuarios\UsuariosController@destroy');
    // $router->get('usuario_show/{id}', 'usuarios\UsuariosController@show');
});

// =====================================================================
// =====================================================================

// CATEGORIAS
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('categoria_index', 'categorias\CategoriasController@index');
    $router->post('categoria_store', 'categorias\CategoriasController@store');
    $router->put('categoria_update/{id}', 'categorias\CategoriasController@update');
    $router->post('consulta_categoria', 'categorias\CategoriasController@consultaCategoria');
});

// ========================================================================
// ========================================================================

// PRODUCTOS
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('producto_index', 'productos\ProductosController@index');
    $router->post('producto_store', 'productos\ProductosController@store');
    $router->post('producto_show/{idProducto}', 'productos\ProductosController@show');
    $router->post('producto_edit/{idProducto}', 'productos\ProductosController@edit');
    $router->put('producto_update/{idProducto}', 'productos\ProductosController@update');
    $router->post('cambiar_estado/{idProducto}', 'productos\ProductosController@destroy');
    $router->post('producto_query_barcode/{idProducto}', 'productos\ProductosController@productoQueryBarcode');
});

// ========================================================================
// ========================================================================
