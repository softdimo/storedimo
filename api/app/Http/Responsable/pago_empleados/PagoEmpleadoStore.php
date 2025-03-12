<?php

namespace App\Http\Responsable\pago_empleados;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Prestamo;

class PrestamoStore implements Responsable
{
    public function toResponse($request)
    {
        $idUsuario = request('id_usuario', null);
        $identificacion = request('identificacion', null);
        $idTipoPersona = request('id_tipo_persona', null);
        $fechaPrestamo = request('fecha_prestamo', null);
        $fechaLimite = request('fecha_limite', null);
        $valorPrestamo = request('valor_prestamo', null);
        $descripcion = request('descripcion', null);

        try {
            $registroPrestamo = Prestamo::create([
                'id_usuario' => $idUsuario,
                'identificacion' => $identificacion,
                'id_tipo_persona' => $idTipoPersona,
                'fecha_prestamo' => $fechaPrestamo,
                'fecha_limite' => $fechaLimite,
                'valor_prestamo' => $valorPrestamo,
                'descripcion' => $descripcion
            ]);

            if (isset($registroPrestamo) && !is_null($registroPrestamo) && !empty($registroPrestamo)) {
                return response()->json(['success' => true]);
            }

        } catch (Exception $e) {
            return response()->json(['error_bd' => $e->getMessage()]);
        }
    }
}
