<?php

namespace App\Http\Responsable\productos;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use App\Models\Producto;

class ProductoStore implements Responsable
{
    public function toResponse($request)
    {
        $idTipoPersona = request('id_tipo_persona', null);
        $nombreProducto = request('nombre_producto', null);
        $idCategoria = request('id_categoria', null);
        $precioUnitario = request('precio_unitario', null);
        $precioDetal = request('precio_detal', null);
        $precioPorMayor = request('precio_por_mayor', null);
        $descripcion = request('descripcion', null);
        $stockMinimo = request('stock_minimo', null);
        $idEstado = request('id_estado', null);
        $referencia = request('referencia', null);
        $fechaVencimiento = request('fecha_vencimiento', null);

        // ================================================

        try {
            $nuevoProducto = Producto::create([
                'id_tipo_persona' => $idTipoPersona,
                'nombre_producto' => $nombreProducto,
                'id_categoria' => $idCategoria,
                'precio_unitario' => $precioUnitario,
                'precio_detal' => $precioDetal,
                'precio_por_mayor' => $precioPorMayor,
                'descripcion' => $descripcion,
                'stock_minimo' => $stockMinimo,
                'id_estado' => $idEstado,
                'referencia' => $referencia,
                'fecha_vencimiento' => $fechaVencimiento
            ]);
    
            if (isset($nuevoProducto) && !is_null($nuevoProducto) && !empty($nuevoProducto)) {
                return response()->json(['success' => true]);
            }
        } catch (Exception $e) {
            return response()->json(['error_bd' => $e->getMessage()]);
        }
    }
}
