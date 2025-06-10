<?php

namespace App\Http\Responsable\productos;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use App\Models\Producto;
use App\Helpers\DatabaseConnectionHelper;

class ReporteProductosPdf implements Responsable
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
            $reporteProductosPdf = Producto::leftJoin('categorias', 'categorias.id_categoria', '=', 'productos.id_categoria')
                ->leftJoin('estados', 'estados.id_estado', '=', 'productos.id_estado')
                ->leftJoin('tipo_persona', 'tipo_persona.id_tipo_persona', '=', 'productos.id_tipo_persona')
                ->select(
                    'id_producto',
                    'nombre_producto',
                    'productos.id_categoria',
                    'categorias.categoria',
                    'precio_unitario',
                    'precio_detal',
                    'precio_por_mayor',
                    'descripcion',
                    'stock_minimo',
                    'productos.id_estado',
                    'estados.estado',
                    'cantidad',
                    'tipo_persona.id_tipo_persona',
                    'tipo_persona',
                    'referencia',
                    'fecha_vencimiento'
                )
                ->where('productos.id_estado', 1)
                ->orderBy('nombre_producto', 'ASC')
                ->get();

                // Restaurar conexión principal si se usó tenant
                if ($empresaActual) {
                    DatabaseConnectionHelper::restaurarConexionPrincipal();
                }

                return response()->json($reporteProductosPdf);

        } catch (Exception $e) {
            // Asegurar restauración de conexión principal en caso de error
            if (isset($empresaActual)) {
                DatabaseConnectionHelper::restaurarConexionPrincipal();
            }
            
            return response()->json(['error_bd' => $e->getMessage()]);
        }
    }
}
