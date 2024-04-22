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
            // Realiza la solicitud POST a la API
            $clientApi = new Client([
                'base_uri' => 'http://localhost:8000/api/cambiar_estado/'.$idProducto,
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'body' => json_encode([])
            ]);

            $response = $clientApi->request('POST');
            $res = $response->getBody()->getContents();
            $respuesta = json_decode($res, true);

            if(isset($respuesta) && !empty($respuesta))
            {
                return response()->json("estado_cambiado");

            }
        } // FIN Try
        catch (Exception $e)
        {
            return response()->json("error_exception");
        } // FIN Catch
    }
}
