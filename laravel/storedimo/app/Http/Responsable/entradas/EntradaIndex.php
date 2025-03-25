<?php

namespace App\Http\Responsable\entradas;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;

class EntradaIndex implements Responsable
{
    public function toResponse($request)
    {
        try {
            $baseUri = env('BASE_URI');
            $clientApi = new Client(['base_uri' => $baseUri]);

            // ==============================================================
            
            // Realiza la solicitud a la API
            $peticion = $clientApi->get($baseUri . 'entrada_index');
            $entradas = json_decode($peticion->getBody()->getContents());

            // Obtener detalles de cada compra
            foreach ($entradas as $entrada) {
                $detallePeticion = $clientApi->post($baseUri . 'detalle_compra/' . $entrada->id_compra);
                $entrada->detalles = json_decode($detallePeticion->getBody()->getContents());
            }

            return view('entradas.index', compact('entradas'));
        } catch (Exception $e) {
            dd($e);
            alert()->error('Error', 'Exception Index Entradas, contacte a Soporte.');
            return back();
        }
    }
}
