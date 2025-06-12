<?php

namespace App\Http\Controllers\personas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Responsable\personas\PersonaIndex;
use App\Http\Responsable\personas\PersonaStore;
use App\Http\Responsable\personas\PersonaUpdate;
use App\Http\Responsable\personas\PersonaEdit;
use Illuminate\Support\Facades\Hash;
use App\Models\Persona;
use App\Helpers\DatabaseConnectionHelper;


class PersonasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new PersonaIndex();
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
        return new PersonaStore($request);
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
    public function edit($idPersona)
    {
        return new PersonaEdit($idPersona);
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
        return new PersonaUpdate($request, $idPersona);
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

    public function consultarIdPersona(Request $request)
    {
        // Obtener empresa_actual del request
        $empresaActual = $request->input('empresa_actual');

        // Configurar conexión tenant si hay empresa
        if ($empresaActual) {
            DatabaseConnectionHelper::configurarConexionTenant($empresaActual);
        }

        $identificacion = request('identificacion', null);
        
        // Consultamos si ya existe un usuario con la cedula ingresada
        $persona = Persona::where('identificacion', $identificacion)->first();

        // Restaurar conexión principal si se usó tenant
        if ($empresaActual) {
            DatabaseConnectionHelper::restaurarConexionPrincipal();
        }

        if ($persona) {
            return response()->json($persona);
        } else {
            return response(null, 200);
        }
    }

    public function consultarNitEmpresa(Request $request)
    {
        // Obtener empresa_actual del request
        $empresaActual = $request->input('empresa_actual');

        // Configurar conexión tenant si hay empresa
        if ($empresaActual) {
            DatabaseConnectionHelper::configurarConexionTenant($empresaActual);
        }

        $nitEmpresa = request('nit_empresa', null);
        
        // Consultamos si ya existe un usuario con la cedula ingresada
        $persona = Persona::where('nit_empresa', $nitEmpresa)->first();

        // Restaurar conexión principal si se usó tenant
        if ($empresaActual) {
            DatabaseConnectionHelper::restaurarConexionPrincipal();
        }

        if ($persona) {
            return response()->json($persona);
        } else {
            return response(null, 200);
        }
    }
}
