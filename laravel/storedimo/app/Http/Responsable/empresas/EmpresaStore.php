<?php

namespace App\Http\Responsable\empresas;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;

class EmpresaStore implements Responsable
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
        $nitEmpresa = request('nit_empresa', null);
        $nombreEmpresa = request('nombre_empresa', null);
        $telefonoEmpresa = request('telefono_empresa', null);
        $celularEmpresa = request('celular_empresa');
        $emailEmpresa = request('email_empresa');
        $direccionEmpresa = request('direccion_empresa');
        $idEstado = request('id_estado');

        $consultarEmpresa = $this->consultarEmpresa($nitEmpresa, $nombreEmpresa);
        
        try {
            if (isset($consultarEmpresa) && !is_null($consultarEmpresa) && !empty($consultarEmpresa)) {
                alert()->warning('Cuidado', 'Empresa existente');
                return redirect()->route('empresas.create')->withInput();
            } else {
                $reqEmpresaStore = $this->clientApi->post($this->baseUri.'empresa_store', [
                    'json' => [
                        'nit_empresa' => $nitEmpresa,
                        'nombre_empresa' => $nombreEmpresa,
                        'telefono_empresa' => $telefonoEmpresa,
                        'celular_empresa' => $celularEmpresa,
                        'email_empresa' => $emailEmpresa,
                        'direccion_empresa' => $direccionEmpresa,
                        'id_estado' => $idEstado
                    ]
                ]);
                $resEmpresaStore = json_decode($reqEmpresaStore->getBody()->getContents());
    
                if(isset($resEmpresaStore) && !empty($resEmpresaStore) && !is_null($resEmpresaStore)) {
                    alert()->success('Proceso Exitoso', 'Empresa creada satisfactoriamente');
                    return redirect()->to(route('empresas.index'));
                }
            }
        } catch (Exception $e) {
            alert()->error('Error', 'Creando la empresa, contacte a Soporte.');
            return back();
        }
    }

    // ===================================================================
    // ===================================================================

    public function consultarEmpresa($nitEmpresa, $nombreEmpresa)
    {
        $consultarEmpresa = $this->clientApi->post($this->baseUri.'consultar_empresa', [
            'json' => [
                'nit_empresa' => $nitEmpresa,
                'nombre_empresa' => $nombreEmpresa
            ]
        ]);
        return json_decode($consultarEmpresa->getBody()->getContents());
    }
} // FIN Class EmpresaStore
