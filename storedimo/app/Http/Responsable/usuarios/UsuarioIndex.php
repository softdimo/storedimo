<?php

namespace App\Http\Responsable\usuarios;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
            
            try {
                // Realiza la solicitud a la API
                $response = $clientApi->get($baseUri . 'usuarios_index');
                $result = json_decode($response->getBody()->getContents());
                
                // Si hay datos válidos, actualizar usuarioIndex
                if (!empty($result) && is_array($result)) {
                    $usuarioIndex = $result;
                }
            } catch (Exception $apiError) {
                // Log del error específico de la API si es necesario
                \Log::error('Error al obtener usuarios de la API: ' . $apiError->getMessage());
            }

            // Siempre retornar la vista con usuarioIndex (sea array vacío o con datos)
            return view('usuarios.index', compact('usuarioIndex'));
            
        } catch (Exception $e)
        {
            \Log::error('Error general en UsuarioIndex: ' . $e->getMessage());
            alert()->error('Error', 'Error Exception, contacte a Soporte.');
            return back()->with('usuarioIndex', []);
        }
    }
}
