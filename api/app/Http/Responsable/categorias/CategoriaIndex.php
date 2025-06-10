<?php

namespace App\Http\Responsable\categorias;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use App\Models\Categoria;
use App\Helpers\DatabaseConnectionHelper;

class CategoriaIndex implements Responsable
{
    public function toResponse($request)
    {
        // Obtener empresa_actual del request
        $empresaActual = $request->input('empresa_actual');

        // Configurar conexión tenant si hay empresa
        if ($empresaActual) {
            DatabaseConnectionHelper::configurarConexionTenant($empresaActual);
        }
        
        try {
            $categorias = Categoria::leftJoin('estados', 'estados.id_estado', '=', 'categorias.id_estado')
            ->select(
                'id_categoria',
                'categoria',
                'categorias.id_estado',
                'estados.estado'
                )
                ->orderBy('categoria', 'ASC')
                ->get();

            if (isset($categorias) && !is_null($categorias) && !empty($categorias)) {
                // Restaurar conexión principal si se usó tenant
                if ($empresaActual) {
                    DatabaseConnectionHelper::restaurarConexionPrincipal();
                }

                return response()->json($categorias);
            } else {
                return response()->json([
                    'message' => 'no hay categorias'
                ], 404);
            }
        } catch (Exception $e) {
            // Asegurar restauración de conexión principal en caso de error
            if (isset($empresaActual)) {
                DatabaseConnectionHelper::restaurarConexionPrincipal();
            }
            
            return response()->json([
                'message' => 'Error en la consulta de la base de datos',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
