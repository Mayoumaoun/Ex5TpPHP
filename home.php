<?php
include("header.php");
?>
<?php 
    
    if(isset($_SESSION["user"])) echo "<div>
    <h1>Hello PHP lovers, welcome to your administration plateforme</h1>
</div>";
    else echo "<div>
    <h1> welcome to your administration plateforme</h1>
</div>";
    ?>

<?php

include("footer.php");
?>
