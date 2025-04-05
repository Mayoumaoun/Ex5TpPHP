<?php
class connexion
{
    private static $_dbname = "plateforme";
    private static $_user = "root";
    private static $_pwd = "root123*/";
    private static $_host = "127.0.0.1:3305";

    private static $_bdd = null;

    private function __construct()
    {
        try {
            self::$_bdd = new PDO("mysql:host=" . self::$_host . ";dbname=" . self::$_dbname . ";charset=utf8", self::$_user, self::$_pwd, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'));
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public static function getInstance(): ?PDO
    {
        if (!self::$_bdd) {
            new connexion();
        }
        return (self::$_bdd);
    }
}