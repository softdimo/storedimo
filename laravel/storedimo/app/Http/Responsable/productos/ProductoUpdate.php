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

        try {
            // Realiza la solicitud POST a la API
            $clientApi = new Client([
                'base_uri' => 'http://localhost:8000/api/producto_update/'.$idProducto,
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'body' => json_encode([
                    'nombre_producto' => $nombreProductoEdit,
                    'id_categoria' => $categoriaEdit,
                    'descripcion' => $descripcionEdit,
                    'stock_minimo' => $stockMinimoEdit,
                    'precio_unitario' => $precioUnitarioEdit,
                    'precio_detal' => $precioDetalEdit,
                    'precio_por_mayor' => $precioPorMayorEdit
                ])
            ]);

            $response = $clientApi->request('POST');
            $res = $response->getBody()->getContents();
            $respuesta = json_decode($res, true);

            if(isset($respuesta) && !empty($respuesta))
            {
                DB::connection('pgsql')->commit();
                alert()->success('Proceso Exitoso', 'Producto editado satisfactoriamente');
                return redirect()->to(route('productos.index'));

            } else {
                DB::connection('pgsql')->rollback();
                alert()->error('Error', 'Producto No editado');
                return redirect()->to(route('productos.index'));
            }
        } // FIN Try
        catch (Exception $e)
        {
            DB::connection('pgsql')->rollback();
            alert()->error('Error', 'Excepción, intente de nuevo, si el problema persiste, contacte a Soporte.');
            return back();
        } // FIN Catch
    }
}
