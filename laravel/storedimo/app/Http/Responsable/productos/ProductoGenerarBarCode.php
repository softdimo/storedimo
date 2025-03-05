<?php

namespace App\Http\Responsable\productos;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
// use DNS1D;
// use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;

class ProductoGenerarBarCode implements Responsable
{
    public function toResponse($request)
    {
        $idProducto = request('id_producto_input', null);
        $nombreProducto = request('nombre_producto_input', null);
        $cantidadBarcode = request('cantidad_barcode', null);

        // dd($request,$idProducto,$nombreProducto,$cantidadBarcode);

        $rutaTempArchivoCodebar = "public/upfiles/productos/barcodes";
        $nombreArchivoCodebar = $idProducto .'_'. $nombreProducto;
        $rutaCodebar = $rutaTempArchivoCodebar.'/'.$nombreArchivoCodebar.'.html';

        try {
            $ejemploJson = "{'nombre': $nombreProducto, 'codigo':$idProducto}";
            $json = json_encode($ejemploJson, true);
            $d = new DNS2D();
            Storage::put($rutaCodebar, ($d->getBarcodeHTML($json, 'QRCODE')));
            
            alert()->info('Info', 'Código de barras creado.');
            return redirect()->to(route('productos.index'));

        } catch (Exception $e) {
            dd($e);
            alert()->error('Error', 'Error al generar el código de barras.');
            return redirect()->to(route('productos.index'));
        }
    }
}

// use Milon\Barcode\DNS1D;

        // $idProducto = $this->idProducto;

        // try {
        //     // Realiza la solicitud POST a la API
        //     $clientApi = new Client([
        //         'base_uri' => 'http://localhost:8000/api/producto_query_barcode/'.$idProducto,
        //         'headers' => [
        //             'Accept' => 'application/json',
        //             'Content-Type' => 'application/json',
        //         ],
        //         'body' => json_encode([])
        //     ]);

        //     $response = $clientApi->request('POST');
        //     $res = $response->getBody()->getContents();
        //     $producto = json_decode($res, true);

        //     if(isset($producto) && !empty($producto))
        //     {
        //         return response()->json($producto);
        //     } else {
        //         alert()->error('Error', 'No existe el producto.');
        //         return redirect()->to(route('productos.index'));
        //     }
        // } // FIN Try
        // catch (Exception $e)
        // {
        //     alert()->error('Error', 'Error consulta producto, si el problema persiste, contacte a Soporte.');
        //     return back();
        // } // FIN Catch
