<?php
session_start();
class IsAuth{
    public function supprimerSession(){
        $_SESSION=[] ;
        session_unset();
        session_destroy();
        
    }
    public function isAuth(){
        return isset($_SESSION["user"]) ;
    }
    public function creerSession($val1,$val2 ){
        $_SESSION["user"] = ["id"=>$val1,"role"=>$val2];
    }
}