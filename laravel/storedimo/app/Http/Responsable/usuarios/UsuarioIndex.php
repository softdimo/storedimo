<?php

namespace App\Http\Responsable\usuarios;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Categoria;
use GuzzleHttp\Client;

class UsuarioIndex implements Responsable
{
    public function toResponse($request)
    {
        $baseUri = env('BASE_URI');
        $clientApi = new Client(['base_uri' => $baseUri]);
        
        try {
            // Realiza la solicitud POST a la API
            $response = $clientApi->get($baseUri . 'usuarios_index');
            $usuarioIndex = json_decode($response->getBody()->getContents(), true);
            
            return view('usuarios.index', compact('usuarioIndex'));
    
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
