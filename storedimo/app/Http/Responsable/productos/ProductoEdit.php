<?php

namespace App\Http\Responsable\productos;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use GuzzleHttp\Client;

class ProductoEdit implements Responsable
{
    protected $idProducto;
    protected $categorias;

    public function __construct($idProducto, $categorias)
    {
        $this->idProducto = $idProducto;
        $this->categorias = $categorias;
    }

    public function toResponse($request)
    {
        $idProducto = $this->idProducto;
        $categorias = $this->categorias;
        view()->share('categorias', $categorias);
        try {
            $baseUri = env('BASE_URI');
            $clientApi = new Client(['base_uri' => $baseUri]);
            
            // Realiza la solicitud a la API
            $response = $clientApi->post($baseUri . 'producto_edit/'.$idProducto, [
                'json' => [
                    'empresa_actual' => session('empresa_actual.id_empresa')
                ]
            ]);
            $productoEdit = json_decode($response->getBody()->getContents());

            // Recibe el tipo de modal desde la request
            $tipoModal = $request->get('tipo_modal', 'editar'); // valor por defecto

            return match ($tipoModal) {
                'qr'     => view('productos.modal_codigo_qr', compact('productoEdit')),
                'estado' => view('productos.modal_estado_producto', compact('productoEdit')),
                default  => view('productos.modal_editar_producto', compact('productoEdit')),
            };
            
        } catch (Exception $e) {
            dd($e);
            alert()->error('Error', 'Error consulta producto, si el problema persiste, contacte a Soporte.');
            return back();
        }
    }
}
