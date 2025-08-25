<?php

namespace App\Http\Responsable\entradas;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class DetalleEntrada implements Responsable
{
    protected $idEntrada;

    public function __construct($idEntrada)
    {
        $this->idEntrada = $idEntrada;
    }
    public function toResponse($request)
    {
        try {
            $baseUri = env('BASE_URI');
            // $clientApi = new Client(['base_uri' => $baseUri]);
            $clientApi = new Client([
                'base_uri' => $baseUri,
                'timeout'  => 10.0, // máximo 10 segundos
                'connect_timeout' => 5.0 // máximo 5 segundos para conectar
            ]);

            // ==============================================================
            
            // Realiza la solicitud a la API
            $peticion = $clientApi->get($baseUri . 'entrada/'. $this->idEntrada, [
                'query' => [
                    'empresa_actual' => session('empresa_actual.id_empresa')
                ]
            ]);
            // try {
            //     $peticion = $clientApi->get($baseUri . 'entrada/'. $this->idEntrada, [
            //         'query' => [
            //             'empresa_actual' => session('empresa_actual.id_empresa')
            //         ],
            //         'timeout' => 10,
            //     ]);
            // } catch (\GuzzleHttp\Exception\RequestException $e) {
            //     Log::error('Error en API entrada: ' . $e->getMessage());
            //     throw $e;
            // }
            $entrada = json_decode($peticion->getBody()->getContents());

            // Obtener detalles de cada compra
            $detallePeticion = $clientApi->post($baseUri . 'detalle_compra/' . $this->idEntrada, [
                'json' => [
                    'empresa_actual' => session('empresa_actual.id_empresa')
                ],
                'timeout' => 10,
            ]);
            $entradaDetalles = json_decode($detallePeticion->getBody()->getContents());

            // Recibe el tipo de modal desde la request
            $tipoModal = $request->get('tipo_modal', 'detalle_compra'); // valor por defecto

            return match ($tipoModal) {
                'anular_compra' => view('entradas.modal_anular_entrada', compact('entrada')),
                default  => view('entradas.modal_detalle_entrada', compact('entrada', 'entradaDetalles')),
            };
            
        } catch (Exception $e) {
            alert()->error('Error', 'Consultando la compra, contacte a Soporte.');
            return back();
        }
    }
}
