<?php

namespace App\Http\Responsable\personas;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use App\Models\Persona;

class PersonaUpdate implements Responsable
{
    protected $request;
    protected $idPersona;

    public function __construct(Request $request, $idPersona)
    {
        $this->request = $request;
        $this->idPersona = $idPersona;
    }

    public function toResponse($request)
    {
        $persona = Persona::find($this->idPersona);
        try {
            if (isset($persona) && !is_null($persona) && !empty($persona)) {
            
                $persona->id_tipo_persona = $request->input('id_tipo_persona');
                $persona->id_tipo_documento = $request->input('id_tipo_documento');
                $persona->identificacion = $request->input('identificacion');
                $persona->nombres_persona = $request->input('nombres_persona');
                $persona->apellidos_persona = $request->input('apellidos_persona');
                $persona->numero_telefono = $request->input('numero_telefono');
                $persona->celular = $request->input('celular');
                $persona->email = $request->input('email');
                $persona->id_genero = $request->input('id_genero');
                $persona->direccion = $request->input('direccion');
                $persona->id_estado = $request->input('id_estado');
                $persona->fecha_contrato = $request->input('fecha_contrato');
                $persona->fecha_terminacion_contrato = $request->input('fecha_terminacion_contrato');
                $persona->update();
    
                return response()->json(['success' => true]);
            }
            
        } catch (Exception $e) {
            return response()->json(['error_bd' => $e->getMessage()]);
        }
        
    }

    // ===================================================================
    // ===================================================================


}
