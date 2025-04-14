<?php

namespace App\Http\Responsable\categorias;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

class CategoriaDestroy implements Responsable
{
    public function toResponse($request)
    {
        $idCategoria = request('id_categoria', null);

        try {
            $baseUri = env('BASE_URI');
            $clientApi = new Client(['base_uri' => $baseUri]);

            // Realiza la solicitud a la API
            $response = $clientApi->post($baseUri . 'cambiar_estado_categoria/'.$idCategoria);
            $respuesta = json_decode($response->getBody()->getContents());

            if(isset($respuesta) && !empty($respuesta)) {

                alert()->success('Proceso Exitoso', 'Estado cambiado satisfactoriamente');
                return redirect()->to(route('categorias.index'));
            }
        } catch (Exception $e) {

            alert()->error('Error', 'Cambiando el estado de la categoría, contacte a Soporte.' . $e->getMessage());
            return back();
        }
    }
}
