<?php

/*
require('fpdf/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Hello World!');
$pdf->Output();
 */

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf( ['tempDir' => '/tmp']);
$mpdf->WriteHTML('<h1>Hello world!</h1>');
$mpdf->Output();
