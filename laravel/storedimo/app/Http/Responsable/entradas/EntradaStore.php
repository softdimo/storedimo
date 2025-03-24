<?php

namespace App\Http\Responsable\entradas;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Categoria;
use GuzzleHttp\Client;

class EntradaStore implements Responsable
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
        $fechaCompra = now()->format('Y-m-d H:i:s'); // Formato compatible con DATETIME en MySQL
        $valorCompra = request('valor_compra', null);
        $idProveedor = request('id_persona', null);
        $idProducto = request('id_producto', null);
        $usuLogueado = session('id_usuario');
        $idEstado = 1;

        try {
            $reqEntradaStore = $this->clientApi->post($this->baseUri.'entrada_store', [
                'json' => [
                    'id_empresa' => $idEmpresa,
                    'fecha_compra' => $fechaCompra,
                    'valor_compra' => $valorCompra,
                    'id_proveedor' => $idProveedor,
                    'id_producto' => $idProducto,
                    'id_usuario' => $usuLogueado,
                    'id_estado' => $idEstado
                ]
            ]);
            $resEntradaStore = json_decode($reqEntradaStore->getBody()->getContents());

            if(isset($resEntradaStore) && !empty($resEntradaStore) && !is_null($resEntradaStore)) {
                alert()->success('Proceso Exitoso', 'Compra creada satisfactoriamente');
                return redirect()->to(route('entradas.index'));
            }
        } catch (Exception $e) {
            alert()->error('Error', 'Creando la compra, contacte a Soporte.');
            return back();
        }
}
}
