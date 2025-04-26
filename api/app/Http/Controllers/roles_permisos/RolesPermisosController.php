<?php

namespace App\Http\Controllers\roles_permisos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Responsable\roles_permisos\RolesPermisosStore;
use App\Http\Responsable\roles_permisos\RolesPermisosShow;
use App\Http\Responsable\roles_permisos\RolesPermisosDestroy;

class RolesPermisosController extends Controller
{
    function crearRol(Request $request)
    {
        return new RolesPermisosStore();
    }

    function crearPermiso(Request $request)
    {
        $rolesPermisos = new RolesPermisosStore();
        return  $rolesPermisos->crearPermiso($request);
    }

    function crearPermisosUsuario(Request $request)
    {
        $rolesPermisos = new RolesPermisosStore();
        return  $rolesPermisos->crearPermisosPorUsuario($request);
    }

    function consultarPermisosPorUsuario(Request $request)
    {
        return new RolesPermisosShow();
    }

    function eliminarPermisosPorUsuario(Request $request)
    {
        return new RolesPermisosDestroy();
    }
}
