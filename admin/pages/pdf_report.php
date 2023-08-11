<?php
require_once('../TCPDF-main/tcpdf.php');
include "../db_connection.php";




$datef = isset($_GET['datef']) ? $_GET['datef'] : '';
$datet = isset($_GET['datet']) ? $_GET['datet'] : '';
$cashier_id = isset($_GET['cashier_id']) ? $_GET['cashier_id'] : '';

// Create a connection
include "../db_connection.php";

// Fetch data from the "users" table
$query = "SELECT cashier.user_id, cashier.name, money.* FROM `money` JOIN cashier on money.user_id = cashier.user_id WHERE
trans_date BETWEEN '$datef' AND '$datet' AND cashier.user_id = $cashier_id;";
$result = $connection->query($query);

// Initialize TCPDF
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');

// Add image and title


$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('PDF Report');
$pdf->SetSubject('Transaction Report');
$pdf->SetKeywords('PDF, TCPDF, example');

// $pdf->setPrintHeader(true);
// $pdf->setPrintFooter(false);


// Extend TCPDF to override the Header() method
class CustomTCPDF extends TCPDF {
    public function Header() {
        $headerText = 'Header Text';
        $this->SetFont('helvetica', 'B', 12);
        $this->Cell(0, 20, $headerText, 0, true, 'C', 0, '', 0, false, 'M', 'M');
    }
}

// Create new PDF object
$pdf = new CustomTCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

$pdf->AddPage();




$imagePath = '../assets/img/guuresoft.jpg';
$imageWidth = 20;
$imageX = ($pdf->GetPageWidth() - $imageWidth) / 2;
$imageY = 15; // Adjust the Y coordinate as needed

$pdf->Image($imagePath, $imageX, $imageY, $imageWidth, 0, 'JPG');
$pdf->SetFont('helvetica', 'B', 16);
$pdf->SetXY(0, $imageY + $imageWidth + 10);

$pdf->Cell(0, 5, 'Tanaad Master Agent', 0, 1, 'C');


$pdf->Ln(5);
$row = $result->fetch_assoc();
$name = $row['name'];
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 5, 'Date From : ' . $datef, 0, 1);
$pdf->Cell(0, 5, 'Date To   : ' . $datet, 0, 1);
$pdf->Cell(0, 5, 'Cashier ID: ' . $cashier_id, 0, 1);
$pdf->Cell(0, 5, 'Cashier Name: ' . $name, 0, 1);

$pdf->Ln(7);
$pdf->Cell(0, 5, 'Transaction Report', 0, 1, 'C');
$pdf->Ln(1);
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(20, 10, 'Trans Id', 1, 0, 'C');
$pdf->Cell(35, 10, 'Trans Date', 1, 0, 'C');
$pdf->Cell(45, 10, 'Cashier Name', 1, 0, 'C');
$pdf->Cell(30, 10, 'Deposit', 1, 0, 'C');
$pdf->Cell(30, 10, 'Withdraw', 1, 0, 'C');
$pdf->Cell(30, 10, 'Commission', 1, 1, 'C');

$pdf->SetFont('helvetica', '', 12);

$totalCommission = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $commission = ($row["deposit"] * 0.05) + ($row["withdraw"] * 0.02);
        $totalCommission += $commission;

        $pdf->Cell(20, 10, $row["trans_id"], 1, 0, 'L');
        $pdf->Cell(35, 10, $row["trans_date"], 1, 0, 'C');
        $pdf->Cell(45, 10, $row["name"], 1, 0, 'L');
        $pdf->Cell(30, 10, "$". $row["deposit"], 1, 0, 'C');
        $pdf->Cell(30, 10, $row["withdraw"], 1, 0, 'C');
        $pdf->Cell(30, 10, "$" . $commission, 1, 1, 'C');
    }
} else {
    $pdf->Cell(210, 10, 'No results found.', 1, 1, 'C');
}

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(160, 10, 'Total', 1, 0, 'R');
$pdf->Cell(30, 10, "$" . $totalCommission, 1, 1, 'C');

$pdf->Output($name .' pdf_report.pdf', 'D');