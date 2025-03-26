<?php

namespace App\Http\Responsable\entradas;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Compra;
use App\Models\CompraProducto;
use App\Models\Producto;

class EntradaStore implements Responsable
{
    public function toResponse($request)
    {
        $idEmpresa = request('id_empresa', null);
        $fechaCompra = request('fecha_compra', null);
        $valorCompra = request('valor_compra', null);
        $idProveedor = request('id_proveedor', null);
        $usuLogueado = request('id_usuario', null);
        $idEstado = request('id_estado', null);
        $productos = request('productos', []);

        try {
            $crearCompra = Compra::create([
                'id_empresa' => $idEmpresa,
                'fecha_compra' => $fechaCompra,
                'valor_compra' => $valorCompra,
                'id_proveedor' => $idProveedor,
                'id_usuario' => $usuLogueado,
                'id_estado' => $idEstado
            ]);
            
            if ($crearCompra) {

                $idCompra = $crearCompra->id_compra;

                foreach ($productos as $producto) {
                    CompraProducto::create([
                        'id_compra' => $idCompra,
                        'id_producto' => $producto['id_producto'],
                        'cantidad' => $producto['cantidad'],
                        'precio_unitario_compra' => $producto['p_unitario'],
                        'subtotal' => $producto['subtotal']
                    ]);

                    $cantidadProducto = Producto::select('cantidad')
                        ->where('id_producto', $producto['id_producto'])
                        ->where('id_persona', $idProveedor)
                        ->first();

                    if ( !is_null($cantidadProducto)) {
                        $cantidad = $cantidadProducto->cantidad + $producto['cantidad'];
                    } else {
                        $cantidad = 0 + $producto['cantidad'];
                    }

                    $producto = Producto::findOrFail($producto['id_producto']);

                    $producto->cantidad = $cantidad;
                    $producto->id_persona = $idProveedor;
                    $producto->update();
                }

                return response()->json(['success' => true]);
            }

        } catch (Exception $e) {
            return response()->json(['error_bd' => $e->getMessage()]);
        }
    }
}
