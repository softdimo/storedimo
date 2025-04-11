<?php

namespace App\Providers;

use App\Models\Usuario;
use OwenIt\Auditing\Contracts\UserResolver;

class AuditUserResolver implements UserResolver
{
    public static function resolve()
    {
        \Log::debug('Audit Resolver', session()->all()); // Depuración

        if (session()->has('sesion_iniciada') && session('sesion_iniciada')) {
            return Usuario::find(session('id_usuario'));
        }
    
        return null;
    }
}
