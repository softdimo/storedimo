<?php

namespace App\Http\Responsable\productos;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Helpers\DatabaseConnectionHelper;

class ProductoEdit implements Responsable
{
    protected $idProducto;

    // =========================================

    public function __construct($idProducto)
    {
        $this->idProducto = $idProducto;
    }

    // =========================================

    public function toResponse($request)
    {
        // Obtener empresa_actual del request
        $empresaActual = $request->input('empresa_actual');

        // Configurar conexión tenant si hay empresa
        if ($empresaActual) {
            DatabaseConnectionHelper::configurarConexionTenant($empresaActual);
        }
        
        $idProducto = $this->idProducto;

        try {
            $producto = Producto::leftJoin('categorias', 'categorias.id_categoria', '=', 'productos.id_categoria')
                ->select(
                    'id_producto',
                    'imagen_producto',
                    'nombre_producto',
                    'categorias.id_categoria',
                    'categorias.categoria',
                    'descripcion',
                    'stock_minimo',
                    'precio_unitario',
                    'precio_detal',
                    'precio_por_mayor',
                    'referencia',
                    'fecha_vencimiento'
                )
                ->where('id_producto', $idProducto)
                ->first();

            if (isset($producto) && !is_null($producto) && !empty($producto)) {
                // Restaurar conexión principal si se usó tenant
                if ($empresaActual) {
                    DatabaseConnectionHelper::restaurarConexionPrincipal();
                }

                return response()->json($producto);
            } else {
                return response()->json([
                    'message' => 'No existe producto'
                ], 404);
            }
        } catch (Exception $e) {
            // Asegurar restauración de conexión principal en caso de error
            if (isset($empresaActual)) {
                DatabaseConnectionHelper::restaurarConexionPrincipal();
            }
            
            return response()->json([
                'message' => 'Error consultando la base de datos',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}