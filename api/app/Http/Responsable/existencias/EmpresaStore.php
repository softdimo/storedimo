<?php

namespace App\Http\Responsable\empresas;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Empresa;

class EmpresaStore implements Responsable
{
    public function toResponse($request)
    {
        $nitEmpresa = request('nit_empresa', null);
        $nombreEmpresa = request('nombre_empresa', null);
        $telefonoEmpresa = request('telefono_empresa', null);
        $celularEmpresa = request('celular_empresa');
        $emailEmpresa = request('email_empresa');
        $direccionEmpresa = request('direccion_empresa');
        $idEstado = request('id_estado');

        try {
            $nuevaEmpresa = Empresa::create([
                'nit_empresa' => $nitEmpresa,
                'nombre_empresa' => $nombreEmpresa,
                'telefono_empresa' => $telefonoEmpresa,
                'celular_empresa' => $celularEmpresa,
                'email_empresa' => $emailEmpresa,
                'direccion_empresa' => $direccionEmpresa,
                'id_estado' => $idEstado
            ]);

            if (isset($nuevaEmpresa) && !is_null($nuevaEmpresa) && !empty($nuevaEmpresa)) {
                return response()->json(['success' => true]);
            }

        } catch (Exception $e) {
            return response()->json(['error_bd' => $e->getMessage()]);
        }
    }
}
