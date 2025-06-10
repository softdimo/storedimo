<?php

namespace App\Http\Responsable\entradas;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use App\Models\Compra;
use App\Helpers\DatabaseConnectionHelper;

class EntradaIndex implements Responsable
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
            $entradas = Compra::leftjoin('proveedores','proveedores.id_proveedor','=','compras.id_proveedor')
                ->leftjoin('usuarios','usuarios.id_usuario','=','compras.id_usuario')
                ->leftjoin('productos','productos.id_producto','=','compras.id_producto')
                ->leftjoin('estados','estados.id_estado','=','compras.id_estado')
                ->leftjoin('empresas','empresas.id_empresa','=','compras.id_empresa')
                ->select(
                    'compras.id_compra',
                    'fecha_compra',
                    DB::raw("CONCAT('$', FORMAT(valor_compra, 0, 'de_DE')) as valor_compra"),
                    'compras.id_proveedor',
                    'proveedores.proveedor_juridico',
                    'proveedores.nit_proveedor',
                    'proveedores.identificacion',
                    'proveedores.nombres_proveedor',
                    'proveedores.apellidos_proveedor',
                    'compras.id_usuario',
                    'empresas.id_empresa',
                    'empresas.nombre_empresa as empresa',
                    DB::raw("CONCAT(nombre_usuario, ' ', apellido_usuario) AS nombres_usuario"),
                    'compras.id_estado',
                    'estado',
                    'compras.id_producto',
                    'nombre_producto',
                    'cantidad',
                    'precio_unitario'
                )
                ->orderByDesc('fecha_compra')
                ->get();

                // Restaurar conexión principal si se usó tenant
                if ($empresaActual) {
                    DatabaseConnectionHelper::restaurarConexionPrincipal();
                }

                return response()->json($entradas);

        } catch (Exception $e) {
            // Asegurar restauración de conexión principal en caso de error
            if (isset($empresaActual)) {
                DatabaseConnectionHelper::restaurarConexionPrincipal();
            }
            
            return response()->json(['error_bd' => $e->getMessage()]);
        }
    }
}
