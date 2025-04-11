<?php

namespace App\Http\Responsable\prestamos;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Prestamo;

class PrestamoVencer implements Responsable
{
    public function toResponse($request)
    {
        try {
            $prestamosVencer = Prestamo::leftjoin('estados','estados.id_estado','=','prestamos.id_estado_prestamo')
                ->leftjoin('usuarios','usuarios.id_usuario','=','prestamos.id_usuario')
                ->leftjoin('tipo_documento','tipo_documento.id_tipo_documento','=','usuarios.id_tipo_documento')
                ->leftjoin('tipo_persona','tipo_persona.id_tipo_persona','=','usuarios.id_tipo_persona')
                ->select(
                    'id_prestamo',
                    'prestamos.id_estado_prestamo',
                    'estado',
                    'prestamos.id_usuario',
                    DB::raw("CONCAT(nombre_usuario, ' ', apellido_usuario) AS nombres_usuario"),
                    'valor_prestamo',
                    'nombre_usuario',
                    'apellido_usuario',
                    'fecha_prestamo',
                    'fecha_limite',
                    'descripcion',
                    'usuarios.id_tipo_documento',
                    'tipo_documento',
                    'usuarios.identificacion',
                    'usuarios.id_tipo_persona',
                    'tipo_persona'
                )
                ->orderByDesc('fecha_prestamo')
                ->get();

                return response()->json($prestamosVencer);

        } catch (Exception $e) {
            return response()->json(['error_bd' => $e->getMessage()]);
        }
    }
}
