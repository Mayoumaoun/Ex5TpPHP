<?php
include("../classes/student.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_POST["id"];
  $name = $_POST["name"];
  $birthday = $_POST["birthday"];
  $section_id = $_POST["section"];
  $stud = new Student();
  $student = $stud->findById($id);
  if (!$student) {
    die("Etudiant n'existe pas");}
    $imageName = $student->image;
  if (isset($_FILES["image"]) && $_FILES["image"]["error"] === 0) {
      $dir = "../uploads/";
      $ext = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
      $imageName = uniqid() . "." . $ext;
      $destination = $dir . $imageName;
  
      move_uploaded_file($_FILES["image"]["tmp_name"], $destination);
  }
  
    $data = [
      "name" => $name,
      "birthday" => $birthday,
      "section" => $section_id,
      "image" => $imageName
  ];
  $stud->update($id, $data);
  header("Location: ../students.php");
    exit();
} else {
    echo "Methode non autorisee.";
}
?>