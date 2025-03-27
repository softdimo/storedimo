<?php

namespace App\Http\Controllers\existencias;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Responsable\existencias\BajaIndex;
// use App\Http\Responsable\existencias\ExistenciaStore;
// use App\Http\Responsable\existencias\ExistenciaUpdate;
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

    // public function entradaConsulta($idCompra)
    // {
    //     try {
    //         return Compra::where('id_compra', $idCompra)->first();

    //     } catch (Exception $e) {
    //         return response()->json(['error_bd' => $e->getMessage()]);
    //     }
    // }

    // ======================================================================
    // ======================================================================

    // public function anularCompra($idCompra)
    // {
    //     $compra = Compra::find($idCompra);

    //     if (isset($compra) && !is_null($compra) && !empty($compra)) {

    //         try {
    //             $compra->id_estado = 2;
    //             $compra->update();

    //             return response()->json(['success' => true]);
    
    //         } catch (Exception $e) {
    //             return response()->json(['error_bd' => $e->getMessage()]);
    //         }
    //     }
    // }

    // ===================================================================
    // ===================================================================

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
    
    // ===================================================================
    // ===================================================================

    // public function detalleCompra($idCompra)
    // {
    //     try {
    //         $detalleCompra = CompraProducto::leftJoin('compras', 'compras.id_compra', '=', 'compra_productos.id_compra')
    //             ->leftJoin('productos', 'productos.id_producto', '=', 'compra_productos.id_producto')
    //             ->where('compra_productos.id_compra', $idCompra)
    //             ->select(
    //                 'compra_productos.id_compra',
    //                 'compra_productos.id_producto',
    //                 'nombre_producto',
    //                 'compra_productos.cantidad',
    //                 'precio_unitario_compra',
    //                 'subtotal'
    //             )
    //             ->orderBy('nombre_producto')
    //             ->get();

                

    //         return response()->json($detalleCompra);

    //     } catch (Exception $e) {
    //         return response()->json(['error_bd' => $e->getMessage()]);
    //     }
    // }
        
    // ===================================================================
    // ===================================================================

    // public function detalleCompraProductoPdf($idCompra)
    // {
    //     try {
    //         $detalleCompraProductoPdf = Compra::leftJoin('compra_productos', 'compra_productos.id_compra', '=', 'compras.id_compra')
    //             ->leftJoin('productos', 'productos.id_producto', '=', 'compra_productos.id_producto')
    //             ->leftJoin('personas', 'personas.id_persona', '=', 'compras.id_proveedor')
    //             ->where('compras.id_compra', $idCompra)
    //             ->select(
    //                 'compras.id_compra',
    //                 'compras.fecha_compra',
    //                 'compras.valor_compra',
    //                 'compras.id_proveedor',
    //                 'personas.nombre_empresa',
    //                 'personas.nombres_persona',
    //                 'personas.apellidos_persona',
    //                 'compra_productos.id_producto',
    //                 'compra_productos.cantidad',
    //                 'compra_productos.precio_unitario_compra',
    //                 'compra_productos.subtotal',
    //                 'productos.nombre_producto'
    //             )
    //             ->orderBy('nombre_producto')
    //             ->get();

    //         return response()->json($detalleCompraProductoPdf);

    //     } catch (Exception $e) {
    //         return response()->json(['error_bd' => $e->getMessage()]);
    //     }
    // }
}
