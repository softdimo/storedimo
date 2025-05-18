<?php

namespace App\Http\Responsable\personas;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Persona;

class PersonaEdit implements Responsable
{
    protected $idPersona;

    // =========================================

    public function __construct($idPersona)
    {
        $this->idPersona = $idPersona;
    }

    // =========================================
    public function toResponse($request)
    {
        try {
            $persona = Persona::leftjoin('tipo_persona', 'tipo_persona.id_tipo_persona', '=', 'personas.id_tipo_persona')
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
                    'nit_empresa',
                    'nombre_empresa',
                    'telefono_empresa'
                )
                ->orderByDesc('nombres_persona')
                ->where('id_persona', $this->idPersona)
                ->first();

            if (isset($persona) && !is_null($persona) && !empty($persona)) {
                return response()->json($persona);
            }

        } catch (Exception $e) {
            return response()->json(['error_bd' => $e->getMessage()], 500);
        }
    }
}
