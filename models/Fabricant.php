<?php
class Fabricant extends Model{
    public function __construct(){
        $this->table = "fabricant";
        $this->getConnection();
    }

    public function update(int $id, string $nom) {
        $updateQuery = "UPDATE ".$this->table." set NOM_FABRICANT=:nom_param WHERE ID_FABRICANT=:id_param";
        $stmt = $this->_connexion->prepare($updateQuery);
        $stmt->bindParam(':id_param', $id,  PDO::PARAM_INT );
        $stmt->bindParam(':nom_param', $nom,  PDO::PARAM_STR );
        $stmt->execute();  
    }

    public function delete(int $id) {
        $deleteQuery = "DELETE FROM ".$this->table." WHERE ID_FABRICANT=:id_param";
        $stmt = $this->_connexion->prepare($deleteQuery);
        $stmt->bindParam(':id_param', $id,  PDO::PARAM_INT );
        $stmt->execute();    
    }

    public function insert(string $nom) {
        $insertQuery = "INSERT INTO ".$this->table." (NOM_FABRICANT) VALUES (:nom_param)";
        $stmt = $this->_connexion->prepare($insertQuery);
        $stmt->bindParam(':nom_param', $nom,  PDO::PARAM_STR );
        $stmt->execute();    
    }
}