<?php

namespace App\Http\Responsable\existencias;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Baja;

class BajaIndex implements Responsable
{
    public function toResponse($request)
    {
        try {
            $bajas = Baja::leftjoin('usuarios','usuarios.id_usuario','=','bajas.id_responsable_baja')
                ->leftjoin('estados','estados.id_estado','=','bajas.id_estado_baja')
                ->select(
                    'id_baja',
                    'id_usuario',
                    DB::raw("CONCAT(nombre_usuario, ' ', apellido_usuario, ' - ', identificacion) AS nombres_usuario"),
                    'fecha_baja',
                    'id_estado_baja',
                    'estado'
                )
                ->orderByDesc('fecha_baja')
                ->get();

                return response()->json($bajas);

        } catch (Exception $e) {
            return response()->json(['error_bd' => $e->getMessage()]);
        }
    }
}
