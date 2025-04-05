<?php
include("header.php");
?>
    <div>
        <form action="handel.php" method="post">
            <input type="hidden" name="form_type" value="signup">
            <label for="username">Username: </label>
            <input type="text" name="username" id="username">
            <br>
            <label for="email">Email:  </label>
            <input type="email" name="email" id="email">
            <br>
            <label for="role">Role: </label>
            <label>
            <input type="radio" name="role" value="user"> User
            </label>
            <label>
            <input type="radio" name="role" value="admin"> Admin
            </label>
            <br>
            <label for="password">Password:  </label>
            <input type="password" name="password" id="password">
            <button type="submit" >Sign up</button>
        </form>
    </div>
<?php
include("footer.php");
?>