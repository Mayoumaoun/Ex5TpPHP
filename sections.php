
<?php
ob_start(); 
include("classes/section.php");
$sect=new Section();
include("header.php");
if (isset($_GET['ajax'])|| isset($_POST['ajax'])) {
    header('Content-Type: application/json');

    $listeSections=$sect->findAll();
    
    if (!$listeSections) {
        echo json_encode(["error" => "No sections found"]);
        exit();
    }
    $filter = $_POST['filter'] ?? '';

    if (!empty($filter)) {
        $filter = strtolower($filter); 

        $listeSections = array_filter($listeSections, function($section) use ($filter) {
            return (
                stripos($section->id, $filter) !== false ||
                stripos($section->designation, $filter) !== false ||
                stripos($section->description, $filter) !== false
            );
        });
    }
    foreach ($listeSections as &$section) {
        $id = $section->id;

        $actions = "<a href='SECTION/liste.php?id={$id}&type=student'><i class='bi bi-list'></i></a> ";
        if ($_SESSION["user"]["role"] === "admin") {
            $actions .= "<a href='SECTION/edit_section.php?id={$id}'><i class='bi bi-pencil-square'></i></a> ";
            $actions .= "<a href='SECTION/delete_section.php?id={$id}' onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer cette section ? ');\"><i class='bi bi-trash-fill'></i></a>";
        }
        $section->actions = $actions; 
    }

    ob_end_clean(); 
    echo json_encode(array_values($listeSections), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit();
}
?>
           <br>
<div class="alert alert-light" role="alert">List of sections</div>
<div class="container">

    <div class="d-flex flex-column gap-3 mb-4">
        <?php
        $role = $_SESSION["user"]["role"];
        if ($role === "admin") {
            echo "<div class='filter'>
                            <input type='text' name='textFilter' id='textFilter'>
                            <button>Filtrer</button>
                            <a href='SECTION/add_section.php'><i class='bi bi-folder-plus'></i></a>
                        </div><br>";
        }
        ?>

        <div class="export d-flex flex-wrap gap-2">
            <button onclick="window.location.href='export_copy_section.php'" class="btn btn-outline-dark">Copy</button>
            <button onclick="window.location.href='export_csv_section.php'" class="btn btn-outline-dark">Export CSV</button>
            <button onclick="window.location.href='export_excel_section.php'" class="btn btn-outline-dark">Export Excel</button>
            <button onclick="window.location.href='export_pdf_section.php'" class="btn btn-outline-dark">Export PDF</button>
        </div>
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
    const table =$('#sectionsTable').DataTable({
        "ajax": {
            "url": "sections.php?ajax=1",
            "type": 'POST', 
            "data": function(d) {
                d.filter = $('#textFilter').val(); 
            },
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
    $('.filter button').on('click', function() {
        table.ajax.reload(); 
    });
});
</script>