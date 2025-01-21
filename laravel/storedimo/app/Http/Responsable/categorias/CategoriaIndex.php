<?php

namespace App\Http\Responsable\categorias;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;

class CategoriaIndex implements Responsable
{
    public function toResponse($request)
    {
        try {
            $baseUri = env('BASE_URI');
            $clientApi = new Client(['base_uri' => $baseUri]);

            // ==============================================================
            
            // Realiza la solicitud a la API
            $response = $clientApi->get($baseUri . 'categoria_index');
            $categorias = json_decode($response->getBody()->getContents(), true);

            if(isset($productos) && !empty($productos) && !is_null($productos)) {
                return view('categorias.index', compact('categorias'));
            }
        } catch (Exception $e) {
            alert()->error('Error', 'Exception Index Categorias, contacte a Soporte.');
            return back();
        }
    }
}
