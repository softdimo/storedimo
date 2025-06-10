<?php

namespace App\Http\Responsable\ventas;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use App\Models\Venta;
use App\Models\Producto;
use App\Models\VentaProducto;
use App\Helpers\DatabaseConnectionHelper;

class VentaStore implements Responsable
{
    public function toResponse($request)
    {
        // Obtener empresa_actual del request
        $empresaActual = $request->input('empresa_actual');

        // Configurar conexión tenant si hay empresa
        if ($empresaActual) {
            DatabaseConnectionHelper::configurarConexionTenant($empresaActual);
        }
        
        $idEmpresa = request('id_empresa', null);
        $idTipoCliente = request('id_tipo_cliente', null);
        $fechaVenta = request('fecha_venta', null);
        $descuento = request('descuento', null);
        $totalVenta = request('total_venta', null);
        $idTipoPago = request('id_tipo_pago', null);
        $idCliente = request('id_cliente', null);
        $usuLogueado = request('id_usuario');
        $idEstado = request('id_estado');
        $idEstadoCredito = request('id_estado_credito', null);
        $fechaLimiteCredito = request('fecha_limite_credito', null);
        $productos = request('productos', []);

        try {
            $crearVenta = Venta::create([
                'id_empresa' => $idEmpresa,
                'id_tipo_cliente' => $idTipoCliente,
                'fecha_venta' => $fechaVenta,
                'descuento' => $descuento,
                'total_venta' => $totalVenta,
                'id_tipo_pago' => $idTipoPago,
                'id_cliente' => $idCliente,
                'id_usuario' => $usuLogueado,
                'id_estado' => $idEstado,
                'id_estado_credito' => $idEstadoCredito,
                'fecha_limite_credito' => $fechaLimiteCredito
            ]);

            if ($crearVenta) {

                $idVenta = $crearVenta->id_venta;

                foreach ($productos as $producto) {
                    VentaProducto::create([
                        'id_venta' => $idVenta,
                        'id_producto' => $producto['id_producto'],
                        'cantidad' => $producto['cantidad'],
                        'precio_detal_venta' => $producto['p_detal'],
                        'precio_x_mayor_venta' => $producto['p_mayor'],
                        'subtotal' => $producto['subtotal']
                    ]);

                    $cantidadProducto = Producto::select('cantidad')
                        ->where('id_producto', $producto['id_producto'])
                        ->first();

                    if ( !is_null($cantidadProducto) ) {
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
