<?php

namespace App\Http\Responsable\usuarios;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Categoria;
use GuzzleHttp\Client;
use App\Traits\MetodosTrait;

class UsuarioIndex implements Responsable
{
    use MetodosTrait;

    public function toResponse($request)
    {
        try {
            // DB::connection()->getPDO();
            // DB::connection()->getDatabaseName();

            $baseUri = env('BASE_URI');
            $clientApi = new Client(['base_uri' => $baseUri]);
            $vista = 'usuarios.index';

            // ==============================================================

            $checkConnection = $this->checkDatabaseConnection($vista);

            if($checkConnection->getName() == 'db_conexion') {
            // if($this->checkDatabaseConnection($vista)->getName() == 'db_conexion') {
                return view('db_conexion');
            } else {
                // Realiza la solicitud a la API
                $response = $clientApi->get($baseUri . 'usuarios_index');
                $usuarioIndex = json_decode($response->getBody()->getContents(), true);

                if(isset($usuarioIndex) && !empty($usuarioIndex) && !is_null($usuarioIndex)) {
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
