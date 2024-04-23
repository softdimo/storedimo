<?php

namespace App\Http\Responsable\productos;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;

class ProductoQueryBarCode implements Responsable
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
            $producto = Producto::select('id_producto','nombre_producto')
            ->where('id_producto', $idProducto)
            ->first();

            if (isset($producto) && !is_null($producto) && !empty($producto)) {
                return response()->json($producto);
            } else {
                return response()->json([
                    'message' => 'No existe producto'
                ], 404);
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error consultando la base de datos',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}