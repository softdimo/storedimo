<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\DatabaseConnectionHelper;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class VerificarSesionIniciada
{
    public function handle($request, Closure $next)
    {
        // 1. Verificar sesión iniciada
        if (!Session::has('sesion_iniciada') || Session::get('sesion_iniciada') !== true) {
            $this->limpiarSesion();
            return redirect()->route('login');
        }

        // 2. Verificar empresa en sesión
        if (!Session::has('empresa_actual')) {
            $this->limpiarSesion();
            return redirect()->route('login')->withErrors(['error' => 'Sesión inválida']);
        }

        try {
            // 3. Configurar conexión tenant
            DatabaseConnectionHelper::configurarConexionTenant(Session::get('empresa_actual'));
            
            // 4. Verificar conexión
            DB::connection('tenant')->getPdo();

            return $next($request);

        } catch (\Exception $e) {
            $this->limpiarSesion();
            return redirect()->route('login')->withErrors([
                'error' => 'Error de conexión: ' . $e->getMessage()
            ]);
        }
    }

    private function limpiarSesion()
    {
        DatabaseConnectionHelper::restaurarConexionPrincipal();
        Session::flush();
    }
}
