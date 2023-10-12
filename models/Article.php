<?php
class Article extends Model{
    public function __construct(){
        $this->table = "article";
        $this->getConnection();
    }

    public function obtenirArticle() {

        $sql = "SELECT ID_ARTICLE, NOM_ARTICLE, NOM_MARQUE, NOM_TYPE, NOM_COULEUR, TITRAGE, VOLUME, PRIX_ACHAT, article.ID_MARQUE, article.ID_TYPE, article.ID_COULEUR FROM " . $this->table;
        $sql .= " INNER JOIN marque ON marque.ID_MARQUE = article.ID_MARQUE ";
        $sql .= " INNER JOIN couleur ON couleur.ID_COULEUR = article.ID_COULEUR";
        $sql .= " INNER JOIN typebiere ON typebiere.ID_TYPE = article.ID_TYPE";
        $sql .= " ORDER BY " . $this->table . ".ID_ARTICLE";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function inserer(string $nom, string $prix, string $volume, string $titrage, int $idMarque, int $idCouleur, int $idType ) {
        $insertQuery = "INSERT INTO " . $this->table . " (NOM_ARTICLE, PRIX_ACHAT, VOLUME, TITRAGE, ID_MARQUE, ID_COULEUR, ID_TYPE) VALUES (:nom_param, :prix_param, :volume_param, :titrage_param, :marque_param, :couleur_param, :type_param )";
        $stmt = $this->_connexion->prepare($insertQuery);

        $stmt->bindParam(':nom_param', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':prix_param', $prix, PDO::PARAM_STR);
        $stmt->bindParam(':volume_param', $volume, PDO::PARAM_STR);
        $stmt->bindParam(':titrage_param', $titrage, PDO::PARAM_STR);
        $stmt->bindParam(':marque_param', $idMarque, PDO::PARAM_INT);
        $stmt->bindParam(':couleur_param', $idCouleur, PDO::PARAM_INT);
        $stmt->bindParam(':type_param', $idType, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function supprimer(int $idArticle) {
        $deleteQuery = 'DELETE FROM ' . $this->table . ' WHERE ID_ARTICLE = :id_param';
        $stmt = $this->_connexion->prepare($deleteQuery);

        $stmt->bindParam(':id_param', $idArticle, PDO::PARAM_INT);

        $stmt->execute();
    }

    public function modifier(int $idArticle, string $nom, string $prix ,string $volume, string $titrage, int $idMarque, int $idCouleur, int $idType ) {
        $updateQuery = 'UPDATE ' . $this->table . ' SET NOM_ARTICLE = :modif_article_name, PRIX_ACHAT = :modif_article_prixachat, VOLUME = :modif_article_volume, TITRAGE = :modif_article_titrage, ID_MARQUE = :id_marque_param, ID_COULEUR = :id_couleur_param, ID_TYPE = :id_type_param  WHERE ID_ARTICLE = :id_param';
        $stmt = $this->_connexion->prepare($updateQuery);

        $stmt->bindParam(':id_param', $idArticle, PDO::PARAM_INT);
        $stmt->bindParam(':modif_article_name', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':modif_article_prixachat', $prix, PDO::PARAM_STR);
        $stmt->bindParam(':modif_article_volume', $volume, PDO::PARAM_INT);
        $stmt->bindParam(':modif_article_titrage', $titrage, PDO::PARAM_STR);
        $stmt->bindParam(':id_marque_param', $idMarque, PDO::PARAM_INT);
        $stmt->bindParam(':id_couleur_param', $idCouleur, PDO::PARAM_INT);
        $stmt->bindParam(':id_type_param', $idType, PDO::PARAM_INT);
        $stmt->execute();
    }
}

