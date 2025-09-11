<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use App\Models\Empresa;
use App\Helpers\DatabaseConnectionHelper;

class MigrateTenants extends Command
{
    protected $signature = 'tenants:migrate {--fresh} {--seed}';
    protected $description = 'Ejecuta migraciones en todas las bases de datos de empresas';

    public function handle()
    {
        // Obtener las empresas desde la BD principal
        $empresas = DB::connection('mysql')->table('empresas')->get();

        foreach ($empresas as $empresa) {
            $this->info("🔹 Migrando tenant: {$empresa->nombre_empresa}");

            try {
                // Conectar al tenant
                DatabaseConnectionHelper::configurarConexionTenant((array)$empresa);
                            
                // 🔍 Depuración: mostrar datos de conexión
                $conexion = config('database.connections.tenant');
                $this->info("🟢 Configuración de conexión tenant para {$empresa->nombre_empresa}:");
                $this->line(print_r($conexion, true));


                // Parámetros de migración
                $params = [
                    '--database' => 'tenant',
                    '--path'     => 'database/migrations/tenant',
                ];

                if ($this->option('fresh')) $params['--fresh'] = true;
                if ($this->option('seed'))  $params['--seed'] = true;

                Artisan::call('migrate', $params);

                $this->info(Artisan::output());
            } catch (\Exception $e) {
                $this->error("❌ Error en {$empresa->nombre_empresa}: " . $e->getMessage());
            } finally {
                DatabaseConnectionHelper::restaurarConexionPrincipal();
            }
        }
    }
}
