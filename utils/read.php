<link rel="stylesheet" href="../style.css">
<?php
include("../classes/student.php");
$res="";
$ret="";
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $user=new Student();
    $details=$user->findById($id);
    if($details){
       echo "<div class='container mt-4'>";
$res = "
    <div class='card p-4'>
        <h2 class='card-title text-center'>Student Details (ID: ".$details->id.")</h2>
        <div class='row'>
            <div class='col-md-4'>
                <img class='img-fluid' src='".$details->image."' alt='Profile Image'>
            </div>
            <div class='col-md-8'>
                <p><strong>Name:</strong> ".$details->name."</p>
                <p><strong>Birthday:</strong> ".$details->birthday."</p>
                <p><strong>Section:</strong> ".$details->section."</p>
            </div>
        </div>
    </div>
</div>";
    }else{
        $res = "<div class='alert alert-danger'>Student not found.</div>";

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
<?php
include("../footer.php");