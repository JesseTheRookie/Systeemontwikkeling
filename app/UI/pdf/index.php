<?php
define('FPDF_FONTPATH','file:///Applications/XAMPP/xamppfiles/htdocs/Systeemontwikkeling/app/UI/pdf/font/');
require('fpdf.php');

foreach ($data['orders'] as $order) {
    $totalPrice = $order->getPrice() * $order->getQuantity();

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->Image('http://localhost/Systeemontwikkeling/img/logo.png', 10, 10, -400);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(56,50, 'Thank you, ' . $order->getUserName());
    $pdf->Ln();
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0,-40, 'You ordered the following product(s): ');
    $pdf->Ln();

    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(100,80, 'Customer information ');
    $pdf->Ln();

    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(20,-60, 'Name: ' . $order->getUserName() . " " . $order->getUserLastName());
    $pdf->Ln();
    $pdf->Cell(20, 73, 'Address: ' . $order->getPhone());
    $pdf->Ln();
    $pdf->Cell(20,-60, 'E-mail: ' . $order->getEmail());
    $pdf->Ln();
    $pdf->Cell(20, 73, 'Phone: ' . $order->getPhone());
    $pdf->Ln();

    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(120,10, 'Ticket information');
    $pdf->Ln();
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(120,10, 'Ticket type', 1, 0, 'L');
    $pdf->Cell(30,10, 'Quantity', 1, 0, 'C');
    $pdf->Cell(20,10, 'Price', 1, 0, 'C');
    $pdf->Cell(20,10, 'Total', 1, 0, 'C');
    $pdf->Ln();

    $pdf->SetFont('Arial', 'I', 12);
    $pdf->Cell(120,10, '' . $order->getDate() . '');
    $pdf->Cell(30,10, '' . $order->getQuantity() . '');
    $pdf->Cell(20,10, '' . $order->getPrice() . '');
    $pdf->Cell(20,10, '' . $totalPrice . '');
    $pdf->Ln();

    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(120, 10, '');
    $pdf->Ln();
    $pdf->Cell(120, 10, 'You have already payed with iDeal');
    $pdf->Ln();
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(120,10, '', 1, 0, 'C');
    $pdf->Cell(30,10, 'Quantity', 1, 0, 'C');
    $pdf->Cell(20,10, 'Tax 21%', 1, 0, 'C');
    $pdf->Cell(20,10, 'Sub Total', 1, 0, 'C');
    $pdf->Ln();

    $pdf->SetFont('Arial', 'I', 12);
    $pdf->Cell(120,10, '' . '' . '');
    $pdf->Cell(30,10, '' . $totalPrice);
    $pdf->Cell(20,10, '' . $subTotal = ($totalPrice * .21));
    $pdf->Cell(20,10, '' . $totalPrice + $subTotal . '');
    $pdf->Ln();

    $pdf->Ln();
    $pdf->Cell(120,70, 'Kinds regards, Haarlem Festival', 0, 1, 'L');

    $pdf->Output();

}
?>
