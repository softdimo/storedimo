<?php

namespace App\Http\Responsable\existencias;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use App\Models\Baja;
use App\Helpers\DatabaseConnectionHelper;
use App\Models\Empresa;

class BajaIndex implements Responsable
{
    public function toResponse($request)
    {
        // 1. Obtener ID de empresa del request (antes era empresa_actual completo)
        $empresaId = $request->input('empresa_actual');

        // 2. Buscar empresa completa usando el ID
        $empresaActual = Empresa::find($empresaId);
        
        // Configurar conexión tenant si hay empresa
        if ($empresaActual) {
            DatabaseConnectionHelper::configurarConexionTenant($empresaActual->toArray());
        }
        
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

                // Restaurar conexión principal si se usó tenant
                if ($empresaActual) {
                    DatabaseConnectionHelper::restaurarConexionPrincipal();
                }

                return response()->json($bajas);

        } catch (Exception $e) {
            // Asegurar restauración de conexión principal en caso de error
            if (isset($empresaActual)) {
                DatabaseConnectionHelper::restaurarConexionPrincipal();
            }
            
            return response()->json(['error_bd' => $e->getMessage()]);
        }
    }
}
