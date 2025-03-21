<?php

namespace App\Http\Controllers\empresas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Http\Responsable\empresas\EmpresaIndex;
use App\Http\Responsable\empresas\EmpresaStore;
use App\Http\Responsable\empresas\EmpresaUpdate;
use App\Models\Empresa;

class EmpresasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new EmpresaIndex();
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
        return new EmpresaStore();
    }

    // ======================================================================
    // ======================================================================    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($idEmpresa)
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
    public function edit()
    {
        //
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
    public function update(Request $request, $idEmpresa)
    {
        return new EmpresaUpdate($request, $idEmpresa);
    }

    // ======================================================================
    // ======================================================================

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idEmpresa)
    {
        //
    }

    // ======================================================================
    // ======================================================================

    // public function verificarPrestamo()
    // {
    //     $nombrePrestamo = request('nombre_producto', null);
    //     $idCategoria = request('id_categoria', null);

    //     try {
    //         $validarNombrePrestamo = Prestamo::where('nombre_producto', $nombrePrestamo)
    //                 ->where('id_categoria', $idCategoria)
    //                 ->first();

    //         if (isset($validarNombrePrestamo) && !is_null($validarNombrePrestamo) && !empty($validarNombrePrestamo)) {
    //             return response()->json($validarNombrePrestamo);
    //         }
    //     } catch (Exception $e) {
    //         return response()->json(['error_bd' => $e->getMessage()]);
    //     }
    // }

    // ======================================================================
    // ======================================================================

    // public function queryPrestamo($idPrestamo)
    // {
    //     try {
    //         return Prestamo::where('id_producto', $idPrestamo)->first();

    //     } catch (Exception $e) {
    //         return response()->json(['error_bd' => $e->getMessage()]);
    //     }
    // }

    // ======================================================================
    // ======================================================================
    
    // public function prestamoVencer()
    // {
    //     return new PrestamoVencer();
    // }
    
    // ======================================================================
    // ======================================================================
}
