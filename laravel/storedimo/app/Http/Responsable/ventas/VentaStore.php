<?php

namespace App\Http\Responsable\ventas;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

class VentaStore implements Responsable
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
        dd($request);
        
        $idEmpresa = request('id_empresa', null);
        $idTipoCliente = request('cliente_venta', null);
        $fechaVenta = now()->format('Y-m-d H:i:s'); // Formato compatible con DATETIME en MySQL
        $descuento = request('descuento_total_venta', null);
        $subtotalVenta = request('sub_total_venta', null);
        $totalVenta = request('total_venta', null);
        $idTipoPago = request('tipo_pago', null);
        $idProducto = request('producto_venta', null);
        $idCliente = request('id_persona', null);
        $usuLogueado = session('id_usuario');
        $idEstado = 1;
        $idEstadoCredito = request('id_estado_credito', null);
        $fechaLimiteCredito = request('fecha_limite_credito', null);
        
        try {
            $reqVentaStore = $this->clientApi->post($this->baseUri.'venta_store', [
                'json' => [
                    'id_empresa' => $idEmpresa,
                    'id_tipo_cliente' => $idTipoCliente,
                    'fecha_venta' => $fechaVenta,
                    'descuento' => $descuento,
                    'subtotal_venta' => $subtotalVenta,
                    'total_venta' => $totalVenta,
                    'id_tipo_pago' => $idTipoPago,
                    'id_producto' => $idProducto,
                    'id_cliente' => $idCliente,
                    'id_usuario' => $usuLogueado,
                    'id_estado' => $idEstado,
                    'id_estado_credito' => $idEstadoCredito,
                    'fecha_limite_credito' => $fechaLimiteCredito
                ]
            ]);
            $resVentaStore = json_decode($reqVentaStore->getBody()->getContents());

            if(isset($resVentaStore) && !empty($resVentaStore) && !is_null($resVentaStore)) {
                alert()->success('Proceso Exitoso', 'Venta creada satisfactoriamente');
                return redirect()->to(route('ventas.index'));
            }
        } catch (Exception $e) {
            alert()->error('Error', 'Creando la venta, contacte a Soporte.');
            return back();
        }
    }
}
