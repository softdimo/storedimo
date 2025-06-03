<?php

namespace App\Http\Controllers\empresas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use App\Http\Responsable\empresas\EmpresaIndex;
use App\Http\Responsable\empresas\EmpresaStore;
use App\Http\Responsable\empresas\EmpresaUpdate;
use App\Http\Responsable\empresas\EmpresaEdit;
use App\Http\Responsable\empresas\EmpresaDatosConexion;
use App\Models\Empresa;

class EmpresasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new EmpresaIndex();
    }

    // ======================================================================
    // ======================================================================

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    // ======================================================================
    // ======================================================================

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return new EmpresaStore();
    }

    // ======================================================================
    // ======================================================================    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($idEmpresa)
    {
        //
    }

    // ======================================================================
    // ======================================================================

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idEmpresa)
    {
        return new EmpresaEdit($idEmpresa);
    }

    // ======================================================================
    // =====================================================================c=

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idEmpresa)
    {
        return new EmpresaUpdate($request, $idEmpresa);
    }

    // ======================================================================
    // ======================================================================

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idEmpresa)
    {
        //
    }

    // ======================================================================
    // ======================================================================

    public function consultarEmpresa(Request $request)
    {
        $nitEmpresa = request('nit_empresa', null);
        $nombreEmpresa = request('nombre_empresa', null);

        try {
            $consultarEmpresa = Empresa::where('nit_empresa', $nitEmpresa)
                    ->where('nombre_empresa', $nombreEmpresa)
                    ->first();

            if (isset($consultarEmpresa) && !is_null($consultarEmpresa) && !empty($consultarEmpresa)) {
                return response()->json($consultarEmpresa);
            }
        } catch (Exception $e) {
            return response()->json(['error_bd' => $e->getMessage()]);
        }
    }

    // ======================================================================
    // ======================================================================

    public function empresaDatosConexion($idEmpresa)
    {
        return new EmpresaDatosConexion($idEmpresa);
    }
    
    // ======================================================================
    // ======================================================================

    public function updateEnv(Request $request)
    {
        // Paso 1: Validar API Key
        $apiKeyHeader = $request->header('X-API-KEY');
        $validKey = config('services.env_update_key'); // definida en .env o config/services.php

        if (!$apiKeyHeader || $apiKeyHeader !== $validKey) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        try {
            // Paso 2: Recibir datos del JSON
            $envVars = $request->only([
                'DB_CONNECTION',
                'DB_DATABASE',
                'DB_USERNAME',
                'DB_PASSWORD',
            ]);

            // Paso 3: Ruta del .env de la API
            $envPath = base_path('.env');

            if (!File::exists($envPath)) {
                throw new Exception("Archivo .env no encontrado.");
            }

            // Paso 4: Leer y actualizar contenido
            $envContent = File::get($envPath);
            $lines = explode("\n", $envContent);

            foreach ($envVars as $key => $value) {
                $found = false;

                foreach ($lines as $i => $line) {
                    if (preg_match('/^' . preg_quote($key) . '=.*/', $line)) {
                        $lines[$i] = "{$key}={$value}";
                        $found = true;
                        break;
                    }
                }

                if (!$found) {
                    $lines[] = "{$key}={$value}";
                }
            }

            // Paso 5: Guardar cambios en el .env
            File::put($envPath, implode("\n", $lines));

            // Paso 6: Limpiar caché
            Artisan::call('config:clear');
            Artisan::call('cache:clear');

            return response()->json(['status' => 'ok', 'message' => 'Variables .env actualizadas.']);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error actualizando el archivo .env',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
