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
        // dd($request);

        $formCompraEntradas = request('form_compra_entradas', null); // formulario de donde se crea

        $fechaCompra1 = request('fecha_compra', null);
        $fechaCompra2 = request('fecha_compra', now()); // now() obtiene la fecha y hora actual
        $fechaCompra3 = now()->format('Y-m-d H:i:s'); // Formato compatible con DATETIME en MySQL

        dd($fechaCompra1,$fechaCompra2,$fechaCompra3);

        $valorCompra = request('valor_compra', null);
        $idProveedor = request('id_proveedor', null);
        $idUsuario = request('id_usuario', null);
        $idEstado = request('id_estado', null);

        
        
        
        
        try {
            $peticionCategoriaStore = $this->clientApi->post($this->baseUri.'categoria_store', [
                'json' => ['categoria' => $categoria]
            ]);
            $respuestaCategoriaStore = json_decode($peticionCategoriaStore->getBody()->getContents());

            if(isset($respuestaCategoriaStore) && !empty($respuestaCategoriaStore)) {
                alert()->success('Proceso Exitoso', 'Categoría creada satisfactoriamente');
                return redirect()->to(route('categorias.index'));
            }
        } catch (Exception $e) {
            alert()->error('Error', 'Error creando categoriausuario, si el problema persiste, contacte a Soporte.' . $e->getMessage());
            return back();
        }
}
}
