<?php

namespace App\Http\Responsable\productos;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;
use GuzzleHttp\Client;

class ProductoStore implements Responsable
{
    public function toResponse($request)
    {
        $nombreProducto = request('nombre_producto', null);
        $idCategoria = request('id_categoria', null);
        $precioUnitario = request('precio_unitario', null);
        $precioDetal = request('precio_detal', null);
        $precioPorMayor = request('precio_por_mayor', null);
        $descripcion = request('descripcion', null);
        $stockMinimo = request('stock_minimo', null);
        $idEstado = 1;

        // ========================================================
        
        DB::connection('mysql')->beginTransaction();

        $baseUri = env('BASE_URI');
        $clientApi = new Client(['base_uri' => $baseUri]);

        try {
            $peticionProductoStore = $clientApi->post($baseUri.'producto_store', [
                'json' => [
                    'nombre_producto' => $nombreProducto,
                    'id_categoria' => $idCategoria,
                    'precio_unitario' => $precioUnitario,
                    'precio_detal' => $precioDetal,
                    'precio_por_mayor' => $precioPorMayor,
                    'descripcion' => $descripcion,
                    'stock_minimo' => $stockMinimo,
                    'id_estado' => $idEstado
                ]
            ]);
            $respuestaProductoStore = json_decode($peticionProductoStore->getBody()->getContents(), true);

            // ========================================================

            if(isset($respuestaProductoStore) && !empty($respuestaProductoStore))
            {
                DB::connection('mysql')->commit();
                alert()->success('Proceso Exitoso', 'Producto creado satisfactoriamente');
                return redirect()->to(route('productos.index'));

            } else {
                DB::connection('mysql')->rollback();
                alert()->error('Error', 'Ha ocurrido un error al crear el producto, por favor contacte a Soporte.');
                return redirect()->to(route('productos.index'));
            }
        } // FIN Try
        catch (Exception $e)
        {
            DB::connection('mysql')->rollback();
            alert()->error('Error', 'Error creando el producto, si el problema persiste, contacte a Soporte.' . $e->getMessage());
            return back();
        }
    }
}
