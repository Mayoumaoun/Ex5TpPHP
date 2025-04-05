<?php
require_once("connexion.php");
class Section{
    
    protected $db;
    protected $tableName;
    public function __construct()
    {
        $this->db = connexion::getInstance();
        $this->tableName = "section";
       
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
        $req->execute($data);
    }
    public function getListeStudent($id){
        $req = $this->db->prepare("SELECT s.id, s.name , s.image , s.birthday from student as s, section as c where c.id=s.section and c.id=:id");
        $req->execute(array('id'=>$id));
        $result = $req->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
}