<?php

namespace App\Http\Responsable\empresas;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Empresa;

class EmpresaIndex implements Responsable
{
    public function toResponse($request)
    {
        try {
            $empresas = Empresa::leftjoin('estados','estados.id_estado','=','empresas.id_estado')
                ->select(
                    'id_empresa',
                    'nit_empresa',
                    'nombre_empresa',
                    'telefono_empresa',
                    'celular_empresa',
                    'email_empresa',
                    'direccion_empresa',
                    'estados.id_estado',
                    'estado'
                )
                ->orderBy('nombre_empresa')
                ->get();

                return response()->json($empresas);

        } catch (Exception $e) {
            return response()->json(['error_bd' => $e->getMessage()]);
        }
    }
}
