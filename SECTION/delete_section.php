<?php
include("../classes/section.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sect = new Section();
    $sect->delete($id);
}
header("Location: ../sections.php");
exit();