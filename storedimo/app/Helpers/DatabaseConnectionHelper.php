<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Exception;

class DatabaseConnectionHelper
{
    public static function configurarConexionTenant(array $empresa)
    {
        try {
            // 1. Limpiar conexión anterior
            Config::set('database.connections.tenant', null);
            DB::purge('tenant');

            // 2. Validar datos de conexión
            if (!isset($empresa['db_database']) || !isset($empresa['db_username']) ||
                !isset($empresa['db_password']) || !isset($empresa['db_host'])
            ) {
                throw new Exception('Datos de conexión incompletos para la empresa API_DB');
            }

            // 3. Crear configuración tenant
            $config = [
                'driver'    => 'mysql',
                'host'      => isset($empresa['db_host']) ? Crypt::decrypt($empresa['db_host']) : env('DB_HOST', 'softdimo.com'),
                'port'      => env('DB_PORT', '3306'),
                'database'  => Crypt::decrypt($empresa['db_database']),
                'username'  => Crypt::decrypt($empresa['db_username']),
                'password'  => Crypt::decrypt($empresa['db_password']),
                'charset'   => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'prefix'    => '',
                'strict'    => true,
                'engine'    => null,
                'options'   => [
                    \PDO::ATTR_PERSISTENT => false,
                ]
            ];

            // 4. Establecer conexión tenant
            Config::set('database.connections.tenant', $config);
            DB::purge('tenant');
            DB::reconnect('tenant');

            // 5. Verificar conexión
            DB::connection('tenant')->getPdo();

            // 6. Establecer como conexión default
            Config::set('database.default', 'tenant');
            DB::reconnect('tenant');

            return true;

        } catch (Exception $e) {
            // Restaurar conexión principal en caso de error
            Config::set('database.default', 'mysql');
            DB::reconnect('mysql');
            throw new Exception('Error Exception configurando conexión tenant APP');
        }
    }

    public static function restaurarConexionPrincipal()
    {
        Config::set('database.default', 'mysql');
        DB::reconnect('mysql');
    }
}
