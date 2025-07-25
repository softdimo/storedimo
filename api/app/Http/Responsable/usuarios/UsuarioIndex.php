<?php

namespace App\Http\Responsable\usuarios;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use App\Models\Usuario;

class UsuarioIndex implements Responsable
{
    public function toResponse($request)
    {
        try {
            // Obtener id_empresa_usuario del request
            $idEmpresaUsuario = $request->input('id_empresa_usuario');

            $query = Usuario::leftjoin('roles', 'roles.id', '=', 'usuarios.id_rol')
                ->leftjoin('estados', 'estados.id_estado', '=', 'usuarios.id_estado')
                ->leftjoin('tipo_documento', 'tipo_documento.id_tipo_documento', '=', 'usuarios.id_tipo_documento')
                ->leftjoin('tipo_persona', 'tipo_persona.id_tipo_persona', '=', 'usuarios.id_tipo_persona')
                ->leftjoin('generos', 'generos.id_genero', '=', 'usuarios.id_genero')
                ->leftjoin('empresas', 'empresas.id_empresa', '=', 'usuarios.id_empresa')
                ->select(
                    'id_usuario',
                    'nombre_usuario',
                    'apellido_usuario',
                    'usuario',
                    'usuarios.id_tipo_documento',
                    'tipo_documento',
                    'identificacion',
                    'email',
                    'name AS rol',
                    'usuarios.id_rol',
                    'estado',
                    'usuarios.id_estado',
                    'usuarios.id_tipo_persona',
                    'tipo_persona',
                    'generos.id_genero',
                    'genero',
                    'numero_telefono',
                    'celular',
                    'direccion',
                    'fecha_contrato',
                    'fecha_terminacion_contrato',
                    'empresas.id_empresa',
                    'nombre_empresa'
                );

            // Si el usuario no es de Softdimo (id_empresa != 5), filtrar por su empresa
            if ($idEmpresaUsuario != 5) {
                $query->where('usuarios.id_empresa', $idEmpresaUsuario);
            }

            $usuarios = $query->orderBy('nombre_usuario')->get();

            return response()->json($usuarios);
            
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error en la consulta de la base de datos',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
