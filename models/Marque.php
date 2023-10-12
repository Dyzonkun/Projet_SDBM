<?php
class Marque extends Model{
    public function __construct(){
        $this->table = "marque";
        $this->getConnection();
    }

    public function getAll_with_pays_and_fabricant_null(){
        $getQuery = "SELECT ID_MARQUE, NOM_MARQUE, NOM_FABRICANT, NOM_PAYS 
                FROM ".$this->table. " LEFT JOIN fabricant ";
        $getQuery .= " ON marque.ID_FABRICANT=fabricant.ID_FABRICANT";
        $getQuery .= " INNER JOIN pays ON pays.ID_PAYS=marque.ID_PAYS";
        $getQuery .= " ORDER BY ID_MARQUE";
        $stmt = $this->_connexion->prepare($getQuery);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function update(int $id, string $nom, ?int $idFab, int $idPays) {

        if ($idFab === "NULL") {
            $updateQuery = "UPDATE " . $this->table . " SET NOM_MARQUE = :p_nom_marque, ID_FABRICANT = null, ID_PAYS = :p_id_pays WHERE ID_MARQUE = :id_param";
        } else {
        $updateQuery = "UPDATE ".$this->table." set NOM_MARQUE=:p_nom_marque, ID_FABRICANT=:p_id_fabricant, ID_PAYS=:p_id_pays WHERE ID_MARQUE=:id_param";
        }
        $stmt = $this->_connexion->prepare($updateQuery);
        $stmt->bindParam(':id_param', $id,  PDO::PARAM_INT );
        $stmt->bindParam(':p_nom_marque', $nom,  PDO::PARAM_STR );
        if ($idFab !== "NULL"){
        $stmt->bindParam(':p_id_fabricant', $idFab,  PDO::PARAM_INT );
        }
        $stmt->bindParam(':p_id_pays', $idPays,  PDO::PARAM_INT );
        $stmt->execute(); 
        
    }

    public function delete(int $id) {
        $deleteQuery = "DELETE FROM ".$this->table." WHERE ID_MARQUE=:id_param";
        $stmt = $this->_connexion->prepare($deleteQuery);
        $stmt->bindParam(':id_param', $id,  PDO::PARAM_INT );
        $stmt->execute();    
    }

    public function insert(string $nom, ?int $idFab, int $idPays) {
   
        $insertQuery = "INSERT INTO ".$this->table." (NOM_MARQUE,ID_FABRICANT, ID_PAYS) VALUES (:p_nom_marque,:p_id_fabricant, :p_id_pays)";
        $stmt = $this->_connexion->prepare($insertQuery);
        $stmt->bindParam(':p_nom_marque', $nom,  PDO::PARAM_STR );
        if ($idFab !== "NULL"){
        $stmt->bindParam(':p_id_fabricant', $idFab,  PDO::PARAM_INT );
        }
        $stmt->bindParam(':p_id_pays', $idPays,  PDO::PARAM_INT );          
       
        $stmt->execute(); 
    } 
    
}