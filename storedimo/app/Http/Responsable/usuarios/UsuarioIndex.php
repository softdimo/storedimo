<?php

namespace App\Http\Responsable\usuarios;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use GuzzleHttp\Client;

class UsuarioIndex implements Responsable
{
    public function toResponse($request)
    {
        try
        {
            $baseUri = env('BASE_URI');
            $clientApi = new Client(['base_uri' => $baseUri]);
            
            // Inicializar la variable con un array vacío por defecto
            $usuarioIndex = [];
            
            // Realiza la solicitud a la API
            $response = $clientApi->get($baseUri . 'administracion/usuarios_index');
            $result = json_decode($response->getBody()->getContents());
            
            // Si hay datos válidos, actualizar usuarioIndex
            if (!empty($result) && is_array($result)) {
                $usuarioIndex = $result;
            }

            // Siempre retornar la vista con usuarioIndex (sea array vacío o con datos)
            return view('usuarios.index', compact('usuarioIndex'));
            
        } catch (Exception $e) {
            alert()->error('Error', 'Error Exception, contacte a Soporte.');
            return back()->with('usuarioIndex', []);
        }
    }
}
