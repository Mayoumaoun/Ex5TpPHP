<?php
require_once("connexion.php");
class User{
    
    protected $db;
    protected $tableName;
    public function __construct()
    {
        $this->db = connexion::getInstance();
        $this->tableName = "user";
       
    }
    public function findAll()
    {
        $query = "SELECT * from {$this->tableName}";
        $response = $this->db->query($query);
        $elements = $response->fetchAll(PDO::FETCH_OBJ);
        return $elements;
    }
    public function findById($id)
    {
        $query = "SELECT * from {$this->tableName} where id=$id";
        $response = $this->db->query($query);
        $elements = $response->fetch(PDO::FETCH_OBJ);
        return $elements;
    }
    public function delete( $id)
    {
        $req = $this->db->prepare('DELETE  FROM {$this->tableName} WHERE id=:id');
        $req->execute(array('id'=>$id));
    }
    public function create($data)
    {   
        $names = implode(',', array_keys($data));
        $vals = ':' . implode(', :', array_keys($data));
        $req = $this->db->prepare("INSERT INTO $this->tableName ($names) VALUES ($vals)");
        
        return $req->execute($data);
    }
    public function isAdmin( $email,$password ){
        $req = $this->db->prepare("SELECT * FROM {$this->tableName} WHERE email = :email AND role = 'admin'");
        $req->execute(["email" => $email]);
        $res = $req->fetch(PDO::FETCH_OBJ);
        return $res && password_verify($password, $res->password);
    }
    public function isUser( $email,$password ){
        $req = $this->db->prepare("SELECT * from {$this->tableName} where email=:email and role='user'");
        $req->execute(array("email"=>$email));
        $res = $req->fetch(PDO::FETCH_OBJ);
        return ($res && password_verify($password, $res->password));
    }
    public function mailExist( $email){
        $req = $this->db->prepare("SELECT * from {$this->tableName} where email=:email");
        $req->execute(array("email"=>$email));
        $res = $req->fetch(PDO::FETCH_OBJ);
        if($res) return true;
        return false;
    }
    public function getId( $email,$password ){
        $req = $this->db->prepare("SELECT id, password from {$this->tableName} where email=:email ");
        $req->execute(array("email"=>$email));
        $res = $req->fetch(PDO::FETCH_OBJ);
        if ($res && password_verify($password, $res->password)) {
            return $res->id;
        }
    
        return null;
    }
    public function getRole( $email,$password ){
        $req = $this->db->prepare("SELECT role,password from {$this->tableName} where email=:email  ");
        $req->execute(array("email"=>$email));
        $res = $req->fetch(PDO::FETCH_OBJ);
        if ($res && password_verify($password, $res->password)) {
            return $res->role;
        }
    
        return null;
    }
    public function findAllAdmin()
    {
        $query = "SELECT * from {$this->tableName} where role='admin'";
        $response = $this->db->query($query);
        $elements = $response->fetchAll(PDO::FETCH_OBJ);
        return $elements;
    }
    public function findAllUser()
    {
        $query = "SELECT * from {$this->tableName} where role='user'";
        $response = $this->db->query($query);
        $elements = $response->fetchAll(PDO::FETCH_OBJ);
        return $elements;
    }
}