<?php

namespace App\Http\Responsable\ventas;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;

class VentaIndex implements Responsable
{
    public function toResponse($request)
    {
        try {
            $baseUri = env('BASE_URI');
            $clientApi = new Client(['base_uri' => $baseUri]);

            // ==============================================================
            
            // Realiza la solicitud a la API
            $peticion = $clientApi->get($baseUri . 'venta_index');
            $ventas = json_decode($peticion->getBody()->getContents());

            return view('ventas.index', compact('ventas'));

        } catch (Exception $e) {
            alert()->error('Error', 'Exception Index Ventas, contacte a Soporte.');
            return back();
        }
    }
}
