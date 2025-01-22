<?php

namespace App\Http\Responsable\usuarios;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class UsuarioStore implements Responsable
{
    public function toResponse($request)
    {
        $nombreUsuario = request('nombre_usuario', null);
        $apellidoUsuario = request('apellido_usuario', null);
        $identificacion = request('identificacion', null);
        $usuario  = request('usuario', null);
        $email = request('email', null);
        $idRol = request('id_rol', null);
        $idEstado = request('id_estado', null);
        $clave = request('clave', null);
        $claveFallas = request('clave_fallas', null);

        // ================================================

        $nuevoUsuario = Usuario::create([
            'nombre_usuario' => $nombreUsuario,
            'apellido_usuario' => $apellidoUsuario,
            'identificacion' => $identificacion,
            'usuario' => $usuario,
            'email' => $email,
            'clave' => $clave,
            'clave_fallas' => $claveFallas,
            'id_estado' => $idEstado,
            'id_rol' => $idRol
        ]);

        // ================================================

        if (isset($nuevoUsuario) && !is_null($nuevoUsuario) && !empty($nuevoUsuario)) {
            return response()->json([
                'success' => true,
                'message' => 'Usuario creado correctamente'
            ]);
        } else {
            return abort(404, 'No existe este usuario');
        }
    }

    // ===================================================================
    // ===================================================================


}
