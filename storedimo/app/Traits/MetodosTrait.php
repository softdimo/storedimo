<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use App\Models\Rol;
use App\Models\Estado;
use App\Models\TipoDocumento;
use App\Models\TipoPersona;
use App\Models\Genero;
use App\Models\TipoBaja;
use App\Models\TipoPago;
use App\Models\PeriodoPago;
use App\Models\PorcentajeComision;
use App\Models\Empresa;
use App\Models\Usuario;
use App\Models\TipoBd;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Exception;
use Illuminate\Support\Facades\Cache;
use App\Models\InformeCampo;
use App\Models\Informe;

trait MetodosTrait
{
    protected $baseUri;
    protected $clientApi;
    protected $apiTimeout = 5.0; // Timeout en segundos

    protected function initHttpClient()
    {
        if (!$this->clientApi) {
            $this->baseUri = env('BASE_URI');
            $this->clientApi = new Client([
                'base_uri' => $this->baseUri,
                'timeout' => $this->apiTimeout,
                'headers' => [
                    'Accept' => 'application/json'
                ]
            ]);
        }
    }

    public function checkDatabaseConnection()
    {
        try {
            DB::connection()->getPdo();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function validarVariablesSesion()
    {
        return [
            session('id_usuario'),
            session('usuario'),
            session('id_rol'),
            session('sesion_iniciada')
        ];
    }

    public function quitarCaracteresEspeciales($cadena)
    {
        $no_permitidas = [
            'á', 'é', 'í', 'ó', 'ú',
            'Á', 'É', 'Í', 'Ó', 'Ú',
            'ñ', 'À', 'Ã', 'Ì', 'Ò',
            'Ù', 'Ã™', 'Ã', 'Ã¨', 'Ã¬',
            'Ã²', 'Ã¹', 'ç', 'Ç', 'Ã¢',
            'ê', 'Ã®', 'Ã´', 'Ã»', 'Ã‚',
            'ÃŠ', 'ÃŽ', 'Ã"', 'Ã›', 'ü',
            'Ã¶', 'Ã–', 'Ã¯', 'Ã¤', '«',
            'Ò', 'Ã', 'Ã„', 'Ã‹', 'ñ',
            'Ñ', '*'
        ];

        $permitidas = [
            'a', 'e', 'i', 'o', 'u',
            'A', 'E', 'I', 'O', 'U',
            'n', 'N', 'A', 'E', 'I',
            'O', 'U', 'a', 'e', 'i',
            'o', 'u', 'c', 'C', 'a',
            'e', 'i', 'o', 'u', 'A',
            'E', 'I', 'O', 'U', 'u',
            'o', 'O', 'i', 'a', 'e',
            'U', 'I', 'A', 'E', 'n',
            'N', ''
        ];

        return str_replace($no_permitidas, $permitidas, $cadena);
    }

    public function shareData()
    {
        // Compartir datos básicos que no requieren la API
        $this->shareBasicData();
        
        // Compartir permisos desde la API
        $this->sharePermissionsData();
    }

    protected function shareBasicData()
    {
        view()->share('roles', Rol::orderBy('name')->pluck('name', 'id'));
        view()->share('estados', Estado::whereIn('id_estado', [1,2])->orderBy('estado')->pluck('estado', 'id_estado'));
        view()->share('tipos_documento', TipoDocumento::orderBy('tipo_documento')->pluck('tipo_documento', 'id_tipo_documento'));
        view()->share('tipos_persona', TipoPersona::whereNotIn('id_tipo_persona', [1,2])->orderBy('tipo_persona')->pluck('tipo_persona', 'id_tipo_persona'));
        view()->share('tipos_empleado', TipoPersona::whereIn('id_tipo_persona', [1,2])->orderBy('tipo_persona')->pluck('tipo_persona', 'id_tipo_persona'));
        view()->share('tipos_proveedor', TipoPersona::whereIn('id_tipo_persona', [3,4])->orderBy('tipo_persona')->pluck('tipo_persona', 'id_tipo_persona'));
        view()->share('generos', Genero::orderBy('genero')->pluck('genero', 'id_genero'));
        view()->share('tipos_baja', TipoBaja::orderBy('tipo_baja','asc')->pluck('tipo_baja', 'id_tipo_baja'));
        view()->share('tipos_pago_ventas', TipoPago::whereNotIn('id_tipo_pago', [4,5])->where('id_estado',1)->orderBy('tipo_pago')->pluck('tipo_pago', 'id_tipo_pago'));
        view()->share('tipos_pago_nomina', TipoPago::whereIn('id_tipo_pago', [4,5])->orderBy('tipo_pago')->pluck('tipo_pago', 'id_tipo_pago'));
        view()->share('periodos_pago', PeriodoPago::orderBy('periodo_pago')->pluck('periodo_pago', 'id_periodo_pago'));
        view()->share('porcentajes_comision', PorcentajeComision::orderBy('porcentaje_comision')->pluck('porcentaje_comision', 'id_porcentaje_comision'));
        view()->share('empresas', Empresa::orderBy('nombre_empresa')->where('id_estado', 1)->pluck('nombre_empresa', 'id_empresa'));
        view()->share('tipos_bd', TipoBd::orderBy('tipo_bd')->pluck('tipo_bd', 'id_tipo_bd'));
        view()->share('usuarios', Usuario::orderBy('id_usuario')
                                    ->select(
                                        DB::raw("CONCAT(nombre_usuario, ' ', apellido_usuario, ' => ', usuario) AS user"),
                                        'id_usuario'
                                    )
                                    ->where('id_estado', 1)
                                    ->pluck('user', 'id_usuario'));


        view()->share('tipos_cliente', TipoPersona::whereIn('id_tipo_persona', [5,6])->orderBy('tipo_persona')->pluck('tipo_persona', 'id_tipo_persona'));
        
    } // FIN shareBasicData()

    protected function sharePermissionsData()
    {
        try {
            $this->initHttpClient();
            
            $permisos = $this->getPermisosFromApi();
            
            view()->share('permisos', $permisos);
            view()->share('permisosAsignados', []);

        } catch (RequestException $e) {
            view()->share('permisos', []);
            return back()->with('error', 'Error obteniendo permisos del sistema');
        }
    }

    protected function getPermisosFromApi()
    {
        $cacheKey = 'permisos_view_share_' . session('id_usuario');
        
        return Cache::remember($cacheKey, now()->addMinutes(1), function () {
            $response = $this->clientApi->get('administracion/permisos_view_share_trait');
            return json_decode($response->getBody()->getContents());
        });
    }

    public function permisos()
    {
        try
        {
            $this->initHttpClient();
            $cacheKey = 'permisos_list_' . session('id_usuario');

            return Cache::remember($cacheKey, now()->addMinutes(1), function () {
                $response = $this->clientApi->get('administracion/permisos_trait');
                return json_decode($response->getBody()->getContents());
            });

        } catch (RequestException $e) {
            return [];
        }
    }

    public function permisosPorUsuario($idUsuario)
    {
        try
        {
            $this->initHttpClient();
            $cacheKey = 'permisos_usuario_' . $idUsuario;

            return Cache::remember($cacheKey, now()->addMinutes(1), function () use ($idUsuario) {
                $response = $this->clientApi->get("administracion/permisos_por_usuario_trait/{$idUsuario}", [
                    'headers' => [
                        'Authorization' => 'Bearer ' . session('api_token')
                    ]
                ]);
                return json_decode($response->getBody()->getContents());
            });

        } catch (RequestException $e) {
            return [];
        }
    }

    public function validarAccesos($usuarioId, $permissionId, $vista, $infCodigo = null)
    {
        try
        {
            $permisosUsuario = $this->permisosPorUsuario($usuarioId);

            if (empty($permisosUsuario)) {
                return view('errors.403')->with('error', 'No se encontraron permisos');
            }

            if (!in_array($permissionId, $permisosUsuario)) {
                return view('errors.403');
            }

            // Si es una vista simple
            if (is_string($vista) && is_null($infCodigo))
            {
                return view($vista);
            }

            // Si es una vista de informe
            if ($vista === 'informe_gerencial' && $infCodigo)
            {
                $campos = InformeCampo::formulario($infCodigo);
                $informe = Informe::where('informe_codigo', $infCodigo)->first();

                return view('informes.informe', compact('campos', 'informe'));
            }

            // Si la vista es una respuesta diferente (por ejemplo, un redirect)
            return $vista;

        } catch (Exception $e)
        {
            return view('errors.403')->with('error', 'Error validando permisos');
        }
    }
}
