<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Exception;
use Illuminate\Support\Facades\View;
use GuzzleHttp\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            try {
                $baseUri = env('BASE_URI');
                $clientApi = new Client(['base_uri' => $baseUri]);
                $idUsuario = session('id_usuario');

                $logoEmpresa = asset('imagenes/logo_storedimo.png');

                if (!$idUsuario) {
                    $view->with('logoEmpresa', $logoEmpresa);
                    return;
                }

                $response = $clientApi->get($baseUri . 'administracion/consulta_usuario_logueado/' . $idUsuario);
                $usuario = json_decode($response->getBody()->getContents());

                $view->with([
                    'usuarioLogueado' => $usuario,
                    'logoEmpresa' => $usuario->logo_empresa ?? $logoEmpresa,
                ]);
            } catch (\Exception $e) {
                $view->with('logoEmpresa', $logoEmpresa);
            }
        });
    }
}
