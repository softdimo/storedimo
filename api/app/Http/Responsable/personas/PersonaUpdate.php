<?php

namespace App\Http\Responsable\usuarios;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioUpdate implements Responsable
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function toResponse($request)
    {
        $idUsuario = $request->route('idUsuario');
        $usuario = Usuario::find($idUsuario);

        if (isset($usuario) && !is_null($usuario) && !empty($usuario)) {

            $usuario->nombre_usuario = $request->input('nombre_usuario');
            $usuario->apellido_usuario = $request->input('apellido_usuario');
            $usuario->identificacion = $request->input('identificacion');
            $usuario->email = $request->input('email');
            $usuario->id_estado = $request->input('id_estado');
            $usuario->id_rol = $request->input('id_rol');
            $usuario->update();

            return response()->json([
                'success' => true,
                'message' => 'El usuario se actualizó correctamente'
            ]);
        } else {
            return abort(404, $message = 'No existe este usuario');
        }
    }

    // ===================================================================
    // ===================================================================


}
