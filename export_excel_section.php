<?php
require 'vendor/autoload.php';
include("classes/section.php");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', 'Designation');
$sheet->setCellValue('C1', 'Description');

$sec = new Section();
$listesection = $sec->findAll();
$row = 2;
foreach ($listesection as $sec) {
    $sheet->setCellValue('A' . $row, $sec->id);
    $sheet->setCellValue('B' . $row, $sec->designation);
    $sheet->setCellValue('C' . $row, $sec->description);
    $row++;
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="sections.xlsx"');

$writer = new Xlsx($spreadsheet);
$writer->save("php://output");
?>
