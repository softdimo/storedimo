<?php

namespace App\Http\Responsable\existencias;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;

class StockMinimo implements Responsable
{
    public function toResponse($request)
    {
        try {
            $baseUri = env('BASE_URI');
            $clientApi = new Client(['base_uri' => $baseUri]);

            // ==============================================================
            
            // Realiza la solicitud a la API
            $peticion = $clientApi->get($baseUri . 'stock_minimo_index');
            $stockMinimoIndex = json_decode($peticion->getBody()->getContents());

            return view('existencias.stock_minimo', compact('stockMinimoIndex'));
        } catch (Exception $e) {
            alert()->error('Error', 'Exception Index stockMinimoIndex, contacte a Soporte.');
            return back();
        }
    }
}
