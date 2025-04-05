<?php
require_once("connexion.php");
class repository
{
    protected $db;
    public function __construct()
    {
        $this->db = connexion::getInstance();
       
    }
    public function findAll($tableName)
    {
        $query = "SELECT * from {$tableName}";
        $response = $this->db->query($query);
        $elements = $response->fetchAll(PDO::FETCH_OBJ);
        return $elements;
    }
    public function findById($id,$tableName)
    {
        $query = "SELECT * from {$tableName} where id=$id";
        $response = $this->db->query($query);
        $elements = $response->fetchAll(PDO::FETCH_OBJ);
        return $elements;
    }
    public function delete($tableName, $id)
    {
        $req = $this->db->prepare('DELETE  FROM {$tableName} WHERE id=:id');
        $req->execute(array('id'=>$id));
    }
    public function create($tableName, $data)
    {   
        $names = implode(',', array_keys($data));
        $vals = ':' . implode(', :', array_keys($data));
        $req = $this->db->prepare("INSERT INTO $tableName ($names) VALUES ($vals)");
        $req->execute($data);
    }
}