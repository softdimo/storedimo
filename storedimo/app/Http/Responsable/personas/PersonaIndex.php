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

            $response = $clientApi->get($baseUri . 'personas_index');
            return json_decode($response->getBody()->getContents());
        } catch (Exception $e) {
            return null;
        }
    }
}
