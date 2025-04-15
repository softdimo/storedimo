<?php

namespace App\Http\Responsable\proveedores;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use App\Models\Proveedor;

class ProveedorIndex implements Responsable
{
    public function toResponse($request)
    {
        try {
            $proveedores = Proveedor::leftjoin('empresas', 'empresas.id_empresa', '=', 'proveedores.id_empresa')
                ->leftjoin('tipo_persona', 'tipo_persona.id_tipo_persona', '=', 'proveedores.id_tipo_persona')
                ->leftjoin('tipo_documento', 'tipo_documento.id_tipo_documento', '=', 'proveedores.id_tipo_documento')
                ->leftjoin('estados', 'estados.id_estado', '=', 'proveedores.id_estado')
                ->leftjoin('generos', 'generos.id_genero', '=', 'proveedores.id_genero')
                ->select(
                    'id_proveedor',
                    'empresas.id_empresa',
                    'empresas.nombre_empresa',
                    'proveedores.id_tipo_persona',
                    'tipo_persona',
                    'proveedores.id_tipo_documento',
                    'tipo_documento',
                    'identificacion',
                    'nombres_proveedor',
                    'apellidos_proveedor',
                    'telefono_proveedor',
                    'celular_proveedor',
                    'email_proveedor',
                    'proveedores.id_genero',
                    'genero',
                    'direccion_proveedor',
                    'proveedores.id_estado',
                    'estado',
                    'nit_proveedor',
                    'proveedor_juridico',
                    'telefono_juridico'
                )
                ->orderByRaw("
                    CASE
                        WHEN proveedor_juridico IS NOT NULL THEN proveedor_juridico
                        ELSE nombres_proveedor
                    END ASC
                ")
                ->get();

            return response()->json($proveedores);
            
        } catch (Exception $e) {
            return response()->json(['error_bd' => $e->getMessage()]);
        }
    }
}
