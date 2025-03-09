<?php

namespace App\Http\Responsable\ventas;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Venta;

class VentaStore implements Responsable
{
    public function toResponse($request)
    {
        $fechaCompra = request('fecha_compra', null);
        $valorCompra = request('valor_compra', null);
        $idProveedor = request('id_proveedor', null);
        $idProductoCompra = request('id_producto_compra', null);
        $usuLogueado = request('id_usuario', null);
        $idEstado = request('id_estado', null);

        try {
            $nuevaCompra = Venta::create([
                'fecha_compra' => $fechaCompra,
                'valor_compra' => $valorCompra,
                'id_proveedor' => $idProveedor,
                'id_producto' => $idProductoCompra,
                'id_usuario' => $usuLogueado,
                'id_estado' => $idEstado
            ]);

            if (isset($nuevaCompra) && !is_null($nuevaCompra) && !empty($nuevaCompra)) {
                return response()->json(['success' => true]);
            }

        } catch (Exception $e) {
            return response()->json(['error_bd' => $e->getMessage()]);
        }
    }
}
