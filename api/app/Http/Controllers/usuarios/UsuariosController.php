<?php

namespace App\Http\Controllers\usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Responsable\usuarios\UsuarioIndex;
use App\Http\Responsable\usuarios\UsuarioStore;
use App\Http\Responsable\usuarios\UsuarioUpdate;
use App\Models\Usuario;


class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new UsuarioIndex();
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
        return new UsuarioStore($request);
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
        //return new UsuaUpdate($request, $id);
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

    public function consultarId() 
    {
        $identificacion = request('identificacion', null);
        // Consultamos si ya existe un usuario con la cedula ingresada
        return Usuario::where('identificacion', $identificacion)->first();
    }

    /* public function consultaUsuario()
    {
        $usuario = request('usuario', null);
        // Consultamos si ya existe un usuario con la cedula ingresada
        return Usuario::where('usuario', $usuario)->first();
    } */

    public function consultaUsuario()
    {
        try {
            $usuario = request('usuario', null);
            $consultarUsuario = Usuario::where('usuario', $usuario)
                    ->whereNull('deleted_at')
                    ->first();

            if ($consultarUsuario) {
                return response()->json($consultarUsuario);
            } else {
                return response()->json('no_user');
            }

        } catch (Exception $e) {
            return response()->json('error_bd');
        }
    }
}
