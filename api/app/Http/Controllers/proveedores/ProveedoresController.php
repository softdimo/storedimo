<?php

namespace App\Http\Controllers\proveedores;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Responsable\proveedores\ProveedorIndex;
use App\Http\Responsable\proveedores\ProveedorStore;
use App\Http\Responsable\proveedores\ProveedorUpdate;
use App\Http\Responsable\proveedores\ProveedorEdit;
use App\Models\Proveedor;
use App\Helpers\DatabaseConnectionHelper;

class ProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ProveedorIndex();
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
        return new ProveedorStore($request);
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
    public function edit($idProveedor)
    {
        return new ProveedorEdit($idProveedor);
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
    public function update(Request $request, $idProveedor)
    {
        return new ProveedorUpdate($request, $idProveedor);
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

    public function consultarIdentificacionProveedor(Request $request)
    {
        // Obtener empresa_actual del request
        $empresaActual = $request->input('empresa_actual');

        // Configurar conexión tenant si hay empresa
        if ($empresaActual) {
            DatabaseConnectionHelper::configurarConexionTenant($empresaActual);
        }

        $identificacion = request('identificacion', null);
        
        // Consultamos si ya existe un proveedor con la identificación ingresada
        $proveedor = Proveedor::where('identificacion', $identificacion)->first();

        // Restaurar conexión principal si se usó tenant
        if ($empresaActual) {
            DatabaseConnectionHelper::restaurarConexionPrincipal();
        }

        return response()->json($proveedor);
    }

    // ======================================================================
    // ======================================================================

    public function consultarNitProveedor(Request $request)
    {
        // Obtener empresa_actual del request
        $empresaActual = $request->input('empresa_actual');

        // Configurar conexión tenant si hay empresa
        if ($empresaActual) {
            DatabaseConnectionHelper::configurarConexionTenant($empresaActual);
        }

        $nitProveedor = request('nit_proveedor', null);
        
        // Consultamos si ya existe un proveedor con el nit ingresado
        $proveedor = Proveedor::where('nit_proveedor', $nitProveedor)->first();

        // Restaurar conexión principal si se usó tenant
        if ($empresaActual) {
            DatabaseConnectionHelper::restaurarConexionPrincipal();
        }

        return response()->json($proveedor);
    }
}
