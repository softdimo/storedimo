<?php

namespace App\Http\Responsable\productos;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

class ProductoDestroy implements Responsable
{
    public function toResponse($request)
    {
        $idProducto = request('id_producto', null);

        try {
            $baseUri = env('BASE_URI');
            $clientApi = new Client(['base_uri' => $baseUri]);

            // Realiza la solicitud a la API
            $response = $clientApi->post($baseUri . 'cambiar_estado/'.$idProducto);
            $respuesta = json_decode($response->getBody()->getContents(), true);

            if(isset($respuesta) && !empty($respuesta)) {
                return response()->json("estado_cambiado");
            }
        } catch (Exception $e) {
            return response()->json("error_exception");
        }
    }
}
