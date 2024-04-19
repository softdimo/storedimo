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

        // try {
        //     $producto = Producto::leftJoin('categorias', 'categorias.id_categoria', '=', 'productos.id_categoria')
        //         ->select(
        //             'id_producto',
        //             'nombre_producto',
        //             'categorias.id_categoria',
        //             'categorias.categoria',
        //             'descripcion',
        //             'stock_minimo',
        //             'precio_unitario',
        //             'precio_detal',
        //             'precio_por_mayor'
        //         )
        //         ->where('id_producto', $idProducto)
        //         ->first();

        //     if (isset($producto) && !is_null($producto) && !empty($producto)) {
        //         return response()->json($producto);
        //     } else {
        //         return response()->json([
        //             'message' => 'No existe producto'
        //         ], 404);
        //     }
        // } catch (Exception $e) {
        //     return response()->json([
        //         'message' => 'Error consultando la base de datos',
        //         'error' => $e->getMessage(),
        //     ], 500);
        // }

        try {
            // Realiza la solicitud POST a la API
            $clientApi = new Client([
                'base_uri' => 'http://localhost:8000/api/producto_edit/'.$idProducto,
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
