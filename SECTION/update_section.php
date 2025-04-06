<?php
include("../classes/section.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $designation = $_POST["designation"];
    $description = $_POST["description"];

    $sect = new Section();
    $section = $sect->findById($id);

    if (!$section) {
        die("Section n'existe pas.");
    }

    $data = [
        "designation" => $designation,
        "description" => $description
    ];

    $sect->update($id, $data);
    header("Location: ../sections.php");
    exit();
} else {
    echo "Méthode non autorisée.";
}
?>
