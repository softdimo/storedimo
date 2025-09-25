<?php

namespace App\Http\Responsable\unidades_medida;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use GuzzleHttp\Client;

class UnidadMedidaStore implements Responsable
{
    protected $baseUri;
    protected $clientApi;

    public function __construct()
    {
        $this->baseUri = env('BASE_URI');
        $this->clientApi = new Client(['base_uri' => $this->baseUri]);
    }

    // ===================================================================
    // ===================================================================

    public function toResponse($request)
    {
        $umd = request('umd', null);
        $abreviaturaUmd = request('abreviatura_umd', null);

        try {
            $peticion = $this->clientApi->post($this->baseUri.'unidad_medida_store', [
                'json' => [
                    'descripcion' => ucwords($umd),
                    'abreviatura' => ucwords($abreviaturaUmd),
                    'estado_id' => 1,
                    'id_audit' => session('id_usuario'),
                    'empresa_actual' => session('empresa_actual.id_empresa')
                ]
            ]);
            $respuesta = json_decode($peticion->getBody()->getContents());

            if(isset($respuesta->success) && $respuesta->success) {
                alert()->success('Proceso Exitoso', 'Unidad de Medida creada satisfactoriamente');
                return redirect()->to(route('unidades_medida.index'));
            }
        } catch (Exception $e) {
            alert()->error('Error', 'Exception creando la nueva unidad de medida, contacte a Soporte.');
            return back();
        }
    }
}
