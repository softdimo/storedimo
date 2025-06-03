<?php

namespace App\Http\Responsable\empresas;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Crypt;
use GuzzleHttp\Client;

class EmpresaUpdate implements Responsable
{
    protected $baseUri;
    protected $clientApi;
    protected $idEmpresa;

    public function __construct($idEmpresa)
    {
        $this->baseUri = env('BASE_URI');
        $this->clientApi = new Client(['base_uri' => $this->baseUri]);
        $this->idEmpresa = $idEmpresa;
    }

    // ===================================================================
    // ===================================================================

    public function toResponse($request)
    {
        $nitEmpresa = request('nit_empresa', null);
        $nombreEmpresa = request('nombre_empresa', null);
        $telefonoEmpresa = request('telefono_empresa', null);
        $celularEmpresa = request('celular_empresa');
        $emailEmpresa = request('email_empresa');
        $direccionEmpresa = request('direccion_empresa');
        $appKey = Crypt::encrypt(request('app_key'));
        $appUrl = request('app_url');
        $idTipoBd = request('id_tipo_bd');
        $dbDatabase = Crypt::encrypt(request('db_database'));
        $dbUsername = Crypt::encrypt(request('db_username'));
        $dbPassword = Crypt::encrypt(request('db_password'));
        $idEstado = request('id_estado');

        // ===================================================================

        try {
            $reqEmpresaUpdate = $this->clientApi->put($this->baseUri.'empresa_update/'.$this->idEmpresa, [
                'json' => [
                    'nit_empresa' => $nitEmpresa,
                    'nombre_empresa' => $nombreEmpresa,
                    'telefono_empresa' => $telefonoEmpresa,
                    'celular_empresa' => $celularEmpresa,
                    'email_empresa' => $emailEmpresa,
                    'direccion_empresa' => $direccionEmpresa,
                    'app_key' => $appKey,
                    'app_url' => $appUrl,
                    'id_tipo_bd' => $idTipoBd,
                    'db_database' => $dbDatabase,
                    'db_username' => $dbUsername,
                    'db_password' => $dbPassword,
                    'id_estado' => $idEstado,
                    'id_audit' => session('id_usuario')
                ]
            ]);
            $resEmpresaUpdate = json_decode($reqEmpresaUpdate->getBody()->getContents());

            if(isset($resEmpresaUpdate->success) && $resEmpresaUpdate->success) {
                alert()->success('Proceso Exitoso', 'Empresa editada satisfactoriamente');
                return redirect()->to(route('empresas.index'));
            }
        } catch (Exception $e) {
            $this->handleError('Error Exception actualizando la empresa, contacte a Soporte.');
        }

        return back();
    }

    // Método auxiliar para manejar errores
    private function handleError($message)
    {
        alert()->error('Error', $message);
    }
}
