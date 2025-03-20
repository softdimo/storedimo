<?php

namespace App\Http\Responsable\ventas;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use App\Models\Venta;

class VentaStore implements Responsable
{
    public function toResponse($request)
    {
        $idEmpresa = request('id_empresa', null);
        $idTipoCliente = request('id_tipo_cliente', null);
        $fechaVenta = request('fecha_venta', null);
        $descuento = request('descuento', null);
        $subtotalVenta = request('subtotal_venta', null);
        $totalVenta = request('total_venta', null);
        $idTipoPago = request('id_tipo_pago', null);
        $idProducto = request('id_producto', null);
        $idCliente = request('id_cliente', null);
        $usuLogueado = request('id_usuario');
        $idEstado = request('id_estado');
        $idEstadoCredito = request('id_estado_credito', null);
        $fechaLimiteCredito = request('fecha_limite_credito', null);

        try {
            $nuevaVenta = Venta::create([
                'id_empresa' => $idEmpresa,
                'id_tipo_cliente' => $idTipoCliente,
                'fecha_venta' => $fechaVenta,
                'descuento' => $descuento,
                'subtotal_venta' => $subtotalVenta,
                'total_venta' => $totalVenta,
                'id_tipo_pago' => $idTipoPago,
                'id_producto' => $idProducto,
                'id_cliente' => $idCliente,
                'id_usuario' => $usuLogueado,
                'id_estado' => $idEstado,
                'id_estado_credito' => $idEstadoCredito,
                'fecha_limite_credito' => $fechaLimiteCredito
            ]);

            if (isset($nuevaVenta) && !is_null($nuevaVenta) && !empty($nuevaVenta)) {
                return response()->json(['success' => true]);
            }

        } catch (Exception $e) {
            return response()->json(['error_bd' => $e->getMessage()]);
        }
    }
}
