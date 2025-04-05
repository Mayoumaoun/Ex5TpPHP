<?php
require 'vendor/autoload.php';
include("classes/student.php");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', 'Image');
$sheet->setCellValue('C1', 'Name');
$sheet->setCellValue('D1', 'Birthday');
$sheet->setCellValue('E1', 'Section');

$std = new Student();
$listeStudents = $std->findAll();
$row = 2;

foreach ($listeStudents as $stud) {
    $sheet->setCellValue('A' . $row, $stud->id);
    $sheet->setCellValue('B' . $row, $stud->image);
    $sheet->setCellValue('C' . $row, $stud->name);
    $sheet->setCellValue('D' . $row, $stud->birthday);
    $sheet->setCellValue('E' . $row, $stud->designation);
    $row++;
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="students.xlsx"');

$writer = new Xlsx($spreadsheet);
$writer->save("php://output");
?>
