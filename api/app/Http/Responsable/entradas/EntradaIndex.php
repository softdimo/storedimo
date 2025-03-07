<?php

namespace App\Http\Responsable\entradas;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Compra;

class EntradaIndex implements Responsable
{
    public function toResponse($request)
    {
        try {
            $entradas = Compra::leftjoin('personas','personas.id_persona','=','compras.id_proveedor')
                ->leftjoin('usuarios','usuarios.id_usuario','=','compras.id_usuario')
                ->leftjoin('estados','estados.id_estado','=','compras.id_estado')
                ->select(
                    'id_compra',
                    'fecha_compra',
                    'valor_compra',
                    'id_proveedor',
                    'nombre_empresa',
                    'nit_empresa',
                    'compras.id_usuario',
                    'nombre_usuario',
                    'compras.id_estado',
                    'estado'
                )
                ->orderByDesc('fecha_compra')
                ->get();

                return response()->json($entradas);

        } catch (Exception $e) {
            return response()->json(['error_bd' => $e->getMessage()]);
        }
    }
}
