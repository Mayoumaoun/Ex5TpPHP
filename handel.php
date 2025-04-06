<?php
include("classes/users.php");
include("classes/isAuth.php");
include("classes/student.php");
include("classes/section.php");
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
        $imagePath = "";
        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
            $tmpName = $_FILES['image']['tmp_name'];
            $originalName = basename($_FILES['image']['name']);
            $uniqueName = uniqid() . "_" . $originalName;
            $destination = "uploads/" . $uniqueName;

            if (move_uploaded_file($tmpName, $destination)) {
                $imagePath = $uniqueName;
            }
        }
        
        $data = [
            "name" => $_POST['name'],
            "birthday" => $_POST['birthday'],
            "section" => $_POST['section'],
            "image" => $imagePath        ];
        
        $std=new Student();
        $std->create($data);
        header("Location: students.php");
        exit();
    }
    if (isset($_POST['form_type']) && $_POST['form_type'] == 'add_section') {
        $data = [
            "designation" => $_POST['designation'],
            "description" => $_POST['description']
        ];
        $sect = new Section();
        $sect->create($data);
        header("Location: sections.php");
        exit();
    }

}
?>
