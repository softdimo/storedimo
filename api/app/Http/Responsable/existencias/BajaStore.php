<?php

namespace App\Http\Responsable\existencias;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use App\Models\Baja;
use App\Models\BajaDetalle;
use App\Models\Producto;
use App\Helpers\DatabaseConnectionHelper;

class BajaStore implements Responsable
{
    public function toResponse($request)
    {
        // Obtener empresa_actual del request
        $empresaActual = $request->input('empresa_actual');

        // Configurar conexión tenant si hay empresa
        if ($empresaActual) {
            DatabaseConnectionHelper::configurarConexionTenant($empresaActual);
        }
        
        $responsableBaja = request('id_responsable_baja', null);
        $fechaBaja = request('fecha_baja', null);
        $idEstado = request('id_estado_baja', null);

        $productos = request('productos', []);

        try {
            $crearBaja = Baja::create([
                'id_responsable_baja' => $responsableBaja,
                'fecha_baja' => $fechaBaja,
                'id_estado_baja' => $idEstado
            ]);

            if ($crearBaja) {

                $idBaja = $crearBaja->id_baja;

                foreach ($productos as $producto) {
                    BajaDetalle::create([
                        'id_baja' => $idBaja,
                        'id_tipo_baja' => $producto['id_tipo_baja'],
                        'id_producto' => $producto['id_producto'],
                        'cantidad' => $producto['cantidad'],
                        'observaciones' => $producto['observaciones']
                    ]);

                    $cantidadProducto = Producto::select('cantidad')
                        ->where('id_producto', $producto['id_producto'])
                        ->first();

                    if ( $cantidadProducto ) {
                        $cantidad = $cantidadProducto->cantidad - $producto['cantidad'];
                    }

                    $producto = Producto::findOrFail($producto['id_producto']);

                    $producto->cantidad = $cantidad;
                    $producto->update();
                }

                // Restaurar conexión principal si se usó tenant
                if ($empresaActual) {
                    DatabaseConnectionHelper::restaurarConexionPrincipal();
                }

                return response()->json(true);
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
