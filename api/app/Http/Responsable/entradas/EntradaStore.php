<?php

namespace App\Http\Responsable\entradas;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Compra;

class EntradaStore implements Responsable
{
    public function toResponse($request)
    {
        $fechaCompra = request('fecha_compra', null);
        $valorCompra = request('valor_compra', null);
        $idProveedor = request('id_proveedor', null);
        $usuLogueado = request('id_usuario', null);
        $idEstado = request('id_estado', null);

        try {
            $nuevaCompra = Compra::create([
                'fecha_compra' => $fechaCompra,
                'valor_compra' => $valorCompra,
                'id_proveedor' => $idProveedor,
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
