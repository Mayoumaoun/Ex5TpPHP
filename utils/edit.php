<?php
include("../classes/student.php");
$res="";
$ret="";

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $user=new Student();
    $details=$user->findById($id);
    if($details){
        $res="<div><h2>Student of id ".$details->id."</h2>
        <img src='".$details->image."' width=150 height=150>".$details->name."<br> <h3>birthday:</h3>  ".$details->birthday."<br><h3>section :</h3> ".$details->section."
        <br><br>";
    }
    $ret="../students.php";
}
    

include("../header.php");
?>
<div>
    <?php
    echo $res;
    ?>
    <button> <a href="<?php echo $ret;?>">Return</a></button>
</div>