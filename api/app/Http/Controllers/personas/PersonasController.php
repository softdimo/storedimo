<?php

namespace App\Http\Controllers\personas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Responsable\personas\PersonaIndex;
use App\Http\Responsable\personas\PersonaStore;
use App\Http\Responsable\personas\PersonaUpdate;
use Illuminate\Support\Facades\Hash;
use App\Models\Persona;


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

    public function consultarIdPersona()
    {
        $identificacion = request('identificacion', null);
        
        // Consultamos si ya existe un usuario con la cedula ingresada
        return Persona::where('identificacion', $identificacion)->first();
    }

    public function consultarNitEmpresa()
    {
        $nitEmpresa = request('nit_empresa', null);
        
        // Consultamos si ya existe un usuario con la cedula ingresada
        return Persona::where('nit_empresa', $nitEmpresa)->first();
    }

    // public function inactivarUsuario($idUsuario) 
    // {
    //     try {

    //         $user = Usuario::find($idUsuario);
    //         $user->id_estado = 2;
    //         $user->save();

    //     } catch (Exception $e) {
    //         return response()->json('error_bd');
    //     }
    // }
}
