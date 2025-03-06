<?php

namespace App\Http\Controllers\productos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Http\Responsable\productos\ProductoIndex;
use App\Http\Responsable\productos\ProductoStore;
use App\Http\Responsable\productos\ProductoShow;
use App\Http\Responsable\productos\ProductoEdit;
use App\Http\Responsable\productos\ProductoUpdate;
use App\Http\Responsable\productos\ProductoDestroy;
use App\Models\Producto;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ProductoIndex();
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
        return new ProductoStore();
    }

    // ======================================================================
    // ======================================================================    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($idProducto)
    {
        return new ProductoShow($idProducto);
    }

    // ======================================================================
    // ======================================================================

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idProducto)
    {
        return new ProductoEdit($idProducto);
    }

    // ======================================================================
    // =====================================================================c=

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idProducto)
    {
        return new ProductoUpdate($request, $idProducto);
    }

    // ======================================================================
    // ======================================================================

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idProducto)
    {
        return new ProductoDestroy($idProducto);
    }

    // ======================================================================
    // ======================================================================

    public function verificarProducto()
    {
        $nombreProducto = request('nombre_producto', null);
        $idCategoria = request('id_categoria', null);

        try {
            $validarNombreProducto = Producto::where('nombre_producto', $nombreProducto)
                    ->where('id_categoria', $idCategoria)
                    ->first();

            if (isset($validarNombreProducto) && !is_null($validarNombreProducto) && !empty($validarNombreProducto)) {
                return response()->json($validarNombreProducto);
            }
        } catch (Exception $e) {
            return response()->json(['error_bd' => $e->getMessage()]);
        }
    }

    // ======================================================================
    // ======================================================================

    public function queryValoresProducto($idProducto)
    {
        try {
            return Producto::where('id_producto', $idProducto)->first();

        } catch (Exception $e) {
            return response()->json(['error_bd' => $e->getMessage()]);
        }
    }
}
