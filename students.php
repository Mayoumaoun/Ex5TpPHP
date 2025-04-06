<?php
ob_start(); 
include("classes/student.php");
$std=new Student();
include("header.php");
$role=$_SESSION["user"]["role"];
if (isset($_GET['ajax'])) {
    header('Content-Type: application/json');

    $students = $std->findAll();
    
    if (!$students) {
        echo json_encode(["error" => "No students found."]);
        exit();
    }
    
    foreach ($students as &$student) {
        $id = $student->id ?? '';
        $student->image = "uploads/" . $student->image;

        $actions = "<a href='SECTION/read.php?id={$id}&type=student'><i class='bi bi-info-circle-fill'></i></a> ";
        if ($role === "admin") {
            $actions .= "<a href='utils/delete.php?id={$id}&type=student' onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?');\"><i class='bi bi-eraser-fill'></i></a> ";
            $actions .= "<a href='utils/edit.php?id={$id}&type=student'><i class='bi bi-pencil-square'></i></a>";
        }
        $student->actions = $actions; 
    }

    ob_end_clean(); 
    echo json_encode(array_values($students), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit();
}
?>
<br>
<div class=" alert alert-light" role="alert"> List of students</div>
    <div class="container">
      

        
        <?php
        if($role== "admin"){
                        echo "<div class='filter'>
                            <input type='text' name='textFilter' id='textFilter'>
                            <button>Filtrer</button>
                            <a href='utils/add.php'><i class='bi bi-person-add'></i></a>
                        </div>";
                    }
        ?>
        <br>
        <div class="export">
        <button onclick="window.location.href='export_copy.php'">Copy</button>
            <button onclick="window.location.href='export_csv.php'">Export CSV</button>
            <button onclick="window.location.href='export_excel.php'">Export Excel</button>
            <button onclick="window.location.href='export_pdf.php'">Export PDF</button>
        </div>
        <br>

        <table id="studentsTable" class="display table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Image</th>
                <th>Name</th>
                <th>Birthday</th>
                <th>Section</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody> 
    </table>
    </div>
<?php

include("footer.php");
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<script>
$(document).ready(function() {
    $('#studentsTable').DataTable({
        "ajax": {
            "url": "students.php?ajax=1",
            "dataSrc": ""
        },
        "columns": [
            { "data": "id" },
            { 
                "data": "image",
                "render": function(data) {
                    return `<img src="${data}" width="50" height="50">`;
                }
            },
            { "data": "name" },
            { "data": "birthday" },
            { "data": "designation" },
            { 
                "data": "actions",
                "orderable": false,
                "searchable": false,
                "defaultContent": "" 
            }
        ]
    });
});
</script>