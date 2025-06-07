<?php

namespace App\Http\Responsable\roles_permisos;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use App\Models\Roles;
use App\Models\Permission;
use App\Models\ModelHasPermissions;

class RolesPermisosStore implements Responsable
{   
    public function toResponse($request)
    {
        try
        {
            $nameRol = request('name', null);
            $validarRole = $this->validarNombreRol(ucwords($nameRol));

            if($validarRole == 0)
            {
                $createRol = Roles::create([
                    'name' => ucwords($nameRol),
                    'guard_name' => 'API'
                ]);
    
                if($createRol)
                {
                    return response()->json([
                        'success' => true,
                        'message' => 'Rol creado correctamente'
                    ]);
                }

                return response()->json([
                    'error' => true,
                    'message' => 'Ha ocurrido un error creando el rol'
                ]);

            } else {

                return response()->json([
                    'error' => true,
                    'message' => 'El nombre de rol ya existe en la base de datos'
                ]);

            }
            
        } catch (Exception $e)
        {
            return response()->json([
                'error' => true,
                'message' => 'Ha ocurrido un error de base de datos creando el rol'
            ]);
            
        }
    }

    public function validarNombreRol($name)
    {
        return Roles::select('name', 'guard_name')
                ->where('name', $name)
                ->count();
    }

    public function crearPermiso($request)
    {
        try
        {
            $namePermission = request('permission', null);
            $validarPermision = $this->validarNombrePermiso(ucwords($namePermission));

            if($validarPermision == 0)
            {
                $createPermission = Permission::create([
                    'name' => ucwords($namePermission),
                    'guard_name' => 'API'
                ]);
    
                if($createPermission)
                {
                    return response()->json([
                        'success' => true,
                        'message' => 'Permiso creado correctamente'
                    ]);
                }

                return response()->json([
                    'error' => true,
                    'message' => 'Ha ocurrido un error creando el permiso'
                ]);

            } else
            {
                return response()->json([
                    'error' => true,
                    'message' => 'El nombre de permiso ya existe en la base de datos'
                ]);

            }
            
        } catch (Exception $e)
        {
            return response()->json([
                'error' => true,
                'message' => 'Ha ocurrido un error de base de datos creando el permiso'
            ]);
            
        }
    }

    public function validarNombrePermiso($name)
    {
        return Permission::select('name', 'guard_name')
                ->where('name', $name)
                ->count();
    }

    public function crearPermisosPorUsuario($request)
    {
        try 
        {
            foreach($request->permissions as $permissions)
            {
                $modelHasPermissions = ModelHasPermissions::updateOrCreate([
                    'permission_id' => $permissions,
                    'model_type' => 'App\Models\Usuario',
                    'model_id' => $request->usuario_id
                ]);
            }

            if($modelHasPermissions)
            {
                return response()->json([
                    'success' => true,
                    'message' => 'Permisos asignados correctamente'
                ]);
            }

            return response()->json([
                'error' => true,
                'message' => 'Ha ocurrido un error asignando los permisos'
            ]);
            
        } catch (Exception $e) 
        {
            return response()->json($e);
            return response()->json([
                'error' => true,
                'message' => 'Ha ocurrido un error de base de datos asignando los permisos'
            ]);
        }
    }
}