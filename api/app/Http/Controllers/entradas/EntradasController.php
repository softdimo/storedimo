<?php

namespace App\Http\Controllers\entradas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Responsable\entradas\EntradaIndex;
use App\Http\Responsable\entradas\EntradaStore;
use App\Http\Responsable\entradas\EntradaUpdate;
use App\Models\Compra;


class EntradasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new EntradaIndex();
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
        return new EntradaStore();
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
        return new EntradaUpdate($request, $id);
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

    public function entradaConsulta($idCompra)
    {
        try {
            return Compra::where('id_compra', $idCompra)->first();

        } catch (Exception $e) {
            return response()->json(['error_bd' => $e->getMessage()]);
        }
    }

    // ======================================================================
    // ======================================================================

    public function anularCompra($idCompra)
    {
        $compra = Compra::find($idCompra);

        if (isset($compra) && !is_null($compra) && !empty($compra)) {

            try {
                $compra->id_estado = 2;
                $compra->update();

                return response()->json(['success' => true]);
    
            } catch (Exception $e) {
                return response()->json(['error_bd' => $e->getMessage()]);
            }
        }
    }

    // ===================================================================
    // ===================================================================

    public function reporteComprasPdf(Request $request)
    {
        $fechaInicial = request('fecha_inicial', null);
        $fechaFinal = request('fecha_final', null);

        try {
            // $compras = Compra::whereBetween('fecha_compra', [$fechaInicial, $fechaFinal])->get();

            $compras = Compra::leftJoin('personas', 'personas.id_persona', '=', 'compras.id_proveedor')
                ->whereBetween('fecha_compra', [$fechaInicial, $fechaFinal])
                ->whereIn('personas.id_tipo_persona', [3, 4]) // Filtra solo si hay una persona
                ->select([
                    'compras.id_compra',
                    'compras.fecha_compra',
                    'compras.valor_compra',
                    'personas.id_persona',
                    \DB::raw("
                        CASE
                            WHEN personas.nombre_empresa IS NOT NULL THEN personas.nombre_empresa
                            ELSE CONCAT(personas.nombres_persona, ' ', personas.apellidos_persona)
                        END AS nombre_proveedor
                    ")
                ])
                ->orderByDesc('fecha_compra')
                ->get();

            $total = $compras->sum('valor_compra');

            return response()->json([
                'compras' => $compras,
                'total' => $total,
            ], 200);


        } catch (Exception $e) {
            return response()->json(['error_bd' => $e->getMessage()]);
        }
    }
}
