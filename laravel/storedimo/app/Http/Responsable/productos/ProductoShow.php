<?php

namespace App\Http\Responsable\productos;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Contracts\Support\Responsable;
use GuzzleHttp\Client;
use App\Models\Producto;

class ProductoShow implements Responsable
{
    protected $idProducto;

    public function __construct($idProducto)
    {
        $this->idProducto = $idProducto;
    }

    public function toResponse($request)
    {
        $idProducto = $this->idProducto;

        try {
            // Realiza la solicitud POST a la API
            $clientApi = new Client([
                'base_uri' => 'http://localhost:8000/api/producto_show/'.$idProducto,
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'body' => json_encode([
                    
                ])
            ]);

            $response = $clientApi->request('POST');
            $res = $response->getBody()->getContents();
            $producto = json_decode($res, true );

            if(isset($producto) && !empty($producto))
            {
                return response()->json($producto);
            } else {
                alert()->error('Error', 'No existe el producto.');
                return redirect()->to(route('productos.index'));
            }
        } // FIN Try
        catch (Exception $e)
        {
            alert()->error('Error', 'Error consulta producto, si el problema persiste, contacte a Soporte.');
            return back();
        }
    }
}
