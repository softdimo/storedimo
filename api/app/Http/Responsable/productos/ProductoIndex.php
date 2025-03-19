<?php

namespace App\Http\Responsable\productos;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use App\Models\Producto;

class ProductoIndex implements Responsable
{
    public function toResponse($request)
    {
        try {
            $productos = Producto::leftJoin('categorias', 'categorias.id_categoria', '=', 'productos.id_categoria')
                ->leftJoin('estados', 'estados.id_estado', '=', 'productos.id_estado')
                ->leftJoin('tipo_persona', 'tipo_persona.id_tipo_persona', '=', 'productos.id_tipo_persona')
                ->select(
                    'id_producto',
                    'nombre_producto',
                    'productos.id_categoria',
                    'categorias.categoria',
                    'precio_unitario',
                    'precio_detal',
                    'precio_por_mayor',
                    'descripcion',
                    'stock_minimo',
                    'productos.id_estado',
                    'estados.estado',
                    'cantidad',
                    'tipo_persona.id_tipo_persona',
                    'tipo_persona'
                )
                ->orderBy('nombre_producto', 'ASC')
                ->get();

            if (isset($productos) && !is_null($productos) && !empty($productos)) {
                return response()->json($productos);
            } else {
                return response()->json([
                    'message' => 'no hay productos'
                ], 404);
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error en la consulta de la base de datos',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
