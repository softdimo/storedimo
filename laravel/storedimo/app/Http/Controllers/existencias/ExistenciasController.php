<?php

namespace App\Http\Controllers\existencias;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipoBaja;

class ExistenciasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('existencias.index');
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
        $this->shareData();
        return view('existencias.create');
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
        //
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
        //
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
    
    private function shareData()
    {
        view()->share('tipo_baja', TipoBaja::orderBy('tipo_baja','asc')->pluck('tipo_baja', 'id_tipo_baja'));
        // view()->share('tipo_documento', tipoDocumento::orderBy('tipo_documento','asc')->pluck('tipo_documento', 'id_tipo_documento'));
        // view()->share('generos', Genero::orderBy('genero','asc')->pluck('genero', 'id_genero'));
    }

    // ======================================================================
    // ======================================================================
    
    // ======================================================================
    // ======================================================================

    public function stockMinimo()
    {
        return view('existencias.stock_minimo');
    }
}
