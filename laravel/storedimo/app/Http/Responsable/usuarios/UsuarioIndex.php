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
        try {
            $baseUri = env('BASE_URI');
            $clientApi = new Client(['base_uri' => $baseUri]);

            // ==============================================================
            
            // Realiza la solicitud a la API
            $response = $clientApi->get($baseUri . 'usuarios_index');
            $usuarioIndex = json_decode($response->getBody()->getContents(), true);

            if(isset($usuarioIndex) && !empty($usuarioIndex) && !is_null($usuarioIndex)) {
                return view('usuarios.index', compact('usuarioIndex'));
            }
        } catch (Exception $e) {
            dd($e);
            alert()->error('Error', 'Error Exception, contacte a Soporte.');
            return back();
        }
    }
}
