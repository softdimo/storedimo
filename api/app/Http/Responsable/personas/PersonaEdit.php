<?php

namespace App\Http\Responsable\personas;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use App\Models\Persona;
use App\Helpers\DatabaseConnectionHelper;

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
            // Obtener empresa_actual del request
            $empresaActual = $request->input('empresa_actual');

            // Configurar conexión tenant si hay empresa
            if ($empresaActual) {
                DatabaseConnectionHelper::configurarConexionTenant($empresaActual);
            }

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
                // Restaurar conexión principal si se usó tenant
                if ($empresaActual) {
                    DatabaseConnectionHelper::restaurarConexionPrincipal();
                }

                return response()->json($persona);
            }

        } catch (Exception $e) {
            // Asegurar restauración de conexión principal en caso de error
            if (isset($empresaActual)) {
                DatabaseConnectionHelper::restaurarConexionPrincipal();
            }
            
            return response()->json(['error_bd' => $e->getMessage()], 500);
        }
    }
}
