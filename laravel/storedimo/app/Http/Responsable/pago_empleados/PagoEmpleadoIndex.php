<?php

namespace App\Http\Responsable\prestamos;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;

class PrestamoIndex implements Responsable
{
    public function toResponse($request)
    {
        try {
            $baseUri = env('BASE_URI');
            $clientApi = new Client(['base_uri' => $baseUri]);

            // ==============================================================
            
            // Realiza la solicitud a la API
            $peticion = $clientApi->get($baseUri . 'prestamo_index');
            $prestamosIndex = json_decode($peticion->getBody()->getContents());

            return view('prestamos.index', compact('prestamosIndex'));

        } catch (Exception $e) {
            alert()->error('Error', 'Exception, contacte a Soporte.');
            return back();
        }
    }
}
