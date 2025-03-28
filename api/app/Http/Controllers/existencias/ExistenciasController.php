<?php

namespace App\Http\Controllers\existencias;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Responsable\existencias\BajaIndex;
use App\Http\Responsable\existencias\BajaStore;
use App\Http\Responsable\existencias\StockMinimoIndex;
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
                ->leftJoin('categorias', 'categorias.id_categoria', '=', 'productos.id_categoria')
                ->where('bajas_detalle.id_baja', $idBaja)
                ->select(
                    'bajas_detalle.id_baja',
                    'bajas_detalle.id_producto',
                    'nombre_producto',
                    'bajas_detalle.cantidad',
                    'tipo_baja.id_tipo_baja',
                    'tipo_baja',
                    'categorias.id_categoria',
                    'categoria',
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

    public function reporteBajasPdf(Request $request)
    {
        $fechaInicial = request('fecha_inicial', null);
        $fechaFinal = request('fecha_final', null);

        try {
            $bajas = BajaDetalle::leftJoin('bajas', 'bajas.id_baja', '=', 'bajas_detalle.id_baja')
                ->leftJoin('productos', 'productos.id_producto', '=', 'bajas_detalle.id_producto')
                ->leftJoin('tipo_baja', 'tipo_baja.id_tipo_baja', '=', 'bajas_detalle.id_tipo_baja')
                ->leftJoin('categorias', 'categorias.id_categoria', '=', 'productos.id_categoria')

                ->whereBetween('fecha_baja', [$fechaInicial, $fechaFinal])
                ->select([
                    'productos.id_producto',
                    'nombre_producto',
                    'categoria',
                    'fecha_baja',
                    'bajas_detalle.cantidad',
                    'tipo_baja'
                ])
                ->orderByDesc('fecha_baja')
                ->get();

            return response()->json($bajas);

        } catch (Exception $e) {
            return response()->json(['error_bd' => $e->getMessage()]);
        }
    }

    // ======================================================================
    // ======================================================================

    public function stockMinimoIndex()
    {
        return new StockMinimoIndex();
    }
}
