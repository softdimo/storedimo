<?php

namespace App\Http\Responsable\empresas;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;

class EmpresaUpdate implements Responsable
{
    protected $baseUri;
    protected $clientApi;

    public function __construct()
    {
        $this->baseUri = env('BASE_URI');
        $this->clientApi = new Client(['base_uri' => $this->baseUri]);
    }

    // ===================================================================
    // ===================================================================

    public function toResponse($request)
    {
        $idEmpresa = request('id_empresa', null);
        $nitEmpresa = request('nit_empresa', null);
        $nombreEmpresa = request('nombre_empresa', null);
        $telefonoEmpresa = request('telefono_empresa', null);
        $celularEmpresa = request('celular_empresa');
        $emailEmpresa = request('email_empresa');
        $direccionEmpresa = request('direccion_empresa');
        $idEstado = request('id_estado');

        // ===================================================================

        try {
            $reqEmpresaUpdate = $this->clientApi->put($this->baseUri.'empresa_update/'.$idEmpresa, [
                'json' => [
                    'nit_empresa' => $nitEmpresa,
                    'nombre_empresa' => $nombreEmpresa,
                    'telefono_empresa' => $telefonoEmpresa,
                    'celular_empresa' => $celularEmpresa,
                    'email_empresa' => $emailEmpresa,
                    'direccion_empresa' => $direccionEmpresa,
                    'id_estado' => $idEstado,
                    'id_audit' => session('id_usuario')
                ]
            ]);
            $resEmpresaUpdate = json_decode($reqEmpresaUpdate->getBody()->getContents());

            if($resEmpresaUpdate) {
                alert()->success('Proceso Exitoso', 'Empresa editada satisfactoriamente');
                return redirect()->to(route('empresas.index'));
            } else {
                $this->handleError('Error editando la empresa, por favor contacte a Soporte.');
            }
        } catch (Exception $e) {
            dd($e);
            $this->handleError('Error Exception, contacte a Soporte.');
        }

        return back();
    }

    // Método auxiliar para manejar errores
    private function handleError($message)
    {
        alert()->error('Error', $message);
    }
}
