<?php

namespace App\Http\Responsable\existencias;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;

class BajaStore implements Responsable
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
        // dd($request);

        $responsableBaja = session('id_usuario');
        $fechaBaja = now()->format('Y-m-d H:i:s'); // Formato compatible con DATETIME en MySQL
        $idEstado = 1;

        $idProductos = request('id_producto', []); // Array de productos
        $cantidades = request('cantidad_baja', []); // Array de cantidades
        $idTiposBaja = request('id_tipo_baja', []); // Array tipos de baja

        try {
            $reqBajaStore = $this->clientApi->post($this->baseUri.'baja_store', [
                'json' => [
                    'id_responsable_baja' => $responsableBaja,
                    'fecha_baja' => $fechaBaja,
                    'id_estado_baja' => $idEstado,
                    'productos' => array_map(function ($idProductos, $cantidades, $idTiposBaja) {
                        return [
                            'id_producto' => $idProductos,
                            'cantidad' => $cantidades,
                            'id_tipo_baja' => $idTiposBaja
                        ];
                    }, $idProductos, $cantidades, $idTiposBaja), // Construcción del array
                ]
            ]);
            $resBajaStore = json_decode($reqBajaStore->getBody()->getContents());

            if(isset($resBajaStore) && !empty($resBajaStore) && !is_null($resBajaStore)) {
                alert()->success('Proceso Exitoso', 'Baja registrada satisfactoriamente');
                return redirect()->to(route('bajas_index'));
            }
        } catch (Exception $e) {
            dd($e);
            alert()->error('Error', 'Registrando la baja, contacte a Soporte.');
            return back();
        }
    } // FIN function toResponse
} // FIN Class EntradaStore
