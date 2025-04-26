<?php

namespace App\Http\Responsable\roles_permisos;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use App\Models\ModelHasPermissions;
use App\Http\Responsable\roles_permisos\RolesPermisosShow;

class RolesPermisosDestroy implements Responsable
{   
    public function toResponse($request)
    {
        try 
        {
            $consultarPermisos = $this->consultarPermisosPorUsuario($request);

            if($consultarPermisos > 0)
            {
                foreach($request->permissions as $permissions)
                {
                    $respuesta = ModelHasPermissions::where('model_id', $request->usuario_id)
                                            ->where('permission_id', $permissions)
                                            ->delete();
                }

                if($respuesta)
                {
                    return response()->json([
                        'success' => true,
                        'message' => 'Permisos eliminados correctamente'
                    ]);
                }

                return response()->json([
                    'error' => true,
                    'message' => 'Ha ocurrido un error quitando los permisos'
                ]);

            } else 
            {
                return response()->json([
                    'error' => true,
                    'message' => 'No se encontrarón permisos asignados para el usuario seleccionado'
                ]);
            }
            
        } catch (Exception $e) 
        {
            return response()->json([
                'error' => true,
                'message' => 'Ha ocurrido un error de base de datos quitando los permisos'
            ]);
        }
    }

    public function consultarPermisosPorUsuario($request)
    {
        return ModelHasPermissions::select('permission_id', 'model_type', 'model_id')
                                    ->where('model_id', $request->usuario_id)
                                    ->whereIn('permission_id', $request->permissions)
                                    ->count();
    }
}