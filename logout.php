<?php
include("classes/isAuth.php");
$ses=new IsAuth();
$ses->supprimerSession();
header("location:index.php");