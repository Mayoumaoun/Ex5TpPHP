<?php
include("../classes/student.php");
include("../classes/section.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $user=new Student();
    $user->delete($id);
    
}
header("Location: ../students.php");
exit();
    