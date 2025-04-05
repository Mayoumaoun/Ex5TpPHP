
<?php
ob_start(); 
include("classes/section.php");
$sect=new Section();
include("header.php");
if (isset($_GET['ajax'])) {
    header('Content-Type: application/json');

    $listeSections=$sect->findAll();
    
    if (!$listeSections) {
        echo json_encode(["error" => "No sections found"]);
        exit();
    }

    foreach ($listeSections as &$section) {
        $id = $section->id;

        $actions = "<a href='utils/liste.php?id={$id}&type=student'><i class='bi bi-list'></i></a> ";
        
        $section->actions = $actions; 
    }

    ob_end_clean(); 
    echo json_encode(array_values($listeSections), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit();
}
?>
        <br>
        <div class=" alert alert-light" role="alert"> List of students</div>
        <div class="container">
        
        <div class="export">
            <button onclick="window.location.href='export_csv_section.php'">Export CSV</button>
            <button onclick="window.location.href='export_excel_section.php'">Export Excel</button>
            <button onclick="window.location.href='export_pdf_section.php'">Export PDF</button>
            </div>
            <br>
        
        <table id="sectionsTable" class="display">
        <thead>
            <tr>
                <th>Id</th>
                <th>Designation</th>
                <th>Description</th>
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
    $('#sectionsTable').DataTable({
        "ajax": {
            "url": "sections.php?ajax=1",
            "dataSrc": ""
        },
        "columns": [
            { "data": "id" },
            { "data": "designation"},
            { "data": "description" },
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