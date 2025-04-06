<?php

namespace App\Http\Responsable\productos;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use Milon\Barcode\DNS2D;
use setasign\Fpdf\FPDF;
use Illuminate\Support\Str;

class ProductoGenerarBarCode implements Responsable
{
    public function toResponse($request)
    {
        $idProducto = request('id_producto_input', null);
        $nombreProducto = request('nombre_producto_input', null);
        $cantidadBarcode = request('cantidad_barcode', 15);

        $rutaTempArchivoCodebar = "public/upfiles/productos/barcodes";
        $slugNombreProducto = Str::slug($nombreProducto); // Para evitar espacios en el nombre del archivo
        $nombreArchivoCodebar = "{$idProducto}_{$slugNombreProducto}";
        $rutaCodebarImage = storage_path("app/{$rutaTempArchivoCodebar}/{$nombreArchivoCodebar}.png");
        $rutaCodebarPdf = storage_path("app/{$rutaTempArchivoCodebar}/{$nombreArchivoCodebar}.pdf");

        try {
            // Consultar Producto para infoQr
            $infoProducto = $this->consultarProducto($idProducto);

            // Generar los datos para el código QR
            $infoQr = json_encode([
                'codigo' => $idProducto,
                'nombre' => $nombreProducto,
                'precio' => $infoProducto->precio_unitario,
                'cat' => $infoProducto->categoria
            ], JSON_UNESCAPED_UNICODE);

            // Generar la imagen del código QR en base64
            $barcode = new DNS2D();
            $barcodeImageBase64 = $barcode->getBarcodePNG($infoQr, 'QRCODE', 10, 10);

            // Decodificar y guardar el PNG como archivo físico
            Storage::put("{$rutaTempArchivoCodebar}/{$nombreArchivoCodebar}.png", base64_decode($barcodeImageBase64));

            // Verificar que la imagen fue guardada correctamente
            if (!file_exists($rutaCodebarImage)) {
                alert()->error('Error', 'No se pudo generar la imagen del código QR.');
                return redirect()->to(route('productos.index'));
            }

            // Crear el PDF con los códigos QR
            $pdf = new \FPDF();
            $pdf->SetAutoPageBreak(false);
            $pdf->AddPage();

            $columnas = 3;
            $espaciadoX = 70;
            $espaciadoY = 55;
            $xInicial = 10;
            $yInicial = 10;

            for ($i = 0; $i < $cantidadBarcode; $i++) {
                $x = $xInicial + ($i % $columnas) * $espaciadoX;
                $y = $yInicial + (floor(($i % 15) / $columnas) * $espaciadoY);

                $pdf->Image($rutaCodebarImage, $x, $y, 60, 60);

                if (($i + 1) % 15 == 0 && ($i + 1) < $cantidadBarcode) {
                    $pdf->AddPage();
                }
            }

            // Guardar el PDF final
            $pdf->Output($rutaCodebarPdf, 'F');

            // Redireccionar con la URL para ver el PDF
            $pdfUrl = route('ver.pdf', ['archivo' => "{$nombreArchivoCodebar}.pdf"]);
            return redirect()->to(route('productos.index'))->with('pdfUrl', $pdfUrl);

        } catch (Exception $e) {
            dd($e);
            alert()->error('Error', 'Error al generar el código QR.');
            return redirect()->to(route('productos.index'));
        }
    }

    public function consultarProducto($idProducto)
    {
        try {
            $baseUri = env('BASE_URI');
            $clientApi = new Client(['base_uri' => $baseUri]);

            $peticion = $clientApi->post($baseUri . 'query_producto/' . $idProducto);
            return json_decode($peticion->getBody()->getContents());

        } catch (Exception $e) {
            alert()->error('Error', 'Consultando el producto, contacte a Soporte.');
            return back();
        }
    }
}
