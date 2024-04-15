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
        
        // Consultamos si ya existe un usuario con la cedula ingresada
        // $consultaCategoria = Categoria::where('categoria', $categoria)->first();
        
        // if(isset($consultaCategoria) && !empty($consultaCategoria) && !is_null($consultaCategoria)) {
        //     alert()->info('Info', 'Esta categoría ya existe.');
        //     return back();
        // } else {

            DB::connection('pgsql')->beginTransaction();

            try {
                // Realiza la solicitud POST a la API
                $clientApi = new Client([
                    'base_uri' => 'http://localhost:8000/api/producto_store',
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                    ],
                    'body' => json_encode([
                        'nombre_producto' => $nombreProducto,
                        'id_categoria' => $idCategoria,
                        'precio_unitario' => $precioUnitario,
                        'precio_detal' => $precioDetal,
                        'precio_por_mayor' => $precioPorMayor,
                        'descripcion' => $descripcion,
                        'stock_minimo' => $stockMinimo,
                        'estado' => 1,
                    ])
                ]);

                $response = $clientApi->request('POST');
                $res = $response->getBody()->getContents();
                $respuesta = json_decode($res, true );

                if(isset($respuesta) && !empty($respuesta))
                {
                    DB::connection('pgsql')->commit();
                    alert()->success('Proceso Exitoso', 'Producto creado satisfactoriamente');
                    return redirect()->to(route('productos.index'));

                } else {
                    DB::connection('pgsql')->rollback();
                    alert()->error('Error', 'Ha ocurrido un error al crear el producto, por favor contacte a Soporte.');
                    return redirect()->to(route('productos.index'));
                }
            } // FIN Try
            catch (Exception $e)
            {
                dd($e);
                DB::connection('pgsql')->rollback();
                alert()->error('Error', 'Error creando el producto, si el problema persiste, contacte a Soporte.');
                return back();
            }
        // } // FIN else
    }

    // ===================================================================
    // ===================================================================

    // private function consultarCategoria($categoria)
    // {
    //     try
    //     {
    //         $usuario = Usuario::where('usuario', $usuario)->first();
    //         return $usuario;

    //     }
    //     catch (Exception $e)
    //     {
    //         alert()->error('Error', 'Error, inténtelo de nuevo, si el problema persiste, contacte a Soporte.');
    //         return back();
    //     }
    // }

    // ===================================================================
    // ===================================================================


}
