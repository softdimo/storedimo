<?php

namespace App\Http\Responsable\personas;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Persona;

class PersonaIndex implements Responsable
{
    public function toResponse($request)
    {
        try {
            $personas = Persona::leftjoin('tipo_persona', 'tipo_persona.id_tipo_persona', '=', 'personas.id_tipo_persona')
                ->leftjoin('estados', 'estados.id_estado', '=', 'personas.id_estado')
                ->leftjoin('tipo_documento', 'tipo_documento.id_tipo_documento', '=', 'personas.id_tipo_documento')
                ->leftjoin('generos', 'generos.id_genero', '=', 'personas.id_genero')
                ->select(
                    'id_persona',
                    'personas.id_tipo_persona',
                    'tipo_persona',
                    'personas.id_tipo_documento',
                    'tipo_documento',
                    'identificacion',
                    'nombres_persona',
                    'apellidos_persona',
                    'numero_telefono',
                    'celular',
                    'email',
                    'genero',
                    'personas.id_genero',
                    'direccion',
                    'estado',
                    'personas.id_estado',
                )
                ->orderBy('nombres_persona')
                ->get();

            return response()->json($personas);
            
        } catch (Exception $e) {
            return response()->json(['error_bd' => $e->getMessage()]);
        }
    }
}
