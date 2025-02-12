<?php

namespace App\Http\Responsable\personas;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;

class PersonaIndex implements Responsable
{
    public function toResponse($request)
    {
        try {
            $baseUri = env('BASE_URI');
            $clientApi = new Client(['base_uri' => $baseUri]);

            // ==============================================================
            
            // Realiza la solicitud a la API
            $response = $clientApi->get($baseUri . 'personas_index');
            $personaIndex = json_decode($response->getBody()->getContents());

            return view('personas.index', compact('personaIndex'));
            
        } catch (Exception $e) {
            alert()->error('Error', 'Error Exception, contacte a Soporte.');
            return back();
        }
    }
}
