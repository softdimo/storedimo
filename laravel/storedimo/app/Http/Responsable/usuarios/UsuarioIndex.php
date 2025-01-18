<?php

namespace App\Http\Responsable\usuarios;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Categoria;
use GuzzleHttp\Client;
// use App\Traits\MetodosTrait;
use App\Http\Controllers\inicio_sesion\LoginController;

class UsuarioIndex implements Responsable
{
    // use MetodosTrait;

    public function toResponse($request)
    {
        try {
            $baseUri = env('BASE_URI');
            $clientApi = new Client(['base_uri' => $baseUri]);
            $vista = 'usuarios.index';

            // ==============================================================

            // Instanciar LoginController
            $loginController = new LoginController();

            $checkConnection = $loginController->checkDatabaseConnection($vista);
            // $checkConnection = $this->checkDatabaseConnection($vista);loginController

            if($checkConnection->getName() == 'db_conexion') {
                return view('db_conexion');
            } else {
                // Realiza la solicitud a la API
                $response = $clientApi->get($baseUri . 'usuarios_index');
                $usuarioIndex = json_decode($response->getBody()->getContents(), true);

                if(isset($usuarioIndex) && !empty($usuarioIndex) && !is_null($usuarioIndex))
                {
                   return view($vista, compact('usuarioIndex'));
                }
            }

            // ==============================================================

            // if (!$this->checkDatabaseConnection()) {
            //     return view('db_conexion');
            // } else {
            //     // Realiza la solicitud a la API
            //     $response = $clientApi->get($baseUri . 'usuarios_index');
            //     $usuarioIndex = json_decode($response->getBody()->getContents(), true);

            //     if(isset($usuarioIndex) && !empty($usuarioIndex) && !is_null($usuarioIndex)) {
            //         return view($vista, compact('usuarioIndex'));
            //     }
            // }
        }
        catch (Exception $e) {
            dd($e);
            alert()->error('Error', 'Error Exception, contacte a Soporte.');
            return back();
        }
    }
}
