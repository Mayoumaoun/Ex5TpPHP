<?php
require_once("classes/student.php");

$std = new Student();
$students = $std->findAll();
$content = "ID\tName\tBirthday\tSection\n";
foreach ($students as $student) {
    $content .= $student->id . "\t" . $student->name . "\t" . $student->birthday . "\t" . $student->designation . "\n";}
header('Content-Type: text/plain');
header('Content-Disposition: attachment; filename="students_list.txt"');
echo $content;
exit;
?>
