<?php

namespace App\Http\Controllers\proveedores;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Responsable\proveedores\ProveedorIndex;
use App\Http\Responsable\proveedores\ProveedorStore;
use App\Http\Responsable\proveedores\ProveedorUpdate;
use App\Models\Proveedor;


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
    public function update(Request $request, $idPersona)
    {
        return new ProveedorUpdate($request, $idPersona);
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

    public function consultarIdentificacionProveedor()
    {
        $identificacion = request('identificacion', null);
        
        // Consultamos si ya existe un proveedor con la identificación ingresada
        return Proveedor::where('identificacion', $identificacion)->first();
    }

    // ======================================================================
    // ======================================================================

    public function consultarNitProveedor()
    {
        $nitProveedor = request('nit_proveedor', null);
        
        // Consultamos si ya existe un proveedor con el nit ingresado
        return Proveedor::where('nit_proveedor', $nitProveedor)->first();
    }
}
