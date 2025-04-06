<?php
include("header.php");

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>
    <link rel="stylesheet" href="style.css">
    <div class="conteneur">
    <div class="container">
      <br />
      <form class="row g-3" action="handel.php" method="post">
        <input type="hidden" name="form_type" value="login">
        <div class="col-md-12">
          <label for="inputEmail4" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" />
        </div>
        <div class="col-md-12">
          <label for="inputPassword4" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" />
        </div>
        <div class="col-md-5">
        </div>
        <div class="col-md-4">
          <button type="submit" class="btn btn-primary" name="login_submit">Log in</button>
        </div>
        <div class="col-md-4">
        </div>
        <?php if (isset($_SESSION['errorMessage'])){ ?>
  <div class="alert alert-danger">
  <?= $_SESSION['errorMessage']?>
</div>
<?php  unset($_SESSION['errorMessage']); } ?>
      </form>
    </div>
    </div>
<?php
include("footer.php");
?>