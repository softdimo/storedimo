<?php

namespace App\Http\Responsable\proveedores;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;

class ProveedorIndex implements Responsable
{
    public function toResponse($request)
    {
        try {
            $baseUri = env('BASE_URI');
            $clientApi = new Client(['base_uri' => $baseUri]);

            $peticion = $clientApi->get($baseUri . 'proveedores_index');
            $resProveedoresIndex = json_decode($peticion->getBody()->getContents());

            return view('proveedores.index', compact('resProveedoresIndex'));
        } catch (Exception $e) {
            alert()->error('Error', 'Exception resProveedoresIndex, contacte a Soporte.');
            return back();
        }
    }
}
