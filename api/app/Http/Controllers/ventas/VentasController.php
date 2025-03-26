<?php

namespace App\Http\Controllers\ventas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Responsable\ventas\VentaIndex;
use App\Http\Responsable\ventas\VentaStore;
use App\Http\Responsable\ventas\VentaUpdate;
use App\Models\Venta;


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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    public function reporteComprasPdf(Request $request)
    {
        $fechaInicial = request('fecha_inicial', null);
        $fechaFinal = request('fecha_final', null);

        try {
            $ventas = Venta::leftJoin('personas', 'personas.id_persona', '=', 'compras.id_proveedor')
                ->whereBetween('fecha_venta', [$fechaInicial, $fechaFinal])
                ->whereIn('personas.id_tipo_persona', [5, 6]) // Filtra solo si hay una persona
                ->select([
                    'ventas.id_venta',
                    'ventas.fecha_venta',
                    'ventas.valor_venta',
                    'personas.id_persona',
                    \DB::raw("
                        CASE
                            WHEN personas.nombre_empresa IS NOT NULL THEN personas.nombre_empresa
                            ELSE CONCAT(personas.nombres_persona, ' ', personas.apellidos_persona)
                        END AS nombre_proveedor
                    ")
                ])
                ->orderByDesc('fecha_venta')
                ->get();

            $total = $ventas->sum('valor_venta');

            return response()->json([
                'venta' => $ventas,
                'total' => $total,
            ], 200);


        } catch (Exception $e) {
            return response()->json(['error_bd' => $e->getMessage()]);
        }
    }
}
