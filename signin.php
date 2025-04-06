<?php
include("header.php");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
?>
    
    <link rel="stylesheet" href="style.css">
    <div class="conteneur">
    <div class="container">
    <form class="row g-3" action="handel.php" method="POST">
        <input type="hidden" name="form_type" value="signup">
        <div class="col-12">
            <label for="inputUserName" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username">
        </div>
        <div class="col-md-12">
            <label for="inputEmail4" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="col-md-12">
            <label for="inputPassword4" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
       
        <div class="col-md-12">
            <label for="inputUserType" class="form-label">Sign up  as:</label>
            <select id="inputUserType" class="form-select" name="role">
                <option name="role" value="admin">Admin</option>
                <option name="role" value="user" selected>User</option>
            </select>
        </div>
        
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary">Sign Up</button>
        </div>
  
    <?php if (isset($_SESSION['errorMessage'])){ ?>
         
  <div class="alert alert-danger">
  <?= $_SESSION['errorMessage']?>
  </div>
<?php  unset($_SESSION['errorMessage']);} ?>

<div class="col-12 text-center mt-3">
<p>Vous avez déjà un compte ? <a href="login.php">Connectez-vous</a></p>
</div>
</form> 
</div>
</div>
<?php include("footer.php");?>