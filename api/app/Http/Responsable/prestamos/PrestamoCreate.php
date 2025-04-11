<?php

namespace App\Http\Responsable\prestamos;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Prestamo;

class PrestamoCreate implements Responsable
{
    public function toResponse($request)
    {
        try {
            $prestamos = Prestamo::leftjoin('estados','estados.id_estado','=','prestamos.id_estado_prestamo')
                ->leftjoin('usuarios','usuarios.id_usuario','=','prestamos.id_usuario')
                ->leftjoin('tipo_persona','tipo_persona.id_tipo_persona','=','usuarios.id_tipo_persona')
                ->select(
                    'id_prestamo',
                    'prestamos.id_estado_prestamo',
                    'estado_prestamo',
                    'prestamos.id_usuario',
                    DB::raw("CONCAT(nombre_usuario, ' ', apellido_usuario) AS nombres_usuario"),
                    'nombre_usuario',
                    'apellido_usuario',
                    'valor_prestamo',
                    'identificacion',
                    'fecha_prestamo',
                    'fecha_limite',
                    'descripcion',
                    'usuarios.id_tipo_persona',
                    'tipo_persona',
                )
                ->orderByDesc('fecha_prestamo')
                ->get();

                return response()->json($prestamos);

        } catch (Exception $e) {
            return response()->json(['error_bd' => $e->getMessage()]);
        }
    }
}
