<?php
require_once("connexion.php");
class Student{
    
    protected $db;
    protected $tableName;
    public function __construct()
    {
        $this->db = connexion::getInstance();
        $this->tableName = "student";
       
    }
    public function findAll()
    {
        $query = "SELECT s.id, s.image, s.name, s.birthday, c.designation from {$this->tableName} as s, section as c where s.section=c.id";
        $response = $this->db->query($query);
        $elements = $response->fetchAll(PDO::FETCH_OBJ);
        return $elements;
    }
    public function findById($id)
    {
        $query = "SELECT s.id, s.image, s.name, s.birthday, c.designation AS section
              FROM " . $this->tableName . " AS s 
              ,section AS c where s.section = c.id 
              and s.id = :id";

        $stmt = $this->db->prepare($query);
        $stmt->execute(['id' => $id]);
    
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function delete( $id)
    {
        $req = $this->db->prepare("DELETE  FROM {$this->tableName} WHERE id=:id");
        $req->execute(array('id'=>$id));
    }
    public function create($data)
    {   
        $names = implode(',', array_keys($data));
        $vals = ':' . implode(', :', array_keys($data));
        $req = $this->db->prepare("INSERT INTO $this->tableName ($names) VALUES ($vals)");
        $req->execute($data);
    }
}