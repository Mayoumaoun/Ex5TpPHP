<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<?php
include("classes/section.php");
$sect=new Section();
$listeSections=$sect->findAll();
include("header.php");
$role=$_SESSION["user"]["role"];
?>
        <br>
        <div class=" alert alert-light" role="alert"> List of students</div>
        <div class="container">
        
        <div class="export"></div>
        
        <table class="table">
            <thead>
                <tr><td>id</td><td>designation</td><td>description</td><td>Actions</td></tr>
            </thead>
            <tbody>
                <?php 
                foreach($listeSections as $stud){
                    echo "<tr>";
                    foreach($stud as $key => $val){
                        echo "<td>".$val."</td>";
                    }
                    echo "<td><a href='utils/liste.php?id=".$stud->id."&type=section'><i class='bi bi-list'></i></a> ";
                    echo "</td></tr>";
                }
                ?>
            </tbody>
        </table>
        </div>

<?php

include("footer.php");
?>