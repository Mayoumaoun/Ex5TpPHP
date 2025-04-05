<?php
include("classes/users.php");
include("classes/isAuth.php");
include("classes/student.php");
$user=new User();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['form_type']) && $_POST['form_type']=='login') {
        $mail=$_POST['email'];
        $password=$_POST['password'];
        if($user->isUser($mail,$password) || $user->isAdmin($mail,$password)){
            // start his session
            $ses=new IsAuth();
            $ses->creerSession($user->getId($mail,$password),$user->getRole($mail,$password));
            header("Location: home.php");
            exit();
        }
        else{
            header("Location:login.php");
            exit();
        }
    } elseif (isset($_POST['form_type']) && $_POST['form_type']=='signup') {
        $email=$_POST['email'];
        if($user->mailExist($email)) {
            header("Location: signin.php");
            exit();}
        else{
        $data = [
            "username" => $_POST['username'],
            "email" => $_POST['email'],
            "role" => $_POST['role'],
            "password" => $_POST['password']
        ];
        $user->create($data);
        header("Location: login.php");
        exit();
    }
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['form_type']) && $_POST['form_type']=='add') {
        $data = [
            "name" => $_POST['name'],
            "birthday" => $_POST['birthday'],
            "section" => $_POST['section'],
            "image"=>"https://th.bing.com/th/id/R.1d9d4000e3ef34fba93a8f359e8ef9e2?rik=fDp1i%2fJVHPhlVQ&riu=http%3a%2f%2fwww.marktechpost.com%2fwp-content%2fuploads%2f2023%2f05%2f7309681-scaled.jpg&ehk=IgADd%2fEbiE2skKDk%2fFHhD%2bN8Ss1b4ypy2OFMTVYvHN4%3d&risl=&pid=ImgRaw&r=0"
        ];
        // if(isset($_FILES['image'])){
        //     $newFileName = 'uploads/'.uniqid().$_FILES['image']['name'];
        //     copy($_FILES['image']['tmp_name'], $newFileName);
        // }
        $std=new Student();
        $std->create($data);
        header("Location: students.php");
        exit();
    }

}
?>
