<?php

namespace App\Http\Controllers\empresas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Traits\MetodosTrait;
use Exception;
use App\Http\Responsable\empresas\EmpresaIndex;
use App\Http\Responsable\empresas\EmpresaStore;
use App\Http\Responsable\empresas\EmpresaUpdate;
use App\Http\Responsable\empresas\EmpresaEdit;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class EmpresasController extends Controller
{
    use MetodosTrait;
    protected $baseUri;
    protected $clientApi;

    public function __construct()
    {
        $this->shareData();
        $this->baseUri = env('BASE_URI');
        $this->clientApi = new Client(['base_uri' => $this->baseUri]);
    }

    // ======================================================================
    // ======================================================================

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try
        {
            if (!$this->checkDatabaseConnection())
            {
                return view('db_conexion');
            } else
            {
                $sesion = $this->validarVariablesSesion();

                if (empty($sesion[0]) || is_null($sesion[0]) &&
                    empty($sesion[1]) || is_null($sesion[1]) &&
                    empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
                {
                    return redirect()->to(route('login'));
                } else
                {
                    $vista = new EmpresaIndex();
                    return $this->validarAccesos($sesion[0], 6, $vista);
                }
            }
        } catch (Exception $e)
        {
            alert()->error("Exception Index Entradas!");
            return redirect()->to(route('login'));
        }
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
        try {
            if (!$this->checkDatabaseConnection()) {
                return view('db_conexion');
            } else {
                $sesion = $this->validarVariablesSesion();

                if (empty($sesion[0]) || is_null($sesion[0]) &&
                    empty($sesion[1]) || is_null($sesion[1]) &&
                    empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
                {
                    return redirect()->to(route('login'));
                } else
                {
                    $vista = 'empresas.create';
                    return $this->validarAccesos($sesion[0], 4, $vista);
                }
            }
        } catch (Exception $e)
        {
            alert()->error("Exception Create Empresas!");
            return redirect()->to(route('login'));
        }
    }

    // ======================================================================
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if (!$this->checkDatabaseConnection())
            {
                return view('db_conexion');
            } else
            {
                $sesion = $this->validarVariablesSesion();

                if (empty($sesion[0]) || is_null($sesion[0]) &&
                    empty($sesion[1]) || is_null($sesion[1]) &&
                    empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
                {
                    return redirect()->to(route('login'));
                } else
                {
                    $vista = new EmpresaStore();
                    return $this->validarAccesos($sesion[0], 22, $vista);
                }
            }
        } catch (Exception $e)
        {
            alert()->error("Exception Store Empresas!");
            return redirect()->to(route('login'));
        }
    }

    // ======================================================================
    // ======================================================================

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        try {
            if (!$this->checkDatabaseConnection())
            {
                return view('db_conexion');
            } else
            {
                $sesion = $this->validarVariablesSesion();

                if (empty($sesion[0]) || is_null($sesion[0]) &&
                    empty($sesion[1]) || is_null($sesion[1]) &&
                    empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
                {
                    return redirect()->to(route('login'));
                } else
                {
                    $vista = new EmpresaEdit($idEmpresa);
                    return $this->validarAccesos($sesion[0], 12, $vista);
                }
            }
        } catch (Exception $e)
        {
            alert()->error("Editando la Empresa!");
            return redirect()->to(route('login'));
        }
    }

    // ======================================================================
    // ======================================================================

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idEmpresa)
    {
        try {
            if (!$this->checkDatabaseConnection())
            {
                return view('db_conexion');
            } else
            {
                $sesion = $this->validarVariablesSesion();

                if (empty($sesion[0]) || is_null($sesion[0]) &&
                    empty($sesion[1]) || is_null($sesion[1]) &&
                    empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
                {
                    return redirect()->to(route('login'));
                } else
                {
                    $vista = new EmpresaUpdate($idEmpresa);
                    return $this->validarAccesos($sesion[0], 12, $vista);
                }
            }
        } catch (Exception $e)
        {
            alert()->error("Exception Update Empresas!");
            return redirect()->to(route('login'));
        }
    }

    // ======================================================================
    // ======================================================================

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    // ======================================================================
    // ======================================================================

    public function empresaDatosConexion(Request $request)
    {
        try {
            $idEmpresa = $request->input('id_empresa');

            $reqEmpresaEnv = $this->clientApi->get($this->baseUri.'empresa_datos_conexion/'.$idEmpresa, [
                'json' => []
            ]);
            $resEmpresaEnv = json_decode($reqEmpresaEnv->getBody()->getContents());
            return response()->json($resEmpresaEnv);
    
        } catch (Exception $e) {
            alert()->error("Error consultando los datos de conexión de la empresa!");
            return redirect()->to(route('login'));
        }
    }

    // ======================================================================
    // ======================================================================

    public function guardarDatosEnv(Request $request)
    {

        try {
            $datos = $request->all();
    
            $envVars = [
                'DB_CONNECTION' => $datos['db_connection'],
                'DB_DATABASE'   => decrypt($datos['db_database']),
                'DB_USERNAME'   => decrypt($datos['db_username']),
                'DB_PASSWORD'   => decrypt($datos['db_password']),
            ];

            if (app()->environment('local')) {
                // ✅ LOCAL
                $pathApi = realpath(base_path('../api')) . DIRECTORY_SEPARATOR . '.env';
                $pathWeb = base_path('.env');
    
                $this->actualizarArchivoEnv($pathApi, $envVars);
                $this->actualizarArchivoEnv($pathWeb, $envVars);
    
            } else {
                // 🌐 PRODUCCIÓN (API REMOTA)
                $this->clientApi->post('update_env', [
                    'headers' => [
                        'X-API-KEY' => config('services.env_update_key'),
                        'Accept' => 'application/json',
                    ],
                    'json' => $envVars,
                ]);
            }
    
            $this->actualizarArchivoEnv($pathApi, $envVars);
            $this->actualizarArchivoEnv($pathWeb, $envVars);

            Artisan::call('config:clear');
            Artisan::call('cache:clear');
    
            return response()->json(['status' => 'ok', 'message' => 'Variables .env actualizadas correctamente']);
    
        } catch (Exception $e) {
            alert()->error("Error guardando los datos de conexión de la empresa!");
            return redirect()->to(route('login'));
        }
    }

    // ======================================================================
    // ======================================================================

    protected function actualizarArchivoEnv($filePath, $envVars)
    {
        if (!file_exists($filePath)) {
            throw new \Exception("Archivo .env no encontrado: $filePath");
        }
    
        $envContent = file_get_contents($filePath);
        $lines = explode("\n", $envContent);
    
        foreach ($envVars as $key => $value) {
            $found = false;
    
            foreach ($lines as $i => $line) {
                // Ignorar líneas vacías o comentarios
                if (preg_match('/^\s*'.$key.'\s*=.*/', $line)) {
                    $lines[$i] = "{$key}={$value}";
                    $found = true;
                    break;
                }
            }
    
            if (!$found) {
                $lines[] = "{$key}={$value}";
            }
        }
    
        $newContent = implode("\n", $lines);
    
        file_put_contents($filePath, $newContent);
    }
}
