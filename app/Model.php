<?php
abstract class Model{
    // information de base de données
    private $host ='localhost';
    private $db_name = 'sdbm_v2';
    private $username = 'root';
    private $password = '';

    // Propriété contenant le connexion
    protected $_connexion;

    // Propriété contenant les informations de requetes
    public $table;
    public $id;

    public function getConnection(){
        $this->_connexion = null;

        try{
            $this->_connexion = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->_connexion->exec('set names utf8');
        }catch(PDOException $exception){
            echo'Erreur :'. $exception->getMessage();
        }
    }   

    public function getAll(){
        $sql = "SELECT * FROM ".$this->table;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function getOne(){
        $sql = "SELECT * FROM " . $this->table . " WHERE id=" . $this->id;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch();
    }
}