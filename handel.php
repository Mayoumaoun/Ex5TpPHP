<?php
include("classes/users.php");
include("classes/isAuth.php");
include("classes/student.php");
session_start();
$user=new User();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['form_type']) && $_POST['form_type']=='login') {
        $mail=$_POST['email'];
        $password=$_POST['password'];

        if(! $mail || ! $password) {
            $_SESSION['errorMessage'] = "Veuillez remplir tous les champs.";
              header("Location: login.php");
              exit();
          }

        if($user->isUser($mail,$password) || $user->isAdmin($mail,$password)){
            $ses=new IsAuth();
            $ses->creerSession($user->getId($mail,$password),$user->getRole($mail,$password));
            header("Location:home1.php");
            exit();
        }
        else{
            $_SESSION['errorMessage'] = "Email ou mot de passe incorrect.";
            header("Location:login.php");
            exit();
        }
    } elseif (isset($_POST['form_type']) && $_POST['form_type']=='signup') {
        
        $username=$_POST['username'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $role=$_POST['role'];
        if (! $username || ! $email|| !$password || !$role) {
            $_SESSION['errorMessage'] = "Veuillez remplir tous les champs.";
            header("Location: signin.php");
            exit();
        }
        if($user->mailExist($email)) {
            $_SESSION['errorMessage']="Cet email est déjà utilisé.";
      header("Location: signin.php");
      exit();}
        else{
        $data = [
            "username" => $username,
            "email" => $email,
            "role" => $role,
            "password" => $hashedPassword = password_hash($password, PASSWORD_DEFAULT)

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
