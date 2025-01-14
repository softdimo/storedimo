<?php

namespace App\Http\Responsable\usuarios;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Categoria;

class UsuarioStore implements Responsable
{
    public function toResponse($request)
    {
        //TODO: Pendiente
        $nombreUsuario = request('nombre_usuario', null);
        $apellidoUsuario = request('apellido_usuario', null);
        $identificacion = request('identificacion', null);
        $email = request('email', null);
        $idRol = request('id_rol', null);
        $idEstado = request('id_estado', null);
        $clave = request('clave', null);
        $claveFallas = request('clave_fallas', null);

        // ================================================

        $nuevoUsuario = Usuario::create([
            'nombres' => $nombres,
            'apellidos' => $apellidos,
            'usuario' => $usuario,
            'id_tipo_documento' => $idTipoDocumento,
            'numero_documento' => $numeroDocumento,
            'clave' => $clave,
            'clave_fallas' => $claveFallas,
            'correo' => $correo,
            'id_estado' => $idEstado,
            'id_rol' => $idRol
        ]);

        // ================================================

        if (isset($nuevoUsuario) && !is_null($nuevoUsuario) && !empty($nuevoUsuario)) {
            return response()->json([
                'success' => true,
                'message' => 'El usuario se actualizó correctamente'
            ]);
        } else {
            return abort(404, $message = 'No existe este usuario');
        }
                        
        $categoria = request('categoria', null);

        // ================================================

        $nuevaCategoria = Categoria::create([
            'categoria' => $categoria,
        ]);

        // ================================================

        if (isset($nuevaCategoria) && !is_null($nuevaCategoria) && !empty($nuevaCategoria)) {
            return response()->json([
                'success' => true,
                'message' => 'Categoría creada correctamente'
            ]);
        } else {
            return abort(404, $message = 'Categoría no creada');
        }
    }

    // ===================================================================
    // ===================================================================


}
