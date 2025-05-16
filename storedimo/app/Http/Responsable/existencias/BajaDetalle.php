<?php

namespace App\Http\Responsable\existencias;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;

class BajaDetalle implements Responsable
{
    protected $idBaja;

    public function __construct($idBaja)
    {
        $this->idBaja = $idBaja;
    }

    public function toResponse($request)
    {
        try {
            $baseUri = env('BASE_URI');
            $clientApi = new Client(['base_uri' => $baseUri]);

            // ==============================================================
            
            // Realiza la solicitud a la API
            $peticion = $clientApi->get($baseUri . 'baja/'. $this->idBaja);
            $baja = json_decode($peticion->getBody()->getContents());

            // Obtener detalles de cada baja
            $detallePeticion = $clientApi->post($baseUri . 'baja_detalle/'. $this->idBaja);
            $bajaDetalles = json_decode($detallePeticion->getBody()->getContents());

            

            return view('existencias.modal_detalle_baja', compact('baja', 'bajaDetalles'));
        } catch (Exception $e) {
            dd($e);
            alert()->error('Error', 'Exception Index Bajas, contacte a Soporte.');
            return back();
        }
    }
}
