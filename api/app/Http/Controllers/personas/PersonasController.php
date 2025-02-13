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

    public function consultaUsuario()
    {
        try {
            $usuario = request('usuario', null);

            // Consultamos si ya existe este usuario específico
            $consultaUsuario = Usuario::where('usuario', $usuario)->first();

            if ($consultaUsuario) {
                return response()->json($consultaUsuario);
            } else {
                return response()->json('no_user');
            }
        } catch (Exception $e) {
            return response()->json('error_bd');
        }
    }


    public function queryUsuarioUpdate($idUsuario)
    {
        try {
            // Consultamos el id del usuario 
            return Usuario::where('id_usuario', $idUsuario)->first();
        } catch (Exception $e) {
            return response()->json('error_bd');
        }
    }


    public function cambiarClave(Request $request, $idUsuario)
    {
        $claveNueva = request('clave', null);

        try {
            $cambioClave = Usuario::where('id_usuario',$idUsuario)
                ->update([
                    'clave' => Hash::make($claveNueva),
            ]);
            return response()->json('clave_cambiada');
        } catch (Exception $e) {
            return response()->json('error_bd');
        }
    }

    public function consultaRecuperarClave(Request $request)
    {
        $email = request('email', null);
        $identificacion = request('identificacion', null);

        try {
             return Usuario::select('id_usuario','usuario','identificacion','email')
                ->where('email', $email)
                ->where('identificacion', $identificacion)
                ->first();
        } catch (Exception $e) {
            return response()->json('error_bd');
        }
    }

    public function inactivarUsuario($idUsuario) 
    {
        try {

            $user = Usuario::find($idUsuario);
            $user->id_estado = 2;
            $user->save();

        } catch (Exception $e) {
            return response()->json('error_bd');
        }
    }

    public function actualizarClaveFallas(Request $request, $idUsuario)
    {
        $contador = request('clave_fallas', null);
        try {
            $user = Usuario::find($idUsuario);
            $user->clave_fallas = $contador;
            $user->save();
        } catch (Exception $e) {
            return response()->json('error_bd');
        }
    }
}
