<?php
class Pays extends Model{
    public function __construct(){
        $this->table = "pays";
        $this->getConnection();
    }

    function obtenirNomContinent() {
        $sql = "SELECT ID_PAYS, NOM_PAYS, NOM_CONTINENT FROM ".$this->table. " INNER JOIN CONTINENT ";
        $sql .= " ON PAYS.ID_CONTINENT=CONTINENT.ID_CONTINENT";
        $sql .= " ORDER BY ID_PAYS";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();    
    }

    public function inserer(string $nom, int $idContinent) {
        $insertQuery = "INSERT INTO pays (NOM_PAYS, ID_CONTINENT) VALUES (:nom_param, :id_continent_param)";
        $stmt = $this->_connexion->prepare($insertQuery);
    
        $stmt->bindParam(':nom_param', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':id_continent_param', $idContinent, PDO::PARAM_INT);

        $stmt->execute();
    }        

    public function modifier(int $id, string $nom, int $idContinent){
        $updateQuery = 'UPDATE ' . $this->table . ' SET NOM_PAYS = :nom_param, ID_CONTINENT = :id_continent_param WHERE ID_PAYS = :id_param';
        $stmt = $this->_connexion->prepare($updateQuery);

        $stmt->bindParam(':id_param', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nom_param', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':id_continent_param', $idContinent, PDO::PARAM_INT);

        $stmt->execute();
    }

    public function supprimer(int $id){
        $deleteQuery = 'DELETE FROM ' . $this->table . ' WHERE ID_PAYS = :id_param';
        $stmt = $this->_connexion->prepare($deleteQuery);
    
        $stmt->bindParam(':id_param', $id, PDO::PARAM_INT);
    
        $stmt->execute();
    }
}