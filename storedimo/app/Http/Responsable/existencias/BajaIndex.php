<?php

namespace App\Http\Responsable\existencias;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;

class BajaIndex implements Responsable
{
    public function toResponse($request)
    {
        try {
            $baseUri = env('BASE_URI');
            $clientApi = new Client(['base_uri' => $baseUri]);

            // ==============================================================
            
            // Realiza la solicitud a la API
            $peticion = $clientApi->get($baseUri . 'baja_index');
            $bajasIndex = json_decode($peticion->getBody()->getContents());

            // Obtener detalles de cada compra
            foreach ($bajasIndex as $baja) {
                $detallePeticion = $clientApi->post($baseUri . 'baja_detalle/' . $baja->id_baja);
                $baja->detalles = json_decode($detallePeticion->getBody()->getContents());
            }

            return view('existencias.bajas_index', compact('bajasIndex'));
        } catch (Exception $e) {
            dd($e);
            alert()->error('Error', 'Exception Index Bajas, contacte a Soporte.');
            return back();
        }
    }
}
