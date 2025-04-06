<?php
include("../classes/section.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sect = new Section();
    $studentsSubscribed = $sect->countStudentsBySection($id);
    if ($studentsSubscribed> 0) {
        echo "Impossible de supprimer : des étudiants sont liés à cette section.";
        exit();
    }
    $sect->delete($id);
}
header("Location: ../sections.php");
exit();