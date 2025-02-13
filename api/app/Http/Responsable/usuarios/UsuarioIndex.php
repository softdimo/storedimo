<?php

namespace App\Http\Responsable\usuarios;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class UsuarioIndex implements Responsable
{
    public function toResponse($request)
    {
        try {
            $usuarios = Usuario::leftjoin('roles', 'roles.id_rol', '=', 'usuarios.id_rol')
                ->leftjoin('estados', 'estados.id_estado', '=', 'usuarios.id_estado')
                ->leftjoin('tipo_documento', 'tipo_documento.id_tipo_documento', '=', 'usuarios.id_tipo_documento')
                ->select(
                    'id_usuario',
                    'nombre_usuario',
                    'apellido_usuario',
                    'usuario',
                    'usuarios.id_tipo_documento',
                    'tipo_documento',
                    'identificacion',
                    'email',
                    'rol',
                    'usuarios.id_rol',
                    'estado',
                    'usuarios.id_estado',
                )
                ->orderBy('nombre_usuario')
                ->get();

            return response()->json($usuarios);
            
        } catch (Exception $e) {
            dd($e);
            return response()->json([
                'message' => 'Error en la consulta de la base de datos',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
