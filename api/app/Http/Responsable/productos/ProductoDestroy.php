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
        $idEstado = $producto->id_estado;

        try {
            if ($idEstado == 1) {
                $cambiarEstadoProducto = Producto::where('id_producto', $idProducto)->update(['id_estado' => 2,]);
            } else {
                $cambiarEstadoProducto = Producto::where('id_producto', $idProducto)->update(['id_estado' => 1,]);
            }

            if (isset($cambiarEstadoProducto) && !is_null($cambiarEstadoProducto) && !empty($cambiarEstadoProducto)) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['message' => 'No existe producto'], 404);
            }
        } catch (Exception $e) {
            return response()->json(['error_bd' => $e->getMessage()]);
        }
    }
}