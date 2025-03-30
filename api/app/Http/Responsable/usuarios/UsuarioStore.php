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
        $idTipoDocumento = request('id_tipo_documento', null);
        $identificacion = request('identificacion', null);
        $usuario  = request('usuario', null);
        $email = request('email', null);
        $idRol = request('id_rol', null);
        $idTipoPersona = request('id_tipo_persona', null);
        $numeroTelefono = request('numero_telefono', null);
        $celular = request('celular', null);
        $idGenero = request('id_genero', null);
        $direccion = request('direccion', null);
        $fechaContrato = request('fecha_contrato', null);
        $fechaTerminacionContrato = request('fecha_terminacion_contrato', null);
        $idEstado = request('id_estado', null);
        $clave = request('clave', null);
        $claveFallas = request('clave_fallas', null);

        $nuevoUsuario = Usuario::create([
            'nombre_usuario' => ucwords($nombreUsuario),
            'apellido_usuario' => ucwords($apellidoUsuario),
            'id_tipo_documento' => $idTipoDocumento,
            'identificacion' => $identificacion,
            'usuario' => $usuario,
            'email' => $email,
            'clave' => $clave,
            'clave_fallas' => $claveFallas,
            'id_estado' => $idEstado,
            'id_rol' => $idRol,
            'id_tipo_persona' => $idTipoPersona,
            'numero_telefono' => $numeroTelefono,
            'celular' => $celular,
            'id_genero' => $idGenero,
            'direccion' => $direccion,
            'fecha_contrato' => $fechaContrato,
            'fecha_terminacion_contrato' => $fechaTerminacionContrato,
        ]);

        if (isset($nuevoUsuario) && !is_null($nuevoUsuario) && !empty($nuevoUsuario))
        {
            return response()->json([
                'success' => true,
                'message' => 'Usuario creado correctamente',
                'usuario' => $nuevoUsuario
            ]);
        } else {
            return abort(404, 'No existe este usuario');
        }
    }
}
