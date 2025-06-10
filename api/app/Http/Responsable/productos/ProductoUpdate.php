<?php

namespace App\Http\Responsable\productos;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Producto;
use App\Helpers\DatabaseConnectionHelper;


class ProductoUpdate implements Responsable
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    // ===================================================================
    // ===================================================================

    public function toResponse($request)
    {
        // Obtener empresa_actual del request
        $empresaActual = $request->input('empresa_actual');

        // Configurar conexión tenant si hay empresa
        if ($empresaActual) {
            DatabaseConnectionHelper::configurarConexionTenant($empresaActual);
        }
        
        $idProducto = $request->route('idProducto');
        $producto = Producto::find($idProducto);

        if (isset($producto) && !is_null($producto) && !empty($producto)) {
            
            $producto->imagen_producto = $this->request->input('imagen_producto');
            $producto->nombre_producto = $this->request->input('nombre_producto');
            $producto->id_categoria = $this->request->input('id_categoria');
            $producto->descripcion = $this->request->input('descripcion');
            $producto->stock_minimo = $this->request->input('stock_minimo');
            $producto->precio_unitario = $this->request->input('precio_unitario');
            $producto->precio_detal = $this->request->input('precio_detal');
            $producto->precio_por_mayor = $this->request->input('precio_por_mayor');
            $producto->referencia = $this->request->input('referencia');
            $producto->fecha_vencimiento = $this->request->input('fecha_vencimiento');
            $producto->update();

            // Restaurar conexión principal si se usó tenant
            if ($empresaActual) {
                DatabaseConnectionHelper::restaurarConexionPrincipal();
            }

            return response()->json([
                'success' => true,
                'message' => 'Producto actualizado correctamente'
            ]);
            
        } else {
            // Asegurar restauración de conexión principal en caso de error
            if (isset($empresaActual)) {
                DatabaseConnectionHelper::restaurarConexionPrincipal();
            }
            
            return abort(404, $message = 'No existe esta categoria');
        }
    }
}
