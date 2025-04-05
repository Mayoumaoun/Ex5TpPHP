<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<?php
include("classes/student.php");
$std=new Student();
$listeStudents=$std->findAll();
include("header.php");
$role=$_SESSION["user"]["role"];
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
            <button onclick="window.location.href='export_csv.php'">Export CSV</button>
            <button onclick="window.location.href='export_excel.php'">Export Excel</button>
            <button onclick="window.location.href='export_pdf.php'">Export PDF</button>
        </div>
        <br>
        <table class="table">
            <thead>
                <tr><td>id</td><td>image</td><td>name</td><td>birthday</td><td>section</td><td>Actions</td></tr>
            </thead>
            <tbody>
                <?php 
                foreach($listeStudents as $stud){
                    echo "<tr>";
                    foreach($stud as $key => $val){
                        echo $key=="image"?"<td><img src='".$val."' alt='profile' height=50 width=50></td>":"<td>".$val."</td>";
                    }
                    
                    echo "<td><a href='utils/read.php?id=".$stud->id."&type=student'><i class='bi bi-info-circle-fill'></i></a> ";
                    if($role== "admin"){
                        echo "<a href='utils/delete.php?id=".$stud->id."&type=student'><i class='bi bi-eraser-fill'></i></a> 
                        <a href='utils/edit?id=".$stud->id."&type=student'><i class='bi bi-pencil-square'></i></a>";
                    }
                    echo "</td></tr>";
                }
                ?>
            </tbody>
            
        </table>
    </div>
<?php

include("footer.php");
?>