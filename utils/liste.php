<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<?php
include("../classes/section.php");
$res="";
$ret="";
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $user=new Section();
    $details=$user->getListeStudent($id);
    if($details){
                foreach($details as $stud){
                    $res.="<tr>";
                    foreach($stud as $key => $val){
                        $res.= $key=="image"?"<td><img src='".$val."' alt='profile' height=50 width=50></td>":"<td>".$val."</td>";
                    }
                    $res.= "<td><a href='read.php?id=".$stud->id."&type=student'><i class='bi bi-info-circle-fill'></i></a> ";
                    $res.= "</td></tr>";
                }
    }
    $ret="../sections.php";
}


include("../header.php");
?>
<div class="container">
    <br>
    <div class=" alert alert-light" role="alert"> List of students</div>
    <br>
    <table class="table">
            <thead>
                <tr><td>Id</td><td>Name</td><td>Image</td><td>Birthday</td><td>Action</td></tr>
            </thead>
            <tbody>
                <?php echo $res;
                ?>
            </tbody>
            
            </table>
    <button> <a href="<?php echo $ret;?>">Return</a></button>
</div>


<?php
include("../footer.php");