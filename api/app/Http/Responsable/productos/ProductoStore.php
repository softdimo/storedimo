<?php

namespace App\Http\Responsable\productos;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use App\Models\Producto;

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
        $estado = request('estado', null);

        // ================================================

        $nuevoProducto = Producto::create([
            'nombre_producto' => $nombreProducto,
            'id_categoria' => $idCategoria,
            'precio_unitario' => $precioUnitario,
            'precio_detal' => $precioDetal,
            'precio_por_mayor' => $precioPorMayor,
            'descripcion' => $descripcion,
            'stock_minimo' => $stockMinimo,
            'estado' => $estado,
        ]);

        // ================================================

        if (isset($nuevoProducto) && !is_null($nuevoProducto) && !empty($nuevoProducto)) {
            return response()->json([
                'success' => true,
                'message' => 'Producto creado correctamente'
            ]);
        } else {
            return abort(404, $message = 'Producto no creado');
        }
    }

    // ===================================================================
    // ===================================================================


}