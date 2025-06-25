<?php

namespace App\Http\Responsable\existencias;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use App\Models\Producto;
use App\Helpers\DatabaseConnectionHelper;
use App\Models\Empresa;

class StockMinimoIndex implements Responsable
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
            $productosStockMinimo = Producto::leftJoin('categorias', 'categorias.id_categoria', '=', 'productos.id_categoria')
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
                    'referencia',
                    'productos.id_estado',
                    'estados.estado',
                    'cantidad',
                    'tipo_persona.id_tipo_persona',
                    'tipo_persona'
                )
                ->orderBy('nombre_producto', 'ASC')
                ->whereColumn('productos.cantidad', '<', 'productos.stock_minimo')
                ->get();

            if (isset($productosStockMinimo) && !is_null($productosStockMinimo) && !empty($productosStockMinimo)) {
                // Restaurar conexión principal si se usó tenant
                if ($empresaActual) {
                    DatabaseConnectionHelper::restaurarConexionPrincipal();
                }

                return response()->json($productosStockMinimo);
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
