<?php
define('FPDF_FONTPATH',
       'file:///Applications/XAMPP/xamppfiles/htdocs/Systeemontwikkeling/app/UI/pdf/font/');
require 'fpdfBarCode.php';

foreach ($data['orders'] as $order) {

    $pdf = new PDF_BARCODE('P','mm','A4');
    $pdf->AddPage();
    $pdf->EAN13(155,10,'01234501', 6, 0.45, 9);
    $pdf->SetFont('Arial', 'B', 18);
    $pdf->Ln();
    $pdf->Image('http://localhost/Systeemontwikkeling/img/logo.png', 10, 10, -500);
    $pdf->Cell(100,80, 'Here is your ticket, ' . $order->getUserName());
    $pdf->Ln();
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Ln();
    $pdf->Cell(100,-170, 'Ticket type: ');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Ln();
    $pdf->Cell(100,190, '' . $order->getDate());
    $pdf->Ln();
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(100,-170, 'Date: ');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Ln();
    $pdf->Cell(100,190, '' . $order->getDate());
    $pdf->Ln();
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(100,-170, 'Name: ');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Ln();
    $pdf->Cell(100,190, '' . $order->getUserName() . ' ' . $order->getUserLastName());
    $pdf->Ln();
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(100,-170, 'Price: ');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Ln();
    $pdf->Cell(100,190, '' . $order->getPrice());
    $pdf->Output();
}
