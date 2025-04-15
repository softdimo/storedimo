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
                $producto->id_estado = 2;
            } else {
                $producto->id_estado = 1;
            }

            $producto->save();

            
            return response()->json(['success' => true]);
        } catch (Exception $e) {
            return response()->json(['error_bd' => $e->getMessage()]);
        }
    }
}