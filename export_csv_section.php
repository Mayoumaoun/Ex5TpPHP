<?php
include("classes/section.php");

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=sections.csv');

$output = fopen("php://output", "w");
fputcsv($output, array('ID', 'Designation', 'Description'));

$sec = new Section();
$listesection = $sec->findAll();

foreach ($listesection as $sec) {
    fputcsv($output, array($sec->id, $sec->designation, $sec->description));
}

fclose($output);
?>
