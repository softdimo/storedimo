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
        $cantidadBarcode = request('cantidad_barcode', 24);

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
            shell_exec("$wkhtmltoimagePath --width 290 --height 290 \"$rutaCodebarHtml\" \"$rutaCodebarImage\" 2>&1");

            // Verificar si la imagen se generó correctamente
            if (!file_exists($rutaCodebarImage)) {
                alert()->error('Error', 'No se pudo generar la imagen del código QR.');
                return redirect()->to(route('productos.index'));
            }

            // Crear el PDF con los códigos QR
            $pdf = new \FPDF();
            $pdf->SetAutoPageBreak(false); // Evita saltos automáticos de página
            $pdf->AddPage(); // Se agrega la primera página inicialmente

            $columnas = 4; // Número de columnas por fila
            $espaciadoX = 50; // Espaciado entre columnas
            $espaciadoY = 45; // Espaciado entre filas
            $xInicial = 10; // Posición inicial en X
            $yInicial = 10; // Posición inicial en Y

            for ($i = 0; $i < $cantidadBarcode; $i++) {
                // Calcular posición del QR en la página
                $x = $xInicial + ($i % $columnas) * $espaciadoX;
                $y = $yInicial + (floor(($i % 24) / $columnas) * $espaciadoY); // Reinicia Y cada 24 códigos
            
                $pdf->Image($rutaCodebarImage, $x, $y, 40, 40);
            
                // Si se completan 24 códigos, agregar una nueva página
                if (($i + 1) % 24 == 0 && ($i + 1) < $cantidadBarcode) {
                    $pdf->AddPage();
                }
            }

            // Guardar el PDF
            $pdf->Output($rutaCodebarPdf, 'F');

            $pdfUrl = route('ver.pdf', ['archivo' => "{$nombreArchivoCodebar}.pdf"]);
            return redirect()->to(route('productos.index'))->with('pdfUrl', $pdfUrl);

        } catch (Exception $e) {
            dd($e);
            alert()->error('Error', 'Error al generar el código QR.');
            return redirect()->to(route('productos.index'));
        }
    }
}
