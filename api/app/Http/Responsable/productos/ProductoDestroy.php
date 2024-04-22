<?php

namespace App\Http\Responsable\productos;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;

class ProductoDestroy implements Responsable
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

        $producto = Producto::where('id_producto', $idProducto)->first();
        $estado = $producto->estado;

        try {
            if ($estado == 1) {
                $cambiarEstadoProducto = Producto::where('id_producto', $idProducto)->update(['estado' => 2,]);
            } else {
                $cambiarEstadoProducto = Producto::where('id_producto', $idProducto)->update(['estado' => 1,]);
            }

            if (isset($cambiarEstadoProducto) && !is_null($cambiarEstadoProducto) && !empty($cambiarEstadoProducto)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Estado Cambiado'
                ]);
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