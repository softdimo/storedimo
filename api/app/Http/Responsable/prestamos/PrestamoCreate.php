<?php

namespace App\Http\Responsable\prestamos;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Prestamo;
use App\Models\Usuario;

class PrestamoCreate implements Responsable
{
    public function toResponse($request)
    {
        try {
            $usuarios = Usuario::leftjoin('roles_2', 'roles_2.id_rol', '=', 'usuarios.id_rol')
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
                    'rol',
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


        // try {
        //     $prestamos = Prestamo::leftjoin('estados_prestamo','estados_prestamo.id_estado_prestamo','=','prestamos.id_estado_prestamo')
        //         ->leftjoin('usuarios','usuarios.id_usuario','=','prestamos.id_usuario')
        //         ->leftjoin('tipo_persona','tipo_persona.id_tipo_persona','=','usuarios.id_tipo_persona')
        //         ->select(
        //             'id_prestamo',
        //             'prestamos.id_estado_prestamo',
        //             'estado_prestamo',
        //             'prestamos.id_usuario',
        //             DB::raw("CONCAT(nombre_usuario, ' ', apellido_usuario) AS nombres_usuario"),
        //             'nombre_usuario',
        //             'apellido_usuario',
        //             'valor_prestamo',
        //             'identificacion',
        //             'fecha_prestamo',
        //             'fecha_limite',
        //             'descripcion',
        //             'usuarios.id_tipo_persona',
        //             'tipo_persona',
        //         )
        //         ->orderByDesc('fecha_prestamo')
        //         ->get();

        //         return response()->json($prestamos);

        // } catch (Exception $e) {
        //     return response()->json(['error_bd' => $e->getMessage()]);
        // }
    }
}
