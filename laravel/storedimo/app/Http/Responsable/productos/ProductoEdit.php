<?php

namespace App\Http\Responsable\productos;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Contracts\Support\Responsable;
use GuzzleHttp\Client;
use App\Models\Producto;

class ProductoEdit implements Responsable
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
            $baseUri = env('BASE_URI');
            $clientApi = new Client(['base_uri' => $baseUri]);
            
            // Realiza la solicitud a la API
            $response = $clientApi->post($baseUri . 'producto_edit/'.$idProducto);
            $producto = json_decode($response->getBody()->getContents(), true);

            if(isset($producto) && !empty($producto)) {
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
