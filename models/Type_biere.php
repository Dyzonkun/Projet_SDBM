<?php
class Type_biere extends Model{
    public function __construct(){
        $this->table = "typebiere";
        $this->getConnection();
    }

    public function insert(string $nom)
    {
        $insertQuery = 'INSERT INTO typebiere (NOM_TYPE) VALUES (:nom_param)';
        $stmt = $this->_connexion->prepare($insertQuery);

        $stmt->bindParam(':nom_param', $nom, PDO::PARAM_STR);
        $stmt->execute();
    }
    public function modifier(int $id, string $nom)
    {
        $updateQuery = 'UPDATE ' . $this->table . ' SET NOM_TYPE = :nom_param WHERE ID_TYPE = :id_param';
        $stmt = $this->_connexion->prepare($updateQuery);

        $stmt->bindParam(':id_param', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nom_param', $nom, PDO::PARAM_STR);

        $stmt->execute();
    }
    public function supprimer(int $id)
    {
        $deleteQuery = 'DELETE FROM ' . $this->table . ' WHERE ID_TYPE = :id_param';
        $stmt = $this->_connexion->prepare($deleteQuery);

        $stmt->bindParam(':id_param', $id, PDO::PARAM_INT);

        $stmt->execute();
    }

}


