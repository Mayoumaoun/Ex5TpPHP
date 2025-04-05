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
                    $res.= "<td><a href='read.php?id=".$stud->id."'>Read</a> ";
                    $res.= "</td></tr>";
                }
    }
    $ret="../sections.php";
}


include("../header.php");
?>
<div>
<table class="table">
            <thead>
                <tr><td>id</td><td>image</td><td>name</td><td>birthday</td><td>section</td></tr>
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