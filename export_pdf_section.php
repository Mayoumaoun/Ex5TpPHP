<?php
require_once('vendor/autoload.php'); 
include("classes/section.php");

$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('OumaimaSamiraAlla');
$pdf->SetTitle('List of Sections');
$pdf->SetSubject('Section List');
$pdf->AddPage();

$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 10, 'List of Sections', 0, 1, 'C');
$pdf->SetFont('helvetica', '', 12);
$html = "<table border='1' cellpadding='5'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Designation</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>";
$sec=new Section();
$listesection=$sec->findAll();
foreach($listesection as $sec) {
    $html .= "<tr>";
    $html .= "<td>" . $sec->id . "</td>";
    $html .= "<td>" . $sec->designation . "</td>";
    $html .= "<td>" . $sec->description. "</td>";
    $html .= "</tr>";
}

$html .= "</tbody></table>";

// Convertir le HTML en PDF
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->Output('sections_list.pdf', 'D');  // 'D' = download
?>