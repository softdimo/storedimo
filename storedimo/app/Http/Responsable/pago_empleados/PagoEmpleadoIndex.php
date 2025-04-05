<?php

namespace App\Http\Responsable\pago_empleados;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;

class PagoEmpleadoIndex implements Responsable
{
    public function toResponse($request)
    {
        try {
            $baseUri = env('BASE_URI');
            $clientApi = new Client(['base_uri' => $baseUri]);

            // ==============================================================
            
            // Realiza la solicitud a la API
            $peticion = $clientApi->get($baseUri . 'pago_empleado_index');
            $pagoEmpleadosIndex = json_decode($peticion->getBody()->getContents());

            return view('pago_empleados.index', compact('pagoEmpleadosIndex'));

        } catch (Exception $e) {
            alert()->error('Error', 'Exception, contacte a Soporte.');
            return back();
        }
    }
}
