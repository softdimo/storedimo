<?php

namespace App\Http\Responsable\pago_empleados;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class PagoEmpleadoCreate implements Responsable
{
    public function toResponse($request)
    {
        try {
            $usuarios = Usuario::leftjoin('roles', 'roles.id', '=', 'usuarios.id_rol')
                ->leftjoin('estados', 'estados.id_estado', '=', 'usuarios.id_estado')
                ->leftjoin('tipo_documento', 'tipo_documento.id_tipo_documento', '=', 'usuarios.id_tipo_documento')
                ->leftjoin('tipo_persona', 'tipo_persona.id_tipo_persona', '=', 'usuarios.id_tipo_persona')
                ->leftjoin('generos', 'generos.id_genero', '=', 'usuarios.id_genero')
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
                )
                ->orderBy('nombre_usuario')
                ->get();

            return response()->json($usuarios);
            
        } catch (Exception $e) {
            return response()->json(['error_bd' => $e->getMessage()]);
        }
    }
}
