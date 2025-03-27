<?php

namespace App\Http\Responsable\existencias;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use App\Models\Baja;
use App\Models\BajaDetalle;
use App\Models\Producto;

class BajaStore implements Responsable
{
    public function toResponse($request)
    {
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
                        'cantidad' => $producto['cantidad']
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

                return response()->json(['success' => true]);
            }

        } catch (Exception $e) {
            return response()->json(['error_bd' => $e->getMessage()]);
        }
    }
}
