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
        $formEntradas = request('form_entradas', null); // Identifico el formulario origen entradas
        $formVentas = request('form_ventas', null); // Identifico el formulario origen ventas

        $nombreProducto = request('nombre_producto', null);
        $idCategoria = request('id_categoria', null);
        $precioUnitario = request('precio_unitario', null);
        $precioDetal = request('precio_detal', null);
        $precioPorMayor = request('precio_por_mayor', null);
        $descripcion = request('descripcion', null);
        $stockMinimo = request('stock_minimo', null);
        $idEstado = 1;

        // ========================================================

        if ( isset($formEntradas) && !is_null($formEntradas) && !empty($formEntradas) ) {
            $formStore = $formEntradas;
        } else {
            $formStore = $formVentas;
        }
        
        // ========================================================
        
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
            $respuestaProductoStore = json_decode($peticionProductoStore->getBody()->getContents());

            // ========================================================

            if (isset($respuestaProductoStore) && !empty($respuestaProductoStore)) {
                if ($formStore == 'crearProductoEntrada') {
                    alert()->success('Proceso Exitoso', 'Producto creado satisfactoriamente');
                    return redirect()->to(route('entradas.create'));
                } elseif ($formStore == 'crearProductoVenta'){
                    alert()->success('Proceso Exitoso', 'Producto creado satisfactoriamente');
                    return redirect()->to(route('ventas.create'));
                } else {
                    alert()->success('Proceso Exitoso', 'Producto creado satisfactoriamente');
                    return redirect()->to(route('productos.index'));
                }
            }
        } catch (Exception $e) {
            alert()->error('Error', 'Creando el producto, si el problema persiste, contacte a Soporte.' . $e->getMessage());
            return back();
        }
    }
}
