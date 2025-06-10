<?php

namespace App\Http\Responsable\prestamos;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use App\Models\Prestamo;
use App\Helpers\DatabaseConnectionHelper;

class PrestamoStore implements Responsable
{
    public function toResponse($request)
    {
        // Obtener empresa_actual del request
        $empresaActual = $request->input('empresa_actual');

        // Configurar conexión tenant si hay empresa
        if ($empresaActual) {
            DatabaseConnectionHelper::configurarConexionTenant($empresaActual);
        }
        
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
                // Restaurar conexión principal si se usó tenant
                if ($empresaActual) {
                    DatabaseConnectionHelper::restaurarConexionPrincipal();
                }

                return response()->json(['success' => true]);
            }

        } catch (Exception $e) {
            // Asegurar restauración de conexión principal en caso de error
            if (isset($empresaActual)) {
                DatabaseConnectionHelper::restaurarConexionPrincipal();
            }
            
            return response()->json(['error_bd' => $e->getMessage()]);
        }
    }
}
