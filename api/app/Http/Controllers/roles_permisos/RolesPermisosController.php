<?php

namespace App\Http\Controllers\roles_permisos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Responsable\roles_permisos\RolesPermisosStore;

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
}
