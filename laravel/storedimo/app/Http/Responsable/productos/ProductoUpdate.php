<?php

namespace App\Http\Responsable\productos;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

class ProductoUpdate implements Responsable
{
    public function toResponse($request)
    {
        $idProducto = request('idProductoEdit', null);
        $nombreProductoEdit = request('nombreProductoEdit', null);
        $categoriaEdit = request('categoriaEdit', null);
        $descripcionEdit = request('descripcionEdit', null);
        $precioUnitarioEdit = request('precioUnitarioEdit', null);
        $precioPorMayorEdit = request('precioPorMayorEdit', null);
        $precioDetalEdit = request('precioDetalEdit', null);
        $stockMinimoEdit = request('stockMinimoEdit', null);

        // ===================================================================
        // ===================================================================

        $baseUri = env('BASE_URI');
        $clientApi = new Client(['base_uri' => $baseUri]);

        try {
            $peticionProductoUpdate = $clientApi->put($baseUri.'producto_update/'.$idProducto, [
                'json' => [
                    'nombre_producto' => $nombreProductoEdit,
                    'id_categoria' => $categoriaEdit,
                    'descripcion' => $descripcionEdit,
                    'stock_minimo' => $stockMinimoEdit,
                    'precio_unitario' => $precioUnitarioEdit,
                    'precio_detal' => $precioDetalEdit,
                    'precio_por_mayor' => $precioPorMayorEdit
                ]
            ]);
            $respuestaProductoUpdate = json_decode($peticionProductoUpdate->getBody()->getContents(), true);

            // ===================================================================

            if(isset($respuestaProductoUpdate) && !empty($respuestaProductoUpdate)) {
                alert()->success('Proceso Exitoso', 'Producto editado satisfactoriamente');
                return redirect()->to(route('productos.index'));
            }
        } catch (Exception $e) {
            alert()->error('Error', 'Excepción, intente de nuevo, si el problema persiste, contacte a Soporte.' . $e->getMessage());
            return back();
        }
    }
}
