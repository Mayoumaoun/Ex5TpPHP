<?php
include("header.php");
?>
    <div>
        <form action="handel.php" method="post">
            <input type="hidden" name="form_type" value="login">
            <label for="email">Email:  </label>
            <input type="email" name="email" id="email">
            <br>
            <label for="password">Password:  </label>
            <input type="password" name="password" id="password">
            <button type="submit" name="login_submit">Login</button>
        </form>
    </div>
<?php
include("footer.php");
?>