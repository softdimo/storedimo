<?php

namespace App\Http\Responsable\entradas;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdf\FPDF;

class ReporteComprasPdf implements Responsable
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
        $fechaInicial = request('fecha_inicial', null);
        $fechaFinal = request('fecha_final', null);

        // Consulta a la BD
        $datosCompras = $this->reporteComprasPdf($fechaInicial,$fechaFinal);

        // Extraer compras y total
        $compras = $datosCompras->compras;
        $total = $datosCompras->total;

        $pdf = new \FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);

        // Título
        $pdf->Cell(190, 10, "INFORME DE COMPRAS", 0, 1, 'C');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(190, 10, "Desde: $fechaInicial hasta $fechaFinal", 0, 1, 'C');
        $pdf->Ln(5);
  
        // Encabezado de tabla
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(30, 10, "Codigo", 1);
        $pdf->Cell(50, 10, "Fecha Compra", 1);
        $pdf->Cell(50, 10, "Valor Total Compra", 1);
        $pdf->Cell(60, 10, "Proveedor", 1);
        $pdf->Ln();

        // Datos de compras
        $pdf->SetFont('Arial', '', 10);
        foreach ($compras as $compra) {
            $pdf->Cell(30, 10, $compra->id_compra, 1);
            $pdf->Cell(50, 10, $compra->fecha_compra, 1);
            $pdf->Cell(50, 10, "$ " . number_format($compra->valor_compra, 2), 1);
            $pdf->Cell(60, 10, $compra->nombre_proveedor, 1);
            $pdf->Ln();
        }

        // Total de entradas
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(190, 10, "Total Entradas: $ " . number_format($total, 2), 0, 1, 'C');

        // Salida del PDF
        $pdf->Output();
        exit;
    }

    // ===================================================================
    // ===================================================================

    public function reporteComprasPdf($fechaInicial,$fechaFinal)
    {
        try {
            $peticionReporteComprasPdf = $this->clientApi->post($this->baseUri.'reporte_compras_pdf', [
                'json' => [
                    'fecha_inicial' => $fechaInicial,
                    'fecha_final' => $fechaFinal,
                ]
            ]);
            return json_decode($peticionReporteComprasPdf->getBody()->getContents());
        } catch (Exception $e) {
            alert()->error('Error', 'Exception reporteComprasPdf, contacte a Soporte.');
            return back();
        }
    }
}
