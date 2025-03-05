<?php

namespace App\Http\Responsable\productos;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use Milon\Barcode\DNS2D;
use setasign\Fpdf\FPDF;

class ProductoGenerarBarCode implements Responsable
{
    public function toResponse($request)
    {
        $idProducto = request('id_producto_input', null);
        $nombreProducto = request('nombre_producto_input', null);
        $cantidadBarcode = request('cantidad_barcode', null);

        $rutaTempArchivoCodebar = "public/upfiles/productos/barcodes";
        $nombreArchivoCodebar = "{$idProducto}_{$nombreProducto}";
        $rutaCodebarHtml = storage_path("app/{$rutaTempArchivoCodebar}/{$nombreArchivoCodebar}.html");
        $rutaCodebarImage = storage_path("app/{$rutaTempArchivoCodebar}/{$nombreArchivoCodebar}.png");
        $rutaCodebarPdf = storage_path("app/{$rutaTempArchivoCodebar}/{$nombreArchivoCodebar}.pdf");

        try {
            // Generar el HTML con el código QR
            $ejemploJson = json_encode(['nombre' => $nombreProducto, 'codigo' => $idProducto], JSON_UNESCAPED_UNICODE);
            $d = new DNS2D();
            Storage::put("{$rutaTempArchivoCodebar}/{$nombreArchivoCodebar}.html", $d->getBarcodeHTML($ejemploJson, 'QRCODE'));

            // Verificar si el archivo HTML existe
            if (!file_exists($rutaCodebarHtml)) {
                alert()->error('Error', 'No se pudo generar el archivo HTML del código QR.');
                return redirect()->to(route('productos.index'));
            }

            // Convertir el HTML a imagen con `wkhtmltoimage`
            $wkhtmltoimagePath = 'wkhtmltoimage'; // Ahora usa la versión de Linux dentro de Docker
            $comando = "$wkhtmltoimagePath --width 290 --height 290 \"$rutaCodebarHtml\" \"$rutaCodebarImage\" 2>&1";
            $output = shell_exec($comando); // se usa en línea 47 para validar si genera la imagen QR

            // Verificar si la imagen se generó correctamente
            if (!file_exists($rutaCodebarImage)) {
                alert()->error('Error', 'No se pudo generar la imagen del código QR.');
                return redirect()->to(route('productos.index'));
                // dd("Error al ejecutar wkhtmltoimage:", $output, "Comando ejecutado:", $comando);
            }

            // Crear el PDF con los códigos QR
            $pdf = new \FPDF();
            $pdf->AddPage();
            $columnas = 4; // Número de columnas por fila
            $espaciadoX = 50; // Espaciado entre columnas
            $espaciadoY = 45; // Espaciado entre filas
            $xInicial = 10; // Posición inicial en X
            $yInicial = 10; // Posición inicial en Y

            for ($i = 0; $i < $cantidadBarcode; $i++) {
                $x = $xInicial + ($i % $columnas) * $espaciadoX;
                $y = $yInicial + (floor($i / $columnas) * $espaciadoY);
                $pdf->Image($rutaCodebarImage, $x, $y, 40, 40);

                if ($i % $columnas == ($columnas - 1)) {
                    $pdf->Ln($espaciadoY); // Salto de línea cada dos imágenes
                }
            }

            // Guardar el PDF
            $pdf->Output($rutaCodebarPdf, 'F');

            alert()->success('Éxito', 'PDF generado correctamente.');
            return redirect()->to(route('productos.index'));

        } catch (Exception $e) {
            dd($e);
            alert()->error('Error', 'Error al generar el código QR.');
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
