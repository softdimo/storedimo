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
        $baseUri = env('BASE_URI');
        $clientApi = new Client(['base_uri' => $baseUri]);
        
        try {
            // Realiza la solicitud POST a la API
            $response = $clientApi->get($baseUri . 'usuarios_index');
            $usuarioIndex = json_decode($response->getBody()->getContents(), true);

            $vista = 'usuarios.index';

            if(isset($usuarioIndex) && !empty($usuarioIndex) && !is_null($usuarioIndex))
            {
                $checkConnection = $this->checkDatabaseConnection($vista);
                if($checkConnection->getName() == "db_conexion") {
                    return view('db_conexion');
                } else {
                    return view($vista, compact('usuarioIndex'));
                }
            }
    
        }
        catch (Exception $e) {
            dd($e);
            alert()->error('Error', 'Error Exception, contacte a Soporte.');
            return back();
        }
    }

    // ===================================================================
    // ===================================================================

    // private function consultarCategoria($categoria)
    // {
    //     try
    //     {
    //         $usuario = Usuario::where('usuario', $usuario)->first();
    //         return $usuario;

    //     }
    //     catch (Exception $e)
    //     {
    //         alert()->error('Error', 'Error, inténtelo de nuevo, si el problema persiste, contacte a Soporte.');
    //         return back();
    //     }
    // }

    // ===================================================================
    // ===================================================================


}
