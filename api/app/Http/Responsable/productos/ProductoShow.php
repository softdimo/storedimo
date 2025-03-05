<?php

namespace App\Http\Responsable\productos;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;

class ProductoShow implements Responsable
{
    protected $idProducto;

    // =========================================

    public function __construct($idProducto)
    {
        $this->idProducto = $idProducto;
    }

    // =========================================

    public function toResponse($request)
    {
        $idProducto = $this->idProducto;

        try {
            $producto = Producto::select(
                'id_producto',
                'nombre_producto',
                DB::raw("CONCAT('$', REPLACE(TO_CHAR(precio_unitario, '999G999G999'), ',', '.')) AS precio_unitario"),
                DB::raw("CONCAT('$', REPLACE(TO_CHAR(precio_detal, '999G999G999'), ',', '.')) AS precio_detal"),
                DB::raw("CONCAT('$', REPLACE(TO_CHAR(precio_por_mayor, '999G999G999'), ',', '.')) AS precio_por_mayor")
            )
            ->where('id_producto', $idProducto)
            ->orderBy('nombre_producto', 'ASC')
            ->first();

            if (isset($producto) && !is_null($producto) && !empty($producto)) {
                return response()->json($producto);
            } else {
                return response()->json(['message' => 'No existe producto'], 404);
            }
        } catch (Exception $e) {
            return response()->json(['error_bd' => $e->getMessage()]);
        }
    }
}