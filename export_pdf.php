<?php
require_once('vendor/autoload.php'); 
include("classes/student.php");

$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('OumaimaSamiraAlla');
$pdf->SetTitle('List of Students');
$pdf->SetSubject('Student List');
$pdf->AddPage();

$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 10, 'List of Students', 0, 1, 'C');
$pdf->SetFont('helvetica', '', 12);
$html = "<table border='1' cellpadding='5'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Birthday</th>
                    <th>Section</th>
                </tr>
            </thead>
            <tbody>";
$std=new Student();
$listeStudents=$std->findAll();
foreach($listeStudents as $stud) {
    $html .= "<tr>";
    $html .= "<td>" . $stud->id . "</td>";
    $html .= "<td><img src='" . $stud->image . "' alt='profile' height='50' width='50'></td>";
    $html .= "<td>" . $stud->name . "</td>";
    $html .= "<td>" . $stud->birthday . "</td>";
    $html .= "<td>" . $stud->designation . "</td>";
    $html .= "</tr>";
}

$html .= "</tbody></table>";

// Convertir le HTML en PDF
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->Output('students_list.pdf', 'D');  // 'D' = download
?>
