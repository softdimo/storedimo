<?php

namespace App\Http\Controllers\existencias;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Responsable\existencias\BajaIndex;
use App\Http\Responsable\existencias\BajaStore;
use App\Models\Baja;
use App\Models\BajaDetalle;


class ExistenciasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return new ExistenciaIndex();
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
        // return new ExistenciaStore();
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
        // return new ExistenciaUpdate($request, $id);
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

    public function bajaIndex()
    {
        return new BajaIndex();
    }

    // ======================================================================
    // ======================================================================
    
    public function bajaStore()
    {
        return new BajaStore();
    }

    // ======================================================================
    // ======================================================================

    public function bajaDetalle($idBaja)
    {
        try {
            $bajaDetalle = BajaDetalle::leftJoin('bajas', 'bajas.id_baja', '=', 'bajas_detalle.id_baja')
                ->leftJoin('tipo_baja', 'tipo_baja.id_tipo_baja', '=', 'bajas_detalle.id_tipo_baja')
                ->leftJoin('productos', 'productos.id_producto', '=', 'bajas_detalle.id_producto')
                ->where('bajas_detalle.id_baja', $idBaja)
                ->select(
                    'bajas_detalle.id_baja',
                    'bajas_detalle.id_producto',
                    'nombre_producto',
                    'bajas_detalle.cantidad',
                    'tipo_baja.id_tipo_baja',
                    'tipo_baja',
                )
                ->orderBy('nombre_producto')
                ->get();

                

            return response()->json($bajaDetalle);

        } catch (Exception $e) {
            return response()->json(['error_bd' => $e->getMessage()]);
        }
    }

    // ======================================================================
    // ======================================================================

    // public function reporteComprasPdf(Request $request)
    // {
    //     $fechaInicial = request('fecha_inicial', null);
    //     $fechaFinal = request('fecha_final', null);

    //     try {
    //         $compras = Compra::leftJoin('personas', 'personas.id_persona', '=', 'compras.id_proveedor')
    //             ->whereBetween('fecha_compra', [$fechaInicial, $fechaFinal])
    //             ->whereIn('personas.id_tipo_persona', [3, 4]) // Filtra solo si hay una persona
    //             ->select([
    //                 'compras.id_compra',
    //                 'compras.fecha_compra',
    //                 'compras.valor_compra',
    //                 'personas.id_persona',
    //                 \DB::raw("
    //                     CASE
    //                         WHEN personas.nombre_empresa IS NOT NULL THEN personas.nombre_empresa
    //                         ELSE CONCAT(personas.nombres_persona, ' ', personas.apellidos_persona)
    //                     END AS nombre_proveedor
    //                 ")
    //             ])
    //             ->orderByDesc('fecha_compra')
    //             ->get();

    //         $total = $compras->sum('valor_compra');

    //         return response()->json([
    //             'compras' => $compras,
    //             'total' => $total,
    //         ], 200);


    //     } catch (Exception $e) {
    //         return response()->json(['error_bd' => $e->getMessage()]);
    //     }
    // }
}
