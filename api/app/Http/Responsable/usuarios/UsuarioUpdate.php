<?php

namespace App\Http\Responsable\usuarios;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioUpdate implements Responsable
{
    protected $request;
    protected $idUsuario;

    public function __construct(Request $request, $idUsuario)
    {
        $this->request = $request;
        $this->idUsuario = $idUsuario;
    }

    public function toResponse($request)
    {
        // $idUsuario = $request->route('idUsuario');
        // $usuario = Usuario::find($idUsuario);

        $usuario = Usuario::find($this->idUsuario);

        if (isset($usuario) && !is_null($usuario) && !empty($usuario)) {
            try {
                $usuario->nombre_usuario = $request->input('nombre_usuario');
                $usuario->apellido_usuario = $request->input('apellido_usuario');
                $usuario->id_tipo_documento = $request->input('id_tipo_documento');
                $usuario->identificacion = $request->input('identificacion');
                $usuario->email = $request->input('email');
                $usuario->id_rol = $request->input('id_rol');
                $usuario->id_tipo_persona = $request->input('id_tipo_persona');
                $usuario->numero_telefono = $request->input('numero_telefono');
                $usuario->celular = $request->input('celular');
                $usuario->id_genero = $request->input('id_genero');
                $usuario->direccion = $request->input('direccion');
                $usuario->id_estado = $request->input('id_estado');
                $usuario->fecha_contrato = $request->input('fecha_contrato');
                $usuario->fecha_terminacion_contrato = $request->input('fecha_terminacion_contrato');
                $usuario->update();

                return response()->json(['success' => true]);
            } catch (Exception $e) {
                return response()->json(['error_bd' => $e->getMessage()]);
            }
        }
    }
}
