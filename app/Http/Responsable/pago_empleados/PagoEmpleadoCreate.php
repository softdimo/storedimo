<?php

namespace App\Http\Responsable\pago_empleados;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;

class PagoEmpleadoCreate implements Responsable
{
    public function toResponse($request)
    {
        try {
            $baseUri = env('BASE_URI');
            $clientApi = new Client(['base_uri' => $baseUri]);

            // ==============================================================
            
            // Realiza la solicitud a la API
            $peticion = $clientApi->get($baseUri . 'pago_empleado_create');
            $pagoEmpleadosCreate = json_decode($peticion->getBody()->getContents());

            return view('pago_empleados.create', compact('pagoEmpleadosCreate'));

        } catch (Exception $e) {
            dd($e);
            alert()->error('Error', 'Exception, contacte a Soporte.');
            return back();
        }
    }
}
