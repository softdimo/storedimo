<?php

namespace App\Http\Responsable\ventas;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdf\FPDF;

class ReporteVentasPdf implements Responsable
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
        $datosVentas = $this->reporteVentasPdf($fechaInicial,$fechaFinal);

        // Extraer ventas y total
        $ventas = $datosVentas->ventas;
        $total = $datosVentas->total;

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
        // $pdf->Cell(60, 10, "Proveedor", 1);
        $pdf->Ln();

        // Datos de compras
        $pdf->SetFont('Arial', '', 10);
        foreach ($ventas as $venta) {
            $pdf->Cell(30, 10, $venta->id_venta, 1);
            $pdf->Cell(50, 10, $venta->fecha_venta, 1);
            $pdf->Cell(50, 10, "$ " . number_format($venta->valor_venta, 2), 1);
            // $pdf->Cell(60, 10, $venta->nombre_proveedor, 1);
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

    public function reporteVentasPdf($fechaInicial,$fechaFinal)
    {
        try {
            $peticionReporteVentasPdf = $this->clientApi->post($this->baseUri.'reporte_ventas_pdf', [
                'json' => [
                    'fecha_inicial' => $fechaInicial,
                    'fecha_final' => $fechaFinal,
                ]
            ]);
            return json_decode($peticionReporteVentasPdf->getBody()->getContents());
        } catch (Exception $e) {
            alert()->error('Error', 'Exception reporteVentasPdf, contacte a Soporte.');
            return back();
        }
    }
}
