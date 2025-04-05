<?php

ob_start(); 

include("classes/student.php");
include("header.php");
$std = new Student();
$role = $_SESSION["user"]["role"];

if (isset($_GET['ajax'])) {
    header('Content-Type: application/json');

    $students = $std->findAll();
    
    if (!$students) {
        echo json_encode(["error" => "No students found."]);
        exit();
    }

    foreach ($students as &$student) {
        $id = $student->id ?? '';

        $actions = "<a href='utils/read.php?id={$id}&type=student'>Read</a> ";
        if ($role === "admin") {
            $actions .= "<a href='utils/delete.php?id={$id}&type=student'>Del</a> ";
            $actions .= "<a href='utils/edit.php?id={$id}&type=student'>Edit</a>";
        }
        $student->actions = $actions; 
    }

    ob_end_clean(); 
    echo json_encode(array_values($students), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit();
}
?>


<div>
    <p>Liste des étudiants</p>

    <?php if ($role == "admin") { ?>
        <div class='c1'>
            <div class='filter'>
                <input type='text' name='textFilter' id='textFilter'>
                <button>Filtrer</button>
            </div>
            <button><a href='<?php echo "utils/add.php"; ?>'>Add</a></button>
        </div>
    <?php } ?>

    <div class="export"></div>

    <table id="studentsTable" class="display">
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

<?php include("footer.php"); ?>


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