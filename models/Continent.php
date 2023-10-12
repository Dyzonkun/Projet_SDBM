<?php
class Continent extends Model{
    public function __construct(){
        $this->table = "continent";
        $this->getConnection();
    }

    public function inserer(string $nom){
        $insertQuery = 'INSERT INTO continent (NOM_CONTINENT) VALUES (:nom_param)';
        $stmt = $this->_connexion->prepare($insertQuery);

        $stmt->bindParam(':nom_param', $nom, PDO::PARAM_STR);

        $stmt->execute();
    }

    public function modifier(int $id, string $nom) {
        $updateQuery = 'UPDATE ' . $this->table . ' SET NOM_CONTINENT = :nom_param WHERE ID_CONTINENT = :id_param';
        $stmt = $this->_connexion->prepare($updateQuery);
    
        $stmt->bindParam(':id_param', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nom_param', $nom, PDO::PARAM_STR);
    
        $stmt->execute();
    }

    public function supprimer(int $id) {
        $deleteQuery = 'DELETE FROM ' . $this->table . ' WHERE ID_CONTINENT = :id_param';
        $stmt = $this->_connexion->prepare($deleteQuery);
    
        $stmt->bindParam(':id_param', $id, PDO::PARAM_INT);
    
        $stmt->execute();
    }
}    