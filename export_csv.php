<?php
include("classes/student.php");

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=students.csv');

$output = fopen("php://output", "w");
fputcsv($output, array('ID', 'Image', 'Name', 'Birthday', 'Section'));

$std = new Student();
$listeStudents = $std->findAll();

foreach ($listeStudents as $stud) {
    fputcsv($output, array($stud->id, $stud->image, $stud->name, $stud->birthday, $stud->designation));
}

fclose($output);
?>
