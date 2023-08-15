<?php
require_once('../TCPDF-main/tcpdf.php');
include "../db_connection.php";




$datef = isset($_GET['datef']) ? $_GET['datef'] : '';
$datet = isset($_GET['datet']) ? $_GET['datet'] : '';
$cashier_id = isset($_GET['cashier_id']) ? $_GET['cashier_id'] : '';

// Create a connection
include "../db_connection.php";

// Fetch data from the "users" table
$query = "SELECT cashier.user_id, cashier.name, cashier.epos, money.* FROM `money` JOIN cashier on money.user_id = cashier.user_id WHERE
trans_date BETWEEN '$datef' AND '$datet' AND cashier.user_id = $cashier_id;";


// Initialize TCPDF
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');

// Add image and title


$pdf->SetCreator(PDF_CREATOR);
// $pdf->SetAuthor('Your Name');
// $pdf->SetTitle('PDF Report');
// $pdf->SetSubject('Transaction Report');
// $pdf->SetKeywords('PDF, TCPDF, example');

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);


// Extend TCPDF to override the Header() method

$pdf->AddPage();




// $imagePath = '../assets/img/guureTech.jpeg';
// $imageWidth = 30;
// $imageX = ($pdf->GetPageWidth() - $imageWidth) / 2;
// $imageY = 15; // Adjust the Y coordinate as needed

// $pdf->Image($imagePath, $imageX, $imageY, $imageWidth, 0, 'JPG');
// $pdf->SetFont('helvetica', 'B', 12);
// $pdf->SetXY(0, $imageY + $imageWidth + 3);

$pdf->Cell(0, 3, 'Tanaad Master Agent', 0, 1, 'C');


$pdf->Ln(5);
$result1 = $connection->query($query);
$row = $result1->fetch_assoc();
// $name = $row['name'];
// $epos = $row['epos'];
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 5, 'Date From : ' . $datef, 0, 1);
$pdf->Cell(0, 5, 'Date To   : ' . $datet, 0, 1);
// $pdf->Cell(0, 5, 'Cashier ID: ' . $cashier_id, 0, 1);
// $pdf->Cell(0, 5, 'EPOS PLACE CODE : ' . $epos, 0, 1);
// $pdf->Cell(0, 5, 'Cashier Name: ' . $name, 0, 1);

$pdf->Ln(2);
$pdf->Cell(0, 5, 'Transaction Report', 0, 1, 'C');
$pdf->Ln(1);
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(20, 5, 'EPOS', 1, 0, 'C');
$pdf->Cell(35, 5, 'Trans Date', 1, 0, 'C');
$pdf->Cell(45, 5, 'Cashier Name', 1, 0, 'C');
$pdf->Cell(30, 5, 'Deposit', 1, 0, 'C');
$pdf->Cell(30, 5, 'Withdraw', 1, 0, 'C');
$pdf->Cell(30, 5, 'Commission', 1, 1, 'C');

$pdf->SetFont('helvetica', '', 12);

$totalCommission = 0;
$totalDeposit =0;
$totalWithDraw =0;

$result = $connection->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $commission = ($row["deposit"] * 0.05) + ($row["withdraw"] * 0.02);
        $totalCommission += $commission;

        $percentage = 5; // The percentage to cut

$cutAmount = $totalCommission * ($percentage / 100);
$finalTotal = $totalCommission - $cutAmount;

$totalDeposit +=$row["deposit"];
$totalWithDraw  +=$row["withdraw"];
        $pdf->Cell(20, 5, $row["epos"], 1, 0, 'L');
        $pdf->Cell(35, 5, $row["trans_date"], 1, 0, 'C');
        $pdf->Cell(45, 5, $row["name"], 1, 0, 'L');
        $pdf->Cell(30, 5, "$". $row["deposit"], 1, 0, 'C');
        $pdf->Cell(30, 5, "$" .$row["withdraw"], 1, 0, 'C');
        $pdf->Cell(30, 5, "$" . $commission, 1, 1, 'C');
    }
} else {
    $pdf->Cell(210, 10, 'No results found.', 1, 1, 'C');
}

$pdf->SetFont('TIMES', 'B', 12);
$pdf->Cell(20, 5, "", 'T', 0, 'L');
$pdf->Cell(35, 5, "", 'T', 0, 'C');
$pdf->Cell(45, 5, "Wadarta", 1, 0, 'L');
$pdf->Cell(30, 5, "$" . $totalDeposit, 1, 0, 'C');
$pdf->Cell(30, 5, "$" . $totalWithDraw, 1, 0, 'C');
$pdf->Cell(30, 5, "$" . $totalCommission, 1, 1, 'C');

// $pdf->Ln(1);
$pdf->Cell(20, 5, "",  0, 0, 'C',);
$pdf->Cell(35, 5, "",  0, 0, 'C',);
$pdf->Cell(45, 5, "",  0, 0, 'C');
$pdf->Cell(30, 5, "" , "T", 0, 'C');
$pdf->Cell(30, 5, "Khidmad: %5" , 1, 0, 'C');
$pdf->Cell(30, 5, "$" . $cutAmount, 1, 1, 'C');

$pdf->Cell(20, 5, "",  0,0, 'C',);
$pdf->Cell(35, 5, "",  0, 0,'C',);
$pdf->Cell(45, 5, "",  0, 0,'C',);
$pdf->Cell(30, 5, "" ,  0, 0, 'C');

$pdf->Cell(30, 5, "Net:" , 1, 0, 'C');
$pdf->Cell(30, 5, "$" .$totalCommission- $cutAmount, 1, 1, 'C');

$pdf->Output($name .' pdf_report.pdf', 'D');