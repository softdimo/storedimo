<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Exception;
use Illuminate\Support\Facades\View;
use GuzzleHttp\Client;
use App\Models\Usuario;

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
        View::composer('layouts.topbar', function ($view)
        {
            $baseUri = env('BASE_URI');
            $clientApi = new Client(['base_uri' => $baseUri]);

            // ==============================================================
            try {
                $idUsuario = session('id_usuario');

                // Consultar el usuario en la base de datos
                $peticionUsuarioLogueado = $clientApi->get($baseUri . 'administracion/consulta_usuario_logueado/'. $idUsuario, [
                    'json' => []
                ]);
                $usuario = json_decode($peticionUsuarioLogueado->getBody()->getContents());

                $view->with('usuarioLogueado', $usuario);
               
            } catch (Exception $e) {
                alert()->error('Error, consultando el usuario logueado, contacte a Soporte.');
                return back();
            }
        });
    }
}
