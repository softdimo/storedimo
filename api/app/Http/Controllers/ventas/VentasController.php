<?php

namespace App\Http\Controllers\ventas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Responsable\ventas\VentaIndex;
use App\Http\Responsable\ventas\VentaDetalle;
use App\Http\Responsable\ventas\VentaStore;
use App\Http\Responsable\ventas\VentaUpdate;
use App\Models\Venta;
use App\Models\VentaProducto;


class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new VentaIndex();
    }

    // ======================================================================
    // ======================================================================

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    // ======================================================================
    // ======================================================================

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return new VentaStore();
    }

    // ======================================================================
    // ======================================================================

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    // ======================================================================
    // ======================================================================

    
    public function ventaDetalle($idVenta)
    {
        return new VentaDetalle($idVenta);
    }

    // ======================================================================
    // ======================================================================

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return new VentaUpdate($request, $id);
    }

    // ======================================================================
    // ======================================================================

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // ======================================================================
    // ======================================================================

    public function consultaVenta($idVenta)
    {
        try {
            return Venta::where('id_venta', $idVenta)->first();

        } catch (Exception $e) {
            return response()->json(['error_bd' => $e->getMessage()]);
        }
    }

    // ======================================================================
    // ======================================================================

    public function anularVenta($idVenta)
    {
        $venta = Venta::find($idVenta);

        if (isset($venta) && !is_null($venta) && !empty($venta)) {

            try {
                $venta->id_venta = 2;
                $venta->update();

                return response()->json(['success' => true]);
    
            } catch (Exception $e) {
                return response()->json(['error_bd' => $e->getMessage()]);
            }
        }
    }

    // ======================================================================
    // ======================================================================

    public function reporteVentasPdf(Request $request)
    {
        $fechaInicial = request('fecha_inicial', null);
        $fechaFinal = request('fecha_final', null);

        try {
            $ventas = Venta::leftJoin('empresas', 'empresas.id_empresa', '=', 'ventas.id_empresa')
                ->leftJoin('tipo_persona', 'tipo_persona.id_tipo_persona', '=', 'ventas.id_tipo_cliente')
                ->leftJoin('tipos_pago', 'tipos_pago.id_tipo_pago', '=', 'ventas.id_tipo_pago')
                ->leftJoin('productos', 'productos.id_producto', '=', 'ventas.id_producto')
                ->leftJoin('personas', 'personas.id_persona', '=', 'ventas.id_cliente')
                ->leftJoin('usuarios', 'usuarios.id_usuario', '=', 'ventas.id_usuario')
                ->leftJoin('estados', 'estados.id_estado', '=', 'ventas.id_estado_credito')
                ->whereBetween('fecha_venta', [$fechaInicial, $fechaFinal])
                ->whereIn('ventas.id_tipo_cliente', [5, 6]) // Filtra solo si hay una persona
                ->select([
                    'ventas.id_venta',
                    'ventas.fecha_venta',
                    'ventas.subtotal_venta',
                    'ventas.descuento',
                    'ventas.total_venta',
                    'personas.id_persona',
                    DB::raw("CONCAT(nombres_persona, ' ', apellidos_persona) AS nombres_cliente"),
                    DB::raw("CONCAT(nombre_usuario, ' ', apellido_usuario) AS vendedor"),
                    'tipo_pago'
                ])
                ->orderByDesc('fecha_venta')
                ->get();

            $total = $ventas->sum('total_venta');

            return response()->json([
                'ventas' => $ventas,
                'total' => $total,
            ], 200);


        } catch (Exception $e) {
            return response()->json(['error_bd' => $e->getMessage()]);
        }
    }

    // ======================================================================
    // ======================================================================
    
    public function detalleVenta($idVenta)
    {
        try {
            $detalleVenta = VentaProducto::leftJoin('ventas', 'ventas.id_venta', '=', 'venta_productos.id_venta')
                ->leftJoin('productos', 'productos.id_producto', '=', 'venta_productos.id_producto')
                ->where('venta_productos.id_venta', $idVenta)
                ->select(
                    'venta_productos.id_venta',
                    'venta_productos.id_producto',
                    'nombre_producto',
                    'venta_productos.cantidad',
                    'subtotal',
                    DB::raw("CONCAT('$', FORMAT(subtotal, 0, 'de_DE')) as subtotal_detalle"),
                    DB::raw("
                        CASE
                            WHEN precio_detal_venta IS NOT NULL THEN precio_detal_venta
                            ELSE CONCAT(precio_x_mayor_venta)
                        END AS precio_venta
                    "),
                    DB::raw("
                        CONCAT('$', FORMAT(
                            CASE
                                WHEN precio_detal_venta IS NOT NULL THEN precio_detal_venta
                                ELSE precio_x_mayor_venta
                            END
                        , 0, 'de_DE')) as precio_venta_detalle
                    ")
                )
                ->orderBy('nombre_producto')
                ->get();

            return response()->json($detalleVenta);

        } catch (Exception $e) {
            return response()->json(['error_bd' => $e->getMessage()]);
        }
    }

    // ===================================================================
    // ===================================================================
}
